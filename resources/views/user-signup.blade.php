<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Signup</title>
    @vite('resources/css/app.css')
          <base href="{{ config('app.url') }}/">
</head>

<body>
    <x-user-navbar></x-user-navbar>
    <div class=" glass flex justify-center items-center min-h-screen">
        <div class=" glass p-8 rounded-2xl shadow-lg w-full max-w-md">
            <h2 class=" text-3xl text-center text-white mb-6">User Signup</h2>
            @error('user')
                <div class="text-red-500 ">{{ $message }}</div>
            @enderror

            <form action="user-signup" method="post" class=" space-y-4">
                @csrf
                <div>
                    <label for="" class="text-gray-600 mb-1">User Name</label>
                    <input type="text" placeholder="Enter User Name" name= "name"
                        class=" w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                    @error('name')
                        <div class="text-red-500 ">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="" class="text-gray-600 mb-1">User Email</label>
                    <input type="email" placeholder="Enter User Email" name= "email"
                        class=" w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                    @error('email')
                        <div class="text-red-500 ">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="" class="text-gray-600 mb-1">Password</label>
                    <input type="password" placeholder="Enter Password" name="password"
                        class=" w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                    @error('password')
                        <div class="text-red-500 ">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="" class="text-gray-600 mb-1">Confirm Password</label>
                    <input type="password" placeholder="Confirm Password" name="password_confirmation"
                        class=" w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                </div>
                <button type="submit" class=" w-full bg-blue-600 rounded-xl px-4 py-2 text-white cursor-pointer">Signup
                </button>
            </form>
        </div>
    </div>
    <x-user-footer></x-user-footer>

</body>

</html>
