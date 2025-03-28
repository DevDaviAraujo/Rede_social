<div>
    <button type="button"
        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
        data-modal-hide="delete-post-modal">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
        <span class="sr-only">Close modal</span>
    </button>
    <div class="p-4 md:p-5 text-center">

        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>

        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Deseja prosseguir com a acão?
        </h3>

        <br>

        <div class="flex justify-center gap-5 border-t border-slate-50 rounded-b">

            <button data-modal-hide="delete-post-modal" type="button"
                class="w-full sm:w-auto flex place-content-center items-center gap-2 transition-transform duration-200 ease-in-out text-slate-50 text-md font-medium bg-gray-700 shadow-xl active:shadow-lg active:bg-gray-800 border-b-4 border-gray-800 active:border-b-2 active:scale-95 rounded-lg px-5 py-2.5 ">

                <svg class="w-6 h-6 text-slate-50 transform scale-x-[-1]" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M5.027 10.9a8.729 8.729 0 0 1 6.422-3.62v-1.2A2.061 2.061 0 0 1 12.61 4.2a1.986 1.986 0 0 1 2.104.23l5.491 4.308a2.11 2.11 0 0 1 .588 2.566 2.109 2.109 0 0 1-.588.734l-5.489 4.308a1.983 1.983 0 0 1-2.104.228 2.065 2.065 0 0 1-1.16-1.876v-.942c-5.33 1.284-6.212 5.251-6.25 5.441a1 1 0 0 1-.923.806h-.06a1.003 1.003 0 0 1-.955-.7A10.221 10.221 0 0 1 5.027 10.9Z" />
                </svg>
            </button>

            <button data-modal-hide="delete-post-modal" type="button" wire:click='delete()'
                class="w-full sm:w-auto flex place-content-center items-center gap-2 transition-transform duration-200 ease-in-out text-slate-50 text-md font-medium bg-red-700 shadow-xl active:shadow-lg active:bg-red-800 border-b-4 border-red-800 active:border-b-2 active:scale-95 rounded-lg px-5 py-2.5 ">
                excloi
            </button>

        </div>
    </div>
</div>