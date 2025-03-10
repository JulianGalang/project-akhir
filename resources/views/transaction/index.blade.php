<x-home-layout>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6">Konfirmasi Transaksi</h2>


            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Tabel Produk yang Dibeli -->
                <div class="col-span-1 lg:col-span-2">
                    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3">Nama Produk</th>
                                    <th class="px-6 py-3">Size</th>
                                    <th class="px-6 py-3">Harga</th>
                                    <th class="px-6 py-3">Jumlah</th>
                                    <th class="px-6 py-3">Total</th>
                                </tr>
                            </thead>
                            <tbody id="transaction-items">
                                <!-- Produk akan dimasukkan melalui JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Ringkasan Pesanan -->
                <div class="col-span-1">
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-bold mb-4">Ringkasan Pesanan</h3>
                        <div class="flex justify-between mb-2">
                            <span>Subtotal:</span>
                            <span id="subtotal">Rp0</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span>PPN (12%):</span>
                            <span id="ppn">Rp0</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span>Ongkos Kirim:</span>
                            <span id="ongkir">Rp10.000</span>
                        </div>
                        <div class="flex justify-between mb-4 font-bold text-lg">
                            <span>Total Bayar:</span>
                            <span id="total-bayar">Rp0</span>
                        </div>
                        <input type="hidden" name="payment_method" id="payment-method" value="qris">
                        <button type="submit" id="sendDataButton" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">Bayar Sekarang</button>
                    </div>
                </div>
            </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
    let selectedItems = JSON.parse(localStorage.getItem("selectedCartItems")) || [];

    if (selectedItems.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Keranjang Kosong',
            text: 'Silakan tambahkan produk terlebih dahulu!',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = "/cart";
        });
        return;
    }

    let transactionTable = document.getElementById("transaction-items");
    let subtotal = 0;
    selectedItems.forEach(item => {
        let totalPrice = item.price * item.quantity;
        subtotal += totalPrice;

        transactionTable.innerHTML += `
            <tr class="bg-white border-b hover:bg-gray-50">
                <td class="px-6 py-4">${item.name}</td>
                <td class="px-6 py-4">${item.size}</td>
                <td class="px-6 py-4">Rp${item.price.toLocaleString('id-ID')}</td>
                <td class="px-6 py-4">${item.quantity}</td>
                <td class="px-6 py-4">Rp${totalPrice.toLocaleString('id-ID')}</td>
            </tr>
        `;
    });

    let ppn = subtotal * 0.12;
    let ongkir = 10000;
    let totalBayar = subtotal + ppn + ongkir;

    document.getElementById("subtotal").innerText = 'Rp' + subtotal.toLocaleString('id-ID');
    document.getElementById("ppn").innerText = 'Rp' + ppn.toLocaleString('id-ID');
    document.getElementById("ongkir").innerText = 'Rp' + ongkir.toLocaleString('id-ID');
    document.getElementById("total-bayar").innerText = 'Rp' + totalBayar.toLocaleString('id-ID');
});

document.getElementById('sendDataButton').addEventListener('click', function() {
    let selectedItems = JSON.parse(localStorage.getItem("selectedCartItems")) || [];
    let subtotal = 0;
    let uniqueProductIds = new Set();

    let products = selectedItems.map(item => {
        subtotal += item.price * item.quantity;
        uniqueProductIds.add(item.id);
        return {
            cart_id: item.id,
            products_id: item.products_id,
            quantity: item.quantity,
            total_price: item.quantity * item.price,
        };
    });

    let ppn = subtotal * 0.12;
    let ongkir = 10000;
    let totalBayar = subtotal + ppn + ongkir;
    let code = 'TRX' + Math.floor(Math.random() * 100000);
    let totalProduct = uniqueProductIds.size;

    const data = {
        code: code,
        total_item: totalProduct,
        total: totalBayar,
        payment_method: document.getElementById("payment-method").value,
        status: 'pending',
        products: products,
    };

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('{{ route('transaction.store') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(responseData => {
        Swal.fire({
            icon: 'success',
            title: 'Transaksi Berhasil!',
            text: 'Pesanan Anda telah diproses.',
            confirmButtonText: 'OK'
        }).then(() => {
            localStorage.clear();
            window.location.href = "/order";
        });
    })
    .catch(error => {
        console.error('Terjadi kesalahan:', error);
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Terjadi kesalahan saat mengirim data transaksi!',
        });
    });
});

    </script>

</x-home-layout>
