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

    <div class="min-h-screen flex flex-col md:flex-row">
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
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 p-3 text-red-500 hover:bg-red-50 rounded-xl transition font-medium">
                        <i class="fa fa-sign-out-alt"></i> <span>Keluar</span>
                    </button>
                </form>
            </nav>
        </aside>

        <main class="flex-1 p-6 md:p-10">
            <header class="flex justify-between items-center mb-10 relative">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        Selamat Datang, {{ auth()->user()->shop_name ?? auth()->user()->name ?? 'Vendor FarmQ' }}!
                    </h2>
                    <p class="text-gray-500 text-sm italic">Pantau perkembangan penjualan hewan qurban Anda hari ini.</p>
                </div>
                
                <div class="relative">
                    <button id="profile-menu-btn" class="flex items-center space-x-4 bg-white hover:bg-gray-50 p-2 rounded-2xl border border-gray-100 transition-all duration-200 focus:outline-none cursor-pointer">
                        <div class="text-right hidden sm:block pl-2">
                            <p class="text-sm font-bold text-gray-700">
                                {{ auth()->user()->name ?? 'Nama Akun' }}
                            </p>
                            <p class="text-[10px] text-green-600 font-bold uppercase tracking-tighter flex items-center justify-end gap-1">
                                {{ auth()->user()->role ?? 'Verified Seller' }} <i class="fa fa-chevron-down text-[8px]"></i>
                            </p>
                        </div>
                        
                        <div class="h-12 w-12 bg-green-600 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg border-2 border-white overflow-hidden shrink-0">
                            @if(auth()->user() && auth()->user()->avatar)
                                <img src="{{ \Illuminate\Support\Facades\Storage::url(auth()->user()->avatar) }}" class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr(auth()->user()->name ?? 'V', 0, 2)) }}
                            @endif
                        </div>
                    </button>

                    <div id="profile-dropdown" class="hidden absolute right-0 mt-3 w-56 bg-white rounded-2xl border border-gray-100 shadow-xl shadow-gray-200/80 py-2 z-50 transform origin-top-right transition-all duration-200">
                        <div class="px-4 py-2.5 border-b border-gray-50">
                            <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Aktivitas Toko</p>
                            <p class="text-xs font-semibold text-gray-700 mt-0.5 truncate">{{ auth()->user()->shop_name ?? 'Peternakan Belum Dinamai' }}</p>
                        </div>
                        
                        <a href="{{ route('penjual.profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-600 hover:bg-green-50 hover:text-green-600 font-medium transition-colors">
                            <i class="fa fa-user-cog text-gray-400 group-hover:text-green-600 text-xs"></i> Pengaturan Profil
                        </a>
                        
                        <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-600 hover:bg-green-50 hover:text-green-600 font-medium transition-colors">
                            <i class="fa fa-info-circle text-gray-400 text-xs"></i> Bantuan Sistem
                        </a>
                        
                        <hr class="border-gray-50 my-1">
                        
                        <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-500 hover:bg-red-50 font-medium transition-colors text-left cursor-pointer">
                                <i class="fa fa-sign-out-alt text-xs"></i> Keluar Akun
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <section class="mb-8">
                <form action="#" method="GET" class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex flex-col md:flex-row md:items-center gap-4">
                        <div class="flex-1 relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fa fa-search"></i>
                            </span>
                            <input type="text" name="search" value="{{ request('search') }}" 
                                class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-xl focus:ring-green-500 focus:border-green-500 text-sm" 
                                placeholder="Cari nama hewan atau kategori...">
                        </div>

                        <div class="w-full md:w-48">
                            <select name="kategori" class="block w-full py-2 px-3 border border-gray-200 bg-white rounded-xl focus:ring-green-500 focus:border-green-500 text-sm">
                                <option value="">Semua Jenis</option>
                                <option value="sapi" {{ request('kategori') == 'sapi' ? 'selected' : '' }}>Sapi</option>
                                <option value="kambing" {{ request('kategori') == 'kambing' ? 'selected' : '' }}>Kambing</option>
                                <option value="domba" {{ request('kategori') == 'domba' ? 'selected' : '' }}>Domba</option>
                            </select>
                        </div>

                        <div class="w-full md:w-48">
                            <select name="status" class="block w-full py-2 px-3 border border-gray-200 bg-white rounded-xl focus:ring-green-500 focus:border-green-500 text-sm">
                                <option value="">Semua Status</option>
                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="terjual" {{ request('status') == 'terjual' ? 'selected' : '' }}>Terjual</option>
                            </select>
                        </div>

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

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4 hover:shadow-md transition">
                    <div class="h-12 w-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fa fa-boxes"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase">Total Produk</p>
                        <h4 class="text-2xl font-extrabold text-gray-800">{{ $totalProduk }}</h4>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4 hover:shadow-md transition">
                    <div class="h-12 w-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fa fa-check-circle"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase">Terjual</p>
                        <h4 class="text-2xl font-extrabold text-gray-800">{{ $terjual }}</h4>
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

            <section>
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-800"><i class="fa fa-list text-green-600 mr-2"></i>Katalog Hewan Qurban Anda</h3>
                    <a href="{{ route('products.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg text-sm inline-flex items-center gap-1 shadow-md shadow-green-100 transition">
                        <span>+</span> Tambah Hewan
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @forelse($products as $product)
                        <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 group">
                            <div class="relative">
                                @if($product->image)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}" class="w-full h-40 object-cover" alt="Foto {{ $product->name }}">
                                @else
                                    <img src="https://images.unsplash.com/photo-1546445317-29f4545e9d53?auto=format&fit=crop&w=800&q=80" class="w-full h-40 object-cover" alt="Default Image">
                                @endif
                                <div class="absolute top-2 right-2 {{ $product->is_sold ? 'bg-red-500' : 'bg-green-600' }} text-white text-[10px] font-bold px-2 py-1 rounded-md">
                                    {{ $product->is_sold ? 'TERJUAL' : 'AKTIF' }}
                                </div>
                            </div>
                            <div class="p-5">
                                <h5 class="font-bold text-gray-800 mb-1 capitalize">{{ $product->name }}</h5>
                                <p class="text-xs text-gray-500 mb-2">Jenis: {{ $product->type }} | Berat: {{ $product->weight }}kg</p>
                                
                                <div class="space-y-1 mb-3 bg-gray-50 p-2.5 rounded-xl border border-gray-100/70">
                                    <p class="text-xs text-gray-600 flex items-center">
                                        <i class="fa fa-calendar-alt text-gray-400 mr-2 w-3.5"></i>Umur: 
                                        <span class="font-semibold text-gray-700 ml-1">{{ $product->age }} Bulan</span>
                                    </p>
                                    <p class="text-xs text-gray-600 flex items-center">
                                        <i class="fa fa-heartbeat text-green-500 mr-2 w-3.5"></i>Kondisi: 
                                        <span class="ml-1 px-2 py-0.5 text-[10px] bg-green-100 text-green-800 font-bold rounded-md">
                                            {{ $product->health_status ?? 'Sehat' }}
                                        </span>
                                    </p>
                                </div>

                                <p class="text-xs text-gray-400 mb-3"><i class="fa fa-map-marker-alt text-red-400 mr-1"></i>{{ $product->location }}</p>
                                
                                <div class="flex justify-between items-center pt-3 border-t border-gray-50">
                                    <span class="text-green-600 font-bold text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('products.edit', $product->id) }}" class="text-gray-400 hover:text-blue-500 transition-colors duration-200" title="Edit Hewan">
                                            <i class="fa fa-edit text-lg"></i>
                                        </a>

                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $product->name }} dari katalog?')" class="inline m-0 p-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors duration-200 flex items-center" title="Hapus Hewan">
                                                <i class="fa fa-trash text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full bg-white rounded-2xl p-10 text-center border border-dashed border-gray-200">
                            <div class="text-gray-400 mb-2"><i class="fa fa-cow text-4xl"></i></div>
                            <p class="text-gray-500 text-sm">Belum ada hewan qurban yang didaftarkan.</p>
                        </div>
                    @endforelse
                </div>
            </section>
        </main>
    </div>

    <script>
        const profileMenuBtn = document.getElementById('profile-menu-btn');
        const profileDropdown = document.getElementById('profile-dropdown');

        // Toggle buka/tutup dropdown saat tombol profile di-klik
        profileMenuBtn.addEventListener('click', function(e) {
            e.stopPropagation(); // Mencegah bentrok click global
            profileDropdown.classList.toggle('hidden');
        });

        // Tutup dropdown otomatis jika user mengklik area lain di luar kotak menu
        document.addEventListener('click', function(e) {
            if (!profileMenuBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
                profileDropdown.classList.add('hidden');
            }
        });
    </script>

</body>
</html>