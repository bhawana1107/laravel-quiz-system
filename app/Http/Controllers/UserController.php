<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\MCQ;

class UserController extends Controller
{
    function welcome(){
        $categories = Category::withCount('quizzes')->get();
        return view('welcome',['categories'=>$categories]);
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
       $quizCount = Mcq::where('quiz_id',$id)->count();
       $quizName = $name;

       return view('start-quiz',['quizName'=>$quizName,'quizCount'=>$quizCount]);
    }
}

