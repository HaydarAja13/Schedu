<div class="bg-white w-full h-fit mt-4 rounded-xl shadow-sm p-4">
    <div class="flex w-full items-center justify-between md:justify-end">
        <button type="button" @click="open = ! open"
            class="size-10 border-1 border-gray-200 flex md:hidden items-center justify-center rounded-xl focus:ring  focus:ring-gray-400 ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
            </svg>
        </button>
        <div class="flex items-center justify-center gap-x-6">
            <div class="bg-gray-200 text-gray-500 rounded-full p-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                </svg>
            </div>
            <div class="flex items-center justify-center gap-x-3">
                <div class="relative inline-flex" x-data="{ open: false, closeTimeout: null }"
                    @mouseenter="if(closeTimeout){clearTimeout(closeTimeout);} open = true"
                    @mouseleave="closeTimeout = setTimeout(() => open = false, 300)">
                    <span class="inline-flex divide-x divide-gray-300 overflow-hidden ">
                        <img src="{{ asset('images/example-user.png') }}" alt=""
                            class="size-10 rounded-full cursor-pointer" @click="open = !open">
                    </span>
                    <div role="menu" x-cloak
                        class="absolute end-0 top-12 z-auto w-36 overflow-hidden rounded border border-gray-300 bg-white shadow-sm"
                        x-show="open" x-transition.origin.top.right @click.away="open = false">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full px-3 py-2 text-left text-sm font-medium text-red-700 transition-colors hover:bg-red-50">
                                <div class="flex item-center gap-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                    </svg>
                                    <p class="font-semibold">Keluar</p>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
                @if ($sidebarUser)
                <div class="-space-y-0.5">
                    @if ($sidebarRole === 'admin')
                    <p class="font-semibold">{{ $sidebarUser->nama_admin ?? '-' }}</p>
                    @elseif ($sidebarRole === 'dosen')
                    <p class="font-semibold">{{ $sidebarUser->nama_dosen ?? '-' }}</p>
                    @elseif ($sidebarRole === 'mahasiswa')
                    <p class="font-semibold">{{ $sidebarUser->nama_mahasiswa ?? '-' }}</p>
                    @else
                    <p class="font-semibold">-</p>
                    @endif
                    <p class="text-xs text-gray-500">{{ $sidebarRole }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>