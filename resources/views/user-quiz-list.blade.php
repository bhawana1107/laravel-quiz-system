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
    <x-user-navbar></x-user-navbar>

    <div class=" flex flex-col items-center min-h-screen pt-5">
        <h2 class=" text-2xl text-center text-gray-800 mb-6">Category Name : {{ $category }} </h2>
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
                            <td class="border border-gray-300 px-4 py-2">{{ $key + 1 }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $item->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="" class=" text-green-600 font-bold">
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
