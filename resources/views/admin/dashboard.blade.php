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
            title="Mahasiswa" 
            description="{{ $jumlahMahasiswa }} mahasiswa aktif"
            icon="fas fa-book"
            highlightNumber="true"
          />
          
          <!-- Card 2: Dosen -->
          <x-dashboard.simple-card 
            title="Dosen" 
            description="{{$jumlahDosen}} dosen aktif"
            icon="fas fa-user-tie"
            highlightNumber="true"
          />
          
          <!-- Card 3: Ruang -->
          <x-dashboard.simple-card 
            title="Ruang" 
            description="{{$jumlahRuang}} ruang tersedia"
            icon="fas fa-door-open"
            highlightNumber="true"
          />
          
          <!-- Card 4: Kelas -->
          <x-dashboard.simple-card 
            title="Mata Kuliah" 
            description="{{$jumlahMataKuliah}} mata kuliah tersedia"
            icon="fas fa-chalkboard"
            highlightNumber="true"
          />
        </div>

        <!-- Kanan: Card Tinggi Penuh -->
        <x-dashboard.management-card
          description="Lorem ipsum dolor sit amet, consectetur adipiscing elit..."
        />
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 mt-6">
    <!-- Left (65%) -->
    <div class="lg:col-span-8">  <!-- 8/12 ≈ 65% -->
        <x-dashboard.activity/>
    </div>
    
    <!-- Right (35%) -->
    <div class="lg:col-span-4">  <!-- 4/12 ≈ 35% -->
        <x-dashboard.request-dosen/>
    </div>
</div>
  </x-slot:content>
</x-template>