<div class="h-full bg-white rounded-lg shadow-sm p-4">
  <p class="text-lg font-semibold">Permintaan Ubah Jadwal</p>
  <div class="grid grid-cols-1 gap-y-1 mt-2">
    @if($notification->isEmpty())
    <div class="flex flex-col items-center justify-center py-8">
      <img src="{{ asset('images/notification-not-select.svg') }}" alt="Empty" class="size-20 mb-2">
      <p class="text-gray-400 text-sm">Tidak ada permintaan ubah jadwal.</p>
    </div>
    @else
    @foreach ($notification as $data)
    <div class="flex items-center justify-between hover:bg-gray-100 p-2 rounded-lg transition-all duration-200">
      <div class="flex items-center gap-x-2">
        <img src="https://placehold.co/400" alt="" class="size-10 rounded-full">
        <div class="text-sm">
          <p class="font-medium">{{ $data->hari }}</p>
          <p class="text-gray-400">Jam: {{ $data->jamMulai->keterangan }} - {{ $data->jamSelesai->keterangan }}</p>
        </div>
      </div>
      @if ($data->status == 'Belum Divalidasi')
      <span class="inline-flex items-center justify-center rounded-full bg-yellow-100 px-2.5 py-0.5 text-yellow-700">
        <p class="text-sm whitespace-nowrap">Belum Divalidasi</p>
      </span>
      @elseif ($data->status == 'Divalidasi')
      <span class="inline-flex items-center justify-center rounded-full bg-green-100 px-2.5 py-0.5 text-green-700">
        <p class="text-sm whitespace-nowrap">Divalidasi</p>
      </span>
      @elseif ($data->status == 'Ditolak')
      <span class="inline-flex items-center justify-center rounded-full bg-red-100 px-2.5 py-0.5 text-red-700">
        <p class="text-sm whitespace-nowrap">Ditolak</p>
      </span>
      @endif
    </div>
    @endforeach
    <div class="flex items-center justify-center">
      <a class="inline-block rounded-lg text-purple-500 px-6 py-2 size-fit text-xs font-medium shadow-sm " href="#">
        Lihat Semua
      </a>
    </div>
    @endif
  </div>
</div>