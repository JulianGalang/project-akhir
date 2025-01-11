@extends('layout')

@section('content')
<div class="container mx-auto mt-8">
    <div class="grid grid-cols-12 gap-6">
        <!-- Sidebar -->
        <aside class="col-span-3 bg-white p-4 rounded-lg shadow">
            <!-- Gambar dan Nama Pengguna -->
            <div class="flex items-center mb-6">
                <img src="https://via.placeholder.com/50" alt="Avatar" class="w-12 h-12 rounded-full mr-3">
                <div>
                    <p class="font-semibold text-gray-800">Nama Pengguna</p>
                    <p class="text-sm text-gray-500">nama@example.com</p>
                </div>
            </div>
            <!-- Menu Navigasi -->
            <nav>
                <ul class="space-y-2">
                    <!-- Akun Saya -->
                    <li>
                        <button class="w-full text-left flex items-center justify-between text-gray-700 hover:text-orange-500 focus:outline-none" onclick="toggleDropdown('akunSayaDropdown')">
                            <span>Akun Saya</span>
                            <svg id="akunSayaDropdownIcon" class="w-4 h-4 transform transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <ul id="akunSayaDropdown" class="mt-2 space-y-2 pl-4 hidden">
                            <li><a href="#profil" class="block text-gray-600 hover:text-orange-500">Profil</a></li>
                            <li><a href="#metode-pembayaran" class="block text-gray-600 hover:text-orange-500">Metode Pembayaran</a></li>
                            <li><a href="#alamat" class="block text-gray-600 hover:text-orange-500">Alamat</a></li>
                            <li><a href="#ubah-password" class="block text-gray-600 hover:text-orange-500">Ubah Password</a></li>
                        </ul>
                    </li>
                    <!-- Pesanan Saya -->
                    <li>
                        <a href="#pesanan-saya" class="block text-gray-700 hover:text-orange-500">Pesanan Saya</a>
                        <li>
                            <a href="javascript:void(0)" id="logoutButton" class="block text-red-700 hover:text-orange-500">Logout</a>
                        </li>
                    </li>
                </ul>
            </nav>
        </aside>
        <section id="logout-confirmation" class="bg-white p-8 w-96 rounded-lg shadow-lg hidden fixed inset-0 flex justify-center items-center z-50">
    <div class="bg-white p-8 w-96 rounded-lg shadow-lg">
        <h3 class="text-2xl font-bold mb-6">Konfirmasi Logout</h3>
        <p class="mb-6">Apakah Anda yakin ingin keluar dari akun Anda?</p>
        <a href="/login" class="bg-red-500 text-white px-6 py-3 rounded hover:bg-red-600">Logout</a>
        <button id="button-cancel" class="bg-gray-300 text-gray-700 px-6 py-3 rounded hover:bg-gray-400 ml-4">Batal</button>
    </div>
</section>



        <div id="overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40 backdrop-blur-sm"></div>



        <!-- Konten Utama -->
        <main class="col-span-9 space-y-6">
            <!-- Profil -->
            <section id="profil" class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-bold mb-4">Profil</h2>
                <form>
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" id="nama" class="w-full p-2 border rounded" value="Sherlock Holmes">
                    </div>
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" id="nama" class="w-full p-2 border rounded" value="nc7890iok.  ">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <label for="">69@yahoo.com</label>
                        <a href="" class="text-blue-700 font-bold">Ubah</a>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">No Telepon</label>
                        <a href="" class="text-blue-700 font-bold">Tambah</a>
                    </div>
                    <div class="mb-4">
    <label for="jenis-kelamin" class="block text-sm font-medium text-gray-700 mb-4">Jenis Kelamin</label>
    <div class="flex items-center space-x-6">
        <label class="flex items-center text-sm text-gray-700">
            <input type="radio" id="laki-laki" name="jenis_kelamin" value="laki-laki" class="form-radio text-orange-500" checked>
            <span class="ml-2">Laki-laki</span>
        </label>
        <label class="flex items-center text-sm text-gray-700">
            <input type="radio" id="perempuan" name="jenis_kelamin" value="perempuan" class="form-radio text-orange-500">
            <span class="ml-2">Perempuan</span>
        </label>
    </div>
</div>

                    <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">Simpan Perubahan</button>
                </form>
            </section>

            <!-- Metode Pembayaran -->
            <section id="metode-pembayaran" class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-bold mb-4">Metode Pembayaran</h2>
                <p class="text-gray-600">Anda belum menambahkan metode pembayaran.</p>
                <button class="mt-4 bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">Tambah Metode Pembayaran</button>
            </section>

            <!-- Alamat -->
            <section id="alamat" class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-bold mb-4">Alamat</h2>
                <p class="text-gray-600">Anda belum menambahkan alamat.</p>
                <button class="mt-4 bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">Tambah Alamat</button>
            </section>

            <!-- Ubah Password -->
            <section id="ubah-password" class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-bold mb-4">Ubah Password</h2>
                <form>
                    <div class="mb-4">
                        <label for="password-lama" class="block text-sm font-medium text-gray-700">Password Lama</label>
                        <input type="password" id="password-lama" class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label for="password-baru" class="block text-sm font-medium text-gray-700">Password Baru</label>
                        <input type="password" id="password-baru" class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label for="konfirmasi-password" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                        <input type="password" id="konfirmasi-password" class="w-full p-2 border rounded">
                    </div>
                    <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">Ubah Password</button>
                    <a class="text-orange-700" href="">Lupa Password?</a>
                </form>
            </section>
      </div>
    </div>
@stop