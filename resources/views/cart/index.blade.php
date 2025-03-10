<x-home-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Tabel Katalog Keranjang -->
            <div class="col-span-1 lg:col-span-2">
                <div class="overflow-x-auto bg-white shadow-md rounded-lg p-4">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th class="p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-all" type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        <label for="checkbox-all" class="sr-only">Select All</label>
                                    </div>
                                </th>
                                <th class="px-6 py-3 w-24">#</th>
                                <th class="px-6 py-3">Nama Produk</th>
                                <th class="px-6 py-3">Size</th>
                                <th class="px-6 py-3">Harga</th>
                                <th class="px-6 py-3">Jumlah</th>
                                <th class="px-6 py-3">Total</th>
                                <th class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="p-4">
                                        <div class="flex items-center">
                                            <input type="checkbox" class="item-checkbox w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                            data-id="{{ $item->id }}"
                                            data-product-id="{{ $item->products_id }}"
                                            data-price="{{ $item->products->price }}"
                                            data-quantity="{{ $item->quantity }}"
                                            data-stock="{{ $item->products->stock }}"
                                            {{ $item->products->stock == 0 ? 'disabled' : '' }}>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 w-24">
                                        <div class="w-24 h-24 flex justify-center items-center">
                                            <img src="{{ asset('storage/products/' . $item->products->picture) }}" alt="{{ $item->products->name }}" class="w-full h-full object-cover rounded">
                                        </div>
                                    </td>
                                    <td data-name="{{ $item->products->name }}" class="px-6 py-4 {{ $item->products->stock == 0 ? 'line-through text-gray-500' : '' }}">
                                        {{ $item->products->name }}
                                    </td>
                                    <td class="px-6 py-4" data-size="{{ $item->products->size }}">{{ $item->products->size }}</td>
                                    <td class="px-6 py-4">Rp{{ number_format($item->products->price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">
                                        <input type="number" min="1" value="{{ $item->quantity }}" class="w-16 text-center border rounded focus:outline-none quantity-input"
                                            data-id="{{ $item->id }}" data-price="{{ $item->products->price }}"
                                            data-stock="{{ $item->products->stock }}" {{ $item->products->stock == 0 ? 'disabled' : '' }}>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="total-price" id="total-price-{{ $item->id }}">
                                            Rp{{ number_format($item->products->price * $item->quantity, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="/cart/{{ $item->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:underline" type="submit">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Ringkasan Pembelian -->
            <div class="col-span-1">
                <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold mb-4">Ringkasan Pembelian</h3>
                    <div class="flex justify-between mb-2">
                        <span>Jumlah Item:</span>
                        <span id="total-items">0</span>
                    </div>
                    <div class="flex justify-between mb-4 font-bold text-lg">
                        <span>Total:</span>
                        <span id="total">Rp0</span>
                    </div>
                    <button id="checkout-btn" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                        Lanjutkan ke Pembayaran
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- JavaScript untuk Update Total Harga dan Jumlah Item -->
    <script>
        function updateSummary() {
            let total = 0;
            let totalItems = 0;

            document.querySelectorAll('.item-checkbox:checked').forEach(checkbox => {
                let id = checkbox.getAttribute('data-id');
                let quantity = parseInt(document.querySelector(`.quantity-input[data-id="${id}"]`).value);
                let price = parseInt(checkbox.getAttribute('data-price'));

                total += price * quantity;
                totalItems += quantity;
            });

            document.getElementById('total').innerText = 'Rp' + total.toLocaleString('id-ID');
            document.getElementById('total-items').innerText = totalItems;
        }

        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('input', function() {
                let id = this.getAttribute('data-id');
                let stock = parseInt(this.getAttribute('data-stock'));
                let price = parseInt(this.getAttribute('data-price'));
                let quantity = parseInt(this.value);
                let totalPriceElement = document.getElementById('total-price-' + id);

                if (isNaN(quantity) || quantity < 1) {
                    quantity = 1;
                    this.value = 1;
                }

                if (quantity > stock) {
                    alert("Jumlah melebihi stok yang tersedia!");
                    this.value = stock;
                    quantity = stock;
                }

                let totalPrice = price * quantity;
                totalPriceElement.innerText = 'Rp' + totalPrice.toLocaleString('id-ID');

                updateSummary();
            });
        });

        document.querySelectorAll('.item-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateSummary);
        });

        document.getElementById('checkbox-all').addEventListener('change', function() {
            let checked = this.checked;

            // Pilih hanya produk yang masih memiliki stok
            document.querySelectorAll('.item-checkbox').forEach(checkbox => {
                if (checkbox.getAttribute('data-stock') > 0) {
                    checkbox.checked = checked;
                }
            });
            updateSummary();
        });

        document.getElementById("checkout-btn").addEventListener("click", function () {
            let selectedItems = [];
            document.querySelectorAll(".item-checkbox:checked").forEach((checkbox) => {
                let id = checkbox.getAttribute("data-id");
                let products_id = checkbox.getAttribute("data-product-id");
                let row = checkbox.closest('tr');

                let nameElement = row.querySelector('td[data-name]');
                let sizeElement = row.querySelector('td[data-size]');

                let name = nameElement ? nameElement.innerText : '';
                let size = sizeElement ? sizeElement.innerText : '';
                let price = parseInt(checkbox.getAttribute("data-price"));
                let quantity = parseInt(row.querySelector('.quantity-input').value);

                selectedItems.push({ id, name, size, price, quantity, products_id});
            });

            if (selectedItems.length === 0) {
                alert("Pilih minimal 1 produk untuk melanjutkan!");
                return;
            }

            localStorage.setItem("selectedCartItems", JSON.stringify(selectedItems));
            console.log(selectedItems)

            window.location.href = "/transaction";
        });

    </script>
</x-home-layout>
