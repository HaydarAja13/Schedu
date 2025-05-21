<x-layout>
    {{-- container --}}
    <div class="h-screen relative">
        <img src="{{ asset('images/login-background.svg') }}" alt="" class="w-screen h-auto max-h-screen object-cover absolute hidden md:block">
        <div
            class="flex flex-col-reverse lg:flex-row gap-4 lg:gap-8 h-full p-4 items-center bg-gradient-to-tr from-[#8C4AF2] to-[#6B56F6]">
            {{-- left --}}
            <div class="h-full rounded-lg bg-white w-full lg:w-1/2 z-10">
                <div class="flex flex-col justify-between items-start h-full">
                    <div class="m-4 size-full grid items-center">
                        <x-form.login></x-form.login>
                    </div>
                    <p class="text-sm md:text-md absolute bottom-8 left-10"><b>2024</b> © all right reserved. Teknologi Rekayasa Komputer.</p>
                </div>
            </div>
            {{-- right --}}
            <x-login.banner></x-login.banner>
        </div>
    </div>
</x-layout>