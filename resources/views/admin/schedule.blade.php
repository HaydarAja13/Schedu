<x-template :role="'admin'" :title="'Jadwal'">
  <x-slot:content>
    <p class="my-2">Selamat datang di platform <span class="text-[#6B56F6] font-bold">Schedu</span></p>
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8">
      <x-schedule.schedule-content :programStudis="$programStudis" />
      <x-request-card></x-request-card>
    </div>
  </x-slot:content>
</x-template>