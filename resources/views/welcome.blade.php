<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quiz System</title>
    @vite ('resources/css/app.css')
</head>
<body>
    <x-user-navbar></x-user-navbar>
     
    <div class="flex flex-col min-h-screen items-center bg-gray-100">
        
          @if (session('message-success'))
        <div class=" bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative max-w-md ml-auto "
            role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('message-success') }}</span>
        </div>
    @endif
        <h1 class="text-4xl font-bold text-green-900 p-5">Check Your Skills</h1>
        <div class="w-full max-w-md">
            <div class="relative">
                <form action="/search-quiz" method="get">
                <input class="w-full px-4 py-3 text-gray-700 border border-gray-300
                rounded-2xl shadow" type="text" name="search" placeholder="Search quiz...">
                <button class="absolute right-2 top-3">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#2854C5"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                </button>
            </form>
            </div>
        </div>

          <div class="w-300">
        <h1 class="text-2xl font-semibold  text-green-900 text-center mt-10 my-5">Category List</h1>
        <table class="w-full border border-gray-300 mt-5 mb-10">
            <thead class="bg-blue-500 text-white font-serif font-medium">
                <th class="border border-gray-300 px-4 py-2 text-left">S.No</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                <th class="border border-gray-300 px-4 py-2 text-left">No. of Quizzes</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Action</th>
            </thead>
            <tbody>
                @foreach ($categories as $key =>$category)
                    <tr class="even:bg-gray-200 font-medium font-sans">
                        <td class="border border-gray-300 px-4 py-2">{{ $key + 1}}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $category->name}}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $category->quizzes_count}}</td>
                        <td class="border border-gray-300 px-4 py-2 flex">
                           
                            <a href="user-quiz-list/{{ $category->id}}/{{str_replace(' ','-',$category->name)}}" class=" hover:scale-110 transition-transform">
<svg xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="20px" fill="#2854C5"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
       

    </div>
     <div class="w-300">
                <h1 class="text-2xl font-semibold  text-green-900 text-center mt-10 my-5">Top Quizzes</h1>

            <table class="w-full border border-gray-300 mt-5 mb-10">
                <thead class="bg-blue-500 text-white font-serif font-medium">
                    <th class="border border-gray-300 px-4 py-2 text-left">S.No</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Quiz Name</th>
                    {{-- <th class="border border-gray-300 px-4 py-2 text-left">Total Questions</th> --}}
                    <th class="border border-gray-300 px-4 py-2 text-left">Action</th>
                </thead>
                <tbody>
                    @foreach ($quizData as $key => $item)
                        <tr class="even:bg-gray-200 font-medium font-sans">
                            <td class="border border-gray-300 px-4 py-2">{{ $key + 1 }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $item->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="/start-quiz/{{ $item->id }}/{{ str_replace(' ','-',$item->name) }}" class=" text-green-600 font-bold">
                                Attempt Quiz
                            </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
    </div>  
    <x-user-footer></x-user-footer>
</body>
</html>