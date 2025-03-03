<div class="border-b border-indigo-200 py-3">

    <div class='flex justify-between '>

        <a href="/user/{{ $coment->user->nick_name }}" class="flex items-center gap-2 w-fit text-lg justify-self-start">
            <img class="w-9 h-9 rounded-full border-2 border-indigo-200" src="{{ $coment->user->getAvatar() }}">
            <div class=" font-normal grid w-auto ">

                <div class=" text-base font-medium sm:block truncate">
                    {{ $coment->user->nick_name }}
                </div>

                @if ($coment->user->isOnline())
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

        <div class="flex gap-4">

            @if(Auth::check() && Auth::id() == $coment->users_id)
                <div class=''>
                    @livewire('actions.delete-coment', ['comentId' => $coment->id])
                </div>
            @endif

            <div class="text-sm place-items-start">
                {{$coment->getTime()}}
            </div>

        </div>

    </div>

    <div id="read-more-container-{{$coment->id}}" class="  overflow-hidden flex place-items-center max-h-24 break-all">
        
        @if($coment->originalComent())
            <a href="/user/{{$coment->originalComent()->user->nickname}}" class="underline">
                {{$coment->originalComent()->user->nickname . " "}}
            </a>
        @endif
        {{$coment->content}}
    </div>
    <button id="read-more-btn-{{$coment->id}}" class="text-indigo-200 underline mt-1 hidden">Leia mais...</button>

    <div class='grid grid-cols-3 justify-items-center'>

        <div class="justify-center justify-items-center">
            {{$coment->enjoyers->count()}}
            @livewire('Actions.likePost', ['postId' => $coment->id])
        </div>

        <div class="justify-center justify-items-center">
            {{$coment->coments()->count()}}
            <div role='button' data-modal-target="make-coment-modal-{{$coment->id}}"
                data-modal-toggle="make-coment-modal-{{$coment->id}}">
                <svg class="size-6 sm:size-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 11.5h13m-13 0V18a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-6.5m-13 0V9a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v2.5M9 5h11a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1h-1" />
                </svg>
            </div>
        </div>

        @if($coment->coments()->count() >= 1)
            <div class="justify-center justify-items-center">
                <br>
                <div role='button' id="showChildComents-{{$coment->id}}">
                    Mostrar comentários
                </div>
            </div>
        @endif

    </div>
    <div id="childComents_container-{{$coment->id}}" class="hidden">
        @foreach($coment->coments() as $coment)

            @include('components.coments', ['coment' => $coment])

        @endforeach
    </div>

</div>