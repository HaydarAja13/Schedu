<x-layout>
    <div class="h-screen w-screen bg-cover bg-center"
        style="background-image: url('{{ asset('images/login-background.svg') }}')">
        <div class="flex" x-data="{open: window.innerWidth >= 768}">
            <x-sidebar :role="$role ?? null"></x-sidebar>
            <div class="w-full mx-4 md:mr-4 overflow-y-scroll">
                <div class="sticky top-4">
                    <x-navbar></x-navbar>
                    <p class="mt-4 text-3xl font-bold">{{ $title }}</p>
                </div>
                {{ $content }}
            </div>
        </div>
    </div>
</x-layout>