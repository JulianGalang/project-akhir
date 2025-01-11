<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class="bg-red-100 flex items-center justify-center min-h-screen">
<section id="register" class="bg-white p-12 rounded-lg shadow w-full max-w-2xl">
    <!-- Logo -->
    <div class="flex justify-center mb-6">
      <img src="logo.png" alt="Logo" class="w-20 h-20">
    </div>

    <h3 class="text-2xl font-bold text-center mb-6">Daftar Akun Baru</h3>
    <form>
        <div class="mb-6">
            <label for="name" class="block text-lg font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" id="name" class="w-full p-4 border rounded focus:ring-2 focus:ring-orange-500" placeholder="Masukkan nama Anda">
        </div>
        <div class="mb-6">
            <label for="email" class="block text-lg font-medium text-gray-700">Email</label>
            <input type="email" id="email" class="w-full p-4 border rounded focus:ring-2 focus:ring-orange-500" placeholder="Masukkan email Anda">
        </div>
        <div class="mb-6">
            <label for="password" class="block text-lg font-medium text-gray-700">Password</label>
            <input type="password" id="password" class="w-full p-4 border rounded focus:ring-2 focus:ring-orange-500" placeholder="Masukkan kata sandi Anda">
        </div>
        <div class="mb-6">
            <label for="confirm-password" class="block text-lg font-medium text-gray-700">Konfirmasi Password</label>
            <input type="password" id="confirm-password" class="w-full p-4 border rounded focus:ring-2 focus:ring-orange-500" placeholder="Konfirmasi kata sandi Anda">
        </div>
        <button class="bg-orange-500 text-white px-6 py-3 rounded w-full hover:bg-orange-600 text-lg font-semibold">Daftar</button>
    </form>
    <p class="mt-6 text-lg text-gray-600 text-center">
      Sudah punya akun? 
      <a href="#login" class="text-orange-500 hover:underline">Login di sini</a>
    </p>
</section>
</body>
</html>
