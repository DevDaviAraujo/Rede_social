<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <title>App</title>

    <nav class="bg-indigo-500 fixed w-full z-40 top-0 start-0 shadow-md">
        <div class="grid grid-cols-2 gap-2 sm:grid-cols-3 items-center justify-between p-1 sm:p-2">

            <div class="flex sm:mx-auto items-center">

                @if(Auth::check())

                    <div role="button" class="flex items-center gap-2 w-full sm:w-full overflow-hidden"
                        id="dropdownDelayButton" data-dropdown-toggle="dropdownDelay" data-dropdown-delay="300"
                        data-dropdown-trigger="hover">

                        <img class="w-10 h-10 rounded-full border-2 border-slate-50" src="{{Auth::user()->getAvatar()}}">
                        <div class="text-lg font-medium text-slate-50">

                            <div class="sm:block truncate">
                                {{ Auth::user()->user_info->name . ' ' . Auth::user()->user_info->last_name }}
                            </div>
                            <div class="text-sm slate-100">{{ Auth::user()->nick_name }}</div>
                        </div>

                    </div>


                    <div id="dropdownDelay"
                        class="z-10 hidden bg-white divide-y divide-indigo-100 rounded-lg shadow w-44 dark:bg-indigo-700">
                        <div class="py-2 text-sm text-indigo-700 dark:text-indigo-200"
                            aria-labelledby="dropdownDelayButton">
                            <div>
                                <a href="/user/{{ Auth::user()->nick_name }}"
                                    class="flex ps-3 py-1.5 hover:bg-indigo-100 dark:hover:bg-indigo-600 dark:hover:text-white items-center justify-center">
                                    Ir
                                    ao
                                    Perfil
                                </a>
                            </div>

                        </div>

                        @livewire('Actions.LogoutSession')

                    </div>


                @else

                    <div class="flex items-center gap-2 w-full sm:w-full overflow-hidden">
                        <a href="/login"
                            class="inline-flex gap-2 items-center text-slate-50 border-2 hover:ring-slate-50 rounded-full px-2 py-1.5 ">
                            <img class="w-8 h-8 rounded-full border-2 border-slate-50" src="../img/user.png">
                            <div class="text-lg font-medium text-slate-50">
                                Login
                            </div>
                        </a>
                    </div>

                @endif

            </div>

            <div class="flex gap-2 sm:order-2 space-x-3 sm:space-x-0 rtl:space-x-reverse sm:mx-auto">

                <a href="/home" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="https://flowbite.com/docs/images/logo.svg" class="h-8">
                    <span
                        class="self-center text-xl sm:text-2xl font-semibold slate-50 space-nowrap text-slate-50">Flowbite</span>
                </a>

                <button
                    class="items-center justify-self-end p-2 mx-auto rounded-full sm:hidden focus:outline-none focus:ring-2 hover:ring-slate-50 focus:ring-slate-50"
                    data-collapse-toggle="navbar-sticky" type="button" aria-controls="navbar-sticky"
                    aria-expanded="false">
                    <svg class="w-6 h-6 text-slate-50 font-medium " aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </button>

            </div>

            <div class="items-center col-span-2 sm:col-span-1 justify-between hidden sm:flex sm:w-auto sm:order-1"
                id="navbar-sticky">
                <ul class="flex-auto p-2 sm:p-0 font-medium sm:space-x-8 rtl:space-x-reverse mx-auto">

                    @livewire('actions.search-users')

                </ul>
            </div>
        </div>
    </nav>



</head>

<body class="bg-slate-700 font-normal">

    <div class="grid h-screen  pt-14 sm:pt-16">

        <div
            class="max-w-xl md:w-[1600px] px-1 sm:px-2 sm:mx-auto bg-slate-600 border-x border-indigo-200 text-indigo-200 font-medium break-all">

            @yield('content')

        </div>

    </div>

    @if(Auth::check())

        <div class="absolute w-full z-40 max-w-xl md:w-5/6 px-1 sm:px-2 sm:mx-auto">
            <div data-dial-init class="fixed right-3 bottom-3 group">
                <div id="speed-dial-menu-dropdown-alternative-square"
                    class="flex flex-col justify-end hidden py-1 mb-4 space-y-2 bg-white border border-gray-100 rounded-lg shadow-sm dark:bg-gray-700 dark:border-gray-600">
                    <ul class="text-sm text-gray-500 dark:text-gray-300">

                        <li>
                            <div role="button" data-modal-target="create_post_modal" data-modal-toggle="create_post_modal"
                                class="flex items-center px-5 py-2 border-b border-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 hover:text-gray-900 dark:hover:text-white dark:border-gray-600">
                                <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 18">
                                    <path
                                        d="M18 0H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h2v4a1 1 0 0 0 1.707.707L10.414 13H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5 4h2a1 1 0 1 1 0 2h-2a1 1 0 1 1 0-2ZM5 4h5a1 1 0 1 1 0 2H5a1 1 0 0 1 0-2Zm2 5H5a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Zm9 0h-6a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Z" />
                                </svg>
                                <span class="text-sm font-medium">New post</span>
                            </div>
                        </li>

                    </ul>
                </div>
                <button type="button" data-dial-toggle="speed-dial-menu-dropdown-alternative-square"
                    data-dial-trigger="click" aria-controls="speed-dial-menu-dropdown-alternative-square"
                    aria-expanded="false"
                    class="flex items-center justify-center ml-auto text-whitetransition-transform duration-200 ease-in-out w-auto text-slate-50 text-md font-medium bg-blue-700 shadow-xl active:shadow-lg active:bg-blue-800 border-b-4 border-blue-800 active:border-b-2 active:scale-95 rounded-full p-4 ">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m13.835 7.578-.005.007-7.137 7.137 2.139 2.138 7.143-7.142-2.14-2.14Zm-10.696 3.59 2.139 2.14 7.138-7.137.007-.005-2.141-2.141-7.143 7.143Zm1.433 4.261L2 12.852.051 18.684a1 1 0 0 0 1.265 1.264L7.147 18l-2.575-2.571Zm14.249-14.25a4.03 4.03 0 0 0-5.693 0L11.7 2.611 17.389 8.3l1.432-1.432a4.029 4.029 0 0 0 0-5.689Z" />
                    </svg>
                    <span class="sr-only">Open actions menu</span>
                </button>
            </div>
        </div>
        </div>
        </div>
        <!-- Main modal -->
        <div id="create_post_modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-2 sm:p-4 w-full max-w-2xl max-h-full">

                @livewire('Forms.registerPost')

            </div>
        </div>

    @endif

    <div class="z-10 absolute left-3 bottom-3">

        @isset($returnMessage)
            @if ($returnMessage['status'] === 'success')
                <div class="relative w-auto animate-popup fade-out">
                    <div class="bg-green-100 rounded-md text-green-600 p-2.5 shadow-md">
                        <div class="flex items-center">
                            <p class="text-md font-medium ms-2 justify-self-start">{{ $returnMessage['message'] }}</p>
                        </div>
                    </div>
                </div>
            @elseif ($returnMessage['status'] === 'error')
                <div class="relative w-auto animate-popup fade-out">
                    <div class="bg-amber-100 rounded-md text-amber-600 p-2.5 shadow-md">
                        <div class="flex items-center">

                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                                    clip-rule="evenodd" />
                            </svg>

                            <p class="text-md font-medium ms-2 justify-self-start">{{ $returnMessage['error'] }}</p>

                        </div>
                    </div>
                </div>
            @endif
        @endisset

    </div>


    @livewireScripts
    
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>