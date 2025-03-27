<div class="border-b  border-indigo-200 py-3 
@if(!$comment->status) bg-slate-700 @endif">



    <div class='flex justify-between '>

        <a href="/user/{{ $comment->user->nick_name }}" class="flex items-center gap-2 w-fit text-lg justify-self-start">
            <img class="w-9 h-9 rounded-full border-2 border-indigo-200" src="{{ $comment->user->getAvatar() }}">
            <div class=" font-normal grid w-auto ">

                <div class=" text-base font-medium sm:block truncate">
                    {{ $comment->user->nick_name }}
                </div>

                @if ($comment->user->isOnline())
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

            @if(Auth::check() && Auth::id() == $comment->users_id && $comment->status == true)
                <div class=''>
                    @livewire('actions.delete-comment', ['commentId' => $comment->id])
                </div>
            @endif

            <div class="text-sm place-items-start">
                {{$comment->getTime()}}
            </div>

        </div>

    </div>

    @if(!$comment->status)

        <div id="read-more-container-{{$comment->id}}" class="overflow-hidden max-h-24 text-wrap w-full ">
            
            <p class="italic font-light">Comentário apagado</p>
        
        </div>

        <button id="read-more-btn-{{$comment->id}}" class="text-indigo-200 underline mt-1 hidden">Leia mais...</button>

    @else

        <div id="read-more-container-{{$comment->id}}" class="overflow-hidden max-h-24 text-wrap w-full "> 

            @if($comment->getOrignalCommentNickname())


                    <a href="/user/{{$comment->getOrignalCommentNickname()}}" class=" text-white underline pe-2">
                        
                        {{$comment->getOrignalCommentNickname()}}

                    </a>

                @endif

            {{$comment->content}}

        </div>

        <button id="read-more-btn-{{$comment->id}}" class="text-indigo-200 underline mt-1 hidden">Leia mais...</button>

    @endif
   

    <div class='grid grid-cols-3 justify-items-center'>

        <div class="justify-center justify-items-center @if(!$comment->status) cursor-not-allowed @endif" @if(!$comment->status) disabled @endif >
            {{$comment->getEnjoyers->count()}}
            @livewire('Actions.likePost', ['postId' => $comment->id])
        </div>

        <div class="justify-center justify-items-center ">
            {{$comment->getAllComments()->count()}}
            <div class="@if(!$comment->status) cursor-not-allowed @endif" @if(!$comment->status) disabled @endif role='button' data-modal-target="make-comment-modal-{{$comment->id}}"
                data-modal-toggle="make-comment-modal-{{$comment->id}}">
                <svg class="size-6 sm:size-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 11.5h13m-13 0V18a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-6.5m-13 0V9a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v2.5M9 5h11a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1h-1" />
                </svg>
            </div>
        </div>

        @if($comment->getAllComments()->count() >= 1)
            <div class="justify-center justify-items-center">
                <br>
                <div role='button' id="showChildComments-{{$comment->id}}">
                    Mostrar mais
                </div>
            </div>
        @endif

    </div>
    @foreach($comment->getAllComments() as $comment)

        <div id="childComments_container-{{$comment->id}}" class="hidden bg-gray-700 ps-3">   

            @include('components.comments', ['comment' => $comment])

        </div>
        
     @endforeach

</div>