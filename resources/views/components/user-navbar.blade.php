 <header class="w-full bg-transparent">
     <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
         <!-- left: logo + mobile menu -->
         <div class="flex items-center justify-between w-full md:w-auto">
             <input id="sidebarToggle" type="checkbox" class="hidden peer" />
             <label for="sidebarToggle" class="fixed inset-0 bg-black/40 hidden peer-checked:block md:hidden z-40">
             </label>
             <label for="sidebarToggle"
                 class="md:hidden p-2 rounded-md bg-white/10 hover:bg-white/20 text-white cursor-pointer z-50">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M4 6h16M4 12h16M4 18h16" />
                 </svg>
             </label>
             <aside id="mobileSidebar"
                 class="fixed inset-y-0 left-0 z-50 w-64 h-auto bg-gray-100 text-black shadow-lg
                -translate-x-full peer-checked:translate-x-0
                transition-transform duration-300 md:hidden">
                 <div class="p-4 font-bold text-4xl border-b font-serif ">Menu</div>
                 <nav class="p-4 space-y-3">
                     <a href="./" class="block text-xl font-bold">Dashboard</a>
                     <a href="categories-list" class="block text-xl font-bold">Categories</a>
                     <a href="all-quiz-list" class="block text-xl font-bold">Quizzes</a>
                     @if (session('user'))
                         <a href="user-details" class="block text-xl font-bold">Welcome,
                             {{ session('user')->name }}</a>
                         <a class="block font-bold text-xl" href="user-logout">Logout</a>
                     @endif
                 </nav>
             </aside>
             <!-- LOGO -->
             <a href="./" class="logo text-3xl md:text-4xl text-white font-bold">
                 Quiz <span class="text-emerald-400">System</span>
             </a>
             <div class="md:hidden ml-auto relative z-50">
                 @if (session('user'))
                     <a class=" px-4 py-2 bg-emerald-500 text-white rounded-lg font-semibold text-sm cursor-pointer shadow"
                         href="user-logout">Logout</a>
                 @else
                     <input type="checkbox" id="menuToggle" class="hidden peer">
                     <label for="menuToggle"
                         class="px-4 py-2 bg-emerald-500 text-white rounded-lg font-semibold text-sm cursor-pointer shadow">
                         Get Started
                     </label>
                     <div
                         class="absolute right-0 mt-2 bg-gray-100 rounded-lg shadow p-3 w-32 hidden peer-checked:block z-50">
                         <a href="user-login" class="block py-2 text-blue-600 font-bold">Login</a>
                         <a href="user-signup" class="block py-2 text-emerald-600 font-bold">Signup</a>
                     </div>
                 @endif
             </div>
         </div>

         <!-- right nav -->
         <nav class="hidden md:flex items-center gap-6 text-sm text-slate-200">
             <a href="./" class="hover:text-white">Home</a>
             <a href="categories-list" class="hover:text-white">Categories</a>
             <a href="all-quiz-list" class="hover:text-white">Quizzes</a>
             @if (session('user'))
                 <a class="hover:text-white" href="user-details">Welcome,
                     {{ session('user')->name }}</a>
                 <a class="hover:text-white" href="user-logout">Logout</a>
             @else
                 <a class="hover:text-white" href="user-login">Login</a>
                 <a class="hover:text-white" href="user-signup">Sign Up</a>
             @endif
         </nav>
     </div>
 </header>
