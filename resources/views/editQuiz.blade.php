<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Quiz</title>
    @vite('resources/css/app.css')
       <base href="{{ config('app.url') }}/">
</head>

<body>
    <x-navbar name={{$name}}></x-navbar>
     
    <!-- Body Content Start -->
    <div class="flex flex-1 w-full max-w-[500px] mx-auto px-4 sm:px-6 lg:px-8 gap-6">
        <!-- MAIN -->
        <main class="flex-1 min-h-[60vh]">
            <div class="glass rounded-2xl p-8">
                <h2 class=" text-2xl text-center texst-white mb-6">Update Quiz</h2>
                <form action="update-Quiz" method="post" class=" space-y-4">
                    @csrf
                    <input type="hidden" name="quiz-id" id="" value="{{$quizData->id}}">
                    <div>
                        <input type="text"  value="{{$quizData->name}}" name= "quiz-name" required
                            class=" w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                        @error('quiz')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit"
                        class=" w-full bg-blue-600 rounded-xl px-4 py-2 text-white cursor-pointer">Update</button>
                </form>
               
            </div>
        </main>
    </div>
    <!-- Body Content End -->
</body>

</html>
