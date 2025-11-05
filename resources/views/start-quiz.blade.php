<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Start Quiz</title>
    @vite('resources/css/app.css')
</head>

<body class=" bg-gray-100">
    <x-user-navbar></x-user-navbar>

    <div class=" flex flex-col items-center min-h-screen pt-5">
        <h1 class=" text-4xl text-center text-green-800 mb-6 font-bold">{{$quizName}}</h1>
        <h2 class="text-lg  text-center text-green-800  mb-6 font-bold">This Quiz Contains {{$quizCount}} Questions & no limit to attempt this Quiz</h2>
       <h1 class="text-2xl text-center text-green-800 mb-6 font-bold">
        Good Luck!
       </h1>
         @if(session('user'))
                   <a type="submit" href=""
                class=" bg-blue-600 rounded-md px-4 py-2 my-5 text-white cursor-pointer">Start Quiz 
    </a>
    @else
            <a type="submit" href="/user-signup-quiz"
                class=" bg-blue-600 rounded-md px-4 py-2 my-5 text-white cursor-pointer">Login / SignUp for Start Quiz 
    </a>
        @endif
    </div>
    <x-user-footer></x-user-footer>
</body>

</html>
