@php
    $shuffledProducts = collect($products)->map(function ($items, $name) {
        return ['name' => $name, 'items' => $items];
    })->shuffle();
@endphp

<x-home-layout>
    <!-- Navbar Kecil untuk Categories -->
    <nav class="bg-white shadow-md mb-2">
        <div class="relative max-w-screen-lg mx-auto px-4">
            <div class="py-3 overflow-x-auto whitespace-nowrap scrollbar-hide scroll-smooth flex md:justify-center border-b"
                id="navScroll">
                <ul class="flex space-x-6 items-center">
                    @foreach ($categories as $data)
                        <li class="px-3">
                            <a href="/categories/{{ $data->id }}"
                                class="text-gray-700 hover:text-orange-500 transition-colors duration-300 font-medium relative">
                                {{ $data->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    <!-- Jenis Produk -->
    <div class="mt-2">
        <div class="flex justify-start items-start">
        </div>
    </div>

    <!-- Katalog Produk -->
    <div class="mt-8">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Katalog Produk</h3>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            @foreach ($shuffledProducts as $product)
                <a href="/preview/{{ $product['name'] }}" class="block bg-gray-100 p-2 rounded-lg hover:shadow-lg transition">
                    <div class="w-full aspect-square bg-gray-200 rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/products/' . $product['items']->first()->picture) }}"
                             alt="{{ $product['items']->first()->name }}"
                             class="object-cover w-full h-full">
                    </div>
                    <p class="mt-2 text-gray-800 text-sm truncate">{{ $product['name'] }}</p>
                    <p class="text-sm font-semibold text-gray-900">Rp. {{ number_format($product['items']->first()->price, 0, ',', '.') }}</p>
                </a>
            @endforeach
        </div>
    </div>
</x-home-layout>
