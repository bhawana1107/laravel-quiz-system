<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MCQ</title>
    @vite('resources/css/app.css')
    <base href="{{ config('app.url') }}/">
</head>

<body>

    <x-user-navbar></x-user-navbar>
    <!-- Body Content Start -->
    <div class="flex flex-1 w-full max-w-[1000px] mx-auto mt-5 px-4 sm:px-6 lg:px-8 gap-6">

        <!-- MAIN -->
        <main class="flex-1 min-h-[60vh]">
            <div class="glass rounded-2xl p-8">
                <div class="mt-8 mb-8">
                    <h1 class=" text-3xl text-center text-white mb-6 font-bold font-serif">{{ $quizName }}</h1>
                    <h1 class=" text-2xl text-center text-white font-serif mb-6 font-bold">Question No.
                        {{ Session::get('currentQuiz.currentMcq') }}</h1>
                    <div class=" mx-auto p-8 glass shadow-2xl rounded-xl w-140">
                        <h3 class="font-bold text-xl mb-5 text-center text-white">{{ $mcqData->question }}</h3>
                        <form action="submit-next/{{ $mcqData->id }}" method="post" class="space-y-4">
                            @csrf
                            <input type="hidden" name="mcq_id" value="{{ $mcqData->id }}">
                            @error('option')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                            <label for="option_1"
                                class="flex border glass p-3 mt-2 rounded-2xl shadow-2xl cursor-pointer hover:text-green-500 ">
                                <input id="option_1" class=" peer form-radio peer-checked:bg-green-400" type="radio"
                                    value="a" name="option" required>
                                <span
                                    class="text-gray-400 pl-2 font-bold peer-checked:text-green-400">{{ $mcqData->a }}</span>
                            </label>
                            <label for="option_2"
                                class="flex border glass p-3 mt-2 rounded-2xl shadow-2xl cursor-pointer hover:text-green-500">
                                <input id="option_2" class="peer form-radio" type="radio" value="b"
                                    name="option">
                                <span
                                    class="text-gray-400 pl-2 font-bold peer-checked:text-green-400">{{ $mcqData->b }}</span>
                            </label>
                            <label for="option_3"
                                class="flex border glass p-3 mt-2 rounded-2xl shadow-2xl cursor-pointer hover:text-green-500">
                                <input id="option_3" class="peer form-radio" type="radio" value="c"
                                    name="option">
                                <span
                                    class="text-gray-400 pl-2 font-bold peer-checked:text-green-400">{{ $mcqData->c }}</span>
                            </label>
                            <label for="option_4"
                                class="flex border glass p-3 mt-2 rounded-2xl shadow-2xl cursor-pointer hover:text-green-500 ">
                                <input id="option_4" class="peer form-radio" type="radio" value="d"
                                    name="option">
                                <span
                                    class="text-gray-400 pl-2 font-bold peer-checked:text-green-400">{{ $mcqData->d }}</span>
                            </label>

                            <button type="submit"
                                class=" w-full bg-blue-600 rounded-xl px-4 py-2 text-white cursor-pointer">Submit Answer
                                and Next
                            </button>
                        </form>

                    </div>

                </div>
            </div>
        </main>

    </div>
    <!-- Body Content End -->

    <x-user-footer></x-user-footer>
</body>

</html>
