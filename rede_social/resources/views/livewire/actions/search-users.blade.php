<div class="w-full mx-auto">


    <div class="relative">

        @if ($search)
            <div wire:click="eraseSearch()" role="button"
                class=" absolute start-1.5 bottom-1.5 items-center text-indigo-800 rounded-lg bg-indigo-200 p-1.5 hover:bg-indigo-300 hover:ring-1 hover:ring-indigo-800">
                <svg class="w-4 h-4  " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18 17.94 6M18 18 6.06 6" />
                </svg>

            </div>
        @endif

        <input type="search" wire:keydown="search_user()" wire:model="search"
            class="block w-full @if ($search) ps-10 @endif p-2 bg-indigo-50 border border-indigo-300 text-indigo-900 text-md font-md rounded-2xl focus:ring-indigo-500 focus:border-indigo-500"
            placeholder="@..." />
        <div role="button"
            class="text-white absolute end-1 bottom-1 items-center bg-blue-600 hover:bg-blue-700 focus:bg-blue-800 font-medium rounded-full text-sm p-2">
            <svg class="w-4 h-4 text-slate-50" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </div>

    @if($users)
        <div class="absolute w-full mt-2 bg-indigo-100 border rounded shadow-lg z-8">
            @foreach ($users as $user)
                <a href="/user/{{ $user->nick_name }}"
                    class="flex items-center gap-2 w-full ps-3  py-2 text-base text-indigo-700 hover:bg-indigo-200">
                    <img class="w-8 h-8 rounded-full border-2 border-indigo-700" src="{{ $user->getAvatar() }}">
                    <div class=" font-normal grid w-auto ">

                        <div class=" font-medium sm:block truncate">
                            {{ $user->nick_name }}
                        </div>

                        @if ($user->isOnline())
                            <p class=" text-xs text-slate-50 rounded-full bg-emerald-400 px-1 flex items-center w-fit">
                                online
                            </p>
                        @else
                            <p class=" text-xs text-slate-50 rounded-full bg-slate-400 px-1 flex items-center w-fit">
                                offline
                            </p>
                        @endif

                    </div>
                </a>
            @endforeach
        </div>
    @endif

    </div>

</div>
