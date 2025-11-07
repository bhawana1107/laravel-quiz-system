<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\MCQ;
use App\Models\User;
use App\Models\Record;
use App\Models\MCQ_Record;

class UserController extends Controller
{
    function welcome()
    {
        $categories = Category::withCount('quizzes')->get();
        return view('welcome', ['categories' => $categories]);
    }

    // User quiz list function
    function userQuizList($id, $category)
    {
        $quizData = Quiz::withCount('mcqs')->where('category_id', $id)->get();
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
        if ($user) {
            Session::put('user', $user);
            if (Session::has('redirectToQuiz')) {
                $redirectTo = Session::get('redirectToQuiz');
                Session::forget('redirectToQuiz');
                return redirect($redirectTo);
            }
            return redirect('/');
        }
    }




    // User logout function
    function userLogout()
    {
        Session::forget('user');
        return redirect('/');
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
                    return redirect($redirectTo);
                }
                return redirect('/');
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
            $currentQuiz['totalMcq'] = MCQ::where('quiz_id', Session::get('firstMCQ')->quiz_id)->count();
            $currentQuiz['currentMcq'] = 1;
            $currentQuiz['quizName'] = $name;
            $currentQuiz['quizId'] = Session::get('firstMCQ')->quiz_id;
            $currentQuiz['recordId'] = $record->id;
            Session::put('currentQuiz', $currentQuiz);
            $mcqData = MCQ::find($id);
            return view('mcq-page', ['quizName' => $name, 'mcqData' => $mcqData]);
        } else {
            return back()->withErrors(['quiz' => 'Unable to start the quiz. Please try again later.']);
        }
    }


    // Submit and next function
    function submitAndNext(Request $req ,$id)
    {
        $currentQuiz = Session::get('currentQuiz');
        $currentQuiz['currentMcq'] += 1;
        $mcqData = MCQ::where([
            ['id', '>', $id],
            ['quiz_id', '=', $currentQuiz['quizId']]
        ])->first();
        $isExist = MCQ_Record::where([
        ['record_id','=',$currentQuiz['recordId']],
        ['mcq_id', '=', $req->mcq_id],
       ])->count();

       if ($isExist < 1 ){
        $mcq_record = new MCQ_Record();
        $mcq_record->record_id = $currentQuiz['recordId'];
        $mcq_record->user_id = Session::get('user')->id;
        $mcq_record->mcq_id = $req->mcq_id;
        $mcq_record->select_answer = $req->option;
        if ($req->option == MCQ::find($req->mcq_id)->correct_ans) {
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
         $resultData = MCQ_Record::withMCQ()->where('record_id',$currentQuiz['recordId'])->get();
           $correct_ans = MCQ_Record::where([
                ['record_id','=', $currentQuiz['recordId']],
                ['is_correct','=',1],
            ])->count();
            return view ('quiz-result',['resultData'=>$resultData,'correct_ans'=>$correct_ans]);
        }
    }   
     
}
