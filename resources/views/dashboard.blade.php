<x-app-layout>

    <div class="bg-white shadow-md py-4">
        <div class="max-w-7xl mx-auto flex justify-between px-4 sm:px-6 lg:px-8 space-x-4">
            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21v-11M9 21H3m6 0h6m-6-11h6" />
                </svg>
                Dashboard
            </a>
            @role('customer')
            <a href="{{ route('dashboard.bookings') }}" class="flex items-center px-4 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21v-11M9 21H3m6 0h6m-6-11h6" />
                </svg>
                My Bookings
            </a>
            @endrole
            @role('super_admin')
            <a href="{{ route('admin.categories.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21v-11M9 21H3m6 0h6m-6-11h6" />
                </svg>
                Categories
            </a>
            <a href="{{ route('admin.package_banks.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21v-11M9 21H3m6 0h6m-6-11h6" />
                </svg>
                Banks
            </a>
            <a href="{{ route('admin.package_bookings.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21v-11M9 21H3m6 0h6m-6-11h6" />
                </svg>
                Package Bookings
            </a>
            @endrole
        </div>
    </div>

    <main class="py-10 bg-gradient-to-r from-blue-50 to-white min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <section class="bg-white shadow-md rounded-lg p-6 text-gray-700 flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-semibold">Welcome Back, Traveler!</h3>
                    <p class="text-sm mt-1">You're logged in and ready to explore new adventures.</p>
                </div>
                <a href="{{ route('front.index') }}" class="px-6 py-2 bg-teal-500 text-white rounded-lg shadow-lg hover:bg-teal-600 transition">
                    Explore Dashboard
                </a>
            </section>

            <section>
                <h3 class="text-lg font-semibold">Booking Progress</h3>
                <div class="mt-4">
                    <div class="w-full bg-gray-200 rounded-full h-4">
                        <div class="bg-teal-500 h-4 rounded-full" style="width: 70%"></div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">You have completed 70% of your bookings.</p>
                </div>
            </section>

            @role('super_admin')
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white shadow-md rounded-lg p-6 flex items-center justify-between">
                    <div>
                        <h4 class="text-lg font-semibold">Total Packages</h4>
                        <p class="text-2xl font-bold">{{ $totalPackages }}</p>
                    </div>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6 flex items-center justify-between">
                    <div>
                        <h4 class="text-lg font-semibold">Total Bookings</h4>
                        <p class="text-2xl font-bold">{{ $totalBookings }}</p>
                    </div>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6 flex items-center justify-between">
                    <div>
                        <h4 class="text-lg font-semibold">Total Users</h4>
                        <p class="text-2xl font-bold">{{ $totalUsers }}</p>
                    </div>
                </div>
            </section>

            <section class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-xl font-semibold">User Statistics</h3>
                <canvas id="userChart" class="mt-6"></canvas>
            </section>

            <section class="flex justify-between items-center bg-gray-50 p-6 rounded-lg shadow-md">
                <div>
                    <h3 class="text-xl font-semibold">Plan your next trip</h3>
                    <p class="text-sm text-gray-500">Manage your packages or explore new destinations for your customers.</p>
                </div>
                <a href="{{ route('admin.package_tours.index') }}" class="px-6 py-2 bg-green-500 text-white rounded-lg shadow-lg hover:bg-green-600 transition">
                    Add New Package
                </a>
            </section>
            @endrole
        </div>
    </main>

     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data statistik user yang dikirim dari controller
        var userStatistics = @json(array_values($userStatistics));

        var ctx = document.getElementById('userChart').getContext('2d');
        var userChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'User Registrations',
                    data: userStatistics,
                    borderColor: '#38b2ac',
                    backgroundColor: 'rgba(56, 178, 172, 0.2)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Fungsi untuk memperbarui data chart saat tahun berubah
        document.getElementById('yearSelect').addEventListener('change', function() {
            var selectedYear = this.value;
            // Lakukan permintaan Ajax atau fetch untuk mengambil data berdasarkan tahun yang dipilih
            // Gantilah isi berikut dengan logika fetch/axios untuk mendapatkan data user statistics yang baru
            fetch(`/dashboard/user-stats?year=${selectedYear}`)
                .then(response => response.json())
                .then(data => {
                    userChart.data.datasets[0].data = data; // Update data grafik dengan data baru
                    userChart.update();
                });
        });
    </script>
</x-app-layout>
