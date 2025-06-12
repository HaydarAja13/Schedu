<x-template :role="'mahasiswa'" title="Mata Kuliah {{ $user->nama_kelas ?? '-' }}">
    <x-slot:content>
        <div class="">
            <livewire:mata-kuliah-table></livewire:mata-kuliah-table>
        </div>
    </x-slot:content>
</x-template>