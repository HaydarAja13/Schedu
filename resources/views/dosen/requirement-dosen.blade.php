<x-template :role="'dosen'" title="Tambah Requirement Dosen">
  <x-slot:content>
    <div class="overflow-scroll h-[calc(100vh-200px)]">
      <form action="{{ route('requirement-dosen.store') }}" method="POST">
        @csrf
        <div class="mt-4 bg-white rounded-lg p-8">
          <div class="grid grid-cols-1 items-center md:grid-cols-3 gap-4 mb-4">
            <div class="w-72">
              <label class=" whitespace-nowrap  text-sm md:text-base">Hari <span class="text-red-500">*</span></label>
              <p class="text-xs text-gray-400">Masukan Hari menggunakan awalan kapital</p>
            </div>
            <input type="text" name="hari" required placeholder="cth: Senin"
              class="md:col-span-2 w-full rounded-md  px-3 py-1.5 h-fit text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500" />
            <div class="w-72">
              <label class=" whitespace-nowrap  text-sm md:text-base">Keterangan <span
                  class="text-red-500">*</span></label>
              <p class="text-xs text-gray-400">Masukan Keterangan</p>
            </div>
            <input type="text" name="keterangan" required placeholder="cth: Mengantar anak sekolah"
              class="md:col-span-2 w-full rounded-md  px-3 py-1.5 h-fit text-sm md:text-sm text-gray-700 outline-1 -outline-offset-1 outline-gray-300 bg-gray-50 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500" />
          </div>
          <x-form.select :label="'Jam Awal'" :description="'Pilih jam awal'" :placeholder="'Pilih'" :options="$jamAwal"
            valueField="id" displayField="keterangan" id="jam_mulai" name="jam_mulai" />
          <x-form.select :label="'Jam Akhir'" :description="'Pilih jam akhir'" :placeholder="'Pilih'"
            :options="$jamAkhir" valueField="id" displayField="keterangan" id="jam_akhir" name="jam_akhir" />

          <input type="hidden" name="id_dosen" value="{{ $sidebarUser->id }}">
          <input type="hidden" name="status" value="Belum Divalidasi">
          <x-form.button-group page="dashboard" />
        </div>
      </form>
    </div>
  </x-slot:content>
</x-template>