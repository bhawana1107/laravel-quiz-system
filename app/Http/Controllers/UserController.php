<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\MCQ;
use App\Models\User;

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
}
