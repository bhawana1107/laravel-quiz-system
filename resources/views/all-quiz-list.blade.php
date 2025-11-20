<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Of Quizzes</title>
    @vite ('resources/css/app.css')
</head>

<body>
    <x-user-navbar></x-user-navbar>
    <!-- Body Content Start -->
    <div class="flex flex-1 w-full max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 gap-6">
        <!-- ERROR -->
        @if (session('message-success'))
            <div class=" bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative max-w-md ml-auto "
                role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('message-success') }}</span>
            </div>
        @endif
        <!-- SIDEBAR -->
        <x-userSidebar></x-userSidebar>
        <!-- MAIN -->
        <main class="flex-1 min-h-[60vh]">
            <div class="glass rounded-2xl p-8">
                <div class="md:flex md:items-center md:justify-between gap-6">
                    <div>
                        <h1 class="text-4xl md:text-5xl font-semibold text-white leading-tight">Sharpen Your Skills with
                            Interactive Quizzes</h1>
                        <p class="text-slate-300 mt-2">Choose a category or search quizzes to begin — earn certificates
                            and level up!</p>
                    </div>
                    <div class="mt-6 md:mt-0 w-full md:w-1/3">
                        <div class="relative">
                            <form action="/search-quiz" method="get">
                                <input placeholder="Search quizzes or categories..." type="text" name="search"
                                    class="w-full rounded-full bg-black/40 border border-white/6 px-4 py-3 text-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 placeholder:text-slate-400" />
                                <button
                                    class="absolute right-2 top-1/2 -translate-y-1/2 inline-flex items-center justify-center h-9 w-9 rounded-full bg-emerald-500/10 text-emerald-300 hover:bg-emerald-500/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- top quizzes grid -->
                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($quizzes as $key => $item)
                        <article class="p-4 rounded-xl glass border border-white/6 flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-white">{{ $item->name }}</h3>
                                <p class="text-slate-300 text-sm mt-1">
                                    @if (!empty($item->description))
                                        <div class="text-slate-400 text-xs mt-1">
                                            {{ $item->description }}
                                        </div>
                                    @endif
                                    {{-- Beginner --}}
                                    • {{ $item->mcqs_count }} questions
                                </p>
                            </div>
                            <a href="/start-quiz/{{ $item->id }}/{{ str_replace(' ', '-', $item->name) }}"
                                class="ml-4 inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg font-medium">Attempt</a>
                        </article>
                    @endforeach
                </div>
                <!-- pagination: flush, no extra gap -->
                <div class="px-6 mt-5 py-2 border-t border-white/6 flex items-center justify-end gap-0">
                    <div class="text-sm">
                        {{ $quizzes->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- Body Content End -->
    <x-user-footer></x-user-footer>
</body>

</html>
