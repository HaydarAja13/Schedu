<x-template :role="'admin'" :title="'Dashboard'">
  <x-slot:content>
    <p class="my-2">Selamat datang di platform <span class="text-[#6B56F6] font-bold">Schedu</span></p>
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-8">
      <div class="h-auto">
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-8">
          <div class="h-32 rounded bg-gray-300"></div>
          <div class="h-32 rounded bg-gray-300"></div>
          <div class="h-32 rounded bg-gray-300"></div>
          <div class="h-32 rounded bg-gray-300"></div>
        </div>
      </div>
      <div class="h-auto">
        <div class="h-full rounded bg-gray-300"></div>
      </div>
    </div>
  </x-slot:content>
</x-template>