<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Mcq</title>
    @vite('resources/css/app.css')
       <base href="{{ config('app.url') }}/">
</head>

<body class=" bg-gray-100">
    <x-navbar name={{$name}}></x-navbar>

    <div class=" glass flex flex-1 w-full max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 gap-6">
        <!-- MAIN -->
        <main class="flex-1 min-h-[60vh]">
            <h2 class=" text-2xl text-center text-white font-serif font bold mt-5 mb-6">
                Quiz Name : {{ $quizName }} <a
                    href="show-quiz/{{ $mcqs[0]->quiz_id }}/{{ str_replace(' ', '-', $quizName) }}"
                    class="text-yellow-500 text-sm ml-3">Back</a></h2>
            <div class="mt-8">
                <div class="glass rounded-2xl overflow-hidden mt-8 border border-white/6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto text-sm">
                            <thead class="table-head row text-slate-300 font-serif">
                                <tr>
                                    <th
                                        class="px-6 py-3 border-b border-white/6 border-r text-3xl border-white/10 text-left w-30">
                                        Field</th>
                                    <th
                                        class="px-6 py-3 border-b border-white/6 border-r text-3xl border-white/10 text-left">
                                        Details</th>
                                </tr>


                            </thead>
                            <tbody>

                                @foreach ($mcqs as $index => $q)
                                    <tr class="border-b border-white/10">
                                        <td class="px-4 py-2 text-lg  text-left font-semibold border-r border-white/10">
                                            Question</td>
                                        <td class="px-4 py-2 text-lg  text-left font-semibold">{{ $q->question }}</td>
                                    </tr>

                                    <tr class="border-b border-white/10">
                                        <td class="px-4 py-2 text-lg  text-left font-semibold border-r border-white/10">
                                            Option A</td>
                                        <td class="px-4 py-2 text-lg  text-left font-semibold">{{ $q->a }}</td>
                                    </tr>

                                    <tr class="border-b border-white/10">
                                        <td class="px-4 py-2 text-lg  text-left font-semibold border-r border-white/10">
                                            Option B</td>
                                        <td class="px-4 py-2 text-lg  text-left font-semibold">{{ $q->b }}</td>
                                    </tr>

                                    <tr class="border-b border-white/10">
                                        <td class="px-4 py-2 text-lg  text-left font-semibold border-r border-white/10">
                                            Option C</td>
                                        <td class="px-4 py-2 text-lg  text-left font-semibold">{{ $q->c }}</td>
                                    </tr>

                                    <tr class="border-b border-white/10">
                                        <td class="px-4 py-2 text-lg  text-left font-semibold border-r border-white/10">
                                            Option D</td>
                                        <td class="px-4 py-2 text-lg  text-left font-semibold">{{ $q->d }}</td>
                                    </tr>

                                    <tr class="border-b border-white/10 bg-white/5">
                                        <td class="px-4 py-2 text-lg  text-left font-semibold border-r border-white/10">
                                            Correct Answer</td>
                                        <td class="px-4 py-2 text-3xl  text-left text-green-400 font-bold">
                                            {{ $q->correct_ans }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </main>
    </div>

</body>

</html>
