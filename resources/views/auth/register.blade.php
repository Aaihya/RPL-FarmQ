<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | FarmQ - Marketplace Qurban</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen py-10">

    <div class="max-w-lg w-full bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100 mx-4">
        <div class="bg-green-600 p-6 text-center text-white">
            <h1 class="text-2xl font-bold italic">Bergabung di FarmQ</h1>
            <p class="text-green-100 text-sm mt-1">Lengkapi data untuk mulai berkontribusi</p>
        </div>

        <div class="p-8">
            <!-- Menampilkan Error Validasi jika ada -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('/register') }}" method="POST" class="space-y-4">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 text-center bg-gray-50 py-1 rounded">Mendaftar Sebagai:</label>
                    <select name="role" id="role" onchange="toggleUsaha()" 
                        class="w-full mt-2 px-4 py-2 border-2 border-green-500 rounded-lg bg-white font-bold text-green-700 focus:outline-none">
                        <!-- PERBAIKAN: Value harus bersih agar sesuai dengan database -->
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>🐑 Pembeli (Mencari Hewan Qurban)</option>
                        <option value="penjual" {{ old('role') == 'penjual' ? 'selected' : '' }}>👨‍🌾 Penjual (Pemilik Peternakan)</option>
                    </select>
                </div>

                <!-- Bagian Syarat Penjual (Akan muncul jika pilih penjual) -->
                <div id="section_usaha" class="{{ old('role') == 'penjual' ? '' : 'hidden' }} transition-all duration-500">
                    <label class="block text-sm font-semibold text-gray-700">Detail Usaha / Alamat Kandang</label>
                    <textarea name="deskripsi_usaha" rows="3" 
                        class="w-full mt-1 px-4 py-2 border border-orange-300 bg-orange-50 rounded-lg focus:ring-2 focus:ring-orange-500 outline-none placeholder-orange-400"
                        placeholder="Contoh: Peternakan Sapi Berkah, Jalan Raya No. 12...">{{ old('deskripsi_usaha') }}</textarea>
                    <p class="text-[10px] text-orange-600 mt-1">*Penjual wajib diverifikasi Admin sebelum bisa berjualan.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Password</label>
                        <input type="password" name="password" required class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
                    </div>
                </div>

                <button type="submit" 
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg mt-4 transition-all shadow-lg">
                    Buat Akun Sekarang
                </button>
            </form>

            <div class="mt-6 text-center text-sm text-gray-600">
                Sudah punya akun? 
                <a href="{{ url('/login') }}" class="text-green-600 font-bold hover:underline">Masuk</a>
            </div>
        </div>
    </div>

    <script>
        function toggleUsaha() {
            var role = document.getElementById("role").value;
            var section = document.getElementById("section_usaha");
            // Menggunakan value "penjual" yang sudah diperbaiki
            if (role === "penjual") {
                section.classList.remove("hidden");
            } else {
                section.classList.add("hidden");
            }
        }
        
        // Jalankan saat halaman load untuk jaga-jaga jika ada error validasi (old value)
        window.onload = toggleUsaha;
    </script>
</body>
</html>