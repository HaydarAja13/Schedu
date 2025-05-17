<x-layout>
    <div class="h-screen w-screen bg-cover bg-center"
        style="background-image: url('{{ asset('images/login-background.svg') }}')">
        <div class="flex">
            <x-sidebar :role="$role ?? null"></x-sidebar>
            <div class="w-full mr-4">
                <x-navbar></x-navbar>
                <p class="mt-8 text-3xl font-bold">{{ $slot }}</p>
                {{ $content }}
            </div>
        </div>
    </div>
</x-layout>