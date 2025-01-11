@extends('layout')

@section('content')
<div class="max-w-7xl mx-auto p-6 bg-white shadow-md rounded-lg grid grid-cols-1 gap-8 mt-5 text-center">
  <!-- Icon Sukses -->
  <div class="flex justify-center items-center">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7 12l5 5 5-10" />
    </svg>
  </div>

  <!-- Pesan Sukses -->
  <h1 class="text-3xl font-bold text-gray-800">Pembayaran Berhasil!</h1>
  <p class="text-gray-600">Terima kasih telah berbelanja bersama kami. Pesanan Anda sedang diproses dan akan segera dikirimkan.</p>

  <!-- Rincian Pesanan -->
  <div class="mt-6 bg-gray-50 p-6 rounded-lg max-w-md mx-auto shadow-md">
    <h3 class="text-gray-800 font-bold mb-4">Rincian Pesanan</h3>
    <div class="flex justify-between text-gray-600 mb-2">
      <span>Nomor Pesanan:</span>
      <span>#INV20250111</span>
    </div>
    <div class="flex justify-between text-gray-600 mb-2">
      <span>Total Pembayaran:</span>
      <span>Rp206.460</span>
    </div>
    <div class="flex justify-between text-gray-600">
      <span>Metode Pengiriman:</span>
      <span>UPS - 5-7 Hari</span>
    </div>
  </div>

  <!-- Tombol Kembali ke Beranda -->
  <div class="mt-6">
    <a href="/" class="bg-orange-500 text-white px-6 py-3 rounded-md hover:bg-blue-600">
      Kembali ke Beranda
    </a>
  </div>
</div>
@endsection