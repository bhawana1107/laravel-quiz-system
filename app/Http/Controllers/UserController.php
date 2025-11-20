<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\Mcq;
use App\Models\User;
use App\Models\Record;
use App\Models\MCQ_Record;
use App\Mail\VerifyUser;
use App\Mail\UserForgotPassword;

class UserController extends Controller
{
    function welcome()
    {
        $categories = Category::withCount('quizzes')->orderBy('quizzes_count', 'desc')->take(5)->get();
        $quizData = Quiz::withCount('Records')->orderBy('records_count', 'desc')->take(5)->get();
        $quizmcq = Quiz::withCount('mcqs')   // count number of questions
            ->orderBy('id', 'desc')
            ->take(8)
            ->get();

        return view('welcome', ['categories' => $categories, 'quizData' => $quizData, 'quizmcq' => $quizmcq]);
    }

    // Function Categories
    function categories()
    {
        $categories = Category::withCount('quizzes')->orderBy('quizzes_count', 'desc')->paginate(5);
        return view('categories-list', ['categories' => $categories]);
    }

    // Function quizzes
    function quizzes()
    {
        $quizzes = Quiz::withCount('mcqs')->orderBy('mcqs_count', 'desc')->paginate(6);
        return view('all-quiz-list', ['quizzes' => $quizzes]);
    }

    // User quiz list function
    function userQuizList($id, $category)
    {
        $quizData = Quiz::withCount('mcqs')->where('category_id', $id)->paginate(5);
        return view('user-quiz-list', ["quizData" => $quizData, "category" => $category]);
    }

    // Start quiz function
    function startQuiz($id, $name)
    {
        $quizCount = Mcq::where('quiz_id', $id)->count();
        $mcqs = Mcq::where('quiz_id', $id)->get();
        Session::put('firstMCQ', $mcqs[0]);

        $quizName = $name;
        return view('start-quiz', ['quizName' => $quizName, 'quizCount' => $quizCount]);
    }

