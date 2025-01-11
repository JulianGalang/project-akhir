@extends('layout')

@section('content')
<div class="container mx-auto p-6">
<nav class="text-sm text-gray-500 mb-6">
    <a href="/" class="hover:text-orange-500">Beranda</a> /
    <span class="text-gray-700">Baju</span>
  </nav>
  <!-- Filter Sidebar dan Konten -->
  <div class="grid grid-cols-5 gap-4">
    <!-- Sidebar Filter -->
    <aside class="col-span-1 bg-gray-100 p-4 rounded-lg">
      <h2 class="font-bold text-lg mb-4">Filter</h2>

      <div>
        <h4 class="font-medium mb-3">Kategori Lainnya</h4>
        <div class="flex flex-col gap-2">
        <label class="flex items-center"><input type="checkbox" class="mr-2">Baju Pria</label>
        <label class="flex items-center"><input type="checkbox" class="mr-2">Baju Wanita</label>
        <label class="flex items-center"><input type="checkbox" class="mr-2">Kemeja</label>
        </div>
      </div>

      <div class="mt-5">
        <h3 class="font-medium text-black-800 mb-2">Rating</h3>
        <ul class="space-y-2">
          <!-- Semua Rating -->
          <li>
            <label class="flex items-center space-x-2">
              <input
                type="radio"
                name="rating"
                value="all"
                class="text-orange-500 focus:ring-orange-500"
                checked
              />
              <span class="text-sm text-gray-700">Semua Bintang</span>
            </label>
          </li>

          <!-- 5 Bintang -->
          <li>
            <label class="flex items-center space-x-2">
              <input
                type="radio"
                name="rating"
                value="5"
                class="text-orange-500 focus:ring-orange-500"
              />
              <div class="flex items-center">
                <span class="text-sm text-gray-700 mr-2">5 Bintang</span>
                <div class="flex space-x-1">
                  <!-- 5 Bintang -->
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 text-orange-500"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.965a1 1 0 00.95.69h4.164c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.286 3.965c.3.921-.755 1.688-1.54 1.118L10 13.348l-3.37 2.448c-.785.57-1.84-.197-1.54-1.118l1.286-3.965a1 1 0 00-.364-1.118L2.642 9.392c-.783-.57-.38-1.81.588-1.81h4.164a1 1 0 00.95-.69l1.286-3.965z"
                    />
                  </svg>
                  <!-- Ulangi SVG 4 kali lagi -->
                </div>
              </div>
            </label>
          </li>

          <!-- 4 Bintang & UP -->
          <li>
            <label class="flex items-center space-x-2">
              <input
                type="radio"
                name="rating"
                value="4"
                class="text-orange-500 focus:ring-orange-500"
              />
              <div class="flex items-center">
                <span class="text-sm text-gray-700 mr-2">4 Bintang & UP</span>
                <div class="flex space-x-1">
                  <!-- 4 Bintang -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.965a1 1 0 00.95.69h4.164c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.286 3.965c.3.921-.755 1.688-1.54 1.118L10 13.348l-3.37 2.448c-.785.57-1.84-.197-1.54-1.118l1.286-3.965a1 1 0 00-.364-1.118L2.642 9.392c-.783-.57-.38-1.81.588-1.81h4.164a1 1 0 00.95-.69l1.286-3.965z" />
                  </svg>
                  <!-- Ulangi SVG 3 kali lagi -->
                </div>
              </div>
            </label>
          </li>

          <!-- Tambahkan opsi lain (3 Bintang & UP, dll.) -->
        </ul>
      </div>

      <!-- Harga -->
      <div class="mt-5">
        <h3 class="font-medium text-black-700">Harga</h3>
        <div class="flex items-center mt-2 space-x-2">
          <input
            type="text"
            placeholder="Min"
            class="w-full p-2 border rounded-lg text-sm"
          />
          <span>-</span>
          <input
            type="text"
            placeholder="Max"
            class="w-full p-2 border rounded-lg text-sm"
          />
        </div>
        <button
          class="w-full mt-4 bg-orange-500 text-white py-2 rounded-lg font-bold hover:bg-orange-600"
        >
          Terapkan
        </button>
        <button
          class="w-full mt-4 bg-red-500 text-white py-2 rounded-lg font-bold hover:bg-red-600"
        >
          Hapus
        </button>
      </div>
    </aside>

    <!-- Konten Produk -->
    <main class="col-span-4">
      <!-- Sortir -->
      <div class="flex items-center justify-between mb-4">
        <h1 class="text-lg font-bold text-gray-800">Produk Terpopuler</h1>
        <select
          class="p-2 border rounded-lg text-sm text-gray-600"
        >
          <option>Terbaru</option>
          <option>Populer</option>
          <option>Harga Terendah</option>
          <option>Harga Tertinggi</option>
        </select>
      </div>

      <!-- Grid Produk -->
      <div class="grid grid-cols-4 gap-4">
        <!-- Produk Item -->
        <a href="/product" class="block">
             <div class="bg-white p-3 rounded-lg shadow hover:shadow-lg transition-shadow">
             <img src="https://via.placeholder.com/150" alt="Produk" class="w-full mb-4">
             <p class="text-orange-500">★★★★☆</p>
             <p class="font-medium mb-5">Nama Produk</p>
              <p class="text-orange-500 font-bold">Rp 100.000</p>
             </div>
        </a>
        <a href="/product" class="block">
             <div class="bg-white p-3 rounded-lg shadow hover:shadow-lg transition-shadow">
             <img src="https://via.placeholder.com/150" alt="Produk" class="w-full mb-4">
             <p class="text-orange-500">★★★★☆</p>
             <p class="font-medium mb-5">Nama Produk</p>
              <p class="text-orange-500 font-bold">Rp 100.000</p>
             </div>
        </a>
        <a href="/product" class="block">
             <div class="bg-white p-3 rounded-lg shadow hover:shadow-lg transition-shadow">
             <img src="https://via.placeholder.com/150" alt="Produk" class="w-full mb-4">
             <p class="text-orange-500">★★★★☆</p>
             <p class="font-medium mb-5">Nama Produk</p>
              <p class="text-orange-500 font-bold">Rp 100.000</p>
             </div>
        </a>
        <a href="/product" class="block">
             <div class="bg-white p-3 rounded-lg shadow hover:shadow-lg transition-shadow">
             <img src="https://via.placeholder.com/150" alt="Produk" class="w-full mb-4">
             <p class="text-orange-500">★★★★☆</p>
             <p class="font-medium mb-5">Nama Produk</p>
              <p class="text-orange-500 font-bold">Rp 100.000</p>
             </div>
        </a>

      </div>

      <!-- Pagination -->
      <div class="flex justify-center mt-6">
        <nav class="inline-flex items-center space-x-1">
          <a
            href="#"
            class="px-4 py-2 border rounded-lg text-gray-500 hover:bg-gray-100"
          >
            &laquo;
          </a>
          <a
            href="#"
            class="px-4 py-2 border rounded-lg text-gray-800 bg-orange-500 text-white font-bold hover:bg-orange-600"
          >
            1
          </a>
          <a
            href="#"
            class="px-4 py-2 border rounded-lg text-gray-500 hover:bg-gray-100"
          >
            2
          </a>
          <a
            href="#"
            class="px-4 py-2 border rounded-lg text-gray-500 hover:bg-gray-100"
          >
            3
          </a>
          <span class="px-4 py-2">...</span>
          <a
            href="#"
            class="px-4 py-2 border rounded-lg text-gray-500 hover:bg-gray-100"
          >
            n
          </a>
          <a
            href="#"
            class="px-4 py-2 border rounded-lg text-gray-500 hover:bg-gray-100"
          >
            &raquo;
          </a>
        </nav>
      </div>
    </main>
  </div>
</div>

@endsection
