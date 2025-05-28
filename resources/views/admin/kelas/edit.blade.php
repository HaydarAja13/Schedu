<x-template :role="'admin'">
    <x-slot name="title">
        <div class="flex justify-between">
            <div class="flex items-center gap-3 mb-8">
                <a href="/admin/kelas">
                    <div class="bg-[#E0E7FF] p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </div>
                </a>
                <h1 class="text-2xl font-bold text-gray-800 font-righteous">Edit Data Kelas</h1>
            </div>
        </div>

        <div class="bg-white px-8 pt-8 pb-6 rounded-xl shadow-lg">
            <form action="{{ route('kelas.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-6 w-full">
                    <div>
                        <label for="nama_kelas_input" class="block text-sm font-medium text-gray-700 mb-1">Nama Kelas<span class="text-red-500">*</span></label>
                        <input type="text" id="nama_kelas_input" name="nama_kelas" value="{{ $data->nama_kelas }}" placeholder="Nama kelas" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400" required maxlength="20">
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger text-red-700 mt-3 w-full max-w-md">
                        <ul class="text-xs font-light">
                            @foreach ($errors->all() as $error)
                                <li class="whitespace-normal break-words">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mt-6 flex justify-end gap-8">
                    <a href="/admin/kelas" class="bg-white border border-gray-300 text-gray-700 px-6 py-2 rounded-lg font-semibold hover:bg-gray-100 shadow-sm">Batal</a>
                    <button type="submit" class="bg-gradient-to-r from-[#6B56F6] to-[#8C4AF2] hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-semibold shadow-md">Update</button>
                </div>
            </form>
        </div>
    </x-slot>
    <x-slot name="content">
    </x-slot>
</x-template>
