<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search Result </title>
    @vite('resources/css/app.css')
       <base href="{{ config('app.url') }}/">
</head>

<body>
    <x-user-navbar></x-user-navbar>
    <!-- Body Content Start -->
    <div class="flex flex-1 w-full max-w-[1000px] my-30 mx-auto px-4 sm:px-6 lg:px-8 gap-6">
        <!-- MAIN -->
        <main class="flex-1 min-h-[60vh]">
            <div class="glass rounded-2xl p-8">
                <h2 class=" text-3xl text-center font-serif text-white mb-6">Search : {{ $search }} </h2>

                <div class="mt-8">
                    <div class="glass rounded-2xl overflow-hidden border border-white/6">
                        <div class="overflow-x-auto">
                            @if ($type === 'category')
                                <!-- category table -->
                                <table class="min-w-full table-auto text-sm">
                                    <thead class="table-head text-slate-300 font-serif">
                                        <tr>
                                            <th
                                                class="px-6 py-3 border-b border-white/6 border-r border-white/10 w-12 text-left">
                                                S.No</th>

                                            <th
                                                class="px-6 py-3 border-b border-white/6 border-r border-white/10 text-left">
                                                Category Name</th>
                                            <th
                                                class="px-6 py-3 border-b border-white/6 border-r border-white/10 w-36 text-left">
                                                No. of Quizzes</th>
                                            <th class="px-6 py-3 border-b border-white/6 w-28 text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $key => $item)
                                            <tr class="group">
                                                <td
                                                    class="px-6 py-3 border-b border-white/6 border-r border-white/10 align-center w-12">
                                                    <div class="text-slate-300">
                                                        {{ $key + 1 }}
                                                    </div>
                                                </td>
                                                <td
                                                    class="px-6 py-3 border-b border-white/6 border-r border-white/10 align-center">
                                                    <div class="font-medium text-white">{{ $item->name }}</div>
                                                </td>
                                                <td
                                                    class="px-6 py-3 border-b border-white/6 border-r border-white/10 align-center w-36">
                                                    <div class="text-white font-medium">{{ $item->quizzes_count }}
                                                    </div>
                                                </td>
                                                <td
                                                    class="px-6 py-3 border-b border-white/6 align-center text-right w-28">
                                                    <a href="user-quiz-list/{{ $item->id }}/{{ str_replace(' ', '-', $item->name) }}"
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
                            @elseif ($type === 'quiz')
                                <!-- quiz table -->
                                <table class="min-w-full table-auto text-sm">
                                    <thead class="table-head text-slate-300 font-serif">
                                        <tr>
                                            <th
                                                class="px-6 py-3 border-b border-white/6 border-r border-white/10 w-12 text-left">
                                                S.No</th>
                                            <th
                                                class="px-6 py-3 border-b border-white/6 border-r border-white/10 text-left">
                                                Category</th>
                                            <th
                                                class="px-6 py-3 border-b border-white/6 border-r border-white/10 text-left">
                                                Quiz Name</th>
                                            <th
                                                class="px-6 py-3 border-b border-white/6 border-r border-white/10 w-36 text-left">
                                                Total Questions</th>
                                            <th class="px-6 py-3 border-b border-white/6 w-28 text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $key => $item)
                                            <tr class="group">
                                                <td
                                                    class="px-6 py-3 border-b border-white/6 border-r border-white/10 align-center w-12">
                                                    <div class="text-slate-300">
                                                        {{ $key + 1 }}
                                                    </div>
                                                </td>
                                                <td
                                                    class="px-6 py-3 border-b border-white/6 border-r border-white/10 align-center">
                                                    <div class="font-medium text-white">{{ $item->category->name }}
                                                    </div>
                                                </td>
                                                <td
                                                    class="px-6 py-3 border-b border-white/6 border-r border-white/10 align-center">
                                                    <div class="font-medium text-white">{{ $item->name }}</div>
                                                </td>
                                                <td
                                                    class="px-6 py-3 border-b border-white/6 border-r border-white/10 align-center w-36">
                                                    <div class="text-white font-medium">{{ $item->mcqs_count }}
                                                    </div>
                                                </td>
                                                <td
                                                    class="px-6 py-3 border-b border-white/6 align-center text-right w-28">
                                                    <a href="start-quiz/{{ $item->id }}/{{ str_replace(' ', '-', $item->name) }}"
                                                        class=" inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg font-medium">Attempt
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif

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
