<x-home-layout>
    <div class="container px-4">
        <h2 class="text-3xl mt-5 font-semibold mb-6 text-center text-gray-800">Daftar Transaksi</h2>

        @foreach($transactions as $transaction)
            <div class="bg-white shadow-lg rounded-lg mb-6 p-6 border border-gray-200 hover:shadow-xl transition duration-300">
                <!-- Kode Transaksi -->
                <div class="flex justify-between items-center">
                    <span class="font-semibold text-xl text-gray-900">Kode: {{ $transaction->code }}</span>
                </div>

                <!-- Status dan Aksi -->
                <div class="flex justify-between items-center mt-4">
                    <span class="text-gray-600">Status:
                        @if ($transaction->status == 'pending')
                            <span class="font-semibold text-yellow-600">{{ $transaction->status }}</span>
                        @elseif ($transaction->status == 'packing')
                            <span class="font-semibold text-green-500">{{ $transaction->status }}</span>
                        @elseif ($transaction->status == 'shipping')
                            <span class="font-semibold text-blue-500">{{ $transaction->status }}</span>
                        @elseif ($transaction->status == 'delivered')
                            <span class="font-semibold text-green-600">{{ $transaction->status }}</span>
                        @elseif ($transaction->status == 'canceled')
                            <span class="font-semibold text-red-600">{{ $transaction->status }}</span>
                        @else
                            <span class="font-semibold text-gray-500">{{ $transaction->status }}</span>
                        @endif
                    </span>

                    <div class="flex gap-3">
                        @if($transaction->status == 'pending')
                            <button class="payButton bg-green-500 text-white px-6 py-3 rounded-md hover:bg-green-600 transition text-sm"
                                data-transaction-id="{{ $transaction->id }}">
                                Bayar
                            </button>

                            <button onclick="showCancelModal('{{ $transaction->id }}')" type="submit" class="bg-red-500 text-white px-6 py-3 rounded-md hover:bg-red-600 transition text-sm">
                                Batal
                            </button>

                            @elseif($transaction->status == 'shipping')
                            <button onclick="showResiModal('{{ $transaction->resi }}')"
                                class="bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 transition text-sm">
                                Info Resi
                            </button>

                            <button onclick="markAsDelivered({{ $transaction->id }})"
                                class="bg-green-500 text-white px-6 py-3 rounded-md hover:bg-green-600 transition text-sm">
                                Selesaikan Pesanan
                            </button>

                            @elseif ($transaction->status == 'cancel')
                            <button onclick="showCancelReasonModal('{{ $transaction->description }}')"
                                class="bg-red-500 text-white px-6 py-3 rounded-md hover:bg-red-600 transition text-sm">
                                Lihat Alasan Pembatalan
                            </button>
                        @endif
                    </div>
                </div>

                @if ($transaction->status == 'packing')
                    <div class="mt-4 bg-green-100 p-4 rounded-lg border-l-4 border-green-500">
                        <p class="text-green-500 font-medium">Pesanan sedang dipacking pada tanggal {{ \Carbon\Carbon::parse($transaction->updated_at)->format('d M Y H:i') }}</p>
                    </div>
                @elseif($transaction->status == 'shipping')
                    <div class="mt-4 bg-blue-100 p-4 rounded-lg border-l-4 border-blue-500">
                        <p class="text-blue-500 font-medium">Pesanan telah dikirim pada tanggal {{ \Carbon\Carbon::parse($transaction->updated_at)->format('d M Y H:i') }}</p>
                    </div>
                @elseif($transaction->status == 'delivered')
                    <div class="mt-4 bg-green-100 p-4 rounded-lg border-l-4 border-green-600">
                        <p class="text-green-700 font-medium">Pesanan telah sampai pada tanggal {{ \Carbon\Carbon::parse($transaction->updated_at)->format('d M Y H:i') }}</p>
                    </div>
                @elseif($transaction->status == 'cancel')
                    <div class="mt-4 bg-red-100 p-4 rounded-lg border-l-4 border-red-600">
                        <p class="text-red-600 font-medium">Pesanan telah dibatalkan pada tanggal {{ \Carbon\Carbon::parse($transaction->updated_at)->format('d M Y H:i') }}</p>
                    </div>

                @endif
                <!-- Detail Produk -->
                <div id="details-{{ $transaction->id }}" class="mt-6 overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 min-w-[600px]">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th class="px-6 py-3">Gambar</th>
                                <th class="px-6 py-3">Nama Produk</th>
                                <th class="px-6 py-3">Size</th>
                                <th class="px-6 py-3">Harga</th>
                                <th class="px-6 py-3">Jumlah</th>
                                <th class="px-6 py-3">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaction->details as $detail)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-3">
                                    @if(optional($detail->products)->picture)
                                        <img src="{{ asset('storage/products/' . optional($detail->products)->picture) }}"
                                             alt="{{ optional($detail->products)->name }}"
                                             class="max-w-[100px] h-auto mx-auto rounded-lg">
                                    @else
                                        <span class="text-red-500">Tidak tersedia</span>
                                    @endif
                                </td>
                                <td class="px-6 py-3 text-gray-800">{{ optional($detail->products)->name ?? 'Produk dihapus' }}</td>
                                <td class="px-6 py-3 text-gray-600">{{ optional($detail->products)->size ?? '-' }}</td>
                                <td class="px-6 py-3 text-gray-800">
                                    Rp{{ number_format(optional($detail->products)->price ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-3 text-gray-600">{{ $detail->quantity }}</td>
                                <td class="px-6 py-3 text-gray-800">
                                    Rp{{ number_format((optional($detail->products)->price ?? 0) * $detail->quantity, 0, ',', '.') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>


    <!-- Modal Info Resi -->
<div id="resiModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center">
    <div class="bg-white rounded-lg shadow-lg w-96 p-6">
        <h2 class="text-lg font-semibold mb-4">Informasi Resi</h2>
        <p class="text-gray-700">Nomor Resi: <span id="resiNumber" class="font-semibold"></span></p>
        <div class="mt-4 flex justify-end">
            <button onclick="closeResiModal()" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">
                Tutup
            </button>
        </div>
    </div>
</div>

<div id="cancelReasonModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center">
    <div class="bg-white rounded-lg shadow-lg w-96 p-6">
        <h2 class="text-lg font-semibold mb-4">Alasan Pembatalan</h2>
        <p id="cancelReasonText" class="text-gray-700"></p>
        <div class="mt-4 flex justify-end">
            <button onclick="closeCancelReasonModal()" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">
                Tutup
            </button>
        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        function showResiModal(resi) {
            document.getElementById('resiNumber').innerText = resi;
            document.getElementById('resiModal').classList.remove('hidden');
        }

        function closeResiModal() {
            document.getElementById('resiModal').classList.add('hidden');
        }
        function showCancelReasonModal(reason) {
            let alasan = reason;
            if (!reason) {
                alasan = "Tidak ada alasan yang diberikan.";
            }
            document.getElementById('cancelReasonText').innerText = alasan;
            document.getElementById('cancelReasonModal').classList.remove('hidden');
        }

        function closeCancelReasonModal() {
            document.getElementById('cancelReasonModal').classList.add('hidden');
        }


        document.querySelectorAll('.payButton').forEach(button => {
    button.addEventListener('click', function() {
        let transactionId = this.getAttribute('data-transaction-id');

        fetch(`/pay/${transactionId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.snap_token) {
                processPayment(transactionId, data.snap_token);
            } else {
                alert("Gagal mendapatkan token pembayaran!");
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            alert("Terjadi kesalahan saat memproses pembayaran!");
        });
    });
});

function processPayment(transactionId, snapToken) {
    snap.pay(snapToken, {
        onSuccess: function(result) {
            updateTransactionStatus(transactionId, 'packing');
            alert("Pembayaran sukses!");
        },
        onPending: function(result) {
            alert("Pembayaran tertunda! Silakan selesaikan pembayaran.");
        },
        onError: function(result) {
            alert("Pembayaran gagal! Silakan coba lagi.");
            showRetryButton(transactionId, snapToken);
        }
    });
}

function showRetryButton(transactionId, snapToken) {
    let buttonContainer = document.getElementById(`retry-container-${transactionId}`);
    if (!buttonContainer) {
        buttonContainer = document.createElement("div");
        buttonContainer.id = `retry-container-${transactionId}`;
        document.body.appendChild(buttonContainer);
    }

    buttonContainer.innerHTML = `
        <button onclick="processPayment('${transactionId}', '${snapToken}')" class="retryButton">
            Coba Bayar Lagi
        </button>
    `;
}


        function updateTransactionStatus(transactionId, status) {
            // alert("KONTOL");
            fetch(`/order/${transactionId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ _method: 'PUT', status: status })
            })
            .then(response => response.json())
            .then(data => {
                // alert("askum")
                    location.reload();
            })
            .catch(error => {
                // alert("error")
                console.error('Error updating status:', error);
            });
        }



    function markAsDelivered(transactionId) {
            fetch(`/order/${transactionId}/complete`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload();
                });
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat memperbarui status!'
                });
            });
        }
        function showCancelModal(transactionId) {
            selectedTransactionId = transactionId;
            Swal.fire({
                title: 'Alasan Pembatalan',
                input: 'textarea',
                inputPlaceholder: 'Tuliskan alasan pembatalan...',
                showCancelButton: true,
                confirmButtonText: 'Batalkan',
                cancelButtonText: 'Batal',
                preConfirm: (reason) => {
                    if (!reason) {
                        Swal.showValidationMessage('Alasan pembatalan harus diisi!');
                    }
                    return reason;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    submitCancellation(result.value);
                }
            });
        }

        function submitCancellation(reason) {
            if (!selectedTransactionId) {
                Swal.fire('Error!', 'ID transaksi tidak ditemukan.', 'error');
                return;
            }

            fetch(`/transactions/${selectedTransactionId}/cancel`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ reason: reason.trim() }) // Hindari string kosong
            })
            .then(response => response.json().then(data => ({ status: response.status, body: data })))
            .then(({ status, body }) => {
                if (status === 400) {
                    Swal.fire('Gagal!', body.error, 'error');
                } else if (status === 404) {
                    Swal.fire('Error!', 'Transaksi tidak ditemukan.', 'error');
                } else if (status === 200) {
                    Swal.fire('Sukses!', 'Pesanan telah dibatalkan.', 'success').then(() => location.reload());
                } else {
                    throw new Error('Respon tidak dikenal');
                }
            })
            .catch(error => {
                Swal.fire('Error!', 'Terjadi kesalahan saat membatalkan pesanan.', 'error');
                console.error('Error:', error);
            });
        }
    </script>
</x-home-layout>
