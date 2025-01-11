@extends('layout')

@section('content')
<div class="max-w-7xl mx-auto p-6 bg-white shadow-md rounded-lg grid grid-cols-12 gap-8 mt-5">
  <!-- Bagian Utama (Detail Transaksi) -->
  <div class="col-span-8">
    <!-- Header -->
    <div class="grid grid-cols-12 items-center border-b pb-4 mb-4">
      <div class="col-span-6 text-gray-700 font-bold">Produk</div>
      <div class="col-span-3 text-center text-gray-700 font-bold">Metode Pengiriman</div>
      <div class="col-span-3 text-right text-gray-700 font-bold">Harga</div>
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
          Pengiriman UPS <br />
          <span class="text-gray-400">5-7 hari</span>
        </div>
        <div class="col-span-3 text-right text-gray-800 font-bold">Rp75.000</div>
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
          Pengiriman Express <br />
          <span class="text-gray-400">3-5 hari</span>
        </div>
        <div class="col-span-3 text-right text-gray-800 font-bold">Rp111.000</div>
      </div>
    </div>

    <!-- Ringkasan Pembayaran -->
    <div class="mt-8 bg-gray-50 p-6 rounded-lg">
      <h3 class="text-gray-800 font-bold mb-4">Ringkasan Pembayaran</h3>
      <div class="flex justify-between text-gray-600 mb-2">
        <span>Total Harga Produk:</span>
        <span>Rp186.000</span>
      </div>
      <div class="flex justify-between text-gray-600 mb-2">
        <span>Ongkos Kirim:</span>
        <span>Rp20.460</span>
      </div>
      <div class="flex justify-between text-gray-800 font-bold text-lg">
        <span>Total Pembayaran:</span>
        <span>Rp206.460</span>
      </div>
    </div>

    <!-- Tombol Konfirmasi -->
    <div class="mt-6 text-right">
      <a href="/transaction/success" class="bg-orange-500 text-white px-6 py-3 rounded-md hover:bg-blue-600">
        Konfirmasi Pembayaran
      </a>
    </div>
  </div>

  <!-- Bagian Samping (Informasi Pembeli) -->
  <div class="col-span-4 bg-gray-50 p-6 rounded-lg">
    <h3 class="text-gray-800 font-bold mb-4">Detail Pembeli</h3>
    <form>
      <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
        <h6>Sherlock Holmes</h6>
      </div>
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <h6>69@yahoo.com</h6>
      </div>
      <div class="mb-4">
        <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
        <h6>Jawa, Jawa Barat</h6>
        <h6>Kabupaten Bogor</h6>
        <h6>Intibumi T/9</h6>
      </div>
    </form>
  </div>
</div>
@endsection
