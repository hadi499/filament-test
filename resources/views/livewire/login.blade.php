<div class="max-w-md mx-auto mt-5 p-2">
    <img src="{{asset('images/sinau-blue.png')}}" alt="">
    <form wire:submit.prevent="login" class="bg-white shadow-md rounded px-8 mt-7 pt-6 pb-8 mb-4 border">
        <h2 class="text-2xl text-center font-semibold mb-4">Login</h2>

        @if (session()->has('message'))
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
        @endif

        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
            <input type="name" wire:model="name" id="name"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>


        <div class="mb-4" x-data="{ show: false }">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <div class="relative">
                <input :type="show ? 'text' : 'password'" wire:model="password" id="password"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 px-4 text-gray-600 focus:outline-none">
                    <span x-show="!show">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path
                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                        </svg>
                    </span>
                    <span x-show="show">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-eye-off">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" />
                            <path
                                d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" />
                            <path d="M3 3l18 18" />
                        </svg>
                    </span>
                </button>
            </div>
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>


        <div class="flex items-center justify-between">
            <!-- <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Login
            </button> -->
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                wire:loading.attr="disabled">
                <span wire:loading.remove>Login</span>
                <svg wire:loading class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
            </button>
        </div>

    </form>
</div>