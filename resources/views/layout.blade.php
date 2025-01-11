<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
  <!-- Navbar Utama -->
  <nav class="bg-orange-500 text-white py-4 relative">
    <div class="container mx-auto flex justify-between items-center px-4">
        <div class="text-xl font-bold"><b>サンゴ版サンゴ版</b></div>

        <!-- Search Bar -->
        <div class="absolute inset-0 mx-auto flex items-center justify-center w-1/2">
            <div class="flex items-center bg-white rounded-lg overflow-hidden w-full">
                <input 
                    type="text" 
                    placeholder="Cari produk..." 
                    class="p-2 text-gray-700 outline-none w-full"
                >
                <button class="p-2 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17a6 6 0 100-12 6 6 0 000 12zm0 0l4 4" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Cart dan Profile -->
        <div class="flex items-center gap-4">
            <a href="/cart" class="cursor-pointer">Cart</a>
            <a href="/profile" class="cursor-pointer"><img src="https://via.placeholder.com/50" alt="Avatar" class="w-12 h-12 rounded-full mr-3"></a>
        </div>
    </div>
</nav>
<div id="chatbox" class="fixed bottom-4 right-4 bg-white shadow-lg rounded-lg w-96 z-50 hidden">
        <!-- Header -->
        <div class="bg-orange-500 text-white py-3 px-4 rounded-t-lg flex items-center justify-between">
            <h3 class="font-bold">Live Chat</h3>
            <div class="flex gap-2">
                <button id="collapseChat" class="text-white text-xl">&#x25BC;</button> <!-- Tombol Collapse -->
                <button id="closeChat" class="text-white text-xl">&times;</button> <!-- Tombol Close -->
            </div>
        </div>

        <!-- Chat Messages -->
        <div id="chatMessages" class="p-4 h-64 overflow-y-auto">
            <!-- Example Messages -->
            <div class="text-left mb-4">
                <div class="bg-gray-200 inline-block p-3 rounded-lg">
                    Hi! How can I help you?
                </div>
                <p class="text-xs text-gray-400 mt-1">Bot - 10:00 AM</p>
            </div>
        </div>

        <!-- Input Chat -->
        <div class="p-3 border-t flex items-center">
            <input 
                id="chatInput" 
                type="text" 
                placeholder="Tulis pesan..." 
                class="w-full p-2 border rounded-lg focus:outline-none focus:ring focus:ring-orange-500"
            >
            <button id="sendChat" class="ml-2 p-2 bg-orange-500 text-white rounded-lg">
                Kirim
            </button>
        </div>
    </div>

    </div>
</div>



    <!-- Navbar Kategori -->
    <nav class="bg-orange-400 text-white py-2">
    <div class="container mx-auto px-4 flex justify-between items-center">
    <ul class="flex gap-6">
    <li><a href="/category" class="hover:underline">Sepatu NIKE</a></li>
    <li><a href="/category" class="hover:underline">Sandal Crocs</a></li>
    <li><a href="/category" class="hover:underline">Celana Jeans</a></li>
    <li><a href="/category" class="hover:underline">Baju Kaos Polos</a></li>
    <li><a href="/category" class="hover:underline">Sepatu Adidas</a></li>
    <li><a href="/category" class="hover:underline">Sandal Havaianas</a></li>
    <li><a href="/category" class="hover:underline">Celana Pendek</a></li>
    <li><a href="/category" class="hover:underline">Baju Hem</a></li>
    <li><a href="/category" class="hover:underline">Sepatu Converse</a></li>
    <li><a href="/category" class="hover:underline">Baju Hoodie</a></li>
</ul>

        <div id="openChat" class="cursor-pointer fixed bottom-4 right-4 bg-orange-500 text-white py-2 px-4 rounded-lg shadow-lg hover:bg-orange-600">
        Butuh Bantuan?
    </div>
    </div>
    </nav>
@yield('content')
<footer class="bg-gray-800 text-white mt-10 py-10">
        <div class="container mx-auto grid grid-cols-4 gap-6 px-4">
            <div>
                <h4 class="font-bold mb-4">Tentang Kami</h4>
                <p>Informasi tentang perusahaan atau layanan.</p>
            </div>
            <div>
                <h4 class="font-bold mb-4">Layanan</h4>
                <ul>
                    <li><a href="#" class="hover:underline">Bantuan</a></li>
                    <li><a href="#" class="hover:underline">Pengembalian</a></li>
                    <li><a href="#" class="hover:underline">FAQ</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Kontak</h4>
                <p>Email: support@example.com</p>
                <p>Telepon: +62 696 787 303</p>
            </div>
            <div>
                <h4 class="font-bold mb-4">Sosial Media</h4>
                <a href="#" class="block hover:underline">Instagram</a>
                <a href="#" class="block hover:underline">Facebook</a>
                <a href="#" class="block hover:underline">Twitter</a>
            </div>
        </div>
    </footer>
<script>
    const carousel = document.getElementById('carousel');
    const prev = document.getElementById('prev');
    const next = document.getElementById('next');
    const dots = document.querySelectorAll('.dot');

    let index = 0;

    const updateCarousel = () => {
        carousel.style.transform = `translateX(-${index * 100}%)`;
        dots.forEach((dot, i) => {
            dot.classList.toggle('bg-orange-500', i === index); // Pentil aktif oranye
            dot.classList.toggle('bg-gray-300', i !== index);  // Pentil tidak aktif abu-abu
        });
    };

    const nextSlide = () => {
        index = (index + 1) % carousel.children.length;
        updateCarousel();
    };

    const prevSlide = () => {
        index = (index - 1 + carousel.children.length) % carousel.children.length;
        updateCarousel();
    };

    const goToSlide = (i) => {
        index = i;
        updateCarousel();
    };

    next.addEventListener('click', nextSlide);
    prev.addEventListener('click', prevSlide);
    dots.forEach((dot) => {
        dot.addEventListener('click', () => goToSlide(parseInt(dot.getAttribute('data-index'))));
    });

    setInterval(nextSlide, 5000);

    updateCarousel();
</script>
<script src="chat.js"></script>
<script src="profile.js"></script>
<script src="logout.js"></script>
</body>
</html>