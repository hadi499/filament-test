<div>
  <nav class="bg-white shadow-md " x-data="{ open: false }">
    <div class="w-full mx-auto px-4 sm:px-6 lg:px-20">
      <div class="flex justify-between h-16">
        <!-- Left side: Logo, Home, About -->
        <div class="flex">
          <a wire:navigate href="/" class="flex items-center space-x-2 text-gray-800 hover:text-gray-900">
            <img src="{{asset('images/pohadi-black.png')}}" class="w-24 " alt="logo">

          </a>
          <div class="hidden md:flex md:items-center md:ml-6 md:gap-3">
            @auth
            <a wire:navigate href="{{ route('home') }}"
              class="text-gray-800  hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('home') ? 'border-b-2 border-blue-500' : '' }}">Home</a>
              <a wire:navigate href="{{ route('score') }}"
              class="text-gray-800  hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('score') ? 'border-b-2 border-blue-500' : '' }}">Score</a>
              
            @if(Auth::user()->role == 'teacher')
            <a href="/admin"
              class="text-gray-800 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium ">Admin</a>
            @endif






            @endauth


          </div>

        </div>

        <!-- Right side: Login, Register -->
        <div class="hidden md:flex md:items-center">


          <div class="flex justify-center items-center gap-2">


            @auth

            <div x-data="{
            open: false,
            toggle() {
                if (this.open) {
                    return this.close()
                }

                this.$refs.button.focus()

                this.open = true
            },
            close(focusAfter) {
                if (! this.open) return

                this.open = false

                focusAfter && focusAfter.focus()
            }
        }" x-on:keydown.escape.prevent.stop="close($refs.button)"
              x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']"
              class="relative">
              <!-- Button -->

              <button x-ref="button" x-on:click="toggle()" :aria-expanded="open" :aria-controls="$id('dropdown-button')"
                type="button" class="flex items-center bg-white">
                <span class="mr-2">
                  {{ Auth::user()->name}}

                </span>
                <!-- Heroicon: chevron-down -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                  fill="currentColor">
                  <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
                </svg>
              </button>

              <!-- Panel -->
              <div x-ref="panel" x-show="open" x-transition.origin.top.left x-on:click.outside="close($refs.button)"
                :id="$id('dropdown-button')" style="display: none;"
                class="absolute right-0 mt-2 w-40 rounded-md bg-white border shadow-md">



                <form action="{{ route('logout') }}" method="POST" class="block w-full">
                  @csrf
                  <button type="submit"
                    class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-blue-50 disabled:text-gray-500">
                    Logout
                  </button>
                </form>


              </div>
            </div>
          </div>

          @else

          <a href="{{ route('login') }}"
            class="text-gray-800  hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium ">Login</a>

          @endauth
        </div>


        @auth

        <!-- Mobile menu button -->
        <div class="-mr-2 flex md:hidden">
          <button @click="open = !open" type="button"
            class="bg-white inline-flex items-center justify-center p-2 rounded-md text-gray-800 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-900">
            <span class="sr-only">Open main menu</span>
            <!-- Menu open: "hidden", Menu closed: "block" -->
            <svg x-show="!open" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <!-- Menu open: "block", Menu closed: "hidden" -->
            <svg x-show="open" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="open" class="md:hidden">
      <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 text-gray-500">


        <a href="{{ route('home') }}"
          class="block hover:bg-blue-200 text-left px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('home') ? ' text-blue-800' : '' }}">Home</a>


        <a href="{{ route('score') }}"
          class="block hover:bg-blue-200 text-left px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('score') ? ' text-blue-800' : '' }}">Score</a>

        



        @if(Auth::user()->role == 'teacher')
        <a href="/admin" target="_blank"
          class="block hover:bg-blue-200 text-left px-3 py-2 rounded-md text-base font-medium ">Admin</a>
        @endif


        <form action="{{ route('logout') }}" method="POST" class="block w-full">
          @csrf
          <button type="submit" class="w-full text-left hover:bg-blue-200 px-3 py-2 rounded-md text-base font-medium ">
            Logout
          </button>
        </form>

        @endauth
      </div>
    </div>
  </nav>

</div>