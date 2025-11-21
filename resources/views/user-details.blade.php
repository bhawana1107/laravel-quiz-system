<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login User Details</title>
    @vite ('resources/css/app.css')
      <base href="{{ config('app.url') }}/">
</head>

<body>
    <x-user-navbar></x-user-navbar>
    <!-- Body Content Start -->
    <div class="flex flex-1 w-full max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 gap-6">
        <!-- SIDEBAR -->
        <x-user-sidebar></x-user-sidebar>
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
                            <form action="search-quiz" method="get">
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
                                            Quiz Name</th>
                                        <th
                                            class="px-6 py-3 border-b border-white/6 border-r border-white/10 w-36 text-left">
                                            Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($quizRecord as $key => $record)
                                        <tr class="group">
                                            <td
                                                class="px-6 py-3 border-b border-white/6 border-r border-white/10 align-center w-12">
                                                <div class="text-slate-300">
                                                    {{ $key + 1 + (($quizRecord->currentPage() ?? 1) - 1) * ($quizRecord->perPage() ?? $quizRecord->count()) }}
                                                </div>
                                            </td>
                                            <td
                                                class="px-6 py-3 border-b border-white/6 border-r border-white/10 align-center">
                                                <div class="font-medium text-white">{{ $record->name }}</div>
                                            </td>
                                            <td
                                                class="px-6 py-3 border-b border-white/6 border-r border-white/10 align-center w-36">
                                                <div class="text-white font-bold">
                                                    @if ($record->status == 2)
                                                        <span class="text-green-500">Completed</span>
                                                    @else
                                                        <a
                                                            href="start-quiz/{{ $record->quiz_id }}/{{ str_replace(' ', '-', $record->name) }}">
                                                            <span class="text-orange-500">Incomplete</span>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- pagination: flush, no extra gap -->
                        <div class="px-6 py-2 border-t border-white/6 flex items-center justify-end gap-0">
                            <div class="text-sm">
                                {{ $quizRecord->links() }}
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

</html
