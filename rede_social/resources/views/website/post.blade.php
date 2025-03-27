@extends('website.index')

@section('content')

    <div class="border-b border-indigo-200 py-3">

        <div class='flex justify-between '>
            <a href="/user/{{ $post->user->nick_name }}" class="flex items-center gap-2 w-fit text-lg justify-self-start">
                <img class="w-9 h-9 rounded-full border-2 border-indigo-200" src="{{ $post->user->getAvatar() }}">
                <div class=" font-normal grid w-auto ">

                    <div class=" text-base font-medium sm:block truncate">
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

            <div class="flex gap-4">

                @if(Auth::check() && Auth::id() == $post->user_id)



                    <div role="button" data-modal-target="edit-post-modal-{{$post->id}}"
                        data-modal-toggle="edit-post-modal-{{$post->id}}"
                        class="bg-indigo-800 text-sm font-medium ring-2 ring-slate-50 text-slate-50 p-0.5 rounded gap-2 h-fit w-fit">

                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                        </svg>

                    </div>

                    <div role="button" data-modal-target="delete-post-modal" data-modal-toggle="delete-post-modal"
                        class="bg-rose-800 text-sm font-medium ring-2 ring-slate-50 text-slate-50 p-1 rounded gap-2 h-fit w-fit">

                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                clip-rule="evenodd" />
                        </svg>

                    </div>


                @endif
                <div class="text-sm place-items-start">
                    {{$post->getTime()}}
                </div>
            </div>
        </div>

        <div>
            <div class=" w-full h-full py-1 max-h-20 text-balance">
                {{$post->content}}
            </div>

            @if($post->images->count() > 0)

                @include('components.media-carousel', ['images' => $post->images])

            @endif
        </div>
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
                    <svg class="size-6 sm:size-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M7.926 10.898 15 7.727m-7.074 5.39L15 16.29M8 12a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm12 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm0-11a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                    </svg>

                </div>
            </div>
        </div>
    </div>

    @foreach($post->getAllComments() as $comment)

        @include('components.comments', ['comment' => $comment])

    @endforeach

    @if(Auth::check())

        <div id="delete-post-modal" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    @livewire('actions.delete-post', ['postId' => $post->id])
                </div>
            </div>
        </div>

        <!-- Main modal -->
        <div id="edit-post-modal-{{$post->id}}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-2 sm:p-4 w-full max-w-2xl max-h-full">

                @livewire('forms.edit-post-form', ['postId' => $post->id])
            </div>
        </div>

        <!-- Main modal -->
        <div id="make-comment-modal-{{$post->id}}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-2 sm:p-4 w-full max-w-2xl max-h-full">

                @livewire('forms.make-comment', ['postId' => $post->id])
            </div>
        </div>

        @foreach($post->getValidComments() as $comment)

            <!-- Main modal -->
            <div id="make-comment-modal-{{$comment->id}}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-2 sm:p-4 w-full max-w-2xl max-h-full">

                    @livewire('forms.make-comment', ['postId' => $comment->id])
                </div>
            </div>

        @endforeach

    @endif
@endsection