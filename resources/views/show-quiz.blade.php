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
    <x-navbar name={{$name}}></x-navbar>
  
   <div class=" flex flex-col items-center min-h-screen pt-5">
        <h2 class=" text-2xl text-center text-gray-800 mb-6">Quiz Name : {{$quizName}} <a href="/add-quiz" class="text-yellow-500 text-sm">Back</a></h2>
    <div class="w-300">
        <table class="w-full border border-gray-300 mt-5 mb-10">
            <thead class="bg-blue-500 text-white font-serif font-medium">
                <th class="border border-gray-300 px-4 py-2 text-left">S.No</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Question</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Action</th>
            </thead>
            <tbody>
                @foreach ($mcqs as $key => $mcq)
                    <tr class="even:bg-gray-200 font-medium font-sans">
                        <td class="border border-gray-300 px-4 py-2">{{ $key + 1}}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $mcq->question}}</td>
                        {{-- <td class="border border-gray-300 px-4 py-2">
                            <a href="/category/delete/{{ $category->id }}" class=" hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="20px" fill="#BB271A"><path d="M312-144q-29.7 0-50.85-21.15Q240-186.3 240-216v-480h-48v-72h192v-48h192v48h192v72h-48v479.57Q720-186 698.85-165T648-144H312Zm336-552H312v480h336v-480ZM384-288h72v-336h-72v336Zm120 0h72v-336h-72v336ZM312-696v480-480Z"/></svg>
                            </a>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
       

    </div>
   </div>
</body>

</html>
