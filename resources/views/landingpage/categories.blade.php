<x-home-layout>


    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold mb-6 text-center">{{ $category->name }} - Katalog Produk</h2>

        @if ($products->isEmpty())
            <p class="text-center text-gray-600">Tidak ada produk yang tersedia di kategori ini.</p>
        @else
        <div class="mt-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Katalog Produk</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                @foreach ($products->groupBy('name') as $name => $items)
    @php $item = $items->first(); @endphp
    <a href="/preview/{{ $item->name }}" class="block bg-gray-100 p-2 rounded-lg hover:shadow-lg transition">
        <div class="w-full aspect-square bg-gray-200 rounded-lg overflow-hidden">
            <img src="{{ asset('storage/products/' . $item->picture) }}" alt="{{ $item->name }}" class="object-cover w-full h-full">
        </div>
        <p class="mt-2 text-gray-800 text-sm truncate">{{ $item->name }}</p>
        <p class="text-sm font-semibold text-gray-900">Rp. {{ number_format($item->price, 0, ',', '.') }}</p>
    </a>
@endforeach

            </div>
        </div>
        @endif
    </div>
</x-home-layout>
