<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-red-100 flex items-center justify-center min-h-screen">

  <section id="login" class="bg-white p-6 rounded-lg shadow w-full max-w-sm">
    <!-- Logo -->
    <div class="flex justify-center mb-4">
      <img src="logo.png" alt="Logo" class="w-16 h-16">
    </div>

    <h3 class="text-lg font-bold text-center mb-4">Login</h3>
    <form>
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Masukkan email Anda">
      </div>
      <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Masukkan kata sandi Anda">
      </div>
      <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded w-full hover:bg-orange-600 transition">Login</button>
    </form>
    <p class="mt-4 text-sm text-gray-600 text-center">
      Belum punya akun? 
      <a href="/register" class="text-orange-500 hover:underline">Daftar di sini</a>
    </p>
  </section>

</body>
</html>
