<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\Mcq;

class AdminController extends Controller
{
    // Admin login function
    function login(Request $req){

        // Validate the incoming request
        $validate = $req->validate([
            'name' => 'required',
            'password' => 'required'
        ]);


        // Check if admin exists with given credentials
        $admin = Admin::where([
            ['name', '=', $req->name],
            ['password', '=', $req->password]
        ])->first();

        if(!$admin){
            return back()->withErrors([
                'user' => 'User Does Not Exist! Please Check Your Credientials Again.'
            ]);
        }

        Session::put('admin', $admin);
        return redirect('admin-dashboard');
    }


    // Admin dashboard function
    function dashboard(){
        $admin = Session::get('admin');
        if($admin){
            return view('admin-dashboard', ["name" => $admin->name]);
        }else{
            return redirect('admin');
        }
    }


    // Admin categories function
    function categories(){
        $categories = Category::get();
        $admin = Session::get('admin');
        if ($admin) {
            return view('categories', ["name" => $admin->name, "categories" => $categories]);
        } else {
            return redirect('admin');
        }
    }
    


    // Admin logout function
    function logout(){
        Session::forget('admin');
        return redirect('admin');
    }


    // Add category function
    function addCategory(Request $req){
        $validation = $req->validate([
            'category-name' => 'required | min:3 | unique:categories,name'
        ]);

        $admin = Session::get('admin');

        $category = new Category();
        $category->name = $req->input('category-name');
        $category->creator = $admin->name;
        if($category->save()){
            session()->flash('category-added', $category->name .' Category Added Successfully!');
        }
        return redirect('admin-categories');
    }


    // Delete category function
    function deleteCategory($id){
       $isDeleted = Category::find($id)->delete();
       if($isDeleted){
            session()->flash('category-deleted', 'Category Deleted Successfully!');
       }
       return redirect('admin-categories');
    }


    // Add quiz function
    function addQuiz(){
        $admin = Session::get('admin');
        $categories = Category::get();
        if ($admin) {
            $quizName = request('quiz_name');
            $categoryId = request('category_id');

            if ($quizName && $categoryId && !Session::has('quizDetails')) {
                $quiz = new Quiz();
                $quiz->name = $quizName;
                $quiz->category_id = $categoryId;
                if ($quiz->save()) {
                    Session::put('quizDetails', $quiz);
                }
            }
            return view('add-quiz', ["name" => $admin->name, "categories" => $categories]);
        } else {
            return redirect('admin');
        }
    }


    // Admin mcqs function
    function addMCQs(Request $req){

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

      if($mcq->save()){
           if($req->submit=="add-more"){
            return redirect(url()->previous());
          }else{
                Session::forget('quizDetails');
            return redirect('/admin-categories');
           }
      }
    }


    // End quiz function
    function endQuiz(){
        Session::forget('quizDetails');
        return redirect('/admin-categories');   
    }
}