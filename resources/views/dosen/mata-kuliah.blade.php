<x-template :role="'dosen'" title="Mata Kuliah {{ $user->nama_dosen ?? '-' }}">
    <x-slot:content>
        <div class="">
            <livewire:mata-kuliah-table></livewire:mata-kuliah-table>
        </div>
    </x-slot:content>
</x-template>