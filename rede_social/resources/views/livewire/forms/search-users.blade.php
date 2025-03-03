<div class="w-full mx-auto">
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    <div class="relative">
        <input type="search" id="default-search" wire:keydown="search_user" wire:model="search"
            class="block w-full p-2 bg-indigo-50 border border-indigo-300 text-indigo-900 text-md font-md rounded-2xl focus:ring-indigo-500 focus:border-indigo-500"
            placeholder="Search Mockups, Logos..." />
        <div role="button"
            class="text-white absolute end-1 bottom-1 items-center bg-blue-600 hover:bg-blue-700 focus:bg-blue-800 font-medium rounded-full text-sm p-2">
            <svg class="w-4 h-4 text-slate-50" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </div>


        <div class="absolute w-full mt-2 bg-indigo-100 border rounded shadow-lg z-10">
            @foreach($users as $user)
                <a href="/user/{{$user->nick_name}}"
                    class="flex items-center gap-2 w-full ps-3  py-2 text-base text-indigo-700 hover:bg-indigo-200">
                    <img class="w-8 h-8 rounded-full border-2 border-indigo-700" src="{{$user->getAvatar()}}">
                    <div class=" font-normal grid w-auto ">

                        <div class=" font-medium sm:block truncate">
                            {{ $user->nick_name }}
                        </div>

                        @if($user->isOnline())
                        
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

    </div>

</div>