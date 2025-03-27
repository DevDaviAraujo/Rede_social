
<a href="/user/{{ $post->user->nick_name }}">
    <div class="border-b border-indigo-200 py-3">

        <div class='flex justify-between my-1 w-full'>
            <a href="/user/{{ $post->user->nick_name }}"
                class="flex items-center gap-2 w-fit text-lg justify-self-start">
                <img class="w-9 h-9 rounded-full border-2 border-indigo-200" loading="lazy" src="{{ $post->user->getAvatar() }}">
                <div class=" font-normal grid w-auto ">

                    <div class="justify-self-start text-base font-medium sm:block truncate">
                        {{ $post->user->nick_name }}
                    </div>

                    @if ($post->user->isOnline())
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
            
            <div class="text-sm place-items-start">
                {{$post->getTime()}}
            </div>
        </div>

        <div class=" overflow-hidden py-1 max-h-20 text-wrap">
            {{$post->content}}
        </div>

        @include('components.media-carousel',['images' => $post->images])

        <div class='grid grid-cols-3 justify-items-center'>

            <div class="justify-center justify-items-center">
                {{$post->getEnjoyers->count()}}
                @livewire('Actions.likePost', ['postId' => $post->id])
            </div>

            <div class="justify-center justify-items-center">
                {{$post->getAllComments()->count()}}
                <div role='button' data-modal-target="make-comment-modal-{{$post->id}}"
                    data-modal-toggle="make-comment-modal-{{$post->id}}">
                    <svg class="size-6 sm:size-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 11.5h13m-13 0V18a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-6.5m-13 0V9a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v2.5M9 5h11a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1h-1" />
                    </svg>
                </div>
            </div>

            <div>
                <div role='button'>
                    <br>
                    <svg class="size-6 sm:size-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M7.926 10.898 15 7.727m-7.074 5.39L15 16.29M8 12a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm12 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm0-11a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                    </svg>

                </div>
            </div>
        </div>
    </div>
</a>
