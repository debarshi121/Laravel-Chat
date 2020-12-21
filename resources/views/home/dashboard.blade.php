<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Document</title>
</head>
<body>
    <div class="container mx-auto w-3/6 p-2 my-2 border-4">
        <div class="grid grid-cols-2 gap-0">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-8 inline">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                </svg>
                <span>{{ auth()->user()->name }}</span>
            </div>
            <div class="grid justify-items-end">
                <a href="{{ route('logout') }}" class="bg-gray-200 hover:bg-gray-300 text-sm border border-gray-400 text-black font-bold py-1 px-4 rounded-md">
                    Logout
                </a>
            </div>
        </div>
        
        <div id="app" class="bg-gray-50 p-3 mt-3">
            <chat :user="{{ auth()->user() }}"></chat>
        </div>
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>