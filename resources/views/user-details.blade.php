<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Details</title>
    @vite ('resources/css/app.css')
</head>
<body>
    <x-user-navbar></x-user-navbar>
    <div class="flex flex-col min-h-screen items-center bg-gray-100">
        <h1 class="text-4xl font-bold text-green-900 p-5">Attempted Quizzes</h1>
      

          <div class="w-300">
        <table class="w-full border border-gray-300 mt-5 mb-10">
            <thead class="bg-blue-500 text-white font-serif font-medium">
                <th class="border border-gray-300 px-4 py-2 text-left">S.No</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Quiz Name</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
            </thead>
            <tbody>
                @foreach ($quizRecord as $key =>$record)
                    <tr class="even:bg-gray-200 font-medium font-sans">
                        <td class="border border-gray-300 px-4 py-2">{{ $key + 1}}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $record->name}}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if($record->status == 2)
                            <span class="text-green-500">Completed</span>
                            @else
                            <span class="text-orange-500">Incomplete</span>
                            @endif
                        </td>
                      
</tr>
                @endforeach
            </tbody>
        </table>
       

    </div>
    </div>  
    <x-user-footer></x-user-footer>
</body>
</html