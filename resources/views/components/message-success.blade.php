<div class="relative">
  @if (session()->has('success'))
  <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
    class="absolute top-2 right-4 z-50 bg-green-600 w-2/3 md:w-[400px]  border border-green-400 text-white px-4 py-6 rounded col-span-6"
    role="alert">
    {{ session('success') }}
    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="show = false" aria-label="Close">
      <span class="text-white">&times;</span>
    </button>
  </div>
  @endif

</div>