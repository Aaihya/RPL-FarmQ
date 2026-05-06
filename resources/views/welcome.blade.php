<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penjual | FarmQ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">

    <!-- Sidebar & Mobile Nav -->
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Sidebar -->
        <aside class="w-full md:w-64 bg-white shadow-xl z-10">
            <div class="p-6 bg-green-600 text-center">
                <h1 class="text-2xl font-bold italic text-white tracking-widest">FarmQ</h1>
                <p class="text-green-100 text-[10px] uppercase mt-1">Vendor Panel</p>
            </div>
            <nav class="mt-6 px-4 space-y-2">
                <a href="#" class="flex items-center space-x-3 p-3 bg-green-50 text-green-600 rounded-xl font-bold">
                    <i class="fa fa-home"></i> <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-50 hover:text-green-600 rounded-xl transition font-medium">
                    <i class="fa fa-cow"></i> <span>Kelola Hewan</span>
                </a>
                <a href="#" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-50 hover:text-green-600 rounded-xl transition font-medium">
                    <i class="fa fa-receipt"></i> <span>Pesanan Masuk</span>
                </a>
                <hr class="my-4 border-gray-100">
                <!-- Form Logout -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 p-3 text-red-500 hover:bg-red-50 rounded-xl transition font-medium">
                        <i class="fa fa-sign-out-alt"></i> <span>Keluar</span>
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 md:p-10">
            <!-- Top Bar -->
            <header class="flex justify-between items-center mb-10">
                <div>
                     <h2 class="text-2xl font-bold text-gray-800">Selamat Datang, GUSTI BAU BAWANG!</h2>
                    <p class="text-gray-500 text-sm italic">Pantau perkembangan penjualan hewan qurban Anda hari ini.</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-gray-700">GUSTI BAU BAWANG</p>
                        <p class="text-[10px] text-green-600 font-bold uppercase tracking-tighter">Verified Seller</p>
                    </div>
                    <div class="h-12 w-12 bg-green-600 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg border-2 border-white">
                        GB
                    </div>
                </div>
            </header>

<!-- Fitur Filter & Pencarian -->
<section class="mb-8">
    <form action="#" method="GET" class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <!-- Search Bar -->
            <div class="flex-1 relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                    <i class="fa fa-search"></i>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" 
                    class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-xl focus:ring-green-500 focus:border-green-500 text-sm" 
                    placeholder="Cari nama hewan atau kategori...">
            </div>

            <!-- Filter Kategori -->
            <div class="w-full md:w-48">
                <select name="kategori" class="block w-full py-2 px-3 border border-gray-200 bg-white rounded-xl focus:ring-green-500 focus:border-green-500 text-sm">
                    <option value="">Semua Jenis</option>
                    <option value="sapi" {{ request('kategori') == 'sapi' ? 'selected' : '' }}>Sapi</option>
                    <option value="kambing" {{ request('kategori') == 'kambing' ? 'selected' : '' }}>Kambing</option>
                    <option value="domba" {{ request('kategori') == 'domba' ? 'selected' : '' }}>Domba</option>
                </select>
            </div>

            <!-- Filter Status -->
            <div class="w-full md:w-48">
                <select name="status" class="block w-full py-2 px-3 border border-gray-200 bg-white rounded-xl focus:ring-green-500 focus:border-green-500 text-sm">
                    <option value="">Semua Status</option>
                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="terjual" {{ request('status') == 'terjual' ? 'selected' : '' }}>Terjual</option>
                </select>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex gap-2">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-xl text-sm font-bold hover:bg-green-700 transition">
                    Filter
                </button>
                @if(request()->anyFilled(['search', 'kategori', 'status']))
                    <a href="{{ url()->current() }}" class="bg-gray-100 text-gray-600 px-4 py-2 rounded-xl text-sm font-bold hover:bg-gray-200 transition">
                        <i class="fa fa-sync-alt"></i>
                    </a>
                @endif
            </div>
        </div>
    </form>
</section>

            <!-- Statistik Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4 hover:shadow-md transition">
                    <div class="h-12 w-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fa fa-boxes"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase">Total Produk</p>
                        <h4 class="text-2xl font-extrabold text-gray-800">12</h4>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4 hover:shadow-md transition">
                    <div class="h-12 w-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fa fa-check-circle"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase">Terjual</p>
                        <h4 class="text-2xl font-extrabold text-gray-800">5</h4>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4 hover:shadow-md transition">
                    <div class="h-12 w-12 bg-orange-50 text-orange-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fa fa-wallet"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase">Pendapatan</p>
                        <h4 class="text-2xl font-extrabold text-gray-800">Rp 120jt+</h4>
                    </div>
                </div>
            </div>

            <!-- Bagian Katalog Hewan Saya -->
            <section>
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-800"><i class="fa fa-list text-green-600 mr-2"></i>Katalog Hewan Qurban Anda</h3>
                    <button class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-green-700 transition shadow-lg shadow-green-100">
                        + Tambah Hewan
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    <!-- Item 1 -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 group">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1546445317-29f4545e9d53?auto=format&fit=crop&w=800&q=80" class="w-full h-40 object-cover">
                            <div class="absolute top-2 right-2 bg-green-600 text-white text-[10px] font-bold px-2 py-1 rounded-md">AKTIF</div>
                        </div>
                        <div class="p-5">
                            <h5 class="font-bold text-gray-800 mb-1">Sapi Limosin Super</h5>
                            <p class="text-xs text-gray-500 mb-3">Berat: 500kg | Stok: 2</p>
                            <div class="flex justify-between items-center pt-3 border-t border-gray-50">
                                <span class="text-green-600 font-bold">Rp 25.000.000</span>
                                <div class="flex space-x-2">
                                    <button class="text-gray-400 hover:text-blue-500 transition"><i class="fa fa-edit"></i></button>
                                    <button class="text-gray-400 hover:text-red-500 transition"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Duplicate for visual filler -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 group opacity-75">
                         <!-- Konten yang sama bisa ditaruh di sini -->
                         <div class="p-10 text-center text-gray-400 italic text-sm">Contoh item lainnya...</div>
                    </div>
                </div>
            </section>
        </main>
    </div>

</body>
</html>