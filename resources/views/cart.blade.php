@extends('layout')

@section('content')
<div class="max-w-7xl mx-auto p-6 bg-white shadow-md rounded-lg grid grid-cols-12 gap-8 mt-5">
  <!-- Bagian Utama (Cart) -->
  <div class="col-span-8">
    <!-- Header -->
    <div class="grid grid-cols-12 items-center border-b pb-4 mb-4">
      <div class="col-span-6 text-gray-700 font-bold">Produk</div>
      <div class="col-span-3 text-center text-gray-700 font-bold">Pengambilan atau Pengiriman</div>
      <div class="col-span-2 text-center text-gray-700 font-bold">Jumlah</div>
      <div class="col-span-1 text-right text-gray-700 font-bold">Harga</div>
    </div>

    <!-- Produk -->
    <div class="space-y-4">
      <!-- Produk 1 -->
      <div class="grid grid-cols-12 items-center border-b pb-4">
        <div class="col-span-6 flex items-center">
          <img src="https://via.placeholder.com/100" alt="Gambar Produk" class="w-20 h-20 object-cover rounded-md mr-4" />
          <div>
            <p class="text-gray-800 font-semibold">Baju Katun Premium Polos Pria</p>
            <p class="text-sm text-gray-500">SKU: 202349</p>
          </div>
        </div>
        <div class="col-span-3 text-sm text-gray-600 text-center">
          GRATIS Ambil di Toko <br />
          <span class="text-gray-400">Tidak tersedia di toko</span><br />
          Pengiriman UPS <br />
          <span class="text-gray-400">5-7 hari</span>
        </div>
        <div class="col-span-2 text-center">
          <div class="inline-flex items-center border rounded-md">
            <button class="px-2 py-1 bg-gray-200 hover:bg-gray-300">-</button>
            <input type="number" value="1" min="1" class="w-10 text-center border-l border-r" />
            <button class="px-2 py-1 bg-gray-200 hover:bg-gray-300">+</button>
          </div>
          <p class="text-sm text-blue-500 cursor-pointer mt-2">Hapus</p>
        </div>
        <div class="col-span-1 text-right text-gray-800 font-bold">Rp75.000</div>
      </div>

      <!-- Produk 2 -->
      <div class="grid grid-cols-12 items-center">
        <div class="col-span-6 flex items-center">
          <img src="https://via.placeholder.com/100" alt="Gambar Produk" class="w-20 h-20 object-cover rounded-md mr-4" />
          <div>
            <p class="text-gray-800 font-semibold">Baju Couple Merak</p>
            <p class="text-sm text-gray-500">SKU: 202376</p>
          </div>
        </div>
        <div class="col-span-3 text-sm text-gray-600 text-center">
          GRATIS Ambil di Toko <br />
          <span class="text-gray-400">Tidak tersedia di toko</span><br />
          Pengiriman Express <br />
          <span class="text-gray-400">5-7 hari</span>
        </div>
        <div class="col-span-2 text-center">
          <div class="inline-flex items-center border rounded-md">
            <button class="px-2 py-1 bg-gray-200 hover:bg-gray-300">-</button>
            <input type="number" value="2" min="1" class="w-10 text-center border-l border-r" />
            <button class="px-2 py-1 bg-gray-200 hover:bg-gray-300">+</button>
          </div>
          <p class="text-sm text-blue-500 cursor-pointer mt-2">Hapus</p>
        </div>
        <div class="col-span-1 text-right text-gray-800 font-bold">Rp111.000</div>
      </div>
    </div>


    <!-- Ringkasan Pesanan -->
    <div class="mt-8 bg-gray-50 p-6 rounded-lg">
      <h3 class="text-gray-800 font-bold mb-4">Ringkasan Pesanan</h3>
      <div class="flex justify-between text-gray-600 mb-2">
        <span>Produk dalam Keranjang:</span>
        <span>Rp186.000</span>
      </div>
      <div class="flex justify-between text-gray-600 mb-2">
        <span>Ongkos Kirim:</span>
        <span>Rp20.460</span>
      </div>
      <div class="flex justify-between text-gray-800 font-bold text-lg">
        <span>Total:</span>
        <span>Rp206.460</span>
      </div>
    </div>

    <!-- Tombol Checkout -->
    <div class="mt-6 text-right">
      <a href="/transaction" class="bg-orange-500 text-white px-6 py-3 rounded-md hover:bg-blue-600">
        Lanjut ke Pembayaran
      </a>
    </div>
  </div>

  <div class="col-span-4 bg-gray-50 p-6 rounded-lg">
    <a href="/" class="flex mx-auto justify-end text-orange-500 mb-5">Lanjut beli yang lain yuk</a>
    <h3 class="text-gray-800 font-bold mb-4">Kamu Mungkin Juga Suka</h3>
    <div class="space-y-4">
      <!-- Produk Rekomendasi 1 -->
      <div class="bg-white p-4 rounded-lg shadow w-50">
          <img src="https://via.placeholder.com/150" alt="Produk" class="w-full mb-2">
           <p class="text-orange-500">★★★★☆</p>
           <p class="font-medium mb-2">Nama Produk</p>
           <p class="text-orange-500 font-bold">Rp 100.000</p>
      </div>
      <div class="bg-white p-4 rounded-lg shadow w-50">
          <img src="https://via.placeholder.com/150" alt="Produk" class="w-full mb-2">
           <p class="text-orange-500">★★★★☆</p>
           <p class="font-medium mb-2">Nama Produk</p>
           <p class="text-orange-500 font-bold">Rp 100.000</p>
      </div>
      <div class="bg-white p-4 rounded-lg shadow w-50">
          <img src="https://via.placeholder.com/150" alt="Produk" class="w-full mb-2">
           <p class="text-orange-500">★★★★☆</p>
           <p class="font-medium mb-2">Nama Produk</p>
           <p class="text-orange-500 font-bold">Rp 100.000</p>
      </div>
      <div class="bg-white p-4 rounded-lg shadow w-50">
          <img src="https://via.placeholder.com/150" alt="Produk" class="w-full mb-2">
           <p class="text-orange-500">★★★★☆</p>
           <p class="font-medium mb-2">Nama Produk</p>
           <p class="text-orange-500 font-bold">Rp 100.000</p>
      </div>
    </div>
</div>
</div>


@endsection