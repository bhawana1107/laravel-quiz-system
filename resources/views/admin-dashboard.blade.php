<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-navbar name={{$name}}></x-navbar>
   <div class=" flex flex-col items-center min-h-screen pt-5">
  <div class="w-300">
        <h1 class="text-2xl font-semibold font-serif text-blue-800 mt-10">Users List</h1>
        <table class="w-full border border-gray-300 mt-5 mb-10">
            <thead class="bg-blue-500 text-white font-serif font-medium">
                <th class="border border-gray-300 px-4 py-2 text-left">S.No</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
            </thead>
            <tbody>
                @foreach ($users as $key =>$user)
                    <tr class="even:bg-gray-200 font-medium font-sans">
                        <td class="border border-gray-300 px-4 py-2">{{ $key + 1}}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->name}}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->email}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
       

    </div>
    <div>
        {{$users->links()}}
    </div>
          </div>
</body>

</html>
