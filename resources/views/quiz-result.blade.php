<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Result Page</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-user-navbar></x-user-navbar>
    <!-- Body Content Start -->
    <div class="flex flex-1 w-full max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 gap-6">
        <!-- MAIN -->
        <main class="flex-1 min-h-[60vh]">
            <div class="glass rounded-2xl p-8">
                <h1 class="text-4xl font-semibold  text-white font-serif text-center mt-10 my-5">Your Result</h1>
                <h1 class="text-lg font-semibold  text-white font-serif text-center mt-2c my-5">
                    {{ $correct_ans }} out of {{ count($resultData) }} Correct
                </h1>
                @if (($correct_ans * 100) / count($resultData) > 70)
                    <a href="/certificate"
                        class="ml-4 inline-flex font-bold items-center gap-2 bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-lg">View
                        & Download
                        Certificate</a>
                @endif
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
                                            Questions</th>
                                        <th
                                            class="px-6 py-3 border-b border-white/6 border-r border-white/10 w-36 text-left">
                                            Selected Answer</th>
                                        <th class="px-6 py-3 border-b border-white/6 w-28 text-right">Correct Answer
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($resultData as $key => $result)
                                        <tr class="group">
                                            <td
                                                class="px-6 py-3 border-b border-white/6 border-r border-white/10 align-center w-12">
                                                <div class="text-slate-300">
                                                    {{ $key + 1 }}
                                                </div>
                                            </td>
                                            <td
                                                class="px-6 py-3 border-b border-white/6 border-r border-white/10 align-center">
                                                <div class="font-medium text-white">{{ $result->question }}</div>
                                            </td>
                                            <td
                                                class="px-6 py-3 border-b border-white/6 border-r border-white/10 align-center w-36">
                                                <div class="text-white font-medium">{{ $result->select_answer }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-3 border-b border-white/6 align-center text-right w-28">
                                                @if ($result->is_correct == 0)
                                                    <div class="font-bold text-red-500">
                                                        InCorrect
                                                    </div>
                                                @else
                                                    <div class="font-bold text-green-500">
                                                        Correct
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
