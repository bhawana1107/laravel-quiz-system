    <nav class=" bg-white shadow-md px-4 py-3">
        <div class="flex justify-between item-center">
            <div class=" text-2xl font-bold text-green-800 hover:text-blue-700 cursor-pointer">
                Quiz System
            </div>
            <div class=" space-x-4">
                <a class="text-green-800 font-bold hover:text-blue-700" href="/">Home</a>
                <a class="text-green-800 font-bold hover:text-blue-700" href="/">Categories</a>
                @if(session('user'))
                <a class="text-green-800 font-bold hover:text-blue-700" href="">Welcome, {{ session('user')->name}}</a>
                <a class="text-green-800 font-bold hover:text-blue-700" href="/user-logout">Logout</a>
                @else
                 <a class="text-green-800 font-bold hover:text-blue-700" href="/user-login">Login</a>
                <a class="text-green-800 font-bold hover:text-blue-700" href="/user-signup">Sign Up</a>
                @endif
                <a class="text-green-800 font-bold hover:text-blue-700" href="/admin-logout">Blog</a>
            </div>
        </div>
    </nav>