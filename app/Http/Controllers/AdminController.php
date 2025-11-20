<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\Mcq;
use App\Models\User;

class AdminController extends Controller
{
    // Admin login function
    function login(Request $req)
    {
        $validate = $req->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $admin = Admin::where([
            ['name', '=', $req->name],
            ['password', '=', $req->password]
        ])->first();

        if (!$admin) {
            return back()->withErrors([
                'user' => 'User Does Not Exist! Please Check Your Credientials Again.'
            ]);
        }

        Session::put('admin', $admin);
        return redirect('admin-dashboard');
    }

    // Admin dashboard function
    function dashboard()
    {
        $admin = Session::get('admin');
        if ($admin) {
            $users = User::orderBy('id', 'desc')->paginate(10);
            return view('admin-dashboard', ["name" => $admin->name, 'users' => $users]);
        } else {
            return redirect('admin');
        }
    }

    // Admin categories function
    function categories()
    {
        $categories = Category::paginate(5);
        $admin = Session::get('admin');
        if ($admin) {
            return view('categories', ["name" => $admin->name, "categories" => $categories]);
        } else {
            return redirect('admin');
        }
    }

    // Admin logout function
    function logout()
    {
        Session::forget('admin');
        return redirect('admin');
    }

    // Add category function
    function addCategory(Request $req)
    {
        $validation = $req->validate([
            'category-name' => 'required | min:3 | unique:categories,name'
        ]);

        $admin = Session::get('admin');
        $category = new Category();
        $category->name = $req->input('category-name');
        $category->creator = $admin->name;
        if ($category->save()) {
            session()->flash('category-added', $category->name . ' Category Added Successfully!');
        }
        return redirect('admin-categories');
    }

    // Delete category function
    function deleteCategory($id)
    {
        $isDeleted = Category::find($id)->delete();
        if ($isDeleted) {
            session()->flash('category-deleted', 'Category Deleted Successfully!');
        }
        return redirect('admin-categories');
    }

    // Add quiz function
    function addQuiz()
    {
        $admin = Session::get('admin');
        $categories = Category::get();
        $totalMCQs = 0;
        if ($admin) {
            $quizName = request('quiz_name');
            $categoryId = request('category_id');

            $existinQuiz = Quiz::where('name', $quizName)->where('category_id', $categoryId)->first();

            if ($existinQuiz) {
                return back()->withErrors([
                    'quiz' => 'Quiz with the same name already exists in the selected category. Please choose a different name.'
                ]);
            } elseif ($quizName && $categoryId && !Session::has('quizDetails')) {
                $quiz = new Quiz();
                $quiz->name = $quizName;
                $quiz->category_id = $categoryId;
                if ($quiz->save()) {
                    Session::put('quizDetails', $quiz);
                }
            } else {
                $quiz = Session::get('quizDetails');

                if ($quiz && isset($quiz->id)) {
                    $totalMCQs = Mcq::where('quiz_id', $quiz->id)->count();
                } else {
                    $totalMCQs = 0;
                }
            }
            return view('add-quiz', ["name" => $admin->name, "categories" => $categories, "totalMCQs" => $totalMCQs]);
        } else {
            return redirect('admin');
        }
    }


    // Admin mcqs function
    function addMCQs(Request $req)
    {

        $req->validate([
            'question' => 'required | min:5',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'correct_ans' => 'required'
        ]);

        $quiz = Session::get('quizDetails');
        $admin = Session::get('admin');
        $mcq = new Mcq();
        $mcq->question = $req->input('question');
        $mcq->a = $req->input('a');
        $mcq->b = $req->input('b');
        $mcq->c = $req->input('c');
        $mcq->d = $req->input('d');
        $mcq->correct_ans = $req->input('correct_ans');
        $mcq->admin_id = $admin->id;
        $mcq->quiz_id = $quiz->id;
        $mcq->category_id = $quiz->category_id;

        if ($mcq->save()) {
            if ($req->submit == "add-more") {
                $quiz = Session::get('quizDetails');
                return redirect('add-quiz');
                // return redirect(back());
            } else {
                Session::forget('quizDetails');
                return redirect('/admin-categories');
            }
        }
    }

    function addQuestionByName($quizName)
    {
        $admin = Session::get('admin');
        if (!$admin) {
            return redirect('admin');
        }
        $quiz = Quiz::where('name', str_replace('-', ' ', $quizName))->first();
        if (!$quiz) {
            return back()->withErrors(['quiz' => 'Quiz not found.']);
        }
        $totalMCQs = Mcq::where('quiz_id', $quiz->id)->count();
        Session::put('quizDetails', $quiz);
        return view('add-quiz', [
            'quizName' => $quiz->name,
            'categoryId' => $quiz->category_id,
            'categoryName' => $quiz->category->name,
            'totalMCQs' => $totalMCQs,
            'name' => $admin->name
        ]);
    }

    // End quiz function
    function endQuiz()
    {
        Session::forget('quizDetails');
        return redirect('/admin-categories');
    }

    // Show quiz function
    function showQuiz($id, $quizName)
    {
        $admin = Session::get('admin');
        $quiz = Quiz::find($id);
        $categoryId = $quiz->category_id;
        $categoryName = $quiz->category->name;
        $mcqs = Mcq::where('quiz_id', $id)->get();
        if ($admin) {
            return view('show-quiz', [
                "name" => $admin->name,
                "mcqs" => $mcqs,
                "quizName" => $quizName,
                "categoryId" => $categoryId,
                "categoryName" => $categoryName,
            ]);
        } else {
            return redirect('admin');
        }
    }

