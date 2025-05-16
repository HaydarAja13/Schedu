<div>
    <form method="POST" action="{{ route('login') }}" class="grid m-4 md:m-16 gap-y-4">
        @csrf
        <img src="{{ asset('images/schedu-logo.svg') }}" alt="" class="h-7 md:h-10">
        <p class="text-1xl md:text-3xl font-semibold">Sign In</p>
        @if(session('error'))
            <div class="text-red-500 text-sm">{{ session('error') }}</div>
        @endif
        {{-- username input --}}
        <div class="max-w-xs md:max-w-md">
            <label for="username" class="block text-sm/6 font-medium select-none ">Username</label>
            <div class="mt-2 flex items-center rounded-lg bg-white px-3 py-1.5 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6 mr-2 text-gray-400">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                <input id="username" name="username" type="text" autocomplete="username"
                    class="block w-full bg-transparent text-base outline-none placeholder:text-gray-400 sm:text-sm/6"
                    placeholder="laravela laravino" value="{{ old('username') }}">
            </div>
            @error('username')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        {{-- password input --}}
        <div class="max-w-xs md:max-w-md">
            <label for="password" class="block text-sm/6 font-medium select-none">Password</label>
            <div class="mt-2 flex items-center rounded-lg bg-white px-3 py-1.5 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600 relative">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6 mr-2 text-gray-400">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                </svg>
                <input type="password" id="password" name="password" autocomplete="current-password"
                    class="block w-full bg-transparent text-base outline-none placeholder:text-gray-400 sm:text-sm/6 pr-8"
                    placeholder="••••••••">
            </div>
            @error('password')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        {{-- role select --}}
        <div class="max-w-xs md:max-w-md">
            <label for="role" class="block text-sm/6 font-medium select-none">Role</label>
            <div class="mt-2 grid grid-cols-1 relative">
                <select id="role" name="role" autocomplete="role"
                    class="block w-full appearance-none rounded-lg bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    <option value="" disabled {{ old('role') ? '' : 'selected' }}>Choose Role</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="dosen" {{ old('role') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                    <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                </select>
                <svg class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 size-5 text-gray-400"
                    viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            @error('role')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        {{-- remember me --}}
        <div class="max-w-xs md:max-w-md flex items-center mt-2">
            <input id="remember" name="remember" type="checkbox"
                class="h-4 w-4 rounded border-gray-300 accent-[#8C4AF2] focus:ring-[#8C4AF2]" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember" class="ml-2 text-xs select-none">Remember me</label>
        </div>
        {{-- submit button --}}
        <div class="max-w-xs md:max-w-md mt-2">
            <button type="submit"
                class="w-full rounded-md bg-gradient-to-tr from-[#8C4AF2] to-[#6B56F6] px-3 font-semibold leading-6 text-white shadow-sm transition-all duration-200 hover:from-[#5141b8] hover:to-[#592f97] hover:cursor-pointer py-2.5">
                Sign in
            </button>
        </div>
    </form>
</div>