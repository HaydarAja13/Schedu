<x-layout>
    <div class="flex h-screen bg-cover bg-center"
        style="background-image: url('{{ asset('images/login-background.svg') }}')">
        
        <div class="flex h-full w-full" x-data="{open: window.innerWidth >= 768}">
            
            <x-sidebar :role="$role ?? null"></x-sidebar>

            {{-- Main Content Area --}}
            <div class="flex-1 ml-64 md:ml-64 flex flex-col h-full">
                
                {{-- Bagian Atas Konten Utama (fixed / tidak discroll) --}}
                {{-- KURANGI PADDING VERTIKAL DI SINI --}}
                <div class="flex-shrink-0 px-4 pt-2 pb-0"> {{-- <=== UBAH INI: pt-2 pb-0 atau py-2 jika ingin simetris atas bawah --}}
                    <x-navbar :role="$role ?? null"></x-navbar> 
                    <p class="mt-4 text-3xl font-bold">{{ $title }}</p>
                    <p class="mb-2">Selamat datang di platform <span class="text-[#6B56F6] font-bold">Schedu</span></p> {{-- <=== UBAH INI: mb-2 --}}
                </div>
                
                {{-- Bagian Konten yang Bisa Di-scroll --}}
                <div class="flex-grow overflow-y-auto px-4 pb-4">
                    {{ $content }}
                </div>
            </div>
        </div>
    </div>
</x-layout>