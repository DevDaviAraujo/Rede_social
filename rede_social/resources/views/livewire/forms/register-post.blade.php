<!-- Modal content -->
<div class="relative bg-indigo-600 text-slate-50 rounded-lg shadow">
    <!-- Modal header -->
    <div class="flex items-center justify-between mx-2 sm:mx-4 py-2 sm:py-4 border-b border-slate-50 rounded-t">

        <div class="flex items-center gap-2 w-fit text-lg justify-self-start">
            <img class="w-10 h-10 rounded-full border-2 border-indigo-200" src="{{ Auth::user()->getAvatar() }}">
            <div class=" font-normal grid w-auto ">

                <div class=" font-medium sm:block truncate">
                    {{ Auth::user()->nick_name }}
                </div>

                @if (Auth::user()->isOnline())
                    <p class=" text-xs text-slate-50 rounded-full bg-emerald-400 px-1 flex items-center w-fit">
                        online
                    </p>
                @else
                    <p class=" text-xs text-slate-50 rounded-full bg-slate-400 px-1 flex items-center w-fit">
                        offline
                    </p>
                @endif

            </div>
        </div>

        <button type="button"
            class="text-slate-50 font-medium bg-transparent rounded-full text-sm w-8 h-8 ms-auto inline-flex justify-center items-center border-2 border-slate-50"
            data-modal-hide="create_post_modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
        </button>
    </div>
    <!-- Modal body -->
    <div class="p-2 sm:p-4 space-y-4">

        <form wire:submit.prevent="register" enctype="multipart/form-data">
            @csrf


            <textarea name="" maxlength="255" wire:model="content"
                class="bg-slate-500 rounded-lg placeholder-slate-200 w-full h-24 ring-0 border-none focus:ring-0 focus:border-none"
                id="" placeholder="Digite aqui o conteúdo do meu post..."></textarea>

            @error('files')
                <div class="text-sm font-medium text-rose-400 justify-self-end me-2">{{ $message }}</div>
            @enderror



            @if ($uploads)
            
            @include('components.uploads-media-carousel', ['uploads' => $uploads])
            
                <div class="mt-1 border-t border-slate-50">
                    <h3>Arquivos anexados:</h3>
                    <ul>
                        @foreach ($uploads as $index => $upload)
                            <li class="flex gap-3 mb-1 ps-1.5 bg-indigo-500 rounded-full w-fit ">
                                <p class="truncate overflow-hidden max-w-56 sm:max-w-80">{{ $upload->getClientOriginalName() }}</p>
                                <div wire:click="removeUploads({{$index}})" class="justify-self-end" role="button"
                                    class="cursor-pointer">
                                    <svg class="w-6 h-6 text-rose-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                 
            @endif

            <label for="file_zone" class="flex items-end justify-end w-full">
                <div class="absolute me-2 mb-2">
                    <div role="button" 
                        class="w-fit flex place-content-center items-center gap-2 transition-transform duration-200 ease-in-out text-slate-50 text-md font-medium bg-blue-700 shadow-xl active:shadow-lg active:bg-blue-800 border-b-4 border-blue-800 active:border-b-2 active:scale-95 rounded-full py-2 px-3">

                        <svg wire:loading.remove wire:target="files" class="w-6 h-6 slate-50" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Zm.394 9.553a1 1 0 0 0-1.817.062l-2.5 6A1 1 0 0 0 8 19h8a1 1 0 0 0 .894-1.447l-2-4A1 1 0 0 0 13.2 13.4l-.53.706-1.276-2.553ZM13 9.5a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z"
                                clip-rule="evenodd" />
                        </svg>

                        <div wire:loading wire:target="files" role="status">
                            <svg aria-hidden="true" class="w-5 h-5 text-md text-slate-50 animate-spin fill-blue-700"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                        </div>

                    </div>
                </div>

                <!-- File Input -->
                <input type="file" class="hidden" wire:model="files" multiple id="file_zone" />
            </label>

            

            @isset($returnMessage)

                @foreach($returnMessage as $message)

                    @if ($message['status'] == 'success')
                        <div class="relative z-0 animate-popup m-2">
                            <div class="bg-green-100 rounded-md text-green-600 p-2.5 shadow-md">
                                <div class="flex items-center">

                                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                                            clip-rule="evenodd" />
                                    </svg>

                                    <p class="text-md font-medium ms-2 justify-self-start">{{ $message['message'] }}</p>

                                </div>
                            </div>
                        </div>
                    @else
                        <div class="relative z-0 w-auto animate-popup m-2">
                            <div class="bg-amber-100 rounded-md text-amber-600 p-2.5 shadow-md">
                                <div class="flex items-center">

                                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z" clip-rule="evenodd"/>
                                      </svg>
                                                                     

                                    <p class="text-md font-medium ms-2 justify-self-start">{{ $message['error'] }}</p>

                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endisset

            <div
                class="flex justify-between gap-4 sm:justify-end items-center pt-2 sm:pt-4 border-t border-slate-50 rounded-b">

                <button type="button"
                    class="w-full sm:w-auto flex place-content-center items-center gap-2 transition-transform duration-200 ease-in-out text-slate-50 text-md font-medium bg-gray-700 shadow-xl active:shadow-lg active:bg-gray-800 border-b-4 border-gray-800 active:border-b-2 active:scale-95 rounded-lg px-5 py-2.5 "
                    data-modal-hide="create_post_modal">

                    <svg class="w-6 h-6 text-slate-50 transform scale-x-[-1]" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M5.027 10.9a8.729 8.729 0 0 1 6.422-3.62v-1.2A2.061 2.061 0 0 1 12.61 4.2a1.986 1.986 0 0 1 2.104.23l5.491 4.308a2.11 2.11 0 0 1 .588 2.566 2.109 2.109 0 0 1-.588.734l-5.489 4.308a1.983 1.983 0 0 1-2.104.228 2.065 2.065 0 0 1-1.16-1.876v-.942c-5.33 1.284-6.212 5.251-6.25 5.441a1 1 0 0 1-.923.806h-.06a1.003 1.003 0 0 1-.955-.7A10.221 10.221 0 0 1 5.027 10.9Z" />
                    </svg>

                    <span class="sr-only">Close modal</span>
                </button>


                <button type="submit"
                    class="w-full sm:w-auto flex place-content-center items-center gap-2 transition-transform duration-200 ease-in-out text-slate-50 text-md font-medium bg-indigo-700 shadow-xl active:shadow-lg active:bg-indigo-800 border-b-4 border-indigo-800 active:border-b-2 active:scale-95 rounded-lg px-5 py-2.5 ">
                    Enviar
                    <div wire:loading wire:target="register" role="status">
                        <svg aria-hidden="true" class="h-4 w-4 text-md text-slate-50 animate-spin fill-indigo-700"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill" />
                        </svg>
                    </div>
                </button>


            </div>

        </form>

    </div>
</div>