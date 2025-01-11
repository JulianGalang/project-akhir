<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body>
<section id="register" class="bg-white p-6 rounded-lg shadow">
    <h3 class="text-lg font-bold mb-4">Daftar Akun Baru</h3>
    <form>
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" id="name" class="w-full p-2 border rounded" placeholder="Masukkan nama Anda">
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" class="w-full p-2 border rounded" placeholder="Masukkan email Anda">
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" class="w-full p-2 border rounded" placeholder="Masukkan kata sandi Anda">
        </div>
        <div class="mb-4">
            <label for="confirm-password" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
            <input type="password" id="confirm-password" class="w-full p-2 border rounded" placeholder="Konfirmasi kata sandi Anda">
        </div>
        <button class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 w-full">Daftar</button>
    </form>
    <p class="mt-4 text-sm text-gray-600">Sudah punya akun? <a href="#login" class="text-orange-500 hover:underline">Login di sini</a></p>
</section>

</body>
</html>