<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quiz List</title>
    @vite('resources/css/app.css')
</head>

<body class=" bg-gray-100">
    <x-navbar name={{$name}}></x-navbar>
  
   <div class=" flex flex-col items-center min-h-screen pt-5">
        <h2 class=" text-2xl text-center text-gray-800 mb-6">Category Name : {{$category}} <a href="/add-quiz" class="text-yellow-500 text-sm">Back</a></h2>
    <div class="w-300">
        <table class="w-full border border-gray-300 mt-5 mb-10">
            <thead class="bg-blue-500 text-white font-serif font-medium">
                <th class="border border-gray-300 px-4 py-2 text-left">S.No</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Quiz Name</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Action</th>
            </thead>
            <tbody>
                @foreach ($quizData as $key => $item)
                    <tr class="even:bg-gray-200 font-medium font-sans">
                        <td class="border border-gray-300 px-4 py-2">{{ $key + 1}}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->name}}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="/show-quiz/{{ $item->id }}/{{$item->name}}" class=" hover:scale-110 transition-transform">
<svg xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="20px" fill="#2854C5"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>                        </td>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
       

    </div>
   </div>
</body>

</html>
