<x-template :role="'admin'" :title="'Dashboard'">
  <x-slot:content>
    <p class="my-2">Selamat datang di platform <span class="text-[#6B56F6] font-bold">Schedu</span></p>
    <div class="overflow-scroll h-[calc(100vh-200px)]">
      <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-4">
        <div class="h-auto">
          <div class="grid grid-cols-2 gap-4 lg:grid-cols-2 lg:gap-4">
            <x-total-card :total="$mahasiswaCount" :title="'Mahasiswa'" />
            <x-total-card :total="$dosenCount" :title="'Dosen'" />
            <x-total-card :total="$matakuliahCount" :title="'Mata Kuliah'" />
            <x-total-card :total="$ruangCount" :title="'Ruang'" />
          </div>
        </div>
        <div class="h-auto">
          <div class="h-full rounded-lg bg-white shadow-sm">
            <div class="grid grid-cols-2 gap-x-2 p-4">
              <div class="flex flex-col justify-between gap-y-2">
                <p class="text-2xl font-semibold">Manajemen <span class="text-[#6B56F6]">Jadwal</span> Kuliah</p>
                <p class="text-sm">Buat jadwal secara instan dengan fitur generate secara otomatis</p>
                <a class="inline-block rounded-lg bg-gradient-to-r from-[#6B56F6] to-[#8C4AF2] px-8 py-2 size-fit text-sm font-medium text-white "
                  href="#">
                  Mulai
                </a>
              </div>
              <img src="{{ asset('images/dashboard-image.svg') }}" alt="" class="h-52">
            </div>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-4 mt-4">
        <x-dashboard.schedule-card :prodiBelum="$prodiBelum" :prodiSudah="$prodiSudah"
          :prodiBelumCount="$prodiBelumCount" :prodiSudahCount="$prodiSudahCount" />
        <x-request-card :notification="$notification" />
      </div>
    </div>
  </x-slot:content>
</x-template>