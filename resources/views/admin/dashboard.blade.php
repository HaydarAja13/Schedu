{{-- resources/views/admin/dashboard.blade.php --}}
<x-template :role="'admin'" :title="'Dashboard'">
  <x-slot:content>
    <div class="mt-6">
      <p class="mb-6">Selamat datang di platform <span class="text-[#6B56F6] font-bold">Schedu</span></p>
      {{-- resources/views/admin/dashboard.blade.php --}}
      <div class="grid grid-cols-1 lg:grid-cols-[1fr_1fr] gap-4">
        <!-- Kiri: Grid 2x2 -->
        <div class="grid grid-cols-2 gap-4">
          <!-- Card 1: Mata Kuliah -->
          <x-dashboard.simple-card 
            title="Mata Kuliah" 
            description="1,000 mata kuliah tersedia"
            icon="fas fa-book"
          />
          
          <!-- Card 2: Dosen -->
          <x-dashboard.simple-card 
            title="Dosen" 
            description="500 dosen aktif"
            icon="fas fa-user-tie"
          />
          
          <!-- Card 3: Ruang -->
          <x-dashboard.simple-card 
            title="Ruang" 
            description="200 ruang tersedia"
            icon="fas fa-door-open"
          />
          
          <!-- Card 4: Kelas -->
          <x-dashboard.simple-card 
            title="Kelas" 
            description="150 kelas aktif"
            icon="fas fa-chalkboard"
          />
        </div>

        <!-- Kanan: Card Tinggi Penuh -->
        <x-dashboard.management-card
          description="Lorem ipsum dolor sit amet, consectetur adipiscing elit..."
        />
      </div>
  </x-slot:content>
</x-template>