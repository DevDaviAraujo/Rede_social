<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])

    @livewireStyles

    
    <title>App</title>
</head>

<body class="bg-slate-50 text-slate-800">
    <div class="grid items-center h-screen">


        <div class="sm:max-w-md w-full px-4 sm:mx-auto border-x border-indigo-500 ">

        @livewire('Forms.RegisterUserForm')

        </div>

    </div>


    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>