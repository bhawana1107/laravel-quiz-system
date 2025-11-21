<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Quiz</title>
    @vite('resources/css/app.css')
   <base href="{{ config('app.url') }}/">
<body>
    <x-navbar name={{$name}}></x-navbar>
    <div class="glass flex flex-col items-center min-h-screen pt-5">
        <div class="glass p-8 rounded-2xl shadow-lg w-full max-w-md">
            @if (!session('quizDetails'))
                <h2 class=" text-2xl text-center text-white mb-6">Add Quiz</h2>
                <form action="add-quiz" method="get" class=" space-y-4">
                    <div>
                        <input type="text" placeholder="Enter Quiz name" name= "quiz_name" required
                            class=" w-full px-4 py-2 border text-white border-gray-300 rounded-xl focus:outline-none">
                        @error('quiz')
                            <div class="text-red-500 ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <select type="text" name= "category_id"
                            class=" w-full px-4 py-2 border text-white bg-gray-800 border-gray-300 rounded-xl focus:outline-none">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit"
                        class=" w-full bg-blue-600 rounded-xl px-4 py-2 text-white cursor-pointer">Add</button>
                </form>
            @else
                <span class="text-white font-bold">Quiz : {{ session('quizDetails')->name }}</span>
                <p class="text-white font-bold">Total MCQs : {{ $totalMCQs }}
                    @if ($totalMCQs > 0)
                        <a href="show-quiz/{{ session('quizDetails')->id }}/{{ str_replace(' ', '-', session('quizDetails')->name) }}"
                            class="text-yellow-500 text-sm">Show MCQs</a>
                    @else
                        <span class="text-sm text-gray-400">No MCQs added yet</span>
                    @endif
                </p>
                <h2 class=" text-2xl text-center mt-2 text-white font-serif font-bold mb-6">Add MCQs</h2>
                <form action="add-mcq" method="post" class="space-y-4">
                    @csrf
                    <div>
                        <textarea type="text" placeholder="Enter Your Question" name= "question"
                            class=" w-full px-4 py-2 border text-white border-gray-300 rounded-xl focus:outline-none">
                    </textarea>
                        @error('question')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <input type="text" placeholder="Enter Option A" name= "a"
                            class=" w-full px-4 py-2 border text-white border-gray-300 rounded-xl focus:outline-none">
                        @error('a')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <input type="text" placeholder="Enter Option B" name= "b"
                            class=" w-full px-4 py-2 border text-white border-gray-300 rounded-xl focus:outline-none">
                        @error('b')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <input type="text" placeholder="Enter Option C" name= "c"
                            class=" w-full px-4 py-2 border text-white border-gray-300 rounded-xl focus:outline-none">
                        @error('c')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <input type="text" placeholder="Enter Option D" name= "d"
                            class=" w-full px-4 py-2 border text-white border-gray-300 rounded-xl focus:outline-none">
                        @error('d')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <select name= "correct_ans"
                            class=" w-full px-4 py-2 border text-white bg-gray-800 border-gray-300 rounded-xl focus:outline-none">
                            <option value="">Choose Correct Answer</option>
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                        </select>
                        @error('correct_ans')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" value="add-more" name="submit"
                        class=" w-full bg-blue-600 rounded-xl px-4 py-2 text-white cursor-pointer">Add More</button>
                    <button type="submit" value="done" name="submit"
                        class=" w-full bg-green-600 rounded-xl px-4 py-2 text-white cursor-pointer">Add and
                        Submit</button>
                    <a href="end-quiz"
                        class=" w-full bg-red-600 block text-center rounded-xl px-4 py-2 text-white cursor-pointer">Finish
                        Quiz</a>
                </form>
            @endif
        </div>
    </div>
</body>

</html>
