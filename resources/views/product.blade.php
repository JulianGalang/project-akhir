@extends('layout')

@section('content')
<div class="container mx-auto p-6 max-w-full">
  <!-- Breadcrumb -->
  <nav class="text-sm text-gray-500 mb-6">
    <a href="/" class="hover:text-orange-500">Beranda</a> /
    <a href="/category" class="hover:text-orange-500">Baju</a> /
    <a href="/category" class="hover:text-orange-500">Baju Pria</a> /
    <span class="text-gray-700">Kaos Polos Katun Premium</span>
  </nav>

  <!-- Konten Produk -->
  <div class="grid grid-cols-2 gap-6">
    <!-- Kolom Gambar Produk -->
    <div class="flex flex-col">
  <!-- Thumbnail Besar -->
  <div class="mb-4">
    <img
      src="https://via.placeholder.com/400x400"
      alt="Thumbnail Besar"
      class="w-full h-auto border rounded-lg"
    />
  </div>

  <!-- Thumbnail Kecil -->
  <div class="flex justify-center space-x-4">
    <img
      src="https://via.placeholder.com/100"
      alt="Thumbnail 1"
      class="w-24 h-24 border rounded-lg cursor-pointer hover:ring hover:ring-orange-500"
    />
    <img
      src="https://via.placeholder.com/100"
      alt="Thumbnail 2"
      class="w-24 h-24 border rounded-lg cursor-pointer hover:ring hover:ring-orange-500"
    />
    <img
      src="https://via.placeholder.com/100"
      alt="Thumbnail 3"
      class="w-24 h-24 border rounded-lg cursor-pointer hover:ring hover:ring-orange-500"
    />
  </div>
</div>


    <!-- Kolom Detail Produk -->
    <div>
      <h1 class="text-2xl font-bold text-gray-800">
        Kaos Polos Katun Premium
      </h1>
      <p class="text-gray-500 text-sm mb-2">SKU: 304598</p>
      <p class="text-orange-500 text-lg font-bold mb-4">Rp75.000</p>

      <p class="text-sm text-gray-700 mb-4">
        Tersedia dalam berbagai ukuran dan warna. Silakan pilih kombinasi sesuai
        keinginan Anda.
      </p>

      <!-- Pilihan Ukuran -->
      <div class="mb-4">
        <span class="block text-gray-700 font-medium">Ukuran:</span>
        <div class="flex space-x-2 mt-2">
          <button
            class="px-3 py-1 border rounded-lg text-gray-700 hover:border-orange-500 focus:ring focus:ring-orange-500"
          >
            S
          </button>
          <button
            class="px-3 py-1 border rounded-lg text-gray-700 hover:border-orange-500 focus:ring focus:ring-orange-500"
          >
            M
          </button>
          <button
            class="px-3 py-1 border rounded-lg text-gray-700 hover:border-orange-500 focus:ring focus:ring-orange-500"
          >
            L
          </button>
          <button
            class="px-3 py-1 border rounded-lg text-gray-700 hover:border-orange-500 focus:ring focus:ring-orange-500"
          >
            XL
          </button>
        </div>
      </div>

      <!-- Pilihan Warna -->
      <div class="mb-4">
        <span class="block text-gray-700 font-medium">Warna:</span>
        <div class="flex space-x-2 mt-2">
          <div class="w-8 h-8 bg-blue-500 rounded-full border"></div>
          <div class="w-8 h-8 bg-black rounded-full border"></div>
          <div class="w-8 h-8 bg-white rounded-full border"></div>
        </div>
      </div>

      <!-- Pilihan Kuantitas -->
      <div class="mb-4">
        <span class="block text-gray-700 font-medium">Kuantitas:</span>
        <div class="flex items-center space-x-2 mt-2">
          <button
            class="px-3 py-1 border rounded-lg text-gray-700 hover:bg-gray-100"
          >
            -
          </button>
          <input
            type="text"
            value="1"
            class="w-12 text-center border rounded-lg"
          />
          <button
            class="px-3 py-1 border rounded-lg text-gray-700 hover:bg-gray-100"
          >
            +
          </button>
        </div>
      </div>

      <!-- Pilihan Pengiriman -->
      <div class="mb-6">
        <span class="block text-gray-700 font-medium">Pilihan Pengiriman:</span>
        <div class="mt-2">
          <label class="flex items-center space-x-2">
            <input
              type="radio"
              name="shipping"
              class="text-orange-500 focus:ring-orange-500"
              checked
            />
            <span>Gratis Ambil di Toko (jika tersedia)</span>
          </label>
          <label class="flex items-center space-x-2 mt-2">
            <input
              type="radio"
              name="shipping"
              class="text-orange-500 focus:ring-orange-500"
            />
            <span>Pengiriman Reguler (3-5 hari)</span>
          </label>
        </div>
      </div>
      <div class="flex gap-4">
      <button
        class="flex bg-orange-500 text-white py-2 px-4 rounded-lg font-bold hover:bg-orange-600"
      >
        Tambahkan ke Keranjang
      </button>
      <button
        class="flex bg-blue-500 text-white py-2 px-4 rounded-lg font-bold hover:bg-blue-600"
      >
        Beli Sekarang
      </button></div>
    </div>
  </div>

  <!-- Produk Rekomendasi -->
  <div class="mt-8">
    <h2 class="text-lg font-bold text-gray-800">Kamu Mungkin Juga Suka</h2>
    <div class="grid grid-cols-4 gap-4 mt-4">
        <a href="/product" class="block">
      <div class="bg-white p-3 rounded-lg shadow">
         <img src="https://via.placeholder.com/150" alt="Produk" class="w-full mb-4">
         <p class="text-orange-500">★★★★☆</p>
         <p class="font-medium mb-5">Nama Produk</p>
         <p class="text-orange-500 font-bold">Rp 100.000</p>
      </div></a>
        <a href="/product" class="block">
      <div class="bg-white p-3 rounded-lg shadow">
         <img src="https://via.placeholder.com/150" alt="Produk" class="w-full mb-4">
         <p class="text-orange-500">★★★★☆</p>
         <p class="font-medium mb-5">Nama Produk</p>
         <p class="text-orange-500 font-bold">Rp 100.000</p>
      </div></a>
        <a href="/product" class="block">
      <div class="bg-white p-3 rounded-lg shadow">
         <img src="https://via.placeholder.com/150" alt="Produk" class="w-full mb-4">
         <p class="text-orange-500">★★★★☆</p>
         <p class="font-medium mb-5">Nama Produk</p>
         <p class="text-orange-500 font-bold">Rp 100.000</p>
      </div></a>
        <a href="/product" class="block">
      <div class="bg-white p-3 rounded-lg shadow">
         <img src="https://via.placeholder.com/150" alt="Produk" class="w-full mb-4">
         <p class="text-orange-500">★★★★☆</p>
         <p class="font-medium mb-5">Nama Produk</p>
         <p class="text-orange-500 font-bold">Rp 100.000</p>
      </div></a>
    </div>
  </div>
</div>


@endsection