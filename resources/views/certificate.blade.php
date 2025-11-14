<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate</title>
    @vite('resources/css/app.css')
</head>

<body class=" pt-5">

   <div class="text-center m-auto w-300">
     <div class="flex justify-between align-items-center m-10">
        <div class="bg-green-500 px-5 py-1 rounded-b-sm border-2 border-green-500" > 
            <a href="/" class="text-white font-semibold text-lg font-serif flex gap-2 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
            <span>Back</span></a>
        </div>
        <div class="border-blue-500 py-1 bg-blue-500 px-5 rounded-b-sm border-2 " >
            <a href="/download-certificate/" class="font-semibold text-white text-lg font-serif flex gap-2 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="M480-320 280-520l56-58 104 104v-326h80v326l104-104 56 58-200 200ZM240-160q-33 0-56.5-23.5T160-240v-120h80v120h480v-120h80v120q0 33-23.5 56.5T720-160H240Z"/></svg>
                <span>Download Certificate</span></a>
        </div>
    </div>
    <div class="border-2 m-10 text-center bg-gray-100 border-indigo-900 rounded-lg p-6">
        <h1 class="text-5xl font-serif flex justify-center items-center gap-4 font-bold text-indigo-900">
<svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#EAC452"><path d="M479.76-140q83.24 0 141.74-58.26 58.5-58.27 58.5-141.5 0-83.24-58.26-141.74-58.27-58.5-141.5-58.5-83.24 0-141.74 58.26-58.5 58.27-58.5 141.5 0 83.24 58.26 141.74 58.27 58.5 141.5 58.5ZM346-563q28-17 60-26.5t67-10.5L363-820H217l129 257Zm268 0 129-257H597l-83 167 30 60q19 5 36.5 12.5T614-563ZM273-183q-25-33-39-72.5T220-340q0-45 14-84.5t39-72.5q-57 10-95 53.5T140-340q0 60 38 103.5t95 53.5Zm414 0q57-10 95-53.5T820-340q0-60-38-103.5T687-497q25 33 39 72.5t14 84.5q0 45-14 84.5T687-183ZM480-80q-40 0-76.5-11.5T336-123q-9 2-18 2.5t-19 .5q-91 0-155-64T80-339q0-87 58-149t143-69L120-880h280l80 160 80-160h280L680-559q85 8 142.5 70T880-340q0 92-64 156t-156 64q-9 0-18.5-.5T623-123q-31 20-67 31.5T480-80Zm0-260ZM346-563 217-820l129 257Zm268 0 129-257-129 257ZM406-230l28-91-74-53h91l29-96 29 96h91l-74 53 28 91-74-56-74 56Z"/></svg>  <span>Certificate of Achievement</span>
        </h1><br></br>
     <p class="text-3xl font-serif text-center leading-12">
    This is to certify that <br>
    <span class="text-blue-600 text-4xl font-semibold">{{$data['name']}}</span><br>
    has successfully completed the <br>
     <span class="text-blue-600 text-4xl font-semibold">{{$data['quiz']}}</span><br>
     with outstanding performance. <br><br>
   <span class="text-green-600 font-semibold"> Keep learning. Keep growing. </span>
    <br><br>
    <span>Date: {{date('y-m-d')}}</span>
</p>
    </div>
   </div>
</body>

</html>
