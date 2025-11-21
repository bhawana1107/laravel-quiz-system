<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
   <base href="{{ config('app.url') }}/">
</head>

<body>
    <x-navbar name={{$name}}></x-navbar>
    <div class=" glass flex flex-1 w-full max-w-[1000px] mx-auto my-5 px-4 sm:px-6 lg:px-8 gap-6">
        <!-- MAIN -->
        <main class="flex-1 min-h-[60vh] my-5">
            <h1 class="text-4xl font-semibold font-serif text-white mt-10">Users List</h1>
            <div class="mt-8">
                <div class="glass rounded-2xl overflow-hidden border border-white/6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto text-sm">
                            <thead class="table-head text-slate-300 font-serif">
                                <tr>
                                    <th
                                        class="px-6 py-3 border-b border-white/6 border-r border-white/10 w-12 text-left">
                                        S.No</th>
                                    <th class="px-6 py-3 border-b border-white/6 border-r border-white/10 text-left">
                                        Name</th>
                                    <th
                                        class="px-6 py-3 border-b border-white/6 border-r border-white/10 w-36 text-left">
                                        Email</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr class="group">
                                        <td
                                            class="px-6 py-3 border-b border-white/6 border-r border-white/10 align-center w-12">
                                            <div class="text-slate-300">
                                                {{ $key + 1 + (($users->currentPage() ?? 1) - 1) * ($users->perPage() ?? $users->count()) }}

                                            </div>
                                        </td>
                                        <td
                                            class="px-6 py-3 border-b border-white/6 border-r border-white/10 align-center">
                                            <div class="font-medium text-white">{{ $user->name }}</div>
                                        </td>
                                        <td
                                            class="px-6 py-3 border-b border-white/6 border-r border-white/10 align-center w-36">
                                            <div class="text-white font-medium">{{ $user->email }}
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- pagination: flush, no extra gap -->
                    <div class="px-6 py-2 border-t border-white/6 flex items-center justify-end gap-0">
                        <div class="text-sm">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
