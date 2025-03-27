<div>
    <p class='text-lg font-medium'>Ordem: </p>

    <div class='inline-flex w-full gap-1 sm:gap-2 py-2 border-b border-indigo-200'>
        <label
            class="flex place-content-center items-center gap-1 transition-transform duration-200 ease-in-out w-auto text-slate-50 text-md font-normal bg-indigo-700 shadow-md border-b-2 border-indigo-800 rounded-full py-0.5 px-1">
            <p class='ms-1'>Recentes</p>
            <input type="radio" wire:model="sortBy" value="latest" class="sr-only peer">
            <div role='button' wire:click="setSortOrder('latest')"
                class="relative ring-1 ring-slate-50 w-9 h-5 bg-indigo-400 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-violet-500">
            </div>
        </label>

        <label
            class="flex place-content-center items-center gap-1 transition-transform duration-200 ease-in-out w-auto text-slate-50 text-md font-normal bg-indigo-700 shadow-md border-b-2 border-indigo-800 rounded-full py-0.5 px-1">
            <p class='ms-1'>Antigos</p>
            <input type="radio" wire:model="sortBy" value="oldest" class="sr-only peer">
            <div role='button' wire:click="setSortOrder('oldest')"
                class="relative ring-1 ring-slate-50 w-9 h-5 bg-indigo-400 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-violet-500">
            </div>
        </label>

        <label
            class="flex place-content-center items-center gap-1 transition-transform duration-200 ease-in-out w-auto text-slate-50 text-md font-normal bg-indigo-700 shadow-md border-b-2 border-indigo-800 rounded-full py-0.5 px-1">
            <p class='ms-1'>Relevância</p>
            <input type="radio" wire:model="sortBy" value="relevance" class="sr-only peer">
            <div role='button' wire:click="setSortOrder('relevance')"
                class="relative ring-1 ring-slate-50 w-9 h-5 bg-indigo-400 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-violet-500">
            </div>
        </label>
    </div>

    @foreach($contents as $content)
        @component('components.posts', ['post' => $content])
        @endcomponent
    @endforeach
</div>