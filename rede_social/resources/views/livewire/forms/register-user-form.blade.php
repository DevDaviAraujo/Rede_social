<form wire:submit.prevent="register">

    @csrf

    <div class="relative z-0 w-full mb-3 group">
        <label class="flex w-full mb-1.5 items-center justify-between ">
            <p class='text-md font-medium justify-self-start'>@</p>
            @error('nick_name')
                <div class="text-sm font-medium text-rose-600 justify-self-end me-2">{{ $message }}</div>
            @enderror
        </label>
        <div class="relative">
            <input type="text" wire:model="nick_name" maxlength="20" oninput='this.value = this.value.replace(/[!@#$%^&*(),.?":{}|<>¨]/, "").replace(/(\..*?)\..*/g, "$1");'
                class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm font-md rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5  "
                placeholder="seu_nickname">
        </div>

    </div>

    <div class="relative z-0 w-full mb-3 group">
        <label class="flex w-full mb-1.5 items-center justify-between ">
            <p class='text-md font-medium justify-self-start'>E-mail</p>
            @error('email')
                <div class="text-sm font-medium text-rose-600 justify-self-end me-2">{{ $message }}</div>
            @enderror
        </label>
        <div class="relative">
            <input type="text" wire:model="email" maxlength="40"
                class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm font-md rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5  "
                placeholder="seuemail@exemplo.com">
        </div>

    </div>
    <div class="relative z-0 w-full mb-3 group">
        <label class="flex w-full mb-1.5 items-center justify-between ">
            <p class='text-md font-medium justify-self-start'>Senha</p>
            @error('password')
                <div class="text-sm font-medium text-rose-600 justify-self-end me-2">{{ $message }}</div>
            @enderror
        </label>
        <div class="relative">
            <input type="password" wire:model="password" maxlength="20"
                class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm font-md rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5  "
                placeholder="s#nh4Exempl0!">
        </div>
    </div>
    <div class="relative z-0 w-full mb-3 group">
        <label class="block mb-1.5 text-md font-medium dark:text-slate-50">Confirme a
            senha</label>
        <div class="relative">
            <input type="password" wire:model="password_confirmation" maxlength="20"
                class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm font-md rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5  "
                placeholder="s#nh4Exempl0!">
        </div>
    </div>

    <div class="grid grid-cols-2 gap-6">

        <div class="relative z-0 w-full mb-3 group">

            <label class="flex w-full mb-1.5 items-center justify-between text-md font-medium">

                <p class='justify-self-start'>Nome</p>

            </label>

            <div class="relative">

                <input type="text" wire:model="name" maxlength="20"
                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm font-md rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5  "
                    placeholder="Nome">

            </div>

            @error('name')
                <div class="text-sm font-medium text-rose-600 justify-self-end me-2 mt-2">{{ $message }}</div>
            @enderror

        </div>

        <div class="relative z-0 w-full mb-3 group">

            <label class="flex w-full mb-1.5 items-center justify-between text-md font-medium">

                <p class='justify-self-start'>SobreNome</p>

            </label>

            <div class="relative">
                <input type="text" wire:model="last_name" maxlength="20"
                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm font-md rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5  "
                    placeholder="Sobrenome">
            </div>

            @error('last_name')
                <div class="text-sm font-medium text-rose-600 justify-self-end me-2 mt-2">{{ $message }}</div>
            @enderror

        </div>

    </div>
    <div class="grid grid-cols-2 gap-6 mb-3">

        <div class="relative z-0 w-full mb-3 group">

            <label class="flex w-full mb-1.5 items-center justify-between text-md font-medium">
                <p class='justify-self-start'>Número de Telefone</p>

            </label>

            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                wire:model="phone_number" maxlength="13" minlength="13"
                class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm font-md rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5  "
                placeholder="55 11 999999999 " />

            @error('phone_number')
                <div class="text-sm font-medium text-rose-600 justify-self-end me-2 mt-2">{{ $message }}</div>
            @enderror

        </div>

        <div class="relative z-0 w-full mb-3 group">

            <label class="flex w-full mb-1.5 items-center justify-between text-md font-medium">

                <p class='justify-self-start'>Gênero</p>

            </label>

            <select id="gender" wire:model="gender"
                class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm font-md rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5  ">
                <option selected value="OT" class="bg-indigo-50 hover:bg-indigo-200">Outro</option>
                <option value="MA">Masculino</option>
                <option value="FE">Feminino</option>
            </select>

            @error('gender')
                <div class="text-sm font-medium text-rose-600 justify-self-end me-2 mt-2">{{ $message }}</div>
            @enderror

        </div>
    </div>
    <div class="relative z-0 w-full mb-3 group">
        <button type="submit"
            class="flex place-content-center items-center gap-2 transition-transform duration-200 ease-in-out w-full text-slate-50 text-md font-medium bg-indigo-700 shadow-xl active:shadow-lg active:bg-indigo-800 border-b-4 border-indigo-800 active:border-b-2 active:scale-95 rounded-lg px-5 py-2.5 "
            wire:loading.attr="disabled" wire:loading.class="">

            Enviar

            <!-- Loading Spinner -->
            <div wire:loading role="status">
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


    @isset($returnMessage)
        @if ($returnMessage['status'] === 'success')
            <div class="relative z-0 w-auto animate-popup">
                <div class="bg-green-100 rounded-md text-green-600 p-2.5 shadow-md">
                    <div class="flex items-center">
                        <p class="text-md font-medium ms-2 justify-self-start">{{ $returnMessage['message'] }}</p>
                    </div>
                </div>
            </div>
        @elseif ($returnMessage['status'] === 'error')
            <div class="relative z-0 w-auto animate-popup">
                <div class="bg-amber-100 rounded-md text-amber-600 p-2.5 shadow-md">
                    <div class="flex items-center">

                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                                clip-rule="evenodd" />
                        </svg>

                        <p class="text-md font-medium ms-2 justify-self-start">{{ $returnMessage['error'] }}</p>
                        
                    </div>
                </div>
            </div>
        @endif
    @endisset






</form>