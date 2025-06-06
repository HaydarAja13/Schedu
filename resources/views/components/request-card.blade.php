<div class="h-full bg-white rounded-lg shadow-sm p-4">
  <p class="text-lg font-semibold">Permintaan Ubah Jadwal</p>
  <div class="grid grid-cols-1 gap-y-1 mt-2">
    @foreach ($notification as $data)
    <div class="flex items-center justify-between hover:bg-gray-100 p-2 rounded-lg transition-all duration-200">
      <div class="flex items-center gap-x-2">
        <img src="https://placehold.co/400" alt="" class="size-10 rounded-full">
        <div class="text-sm">
          <p class="font-medium">{{ $data->dosen->nama_dosen }}</p>
          <p class="text-gray-400">{{ $data->hari }}: {{ $data->keterangan }}</p>
        </div>
      </div>
      @if ($data->status == 'Belum Divalidasi')
      <div class="size-2 bg-red-600 rounded-full">
      </div>
      @endif
    </div>
    @endforeach
    <div class="flex items-center justify-center">
      <a class="inline-block rounded-lg text-purple-500 px-6 py-2 size-fit text-xs font-medium shadow-sm " href="#">
        Lihat Semua
      </a>
    </div>
  </div>
</div>