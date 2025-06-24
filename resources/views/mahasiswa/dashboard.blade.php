<div>
    ini dashboard mahasiswa 
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded mt-4">Logout</button>
    </form>
</div>
