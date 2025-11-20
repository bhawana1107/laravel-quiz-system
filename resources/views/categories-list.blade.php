<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Of Categories</title>
    @vite ('resources/css/app.css')
</head>

<body>
    <x-user-navbar></x-user-navbar>
    <!-- Body Content Start -->
    <div class="flex flex-1 w-full max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 gap-6">
        <!-- ERROR -->
       @if (session('message-success'))
        <div id="successMsg"
            class=" bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative max-w-md ml-auto "
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
                <div class="mt-8">
                    <div class="glass rounded-2xl overflow-hidden border border-white/6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto text-sm">
                                <thead class="table-head text-slate-300 font-serif">
                                    <tr>
                                        <th
                                            class="px-6 py-3 border-b border-white/6 border-r border-white/10 w-12 text-left">
                                            S.No</th>
                                        <th
                                            class="px-6 py-3 border-b border-white/6 border-r border-white/10 text-left">
                                            Name</th>
                                        <th
                                            class="px-6 py-3 border-b border-white/6 border-r border-white/10 w-36 text-left">
                                            No. of Quizzes</th>
                                        <th class="px-6 py-3 border-b border-white/6 w-28 text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $key => $category)
                                        <tr class="group">
                                            <td
                                                class="px-6 py-3 border-b border-white/6 border-r border-white/10 align-center w-12">
                                                <div class="text-slate-300">
                                                    {{ $key + 1 + (($categories->currentPage() ?? 1) - 1) * ($categories->perPage() ?? $categories->count()) }}
                                                </div>
                                            </td>
                                            <td
                                                class="px-6 py-3 border-b border-white/6 border-r border-white/10 align-center">
                                                <div class="font-medium text-white">{{ $category->name }}</div>
                                            </td>
                                            <td
                                                class="px-6 py-3 border-b border-white/6 border-r border-white/10 align-center w-36">
                                                <div class="text-white font-medium">{{ $category->quizzes_count }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-3 border-b border-white/6 align-center text-right w-28">
                                                <a href="user-quiz-list/{{ $category->id }}/{{ str_replace(' ', '-', $category->name) }}"
                                                    class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-emerald-500 hover:bg-emerald-600 text-white font-medium transform transition hover:scale-105">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="28px"
                                                        viewBox="0 -960 960 960" width="20px" fill="#fff">
                                                        <path
                                                            d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z" />
                                                    </svg> View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- pagination: flush, no extra gap -->
                        <div class="px-6 py-2 border-t border-white/6 flex items-center justify-end gap-0">
                            <div class="text-sm">
                                {{ $categories->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- Body Content End -->
    <x-user-footer></x-user-footer>
</body>

</html>
