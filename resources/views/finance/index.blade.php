<x-layout>
    <style>
        @media (max-width: 768px) {
            .grid-cols-3 {
                grid-template-columns: repeat(1, minmax(0, 1fr));
            }
            .col-span-1, .col-span-2, .col-span-3 {
                grid-column: span 1 / span 1;
            }
            .text-5xl {
                font-size: 2.25rem;
            }
        }
    </style>

    <div class="p-4 mt-14">
        <p class="text-5xl font-bold text-center">Finance</p>
    </div>

    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <!-- Form Input -->
            <div class="col-span-1">
                <form method="POST" action="{{ route('finance.store') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <!-- Type -->
                    <div>
                        <x-input-label for="type" :value="__('Tipe Keuangan')" />
                        <select id="type" name="type" class="w-full mt-2 p-2 border rounded-md focus:outline-indigo-600">
                            <option hidden>Pilih Type</option>
                            <option value="fund">Modal</option>
                            <option value="out">Pengeluaran</option>
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <!-- Nominal -->
                    <div x-data="">
                        <x-input-label for="amount" :value="__('Nominal')" />
                        <x-text-input x-mask:dynamic="$money($input, ' ', '.')" id="amount"  name="amount_display" class="w-full mt-2 p-2 border rounded-md" type="text" required />
                        <x-text-input  id="cleanedAmount" name="amount" class="hidden w-full mt-2 p-2 border rounded-md" type="text" required />
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div>
                        <x-input-label for="description" :value="__('Deskripsi')" />
                        <x-text-input id="description" name="description" class="w-full mt-2 p-2 border rounded-md" type="text" required />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="w-full py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Tambah barang
                        </button>
                    </div>
                </form>
            </div>

            <!-- Fund Table -->
            <div class="col-span-2">
                <div class="overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="text-center text-xl font-bold mb-2">Modal</div>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-2">Tipe</th>
                                <th scope="col" class="px-4 py-2">Nominal</th>
                                <th scope="col" class="px-4 py-2">Deskripsi</th>
                                <th scope="col" class="px-4 py-2">Tanggal</th>
                                <th scope="col" class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fund as $funds)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <td class="px-4 py-2">Modal</td>
                                <td class="px-4 py-2">{{ $funds->amount }}</td>
                                <td class="px-4 py-2">{{ $funds->description }}</td>
                                <td class="px-4 py-2">{{ $funds->created_at }}</td>
                                <td class="px-4 py-2">
                                    <form action="{{ route('finance.destroy', $funds->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="px-6 py-2">
                                    <div class="justify-start">{{ $fund->appends(['out_page' => $outPage])->links() }}</div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Pengeluaran Table -->
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-4">
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <div class="text-center text-xl font-bold mb-2">Pengeluaran</div>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-2">Tipe</th>
                        <th scope="col" class="px-4 py-2">Nominal</th>
                        <th scope="col" class="px-4 py-2">Deskripsi</th>
                        <th scope="col" class="px-4 py-2">Tanggal</th>
                        <th scope="col" class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($out as $spend)
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <td class="px-4 py-2">Pengeluaran</td>
                        <td class="px-4 py-2">{{ $spend->amount }}</td>
                        <td class="px-4 py-2">{{ $spend->description }}</td>
                        <td class="px-4 py-2">{{ $spend->created_at }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('finance.destroy', $spend->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="px-6 py-2">
                            <div class="justify-start">{{ $out->appends(['fund_page' => $fundPage])->links() }}</div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="min-h-fit rounded bg-gray-200 dark:bg-gray-800">
                <div class="w-full text-center">
                    <h2 class="text-xl bg-red-600 font-bold text-white">Pengeluaran</h2>
                    <div class="py-5 border-t border-gray-200">
                        <p class="text-gray-700 text-lg font-bold">Rp. {{ $pengeluaran->sum('amount') }}</p>
                    </div>
                </div>
            </div>

            <div class="min-h-fit rounded bg-gray-50 dark:bg-gray-800">
                <div class="w-full text-center">
                    <h2 class="text-xl bg-red-600 font-bold text-white">Modal</h2>
                    <div class="py-5 border-t border-gray-200">
                        <p class="text-gray-700 text-lg font-bold">Rp. {{ $modal->sum('amount') }}</p>
                    </div>
                </div>
            </div>

            <div class="min-h-fit rounded bg-gray-50 dark:bg-gray-800">
                <div class="w-full text-center">
                    <h2 class="text-xl bg-red-600 font-bold text-white">Pemasukan</h2>
                    <div class="py-5 border-t border-gray-200">
                        <p class="text-gray-700 text-lg font-bold">Rp. {{ $in->sum('total') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid mt-3">
            <div class="min-h-fit rounded bg-gray-50 dark:bg-gray-800">
                <div class="w-full text-center">
                    <h2 class="text-xl bg-red-600 font-bold text-white">Keuntungan</h2>
                    <div class="py-5 border-t border-gray-200">
                        <p class="text-gray-700 text-lg font-bold">Rp. {{ ( $in->sum('total') - $pengeluaran->sum('amount')  ) + $modal->sum('amount')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Menampilkan alert sukses setelah form dikirim
        document.addEventListener("DOMContentLoaded", function() {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session("success") }}',
                    confirmButtonColor: '#4F46E5'
                });
            @endif
        });

        // Konfirmasi sebelum menghapus data
        function confirmDelete(event, form) {
            event.preventDefault(); // Mencegah submit form langsung

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Kirim form jika dikonfirmasi
                }
            });
        }
    </script>

    <script>
        document.getElementById('amount').addEventListener('input', function () {
            const cleanValue = this.value.replace(/\./g, ''); // Hapus semua titik
            document.getElementById('cleanedAmount').value = cleanValue; // Simpan nilai bersih
        });

        // Menampilkan alert sukses jika ada session message
        @if(session('message'))
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: '{{ session("message") }}',
                confirmButtonColor: '#4F46E5'
            });
        @endif
    </script>
</x-layout>
