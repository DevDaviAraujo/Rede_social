<!-- Modal content -->
<div class="relative bg-indigo-600 text-slate-50 rounded-lg shadow">
    <!-- Modal header -->
    <div class="flex items-center justify-between mx-2 sm:mx-4 py-2 sm:py-4 border-b border-slate-50 rounded-t">

        <div class="relative w-5/6">
            <input type="search" wire:keydown="search_followings({{$user}})" wire:model="search"
                class="block w-full p-2 bg-indigo-50 border border-indigo-300 text-indigo-900 text-md font-md rounded-2xl focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="@..." />

            <div role="button"
                class="text-white absolute end-1 bottom-1 items-center bg-blue-600 hover:bg-blue-700 focus:bg-blue-800 font-medium rounded-full text-sm p-2">
                <svg class="w-4 h-4 text-slate-50" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
        </div>

        <div class="">
            <button type="button" data-modal-hide="show-followings-modal"
                class="text-slate-50 font-medium bg-transparent rounded-full text-sm w-8 h-8 ms-auto inline-flex justify-center items-center border-2 border-slate-50">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>

    </div>
    <!-- Modal body -->
    <div class="p-4 md:p-5 space-y-4">

        <div class="h-80 overflow-y">

            @foreach($followings as $following)

                <a href="/user/{{$following->nick_name}}"
                    class="flex items-center gap-2 w-full ps-3  py-2 text-lg text-slate-50 hover:bg-indigo-500">
                    <img class="w-12 h-12 rounded-full border-2 border-slate-50" src="{{$following->getAvatar()}}">
                    <div class=" font-normal grid w-auto ">

                        <div class=" font-medium sm:block truncate">
                            {{ $following->nick_name }}
                        </div>

                        @if($following->isOnline())

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
