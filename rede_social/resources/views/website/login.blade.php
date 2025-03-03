<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <title>App</title>

</head>

<body class="bg-slate-50 text-slate-800">
    <div class="grid w-full sm:grid-cols-2 lg:grid-cols-3 items-center h-screen">
        @if(session('returnMessage'))
            @livewire('Forms.LoginAuthenticateForm', ['returnMessage' => session('returnMessage')])
        @else
            @livewire('Forms.LoginAuthenticateForm')
        @endif
        <div class="h-full lg:col-span-2">
            <div id="default-carousel" class="relative w-full h-full" data-carousel="slide">

                <div class="relative w-full h-full overflow-hidden ">

                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="../img/image0_0.jpg" class="absolute block w-full h-full object-cover" alt="...">
                    </div>

                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="../img/image0_0 (1).jpg" class="absolute block w-full h-full object-cover" alt="...">
                    </div>

                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="../img/image1_0.jpg" class="absolute block w-full h-full object-cover" alt="...">
                    </div>

                </div>
            </div>
        </div>

    </div>




    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>