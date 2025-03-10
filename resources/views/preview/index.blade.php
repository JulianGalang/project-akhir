@php
    $totalStock = $productVariants->sum('stock');
    $groups = $productVariants->groupBy('group'); // Mengelompokkan berdasarkan kolom group dari tabel product
@endphp

<x-home-layout>
    <div class="max-w-4xl mx-auto mt-8 p-6 bg-white shadow-md rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Gambar Produk -->
            <div id="image-container" class="aspect-square bg-gray-200 rounded-lg overflow-hidden">
                <img id="product-image" src="{{ asset('storage/products/' . $productVariants->first()->picture) }}"
                     alt="{{ $productVariants->first()->name }}"
                     class="object-cover w-full h-full">
            </div>

            <!-- Detail Produk -->
            <div>
                <h1 class="text-2xl font-bold text-gray-800" id="product-name">{{ $productVariants->first()->name }}</h1>

                <!-- Harga -->
                <p id="price" class="mt-2 text-gray-600 text-xl font-semibold">
                    Rp. {{ number_format($productVariants->first()->price, 0, ',', '.') }}
                </p>

                <p id="label" class="mt-2 text-black text-xl font-semibold">Description</p>
                <p id="description" class="mt-2 text-gray-600 text-s">
                    {{ $productVariants->first()->description }}
                </p>

                <!-- Pilih Golongan -->
                <h3 class="text-lg font-semibold text-gray-800 mt-4">Pilih Golongan</h3>
                <div class="flex space-x-2 mt-2">
                    @foreach ($groups as $group => $items)
                        <button
                            class="group-btn px-4 py-2 border rounded-lg hover:bg-blue-600 hover:text-white"
                            data-group="{{ $group }}">
                            {{ ucfirst($group) }}
                        </button>
                    @endforeach
                </div>

                <!-- Pilih Ukuran -->
                <h3 class="text-lg font-semibold text-gray-800 mt-4">Pilih Ukuran</h3>
                <div id="size-container" class="flex space-x-2 mt-2"></div>

                <p id="stock" class="mt-1 text-gray-500">Stok: {{ $totalStock }}</p>

                <!-- Form Tambah ke Keranjang -->
                <form action="{{ route('cart.store') }}" method="POST" class="mt-6">
                    @csrf
                    <input type="hidden" name="products_id" id="product_id">
                    <input type="hidden" name="size" id="selected_size">
                    <input type="hidden" name="group" id="selected_group">

                    <label for="quantity" class="block mb-2 text-gray-600">Jumlah:</label>
                    <input type="number" id="quantity" name="quantity" min="1" max="1" value="1" class="w-16 text-center border rounded focus:outline-none" disabled>

                    <button type="submit" id="add-to-cart" class="ml-4 bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                        Tambah ke Keranjang
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        const allVariants = @json($productVariants);
        let selectedGroup = null;

        document.querySelectorAll('.group-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Reset semua tombol golongan
                document.querySelectorAll('.group-btn').forEach(btn => {
                    btn.classList.remove('bg-blue-600', 'text-white');
                });

                // Set golongan yang dipilih
                selectedGroup = this.getAttribute('data-group');
                document.getElementById('selected_group').value = selectedGroup;

                // Tambahkan efek aktif ke tombol yang dipilih
                this.classList.add('bg-blue-600', 'text-white');

                // Filter ukuran yang sesuai dengan golongan
                const filteredVariants = allVariants.filter(variant => variant.group === selectedGroup);

                // Update Gambar & Nama Produk
                if (filteredVariants.length > 0) {
                    document.getElementById('product-image').src = "/storage/products/" + filteredVariants[0].picture;
                    document.getElementById('product-name').innerText = filteredVariants[0].name;
                }

                // Update ukuran yang tersedia
                updateSizeButtons(filteredVariants);
            });
        });

        function updateSizeButtons(variants) {
            const sizeContainer = document.getElementById('size-container');
            sizeContainer.innerHTML = '';

            variants.forEach(variant => {
                let button = document.createElement('button');
                button.classList.add('size-btn', 'px-4', 'py-2', 'border', 'rounded-lg', 'hover:bg-blue-600', 'hover:text-white');
                button.innerText = variant.size;
                button.setAttribute('data-id', variant.id);
                button.setAttribute('data-size', variant.size);
                button.setAttribute('data-price', variant.price);
                button.setAttribute('data-stock', variant.stock);

                button.addEventListener('click', function() {
                    document.querySelectorAll('.size-btn').forEach(btn => {
                        btn.classList.remove('bg-blue-600', 'text-white');
                        btn.removeAttribute('disabled');
                    });

                    let productId = this.getAttribute('data-id');
                    let size = this.getAttribute('data-size');
                    let price = this.getAttribute('data-price');
                    let stock = this.getAttribute('data-stock');

                    document.getElementById('product_id').value = productId;
                    document.getElementById('selected_size').value = size;
                    document.getElementById('price').innerText = "Rp. " + new Intl.NumberFormat('id-ID').format(price);
                    document.getElementById('stock').innerText = "Stok: " + stock;

                    let quantityInput = document.getElementById('quantity');
                    quantityInput.setAttribute('max', stock);
                    quantityInput.value = 1;
                    quantityInput.removeAttribute('disabled');

                    document.getElementById('add-to-cart').removeAttribute('disabled');

                    this.classList.add('bg-blue-600', 'text-white');
                    this.setAttribute('disabled', 'true');
                });

                sizeContainer.appendChild(button);
            });
        }
    </script>
</x-home-layout>
