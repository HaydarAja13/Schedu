@props(['role'])
<div class="h-screen md:p-4" x-show="open" x-transition>
	<div class="fixed inset-0 z-50 bg-transparent backdrop-blur-sm md:hidden"></div>
	<div
		class="absolute md:relative z-50 flex flex-col h-full justify-between md:border-e md:rounded-xl md:border-gray-100 bg-gradient-to-tr from-[#6B56F6] to-[#8C4AF2] w-64"
		@click.away="window.innerWidth < 768 && (open = false)">
		<img src="{{ asset('images/sidebar-background.svg') }}" alt=""
			class="absolute in	set-0 w-full h-full object-cover object-top z-10 rounded-xl ">
		<img src="{{ asset('images/sidebar-background.svg') }}" alt=""
			class="absolute inset-0 w-full h-full object-cover object-bottom z-10 rounded-xl ">
		<div class="relative px-4 py-6 z-10">
			<span class="grid place-content-center ">
				<img src="{{ asset('images/schedu-logo-white.svg') }}" alt="" class="h-12">
			</span>

			<p class="text-white text-xl mt-4 font-semibold">Menu</p>
			<hr class="h-0.5 mt-3 bg-[#6317DA] border-none">
			<div class="overflow-y-scroll h-[calc(100vh-400px)] md:h-84 [&::-webkit-scrollbar]:w-0 ">
				<ul class="mt-6 space-y-2">
					<x-sidebar.single-nav-link :title="'Beranda'" :href="'/' . $role . '/dashboard'"
						:active="request()->is($role.'/dashboard')">
						<x-slot:icon>
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
								<path fill-rule="evenodd"
									d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
									clip-rule="evenodd" />
							</svg>
						</x-slot:icon>
					</x-sidebar.single-nav-link>

					@if ($sidebarRole === 'admin')
					<x-sidebar.nested-nav-link :title="'Data'" :role="$role" :children="[
															['label' => 'Dosen', 'href' => 'dosen'],
															['label' => 'Mahasiswa', 'href' => 'mahasiswa'],
															['label' => 'Prodi', 'href' => 'program-studi'],
															['label' => 'Kelompok Prodi', 'href' => 'kelompok-prodi'],
															['label' => 'Mata kuliah', 'href' => 'mata-kuliah'],
															['label' => 'Ruang', 'href' => 'ruang'],
															['label' => 'Kelas', 'href' => 'kelas'],
															['label' => 'Angkatan', 'href' => 'angkatan'],
															['label' => 'Jurusan', 'href' => 'jurusan'],
															]">
						<x-slot:icon>
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
								<path d="M21 6.375c0 2.692-4.03 4.875-9 4.875S3 9.067 3 6.375 7.03 1.5 12 1.5s9 2.183 9 4.875Z" />
								<path
									d="M12 12.75c2.685 0 5.19-.586 7.078-1.609a8.283 8.283 0 0 0 1.897-1.384c.016.121.025.244.025.368C21 12.817 16.97 15 12 15s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.285 8.285 0 0 0 1.897 1.384C6.809 12.164 9.315 12.75 12 12.75Z" />
								<path
									d="M12 16.5c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 0 0 1.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 0 0 1.897 1.384C6.809 15.914 9.315 16.5 12 16.5Z" />
								<path
									d="M12 20.25c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 0 0 1.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 0 0 1.897 1.384C6.809 19.664 9.315 20.25 12 20.25Z" />
							</svg>
						</x-slot:icon>
					</x-sidebar.nested-nav-link>

					<x-sidebar.nested-nav-link :title="'Enrollment'" :role="$role" :children="[
																				['label' => 'Enrollment Kelas', 'href' => 'enrollment-kelas'],
																				['label' => 'Enrollment Mahasiswa', 'href' => 'enrollment-mahasiswa-kelas'],
																				['label' => 'Enrollment Jadwal', 'href' => 'enrollment-jadwal'],
																				]">
						<x-slot:icon>
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
								<path fill-rule="evenodd"
									d="M1.5 5.625c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v12.75c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 18.375V5.625ZM21 9.375A.375.375 0 0 0 20.625 9h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 0 0 .375-.375v-1.5Zm0 3.75a.375.375 0 0 0-.375-.375h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 0 0 .375-.375v-1.5Zm0 3.75a.375.375 0 0 0-.375-.375h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 0 0 .375-.375v-1.5ZM10.875 18.75a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h7.5ZM3.375 15h7.5a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375Zm0-3.75h7.5a.375.375 0 0 0 .375-.375v-1.5A.375.375 0 0 0 10.875 9h-7.5A.375.375 0 0 0 3 9.375v1.5c0 .207.168.375.375.375Z"
									clip-rule="evenodd" />
							</svg>
						</x-slot:icon>
					</x-sidebar.nested-nav-link>

					<x-sidebar.single-nav-link :title="'Aktivasi'" :href="'/' . $role . '/tahun-akademik'"
						:active="request()->is($role.'/tahun-akademik')">
						<x-slot:icon>
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
								stroke="currentColor" class="size-6">
								<path stroke-linecap="round" stroke-linejoin="round"
									d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
							</svg>
						</x-slot:icon>
					</x-sidebar.single-nav-link>

					<x-sidebar.single-nav-link :title="'Jadwal'" :href="'/' . $role . '/schedule'"
						:active="request()->is($role.'/schedule')">
						<x-slot:icon>
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
								<path fill-rule="evenodd"
									d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3 3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z"
									clip-rule="evenodd" />
							</svg>
						</x-slot:icon>
					</x-sidebar.single-nav-link>

					<x-sidebar.single-nav-link :title="'Profil'" :href="'/' . $role . '/profile'"
						:active="request()->is($role.'/profile')">
						<x-slot:icon>
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
								<path fill-rule="evenodd"
									d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
									clip-rule="evenodd" />
							</svg>
						</x-slot:icon>
					</x-sidebar.single-nav-link>

					<x-sidebar.single-nav-link :title="'Notifikasi'" :href="'/' . $role . '/notification'"
						:active="request()->is($role.'/notification')">
						<x-slot:icon>
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
								<path fill-rule="evenodd"
									d="M5.25 9a6.75 6.75 0 0 1 13.5 0v.75c0 2.123.8 4.057 2.118 5.52a.75.75 0 0 1-.297 1.206c-1.544.57-3.16.99-4.831 1.243a3.75 3.75 0 1 1-7.48 0 24.585 24.585 0 0 1-4.831-1.244.75.75 0 0 1-.298-1.205A8.217 8.217 0 0 0 5.25 9.75V9Zm4.502 8.9a2.25 2.25 0 1 0 4.496 0 25.057 25.057 0 0 1-4.496 0Z"
									clip-rule="evenodd" />
							</svg>
						</x-slot:icon>
					</x-sidebar.single-nav-link>
					@elseif ($sidebarRole === 'dosen')

					<x-sidebar.single-nav-link :title="'Jadwal'" :href="'/' . $role . '/schedule'"
						:active="request()->is($role.'/schedule')">
						<x-slot:icon>
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
								<path fill-rule="evenodd"
									d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3 3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z"
									clip-rule="evenodd" />
							</svg>
						</x-slot:icon>
					</x-sidebar.single-nav-link>

					<x-sidebar.single-nav-link :title="'Mata Kuliah'" :href="'/' . $role . '/mata-kuliah'"
						:active="request()->is($role.'/mata-kuliah')">
						<x-slot:icon>
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
								class="size-6">
								<path stroke-linecap="round" stroke-linejoin="round"
									d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
							</svg>							
						</x-slot:icon>
					</x-sidebar.single-nav-link>

					<x-sidebar.single-nav-link :title="'Requirement Dosen'" :href="'/' . $role . '/requirement-dosen'"
						:active="request()->is($role.'/requirement-dosen')">
						<x-slot:icon>
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
								stroke="currentColor" class="size-6">
								<path stroke-linecap="round" stroke-linejoin="round"
									d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
							</svg>
						</x-slot:icon>
					</x-sidebar.single-nav-link>

					<x-sidebar.single-nav-link :title="'Profil'" :href="'/' . $role . '/profile'"
						:active="request()->is($role.'/profile')">
						<x-slot:icon>
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
								<path fill-rule="evenodd"
									d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
									clip-rule="evenodd" />
							</svg>
						</x-slot:icon>
					</x-sidebar.single-nav-link>
					@elseif ($sidebarRole === 'mahasiswa')
					<x-sidebar.single-nav-link :title="'Jadwal'" :href="'/' . $role . '/schedule'"
						:active="request()->is($role.'/schedule')">
						<x-slot:icon>
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
								<path fill-rule="evenodd"
									d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3 3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z"
									clip-rule="evenodd" />
							</svg>
						</x-slot:icon>
					</x-sidebar.single-nav-link>
					
					<x-sidebar.single-nav-link :title="'Mata Kuliah'" :href="'/' . $role . '/mata-kuliah'"
						:active="request()->is($role.'/mata-kuliah')">
						<x-slot:icon>
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
								class="size-6">
								<path stroke-linecap="round" stroke-linejoin="round"
									d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
							</svg>
						</x-slot:icon>
					</x-sidebar.single-nav-link>
					
					<x-sidebar.single-nav-link :title="'Profil'" :href="'/' . $role . '/profile'" :active="request()->is($role.'/profile')">
						<x-slot:icon>
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
								<path fill-rule="evenodd"
									d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
									clip-rule="evenodd" />
							</svg>
						</x-slot:icon>
					</x-sidebar.single-nav-link>
					@endif
				</ul>
			</div>
		</div>

		<div class="absolute inset-x-0 bottom-0 grid place-content-center w-full z-10 bg-transparent">
			<img src="{{ asset('images/sidebar-logo.svg') }}" alt="" class="h-40">
			<hr class="h-0.5 my-2 bg-[#6317DA] border-none">
			<p class="text-center w-full text-white text-xs mb-3">Powered By <b>TI-2A III</b>.</p>
		</div>
	</div>
</div>