    // Quiz list function
    function quizList($id, $category)
    {
        $admin = Session::get('admin');

        if ($admin) {
            $quizData = Quiz::where('category_id', $id)->get();

            return view('quiz-list', ["name" => $admin->name, "quizData" => $quizData, "category" => $category]);
        } else {
            return redirect('admin');
        }
    }

    // Edit Category function
    function editCategory($id, $category)
    {
        $admin = Session::get('admin');
        if ($admin) {
            $categoryData = Category::where('id', $id)->where('name', str_replace('-', ' ', $category))->first();
            return view('editCategory', ["name" => $admin->name, "categoryData" => $categoryData]);
        } else {
            return redirect('admin');
        }
    }

    // Update Category Fucntion
    function updateCategory(Request $req)
    {
        $categoryName = $req->input('category-name');
        $categoryId = $req->input('categoryid');

        $existingCategory = Category::where('name', $categoryName)->first();
        if ($existingCategory) {
            return back()->withErrors([
                'category' => 'category already exists!'
            ]);
        } else {
            $category = Category::find($categoryId);
            $category->name = $categoryName;
            if ($category->save()) {
                session()->flash('category-updated', 'Category Updated Successfully!');
                return redirect('admin-categories');
            }
        }
    }

    // Edit Quiz Function
    function editQuiz($id, $quizName)
    {
        $admin = Session::get('admin');
        if ($admin) {
            $quizData = Quiz::where('id', $id)->where('name', str_replace('-', ' ', $quizName))->first();
            return view('editQuiz', ["name" => $admin->name, "quizData" => $quizData]);
        } else {
            return redirect('admin');
        }
    }

    // Update Quiz Function
    function updateQuiz(Request $req)
    {
        $quizName = $req->input('quiz-name');
        $quizId = $req->input('quiz-id');

        $existingQuiz = Quiz::where('name', $quizName)->first();
        if ($existingQuiz) {
            return back()->withErrors([
                'quiz' => 'quiz already exists!'
            ]);
        } else {
            $quiz = Quiz::find($quizId);
            $quiz->name = $quizName;
            if ($quiz->save()) {
                session()->flash('quiz', 'Quiz Updated Successfully!');
                return redirect('quiz-list/' . $quiz->category_id . "/" . str_replace(' ', '-', $quiz->category->name));
            }
        }
    }


    // Delete Quiz Function
    function deleteQuiz($id)
    {
        $category_id = Quiz::find($id)->category_id;
        $categoryName = Category::find($category_id)->name;
        $isDeleted = Quiz::find($id)->delete();
        if ($isDeleted) {
            session()->flash('quiz', 'Quiz Deleted Successfully!');
            return redirect('quiz-list/' . $category_id . "/" . $categoryName);
        }
    }

    // Show Mcq Question each Function
    function showMcq($id)
    {
        $admin = Session::get('admin');
        $mcqs = Mcq::where('id', $id)->get();
        $quizName = $mcqs[0]->quiz->name;
        if ($admin) {
            return view('show-mcq', ["name" => $admin->name, "mcqs" => $mcqs, "quizName" => $quizName]);
        } else {
            return redirect('admin');
        }
    }

    // Edit Mcq Function
    function editMcq($id)
    {
        $admin = Session::get('admin');
        $mcqs = Mcq::where('id', $id)->first();
        $quizName = $mcqs->quiz->name;
        if ($admin) {
            return view('editMcq', ["name" => $admin->name, "mcqs" => $mcqs, "quizName" => $quizName]);
        } else {
            return redirect('admin');
        }
    }

    // Update Mcq Function
    function updateMcq(Request $req)
    {
        $mcqQuestion = $req->input('mcq-question');
        $mcqA = $req->input('mcq-a');
        $mcqB = $req->input('mcq-b');
        $mcqC = $req->input('mcq-c');
        $mcqD = $req->input('mcq-d');
        $mcqCorrect = $req->input('correct_ans');
        $mcqId = $req->input('mcq-id');
        $existingMcq = Mcq::where([
            ['question', '=', $mcqQuestion],
            ['a', '=', $mcqA],
            ['b', '=', $mcqB],
            ['c', '=', $mcqC],
            ['d', '=', $mcqD],
            ['correct_ans', '=', $mcqCorrect]
        ])->first();

        if ($existingMcq) {
            return back()->withErrors([
                'mcq-msg' => 'Mcq already exists!'
            ]);
        } else {
            $mcq = Mcq::find($mcqId);
            $mcq->update([
                'question' => $mcqQuestion,
                'a' => $mcqA,
                'b' => $mcqB,
                'c' => $mcqC,
                'd' => $mcqD,
                'correct_ans' => $mcqCorrect
            ]);
            if ($mcq->save()) {
                session()->flash('mcq-msg', 'Mcq Updated Successfully!');
                $mcqQuizid = $mcq->quiz_id;
                $mcqQuizname = Quiz::find($mcqQuizid)->name;
                return redirect('show-quiz/' . $mcqQuizid . '/' . str_replace(' ', '-', $mcqQuizname));
            }
        }
    }

    // Delete Mcq function 
    function deleteMcq($id)
    {
        $mcq = Mcq::find($id);
        $mcqQuizid = $mcq->quiz_id;
        $mcqQuizname = Quiz::find($mcqQuizid)->name;
        $isDeleted = Mcq::find($id)->delete();
        if ($isDeleted) {
            session()->flash('mcq-msg', 'Mcq Deleted Successfully!');
            return redirect('show-quiz/' . $mcqQuizid . '/' . $mcqQuizname);
        }
    }
}
