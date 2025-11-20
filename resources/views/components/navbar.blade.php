<header class="w-full bg-transparent">
    <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="/" class="logo text-3xl md:text-4xl text-white font-bold">Quiz <span
                    class="text-emerald-400">System</span></a>
        </div>
        <nav class="hidden md:flex items-center gap-6 text-sm text-slate-200">
            <a href="/admin-dashboard" class="hover:text-white">Dashboard</a>
            <a href="/admin-categories" class="hover:text-white">Categories</a>
            <a href="/add-quiz" class="hover:text-white">Quiz</a>

            <a class="hover:text-white" href="">Welcome,
                {{ $name }}</a>
            <a class="hover:text-white" href="/admin-logout">Logout</a>
        </nav>
    </div>
</header>
