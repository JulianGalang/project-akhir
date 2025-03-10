<x-layout>
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="flex flex-wrap items-center justify-between pb-4 gap-4">
                <!-- Filter Status -->
                <div>
                    <label for="status-filter" class="mr-2 font-medium text-gray-700 dark:text-gray-300">Filter Status:</label>
                    <select id="status-filter" class="p-2 border rounded-lg text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600">
                        <option value="all">Semua</option>
                        <option value="pending">Pending</option>
                        <option value="packing">Dikemas</option>
                        <option value="shipping">Diantar</option>
                        <option value="delivered">Sampai</option>
                        <option value="cancel">Batal</option>
                    </select>
                </div>

                <!-- Filter Waktu -->
                <div>
                    <label for="time-filter" class="mr-2 font-medium text-gray-700 dark:text-gray-300">Filter Waktu:</label>
                    <select id="time-filter" class="p-2 border rounded-lg text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600">
                        <option value="all">Semua</option>
                        <option value="today">Hari Ini</option>
                        <option value="this-week">Minggu Ini</option>
                        <option value="this-month">Bulan Ini</option>
                        <option value="this-year">Tahun Ini</option>
                    </select>
                </div>
            </div>

            <!-- Tabel -->
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 text-center dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3">ID Transaksi</th>
                        <th class="px-6 py-3">Pelanggan</th>
                        <th class="px-6 py-3">Total</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody id="transaction-table" class="text-center">
                    @foreach ($transactions as $data)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                        data-status="{{ strtolower($data->status) }}"
                        data-date="{{ $data->updated_at }}">
                        <td class="px-6 py-4">{{ $data->code }}</td>
                        <td class="px-6 py-4">{{ $data->user->name }}</td>
                        <td class="px-6 py-4">{{ $data->total }}</td>
                        <td>
                        @if ($data->status == 'pending')
                            <span class="font-semibold text-yellow-600">{{ $data->status }}</span>
                        @elseif ($data->status == 'packing')
                            <span class="font-semibold text-green-500">{{ $data->status }}</span>
                        @elseif ($data->status == 'shipping')
                            <span class="font-semibold text-blue-500">{{ $data->status }}</span>
                        @elseif ($data->status == 'delivered')
                            <span class="font-semibold text-green-600">{{ $data->status }}</span>
                        @elseif ($data->status == 'canceled')
                            <span class="font-semibold text-red-600">{{ $data->status }}</span>
                        @else
                            <span class="font-semibold text-gray-500">{{ $data->status }}</span>
                        @endif
                    </td>
                        <td class="px-6 py-4 font-medium">{{ $data->updated_at }}</td>
                        <td class="px-6 py-4 flex gap-2">
                            @if ($data->status == 'packing')
                                <button onclick="showShippingModal('{{ $data->id }}')" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Kirim</button>
                                <button onclick="showCancelModal('{{ $data->id }}')" class="px-4 py-2 bg-red-500 text-white rounded-lg">Batalkan</button>
                                @elseif (in_array($data->status, ['pending', 'packing', 'shipping']))
                                <button onclick="showCancelModal('{{ $data->id }}')" class="px-4 py-2 bg-red-500 text-white rounded-lg">Batalkan</button>
                            @elseif ($data->status == 'cancel')
                                <button onclick="showCancelReasonModal('{{ $data->description }}')" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Lihat Alasan</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const statusFilter = document.getElementById('status-filter');
            const timeFilter = document.getElementById('time-filter');
            const rows = document.querySelectorAll('#transaction-table tr');

            function filterTable() {
                let status = statusFilter.value.toLowerCase();
                let time = timeFilter.value;
                let now = new Date();

                rows.forEach(row => {
                    let rowStatus = row.dataset.status;
                    let rowDate = new Date(row.dataset.date);
                    let show = true;

                    // Filter berdasarkan status
                    if (status !== 'all' && rowStatus !== status) {
                        show = false;
                    }

                    // Filter berdasarkan waktu
                    if (time !== 'all') {
                        let startDate;
                        switch (time) {
                            case 'today':
                                startDate = new Date();
                                startDate.setHours(0, 0, 0, 0);
                                show = show && rowDate >= startDate;
                                break;
                            case 'this-week':
                                startDate = new Date();
                                startDate.setDate(now.getDate() - now.getDay());
                                startDate.setHours(0, 0, 0, 0);
                                show = show && rowDate >= startDate;
                                break;
                            case 'this-month':
                                startDate = new Date(now.getFullYear(), now.getMonth(), 1);
                                show = show && rowDate >= startDate;
                                break;
                            case 'this-year':
                                startDate = new Date(now.getFullYear(), 0, 1);
                                show = show && rowDate >= startDate;
                                break;
                        }
                    }

                    row.style.display = show ? '' : 'none';
                });
            }

            statusFilter.addEventListener('change', filterTable);
            timeFilter.addEventListener('change', filterTable);
        });

        function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
        let selectedTransactionId = null;

        function showShippingModal(transactionId) {
            selectedTransactionId = transactionId;
            Swal.fire({
                title: 'Masukkan Nomor Resi',
                input: 'text',
                inputPlaceholder: 'Nomor Resi',
                showCancelButton: true,
                confirmButtonText: 'Kirim',
                cancelButtonText: 'Batal',
                preConfirm: (resi) => {
                    if (!resi) {
                        Swal.showValidationMessage('Nomor resi harus diisi!');
                    }
                    return resi;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    submitShipping(result.value);
                }
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

        function showCancelReasonModal(description) {
            if (!description) {
                description = "Tidak ada alasan yang diberikan.";
            }
            Swal.fire({
                title: 'Alasan Pembatalan',
                text: description,
                icon: 'info'
            });
        }

        function submitShipping(resi) {
            fetch(`/transactions/${selectedTransactionId}/ship`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ resi })
            })
            .then(response => response.json())
            .then(data => {
                Swal.fire('Sukses!', 'Pesanan telah dikirim.', 'success').then(() => location.reload());
            })
            .catch(error => {
                Swal.fire('Error!', 'Gagal memperbarui status.', 'error');
                console.error('Error:', error);
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
</x-layout>
