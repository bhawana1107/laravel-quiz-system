<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Quiz</title>
    @vite('resources/css/app.css')
</head>

<body class=" bg-gray-100">
    <x-navbar name={{ $name }}></x-navbar>
    @if (session()->has('mcq-msg'))
        <div class=" bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative max-w-md ml-auto "
            role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('mcq-msg') }}</span>
        </div>
    @endif
    <div class=" glass flex flex-1 w-full max-w-[1000px] mx-auto px-4 sm:px-6 lg:px-8 gap-6">
        <!-- MAIN -->
        <main class="flex-1 min-h-[60vh]">
            <div class="flex justify-between ">
                <div>
                    <h2 class=" text-2xl text-center text-white font-serif font bold mt-5 mb-6">
                        Quiz Name : {{ str_replace('-', ' ', $quizName) }}
                        <a
                            href="/quiz-list/{{ $categoryId }}/{{ str_replace(' ', '-', $categoryName) }}"class="text-yellow-500 text-sm ml-3">Back</a>
                    </h2>
                </div>
                <div
                    class="text-white text-lg bg-blue-500 w-38  mt-3 py-2  h-12 text-center font-semibold rounded-lg font-serif">
                    <a href="/add-question/{{ str_replace(' ', '-', $quizName) }}">Add Question</a>
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
                                    <th class="px-6 py-3 border-b border-white/6 border-r border-white/10 text-left">
                                        Question</th>
                                    <th
                                        class="px-6 py-3 border-b border-white/6 border-r border-white/10 w-36 text-left">
                                        Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($mcqs as $key => $mcq)
                                    <tr class="group">
                                        <td
                                            class="px-6 py-3 border-b border-white/6 border-r border-white/10 align-center w-12">
                                            <div class="text-slate-300">
                                                {{ $key + 1 }}

                                            </div>
                                        </td>
                                        <td
                                            class="px-6 py-3 border-b border-white/6 border-r border-white/10 align-center">
                                            <div class="font-medium text-white">{{ $mcq->question }}</div>
                                        </td>

                                        <td
                                            class="px-6 py-3 border-b border-white/6 border-r flex gap-3 border-white/10 align-center w-36">
                                            <a href="/show-mcq/{{ $mcq->id }}"
                                                class=" hover:scale-110 transition-transform">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="28px"
                                                    viewBox="0 -960 960 960" width="20px" fill="#fff">
                                                    <path
                                                        d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z" />
                                                </svg>

                                            </a>
                                            <a href="/edit-mcq/{{ $mcq->id }}"
                                                class=" hover:scale-110 transition-transform">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="28px"
                                                    viewBox="0 -960 960 960" width="20px" fill="#FFFFFF">
                                                    <path
                                                        d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z" />
                                                </svg>
                                            </a>
                                            <a href="/mcq-delete/{{ $mcq->id }}"
                                                class=" hover:scale-110 transition-transform">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="28px"
                                                    viewBox="0 -960 960 960" width="20px" fill="#fff">
                                                    <path
                                                        d="M312-144q-29.7 0-50.85-21.15Q240-186.3 240-216v-480h-48v-72h192v-48h192v48h192v72h-48v479.57Q720-186 698.85-165T648-144H312Zm336-552H312v480h336v-480ZM384-288h72v-336h-72v336Zm120 0h72v-336h-72v336ZM312-696v480-480Z" />
                                                </svg>
                                            </a>

                                        </td>

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
