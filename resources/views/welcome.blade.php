@extends('layout')

@section('content')
    <div class="container mx-auto mt-4 relative">
    <div class="overflow-hidden rounded-lg relative">
        <div id="carousel" class="flex transition-transform duration-500 ease-in-out">
            <img src="https://via.placeholder.com/1200x400?text=Slide+1" alt="Slide 1" class="w-full flex-shrink-0">
            <img src="https://via.placeholder.com/1200x400?text=Slide+2" alt="Slide 2" class="w-full flex-shrink-0">
            <img src="https://via.placeholder.com/1200x400?text=Slide+3" alt="Slide 3" class="w-full flex-shrink-0">
        </div>
    </div>

    <!-- Navigasi Carousel -->
    <div class="absolute inset-0 flex justify-between items-center px-2">
        <!-- Panah Kiri -->
        <button id="prev" class="w-10 h-10 bg-orange-500 text-white rounded-full flex items-center justify-center m-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <!-- Panah Kanan -->
        <button id="next" class="w-10 h-10 bg-orange-500 text-white rounded-full flex items-center justify-center m-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>

    <!-- Indikator Titik (Pentil) -->
    <div class="absolute bottom-2 left-0 right-0 flex justify-center space-x-2 m-4">
        <div class="dot w-3 h-3 bg-gray-300 rounded-full cursor-pointer" data-index="0"></div>
        <div class="dot w-3 h-3 bg-gray-300 rounded-full cursor-pointer" data-index="1"></div>
        <div class="dot w-3 h-3 bg-gray-300 rounded-full cursor-pointer" data-index="2"></div>
    </div>
</div>

<div class="flex flex-col items-center mt-8">
    <!-- Judul -->
    <h2 class="text-center text-xl font-bold text-black-700 uppercase mb-6">Jenis Produk</h2>

    <!-- Tombol-tombol -->
    <div class="flex justify-center items-center gap-6">
        <a href="/category" class="flex justify-center items-center w-40 h-40 rounded-full bg-gray-200 hover:bg-orange-500 transition duration-300">
            <img src="img/shirt.png" alt="Icon 1" class="w-20 h-20">
        </a>
        <a href="/category" class="flex justify-center items-center w-40 h-40 rounded-full bg-gray-200 hover:bg-orange-500 transition duration-300">
            <img src="img/pant.png" alt="Icon 1" class="w-20 h-20">
        </a>
        <a href="/category" class="flex justify-center items-center w-40 h-40 rounded-full bg-gray-200 hover:bg-orange-500 transition duration-300">
            <img src="img/shoes.png" alt="Icon 1" class="w-20 h-20">
        </a>
        <a href="/category" class="flex justify-center items-center w-40 h-40 rounded-full bg-gray-200 hover:bg-orange-500 transition duration-300">
            <img src="img/sandal.png" alt="Icon 1" class="w-20 h-20">
        </a>
    </div>
</div>

<hr class="mt-4">

    <!-- Layout Utama -->
    <div class="container mx-auto flex mt-6 px-4 gap-6">
        <!-- Sidebar Filter -->
        <div class="w-1/4 bg-white p-4 rounded-lg shadow">
            <h3 class="text-lg font-bold mb-4">Filters</h3>
            <div class="mb-4">
                <h4 class="font-medium mb-2">Ratings</h4>
                <div class="flex gap-2">
                    <input type="number" placeholder="Min" min="0" class="w-1/2 p-2 border rounded">
                    <input type="number" placeholder="Max" min="0" class="w-1/2 p-2 border rounded">
                </div>
            </div>
            <div class="mb-4">
                <h4 class="font-medium mb-2">Harga</h4>
                <div class="flex gap-2">
                    <input type="number" placeholder="Min" class="w-1/2 p-2 border rounded">
                    <input type="number" placeholder="Max" class="w-1/2 p-2 border rounded">
                </div>
            </div>
            <div>
                <h4 class="font-medium mb-2">Kategori</h4>
                <div class="flex flex-col gap-2">
                    <label class="flex items-center"><input type="checkbox" class="mr-2"> Sepatu</label>
                    <label class="flex items-center"><input type="checkbox" class="mr-2"> Sandal</label>
                    <label class="flex items-center"><input type="checkbox" class="mr-2"> Celana</label>
                    <label class="flex items-center"><input type="checkbox" class="mr-2"> Baju</label>
                </div>
            </div>
        </div>

        <!-- Konten Produk -->
        <div class="w-3/4">
            <h2 class="text-xl font-bold mb-4">Produk Terbaru</h2>
            <div class="grid grid-cols-4 gap-6">
                <!-- Item Produk -->
                <a href="/product" class="block">
                <div href="/product" class="bg-white p-3 rounded-lg shadow">
                    <img src="https://via.placeholder.com/150" alt="Produk" class="w-full mb-4">
                    <p class="text-orange-500">★★★★☆</p>
                    <p class="font-medium mb-5">Nama Produk</p>
                    <p class="text-orange-500 font-bold">Rp 100.000</p>
                </div></a>
                <a href="/product" class="block">
                <div href="/product" class="bg-white p-3 rounded-lg shadow">
                    <img src="https://via.placeholder.com/150" alt="Produk" class="w-full mb-4">
                    <p class="text-orange-500">★★★★☆</p>
                    <p class="font-medium mb-5">Nama Produk</p>
                    <p class="text-orange-500 font-bold">Rp 100.000</p>
                </div></a>
                <a href="/product" class="block">
                <div href="/product" class="bg-white p-3 rounded-lg shadow">
                    <img src="https://via.placeholder.com/150" alt="Produk" class="w-full mb-4">
                    <p class="text-orange-500">★★★★☆</p>
                    <p class="font-medium mb-5">Nama Produk</p>
                    <p class="text-orange-500 font-bold">Rp 100.000</p>
                </div></a>
                <a href="/product" class="block">
                <div href="/product" class="bg-white p-3 rounded-lg shadow">
                    <img src="https://via.placeholder.com/150" alt="Produk" class="w-full mb-4">
                    <p class="text-orange-500">★★★★☆</p>
                    <p class="font-medium mb-5">Nama Produk</p>
                    <p class="text-orange-500 font-bold">Rp 100.000</p>
                </div></a>
                <!-- Tambahkan item produk lainnya -->
            </div>
        </div>
    </div>

    <!-- Section Map -->
<div class="mt-8">
    <h2 class="text-center text-xl font-bold text-black-700 mb-6">LOKASI KAMI</h2>
    <div class="flex justify-center">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3162.8888909282877!2d-122.08424968505841!3d37.42199997982517!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb24d43d4c1a9%3A0x26b57d6a01b8a569!2sGoogleplex!5e0!3m2!1sen!2sus!4v1675687909241!5m2!1sen!2sus" 
            width="1500" 
            height="400" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>
@stop
