<x-template :role="'admin'" title="Notifikasi">
  <x-slot:content>
    <div class="w-full bg-white rounded-lg mt-4 p-4 overflow-scroll h-[calc(100vh-200px)]">
      <div class="flex items-center justify-start gap-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="size-5">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
        </svg>
        <p class="font-semibold text-sm">Notifikasi</p>
      </div>
      <livewire:notification-table></livewire:notification-table>

    </div>
  </x-slot:content>
</x-template>