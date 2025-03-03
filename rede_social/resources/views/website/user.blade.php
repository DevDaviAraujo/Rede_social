@extends('website.index')
@section('content')


    <div class=" mt-4 grid grid-cols-3 ">

        <div class="p-1 border-r border-indigo-200 ">

            <div class="px-1 py-2 rounded bg-gray-700 items-start place-content-center h-full">


                <img class="w-16 h-16 rounded-full border-2 border-indigo-200" src="{{$user->getAvatar()}}">

                <div class="items-start mt-2 truncate">
                    <p>{{$user->nick_name}}</p>
                    @if($user->isOnline())

                        <p
                            class=" font-normal text-slate-50 rounded-full align-self-center bg-emerald-400 px-1 flex items-center w-fit">
                            online
                        </p>
                    @else
                        <p class="  text-slate-50 rounded-full bg-slate-400 px-1 flex items-center w-fit">
                            offline
                        </p>
                    @endif
                </div>

            </div>

        </div>

        <div class="col-span-2 p-1 place-content-center">

            <div class="px-1 py-2 rounded bg-gray-700 h-full place-items-center">

                <div class="flex gap-6 my-4 justify-center ">

                    <p role="button" data-modal-target="show-followers-modal" data-modal-toggle="show-followers-modal">
                        Seguidores:
                        {{$user->followersCount()}}
                    </p>

                    <p role="button" data-modal-target="show-followings-modal" data-modal-toggle="show-followings-modal">
                        Seguindo:
                        {{$user->followingsCount()}}
                    </p>

                </div>

                <div class="flex gap-4 my-2 justify-center ">

                    @if(Auth::check() && Auth::user()->id == $user->id)

                        <button data-modal-target="edit-user-modal" data-modal-toggle="edit-user-modal"
                            class=" flex place-content-center items-center gap-2 transition-transform duration-200 ease-in-out w-auto text-slate-50 text-md font-medium bg-indigo-700 shadow-xl active:shadow-lg active:bg-indigo-800 border-b-4 border-indigo-800 active:border-b-2 active:scale-95 rounded-full py-1.5 px-2 ">

                            <svg class="w-6 h-6 text-slate-50" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="2"
                                    d="M7 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h1m4-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm7.441 1.559a1.907 1.907 0 0 1 0 2.698l-6.069 6.069L10 19l.674-3.372 6.07-6.07a1.907 1.907 0 0 1 2.697 0Z" />
                            </svg>

                        </button>

                    @else

                        @livewire('actions.follow', ['user_followed_id' => $user->id])

                    @endif

                    <button type="submit"
                        class="flex place-content-center items-center gap-1 border-2 border-slate-50 text-slate-50 active:text-slate-200 px-3 py-1.5 rounded-full">
                        share

                        <svg class="w-4 h-4 text-slate-50" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17.5 3a3.5 3.5 0 0 0-3.456 4.06L8.143 9.704a3.5 3.5 0 1 0-.01 4.6l5.91 2.65a3.5 3.5 0 1 0 .863-1.805l-5.94-2.662a3.53 3.53 0 0 0 .002-.961l5.948-2.667A3.5 3.5 0 1 0 17.5 3Z" />
                        </svg>


                    </button>

                </div>

            </div>

        </div>
    </div>

    <div class="text-md border-y border-indigo-200 py-1 mx-1">
        <div id="read-more-container-bio"
            class=" p-2 overflow-hidden rounded bg-gray-700 max-h-24 ">
            <p class="text-pretty">{{$user->bio}}</p>
        </div>
        <button id="read-more-btn-bio" class="text-indigo-200 underline mt-1 hidden">Leia mais...</button>
    </div>

    <div id="show-followers-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">

            @livewire('Actions.ShowFollowers', ['user' => $user])

        </div>
    </div>

    <div id="show-followings-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">

            @livewire('Actions.ShowFollowings', ['user' => $user])

        </div>
    </div>


    @foreach($user->posts as $index => $post)

        
            @include('components.posts', ['post' => $post])
        

    @endforeach


    @if(Auth::check())
        @if(Auth::user()->id == $user->id)

            <!-- Main modal -->
            <div id="edit-user-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-2 sm:p-4 w-full max-w-2xl max-h-full">

                    @livewire('forms.edit-user-form', ['user' => $user])

                </div>
            </div>
        @endif
    @endif

@endsection