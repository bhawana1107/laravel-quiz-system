<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ str_replace('-', ' ', $quizName) }}</title>
    @vite('resources/css/app.css')
</head>

<body>
    <!-- ERROR -->
    @if (session('message-success'))
        <div id="successMsg"
            class=" bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative max-w-md ml-auto "
            role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('message-success') }}</span>
        </div>
    @endif
    <!-- ERROR END -->
    <x-user-navbar></x-user-navbar>
    <!-- Body Content Start -->
    <div class="flex flex-1 w-full max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 gap-6">
        <!-- SIDEBAR -->
        <x-userSidebar></x-userSidebar>
        <!-- MAIN -->
        <main class="flex-1 min-h-[60vh]">
            <div class="glass rounded-2xl p-8">
                <div class="overflow-x-auto">
                    <div class=" flex flex-col items-center min-h-screen pt-5">
                        <h1 class=" text-5xl text-center font-serif text-white-800 mb-6 font-bold">
                            {{ str_replace('-', ' ', $quizName) }}</h1>
                        <h2 class="text-xl  text-center text-white-800  mb-6 font-bold">This Quiz Contains
                            {{ $quizCount }} Questions
                            & no limit to attempt this Quiz</h2>
                        <h1 class="text-4xl font-serif text-center text-amber-400 mb-6 font-bold">
                            Good Luck!
                        </h1>
                        @if (session('user'))
                            <a type="submit"
                                href="/mcq/{{ session('firstMCQ')->id . '/' . $quizName }}/{{ session('firstMCQ')->quiz_name }}"
                                class=" bg-blue-600 rounded-md px-4 py-2 my-5 text-white cursor-pointer">Start
                                Quiz
                            </a>
                        @else
                            <div class="flex justify-evenly items-center gap-8">
                                <a type="submit" href="/user-signup-quiz"
                                    class=" bg-blue-600 rounded-md px-6 py-4 my-5 text-white cursor-pointer">SignUp
                                    for Start Quiz
                                </a>
                                <a type="submit" href="/user-login-quiz"
                                    class=" bg-blue-600 rounded-md px-6 py-4 my-5 text-white cursor-pointer">Login
                                    for Start Quiz
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- Body Content End -->
    <x-user-footer></x-user-footer>
</body>

</html>
