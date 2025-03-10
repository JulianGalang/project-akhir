<x-layout>
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div class="min-h-fit rounded bg-gray-50 dark:bg-gray-800">
                <div class="w-full text-center">
                    <h2 class="text-xl  bg-red-600 font-bold text-white">Pendapatan</h2>
                    <div class="py-5 border-t border-gray-200">
                      <p class="text-gray-700 text-lg font-bold">Rp. {{ $transactions->sum('total') }}</p>
                    </div>
                </div>
              </div>

              <div class="min-h-fit rounded bg-gray-50 dark:bg-gray-800">
                <div class="w-full text-center">
                    <h2 class="text-xl  bg-red-600 font-bold text-white">Penjualan</h2>
                    <div class="py-5 border-t border-gray-200">
                      <p class="text-gray-700 text-lg font-bold">{{ $totalItemsSold }}</p>
                    </div>
                </div>
              </div>
        </div>

        <!-- Grafik Pendapatan -->
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Grafik Pendapatan Bulan Ini</h2>
            <canvas id="revenueChart"></canvas>
        </div>

        <!-- Grafik Penjualan -->
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md mt-4">
            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Grafik Penjualan Bulan Ini</h2>
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    <!-- Script Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Data dari Laravel (pastikan data dikirim dari controller)
            let revenueData = @json($monthlyRevenue);
            let salesData = @json($monthlySales);

            // Label (misalnya tanggal dalam bulan ini)
            let labels = Object.keys(revenueData);

            // Konversi data menjadi array nilai
            let revenueValues = Object.values(revenueData);
            let salesValues = Object.values(salesData);

            // Render Grafik Pendapatan
            let ctxRevenue = document.getElementById('revenueChart').getContext('2d');
            new Chart(ctxRevenue, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Pendapatan (Rp)',
                            data: revenueValues,
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Render Grafik Penjualan
            let ctxSales = document.getElementById('salesChart').getContext('2d');
            new Chart(ctxSales, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Total Item Terjual',
                            data: salesValues,
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</x-layout>
