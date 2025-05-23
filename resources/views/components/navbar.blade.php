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
                <img src="{{ asset('images/example-user.png') }}" alt="" class="size-10 rounded-full">
                <div class="-space-y-0.5">
                    <p class="font-semibold">Admin 1</p>
                    <p class="text-xs text-gray-500">Admin 1</p>
                </div>
            </div>
        </div>
    </div>
</div>