    // User signup function
    function userSignup(Request $req)
    {
        $validate = $req->validate([
            'name' => 'required | string | min:3',
            'email' => 'required | email | unique:users',
            'password' => 'required | min:3 | confirmed',
        ]);

        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
        ]);

        //
        $link = Crypt::encryptString($user->email);
        $link = url('verify-user/' . $link);
        Mail::to($user->email)->send(new VerifyUser($link));
        // 
        if ($user) {
            Session::put('user', $user);
            if (Session::has('redirectToQuiz')) {
                $redirectTo = Session::get('redirectToQuiz');
                Session::forget('redirectToQuiz');
                return redirect($redirectTo)->with('message-success', "User registered successfully, please check email to verify account");
            }
            return redirect('/')->with('message-success', "User registered successfully, please check email to verify account");
        }
    }

    // User logout function
    function userLogout()
    {
        Session::forget('user');
        return redirect('/')->with('message-success', "User logged out successfully");
    }

    // User signup quiz function
    function userSignupQuiz()
    {
        Session::put('redirectToQuiz', url()->previous());
        return view('/user-signup');
    }

    // User login function
    function userLogin(Request $req)
    {
        $validate = $req->validate([
            'email' => 'required | email',
            'password' => 'required | min:3',
        ]);

        $user = User::where('email', $req->email)->first();
        if ($user) {
            if (Hash::check($req->password, $user->password)) {
                Session::put('user', $user);
                if (Session::has('redirectToQuiz')) {
                    $redirectTo = Session::get('redirectToQuiz');
                    Session::forget('redirectToQuiz');
                    return redirect($redirectTo)->with('message-success', "User logged in successfully");
                }
                return redirect('/')->with('message-success', "User logged in successfully");
            } else {
                return back()->withErrors(['user' => 'Invalid Credentials']);
            }
        } else {
            return back()->withErrors(['user' => 'No account found with this email']);
        }
    }

    // User login quiz function
    function userLoginQuiz()
    {
        Session::put('redirectToQuiz', url()->previous());
        return view('/user-login');
    }

    // MCQ function
    function mcq($id, $name)
    {
        $record = new Record();
        $record->user_id = Session::get('user')->id;
        $record->quiz_id = Session::get('firstMCQ')->quiz_id;
        $record->status = 1;
        if ($record->save()) {
            $currentQuiz = [];
            $currentQuiz['totalMcq'] = Mcq::where('quiz_id', Session::get('firstMCQ')->quiz_id)->count();
            $currentQuiz['currentMcq'] = 1;
            $currentQuiz['quizName'] = $name;
            $currentQuiz['quizId'] = Session::get('firstMCQ')->quiz_id;
            $currentQuiz['recordId'] = $record->id;
            Session::put('currentQuiz', $currentQuiz);
            $mcqData = Mcq::find($id);
            return view('mcq-page', ['quizName' => $name, 'mcqData' => $mcqData]);
        } else {
            return back()->withErrors(['quiz' => 'Unable to start the quiz. Please try again later.']);
        }
    }

    // Submit and next function
    function submitAndNext(Request $req, $id)
    {
        $currentQuiz = Session::get('currentQuiz');
        $currentQuiz['currentMcq'] += 1;
        $mcqData = Mcq::where([
            ['id', '>', $id],
            ['quiz_id', '=', $currentQuiz['quizId']]
        ])->first();
        $isExist = MCQ_Record::where([
            ['record_id', '=', $currentQuiz['recordId']],
            ['mcq_id', '=', $req->mcq_id],
        ])->count();

        if ($isExist < 1) {
            $mcq_record = new MCQ_Record();
            $mcq_record->record_id = $currentQuiz['recordId'];
            $mcq_record->user_id = Session::get('user')->id;
            $mcq_record->mcq_id = $req->mcq_id;
            $mcq_record->select_answer = $req->option;
            if ($req->option == Mcq::find($req->mcq_id)->correct_ans) {
                $mcq_record->is_correct = 1;
            } else {
                $mcq_record->is_correct = 0;
            }
            $mcq_record->save();
        }
        Session::put('currentQuiz', $currentQuiz);
        if ($mcqData) {
            return view('mcq-page', ['quizName' => $currentQuiz['quizName'], 'mcqData' => $mcqData]);
        } else {
            $resultData = MCQ_Record::withMCQ()->where('record_id', $currentQuiz['recordId'])->get();
            $correct_ans = MCQ_Record::where([
                ['record_id', '=', $currentQuiz['recordId']],
                ['is_correct', '=', 1],
            ])->count();

            $record = Record::find($currentQuiz['recordId']);
            if ($record) {
                $record->status = 2;
                $record->update();
            }
            return view('quiz-result', ['resultData' => $resultData, 'correct_ans' => $correct_ans]);
        }
    }

    // User Details Function
    function userDetails()
    {
        $quizRecord = Record::withQuiz()->where('user_id', Session::get('user')->id)->paginate(10);
        return view('user-details', ['quizRecord' => $quizRecord]);
    }

    // Search Quiz Function
    function searchQuiz(Request $req)
    {
        $term = trim($req->search);

        // 1) CATEGORY SEARCH
        $categories = Category::withCount('quizzes')
            ->where('name', 'LIKE', "%{$term}%")
            ->orderBy('name')
            ->get();

        if ($categories->count() > 0) {
            // If category found → show category table
            return view('quiz-search', [
                'search' => $term,
                'type' => 'category',
                'items' => $categories
            ]);
        }

        // 2) QUIZ + MCQ SEARCH
        $quizzes = Quiz::withCount('mcqs')
            ->where('name', 'LIKE', "%{$term}%")

            // quiz matching by category name
            ->orWhereHas('category', function ($q) use ($term) {
                $q->where('name', 'LIKE', "%{$term}%");
            })

            ->with('category')
            ->distinct()
            ->paginate(5)
            ->appends(['search' => $term]);

        return view('quiz-search', [
            'search' => $term,
            'type' => 'quiz',
            'items' => $quizzes
        ]);
    }

    // Verify User
    function verifyUser($email)
    {
        $orgEmail = Crypt::decryptString($email);
        $user = User::where('email', $orgEmail)->first();
        if ($user) {
            $user->active = 2;
            if ($user->save()) {
                return redirect('/')->with('message-success', "User Verified Successfully");
            }
        }
    }

    // user forgot password Function
    function userForgotPassword(Request $req)
    {
        $link = Crypt::encryptString($req->email);
        $link = url('/user-forgot-password/' . $link);
        Mail::to($req->email)->send(new UserForgotPassword($link));
        return redirect("/")->with('message-success', "Password reset link sent to your email");
    }

    // User reset forgot password fucntion
    function userResetForgotPassword($email)
    {
        $orgEmail = Crypt::decryptString($email);
        return view('user-set-forgot-password', ['email' => $orgEmail]);
    }

    // User Set forgot password function
    function userSetForgotPassword(Request $req)
    {
        $validate = $req->validate([

            'email' => 'required | email',
            'password' => 'required | min:3 | confirmed',
        ]);

        $user = User::where('email', $req->email)->first();

        if ($user) {
            $user->password = Hash::make($req->password);
            if ($user->save()) {
                return  redirect('user-login')->with('message-success', "Password reset successfully, please login with new password");
            }
        }
    }

    // certificate function
    function certificate()
    {
        $data = [];

        $data['quiz'] = str_replace('-', ' ', Session::get('currentQuiz')['quizName']);
        $data['name'] = Session::get('user')['name'];

        return view('certificate', ['data' => $data]);
    }

    // Download Certificate
    function downloadCertificate()
    {
        $data = [];

        $data['quiz'] = str_replace('-', ' ', Session::get('currentQuiz')['quizName']);
        $data['name'] = Session::get('user')['name'];

        $html =  view('download-certificate', ['data' => $data])->render();
        return response(
            Browsershot::html($html)->pdf()
        )->withHeaders(
            [
                'content-Type' => 'application/pdf',
                'content-Disposition' => 'attachment; filename=certificate.pdf'
            ]
        );
    }
}
