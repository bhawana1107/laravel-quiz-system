<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Categories</title>
    @vite('resources/css/app.css')
</head>

<body class=" bg-gray-100">
    <x-navbar name={{$name}}></x-navbar>
    @if (session()->has('category-added'))
        <div class=" bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative max-w-md ml-auto "
            role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('category-added') }}</span>
        </div>
    @endif
    @if(session()->has('category-deleted'))
        <div class=" bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-md ml-auto "
            role="alert">
            <strong class="font-bold">Deleted!</strong>
            <span class="block sm:inline">{{ session('category-deleted') }}</span>
        </div>
    @endif
   <div class=" flex flex-col items-center min-h-screen pt-5">
      <div class=" bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">
        <h2 class=" text-2xl text-center text-gray-800 mb-6">Add Category</h2>
        <form action="/add-category" method="post" class=" space-y-4">
            @csrf
            <div>
                <input type="text" placeholder="Enter Category Name" name= "category-name"
                    class=" w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                @error('category-name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
          
            <button type="submit"
                class=" w-full bg-blue-600 rounded-xl px-4 py-2 text-white cursor-pointer">Add</button>
        </form>
    </div>

    <div class="w-300">
        <h1 class="text-2xl font-semibold font-serif text-blue-800 mt-10">Category List</h1>
        <table class="w-full border border-gray-300 mt-5 mb-10">
            <thead class="bg-blue-500 text-white font-serif font-medium">
                <th class="border border-gray-300 px-4 py-2 text-left">S.No</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Creator</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Action</th>
            </thead>
            <tbody>
                @foreach ($categories as $key =>$category)
                    <tr class="even:bg-gray-200 font-medium font-sans">
                        <td class="border border-gray-300 px-4 py-2">{{ $key + 1}}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $category->name}}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $category->creator}}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="/category/delete/{{ $category->id }}" class=" hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="20px" fill="#BB271A"><path d="M312-144q-29.7 0-50.85-21.15Q240-186.3 240-216v-480h-48v-72h192v-48h192v48h192v72h-48v479.57Q720-186 698.85-165T648-144H312Zm336-552H312v480h336v-480ZM384-288h72v-336h-72v336Zm120 0h72v-336h-72v336ZM312-696v480-480Z"/></svg>
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
