<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Vendor | FarmQ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .form-input-focus:focus {
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.15);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased min-h-screen pb-12 selection:bg-green-500 selection:text-white">

    <div class="bg-green-600 py-5 px-6 mb-8 shadow-lg shadow-green-600/10">
        <div class="max-w-3xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-2xl bg-white/20 p-2 rounded-xl text-white flex items-center justify-center">🚜</span>
                <div>
                    <h1 class="text-xl font-extrabold text-white tracking-widest">FarmQ</h1>
                    <p class="text-[10px] text-green-100 font-bold uppercase tracking-wider mt-0.5">Vendor Panel</p>
                </div>
            </div>
            <a href="{{ route('penjual.dashboard') }}" class="text-xs font-bold text-white/90 hover:text-white transition-all duration-200 flex items-center gap-2 bg-white/10 hover:bg-white/20 px-4 py-2.5 rounded-xl border border-white/10 shadow-sm">
                <i class="fa fa-arrow-left text-[10px]"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>

    <div class="max-w-2xl mx-auto bg-white p-6 md:p-10 rounded-3xl border border-gray-100 shadow-2xl shadow-gray-200/80">
        
        <div class="border-b border-gray-100 pb-5 mb-8 text-center sm:text-left">
            <span class="text-xs font-bold text-green-600 uppercase tracking-widest bg-green-50 px-3 py-1 rounded-full">Pengaturan Profil</span>
            <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight mt-3">Kelola Identitas Vendor</h2>
            <p class="text-xs text-gray-400 mt-1">Lengkapi data profil usaha Anda agar pembeli lebih percaya dan mudah menghubungi Anda.</p>
        </div>

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-2xl text-xs font-bold mb-6 flex items-center gap-3 shadow-inner">
                <i class="fa fa-check-circle text-lg"></i> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('penjual.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="flex flex-col items-center justify-center gap-4 bg-gray-50 p-6 rounded-3xl border border-dashed border-gray-200 mb-8">
                <div class="relative group">
                    @if($user->avatar)
                        <img id="avatar-preview" src="{{ Storage::url($user->avatar) }}" class="w-28 h-28 rounded-full object-cover border-4 border-white shadow-xl">
                    @else
                        <div id="avatar-placeholder" class="w-28 h-28 bg-green-600 text-white rounded-full flex items-center justify-center font-bold text-3xl shadow-xl border-4 border-white">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        <img id="avatar-preview" src="#" class="hidden w-28 h-28 rounded-full object-cover border-4 border-white shadow-xl">
                    @endif
                    
                    <label for="avatar-input" class="absolute bottom-0 right-0 bg-white p-2 rounded-full shadow-lg border border-gray-100 cursor-pointer hover:scale-110 transition active:scale-95 text-green-600">
                        <i class="fa fa-camera text-sm"></i>
                        <input type="file" name="avatar" id="avatar-input" class="hidden" accept="image/*">
                    </label>
                </div>
                <div class="text-center">
                    <p class="text-xs font-bold text-gray-700">Foto Profil Toko</p>
                    <p class="text-[10px] text-gray-400 mt-0.5">Klik ikon kamera untuk mengganti (Max 2MB)</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="group">
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-2 tracking-wider group-focus-within:text-green-600 transition-colors">Nama Lengkap Pemilik</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400 group-focus-within:text-green-600">
                            <i class="fa fa-user-circle text-sm"></i>
                        </span>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:border-green-600 text-sm outline-none transition form-input-focus text-gray-700 font-medium" required>
                    </div>
                </div>

                <div class="group">
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-2 tracking-wider group-focus-within:text-green-600 transition-colors">Nama Peternakan / Toko</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400 group-focus-within:text-green-600">
                            <i class="fa fa-store text-sm"></i>
                        </span>
                        <input type="text" name="shop_name" value="{{ old('shop_name', $user->shop_name) }}" class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:border-green-600 text-sm outline-none transition form-input-focus text-gray-700 font-medium" placeholder="Contoh: Berkah Farm" required>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="group">
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-2 tracking-wider group-focus-within:text-green-600 transition-colors">Nomor WhatsApp Aktif</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-green-500">
                            <i class="fab fa-whatsapp text-lg"></i>
                        </span>
                        <input type="number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:border-green-600 text-sm outline-none transition form-input-focus text-gray-700 font-bold" placeholder="0812xxxxxx" required>
                    </div>
                </div>

                <div class="group">
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-2 tracking-wider">Email Terdaftar</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400">
                            <i class="fa fa-envelope text-sm"></i>
                        </span>
                        <input type="email" value="{{ $user->email }}" class="w-full pl-10 pr-4 py-3 border border-gray-200 bg-gray-50 rounded-xl text-sm outline-none text-gray-400 font-medium cursor-not-allowed" readonly>
                    </div>
                    <p class="text-[10px] text-gray-400 mt-1.5 italic">* Email tidak dapat diubah untuk keamanan akun.</p>
                </div>
            </div>

            <div class="group">
                <label class="block text-xs font-bold uppercase text-gray-500 mb-2 tracking-wider group-focus-within:text-green-600 transition-colors">Deskripsi Usaha & Alamat Kandang</label>
                <div class="relative">
                    <span class="absolute left-3.5 top-3.5 text-gray-400 group-focus-within:text-green-600">
                        <i class="fa fa-map-marked-alt text-sm"></i>
                    </span>
                    <textarea name="deskripsi_usaha" rows="4" class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:border-green-600 text-sm outline-none transition form-input-focus text-gray-700 leading-relaxed" placeholder="Tuliskan deskripsi singkat peternakan Anda dan alamat lengkap kandang untuk memudahkan pembeli..." required>{{ old('deskripsi_usaha', $user->deskripsi_usaha) }}</textarea>
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="w-full sm:w-auto px-8 py-4 text-xs font-bold text-white bg-green-600 hover:bg-green-700 rounded-2xl shadow-xl shadow-green-600/20 transition-all duration-200 active:scale-95 flex items-center justify-center gap-2">
                    <i class="fa fa-save"></i> Perbarui Profil Toko
                </button>
            </div>
        </form>
    </div>

    <script>
        const avatarInput = document.getElementById('avatar-input');
        const avatarPreview = document.getElementById('avatar-preview');
        const avatarPlaceholder = document.getElementById('avatar-placeholder');

        avatarInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                
                // Batas 2MB
                if (file.size > 2 * 1024 * 1024) {
                    alert('❌ Ukuran foto terlalu besar! Maksimal 2MB.');
                    this.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.src = e.target.result;
                    avatarPreview.classList.remove('hidden');
                    if (avatarPlaceholder) {
                        avatarPlaceholder.classList.add('hidden');
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    </script>

</body>
</html>