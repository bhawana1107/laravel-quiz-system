<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Result Page</title>
    @vite('resources/css/app.css')
</head>

<body class=" bg-gray-100">
    <x-user-navbar></x-user-navbar>
    <div class="flex flex-col min-h-screen items-center bg-gray-100">
        <div class="w-300">
            <h1 class="text-2xl font-semibold  text-green-900 text-center mt-10 my-5">Your Result</h1>
                        <h1 class="text-2xl font-semibold  text-green-900 text-center mt-10 my-5">
                            {{$correct_ans}} out of {{count($resultData)}} Correct
                        </h1>

            <table class="w-full border border-gray-300 mt-5 mb-10">
                <thead class="bg-blue-500 text-white font-serif font-medium">
                    <th class="border border-gray-300 px-4 py-2 text-left">S.No</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Questions</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Selected Answer</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Correct_answer</th>
                </thead>
                <tbody>
                   
                    @foreach ($resultData as $key => $result)
                        <tr class="even:bg-gray-200 font-medium font-sans">
                            <td class="border border-gray-300 px-4 py-2">{{ $key + 1 }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $result->question}}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $result->select_answer }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                @if ($result->is_correct == 0)
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                        width="24px" fill="#EA3323">
                                        <path
                                            d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                        width="24px" fill="#48752C">
                                        <path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z" />
                                    </svg>
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

</html>
