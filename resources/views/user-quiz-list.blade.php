<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category : {{ str_replace('-', ' ', $category) }}</title>
    @vite('resources/css/app.css')
       <base href="{{ config('app.url') }}/">
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
        <x-user-sidebar></x-user-sidebar>
        <!-- MAIN -->
        <main class="flex-1 min-h-[60vh]">
            <div class="glass rounded-2xl p-8">
                <h2 class=" text-3xl text-center text-white font-serif mb-6">Category Name :
                    {{ str_replace('-', ' ', $category) }} </h2>
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
                                            Total Questions</th>
                                        <th class="px-6 py-3 border-b border-white/6 w-28 text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($quizData as $key => $item)
                                        <tr class="group">
                                            <td
                                                class="px-6 py-3 border-b border-white/6 border-r border-white/10 align-center w-12">
                                                <div class="text-slate-300">
                                                    {{ $key + 1 + (($quizData->currentPage() ?? 1) - 1) * ($quizData->perPage() ?? $quizData->count()) }}
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
                                            <td class="px-6 py-3 border-b border-white/6 align-center text-right w-28">

                                                <a href="start-quiz/{{ $item->id }}/{{ str_replace(' ', '-', $item->name) }}"
                                                    class=" inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg font-medium">Attempt
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
                                {{ $quizData->links() }}
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
