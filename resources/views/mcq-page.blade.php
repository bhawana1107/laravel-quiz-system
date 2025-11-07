<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MCQ Page</title>
    @vite('resources/css/app.css')
</head>

<body class=" bg-gray-100">
    
    <x-user-navbar></x-user-navbar>

    <div class=" flex flex-col items-center min-h-screen pt-5">
        <h1 class=" text-2xl text-center text-green-800 mb-6 font-bold">{{ $quizName }}</h1>
        <h1 class=" text-2xl text-center text-green-800 mb-6 font-bold">Question No.
             {{ Session::get('currentQuiz.totalMcq') }}</h1>


    <div class="mt-2 p-4 bg-white shadow-2xl rounded-xl w-140">
        <h3 class="font-bold text-xl mb-1 text-green-900">{{ $mcqData->question }}</h3>
       <form action="/submit-next/{{ $mcqData->id }}" method="post" class="space-y-4">
        @csrf
        <input type="hidden" name="mcq_id" value="{{ $mcqData->id }}">
        <label for="option_1" class="flex border p-3 mt-2 rounded-2xl shadow-2xl cursor-pointer hover:text-blue-50">
            <input id="option_1" class="form-radio text-blue-900" type="radio" value="a" name="option">
            <span class="text-green-900 pl-2 font-bold">{{ $mcqData->a }}</span>
        </label>
        <label for="option_2" class="flex border p-3 mt-2 rounded-2xl shadow-2xl cursor-pointer hover:text-blue-50">
            <input id="option_2" class="form-radio text-blue-500" type="radio" value="b" name="option">
            <span class="text-green-900 pl-2 font-bold">{{ $mcqData->b }}</span>
        </label>
        <label for="option_3" class="flex border p-3 mt-2 rounded-2xl shadow-2xl cursor-pointer hover:text-blue-50">
            <input id="option_3" class="form-radio text-blue-500" type="radio" value="c" name="option">
            <span class="text-green-900 pl-2 font-bold">{{ $mcqData->c }}</span>
        </label>
         <label for="option_4" class="flex border p-3 mt-2 rounded-2xl shadow-2xl cursor-pointer hover:text-blue-50">
            <input id="option_4" class="form-radio text-blue-500" type="radio" value="d" name="option">
            <span class="text-green-900 pl-2 font-bold">{{ $mcqData->d }}</span>
        </label>

         <button type="submit"
                class=" w-full bg-blue-600 rounded-xl px-4 py-2 text-white cursor-pointer">Submit Answer and Next
            </button>
       </form>

</div>
    </div>
    <x-user-footer></x-user-footer>
</body>

</html>
