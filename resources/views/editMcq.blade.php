<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Mcq</title>
    @vite('resources/css/app.css')
       <base href="{{ config('app.url') }}/">
</head>

<body>
    <x-navbar name={{$name}}></x-navbar>
     
    <!-- Body Content Start -->
    <div class="flex flex-1 w-full max-w-[500px] mx-auto px-4 sm:px-6 lg:px-8 gap-6">
        <!-- MAIN -->
        <main class="flex-1 min-h-[60vh]">
            <div class="glass rounded-2xl p-8">
                <h2 class=" text-2xl text-center text-white mb-6">Update Mcq</h2>
                <form action="update-mcq" method="post" class=" space-y-4">
                    @csrf
                    <input type="hidden" name="mcq-id" id="" value="{{$mcqs->id}}">
                    <div>
                        Question:
                        <input type="text"  value="{{$mcqs->question}}" name= "mcq-question" required
                            class=" w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                        @error('mcq-question')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                     <div>
                        option A:
                        <input type="text"  value="{{$mcqs->a}}" name= "mcq-a" required
                            class=" w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                      
                    </div>
                     <div>
                        option B:
                        <input type="text"  value="{{$mcqs->b}}" name= "mcq-b" required
                            class=" w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                      
                    </div>
                     <div>
                        option C:
                        <input type="text"  value="{{$mcqs->c}}" name= "mcq-c" required
                            class=" w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                       
                    </div>
                     <div>
                        option D:
                        <input type="text"  value="{{$mcqs->d}}" name= "mcq-d" required
                            class=" w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none">
                      
                    </div>
                    <div>
                    <select name= "correct_ans"
                        class=" w-full px-4 py-2 border text-white bg-gray-800 border-gray-300 rounded-xl focus:outline-none">
                        <option value="{{$mcqs->correct_ans}}">{{$mcqs->correct_ans}}</option>
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                    </select>
                   
                </div>

                    <button type="submit"
                        class=" w-full bg-blue-600 rounded-xl px-4 py-2 text-white cursor-pointer">Update</button>
                </form>
               
            </div>
        </main>
    </div>
    <!-- Body Content End -->
</body>

</html>