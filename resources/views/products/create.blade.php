<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Hewan Qurban | FarmQ Vendor Panel</title>
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
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-6px); }
            40%, 80% { transform: translateX(6px); }
        }
        .shake-animation {
            animation: shake 0.4s ease-in-out;
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

    <div class="max-w-2xl mx-auto bg-white p-6 md:p-10 rounded-3xl border border-gray-100 shadow-2xl shadow-gray-200/80 transform transition-all duration-300">
        
        <div class="border-b border-gray-100 pb-5 mb-6">
            <span class="text-xs font-bold text-green-600 uppercase tracking-widest bg-green-50 px-3 py-1 rounded-full">Creation Mode</span>
            <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight mt-3">Tambah Hewan Qurban Anda</h2>
            <p class="text-xs text-gray-400 mt-1">Daftarkan komoditas ternak terbaik Anda hari ini dengan spesifikasi yang valid.</p>
        </div>
        
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl text-xs space-y-1 shadow-sm">
                    <p class="font-bold mb-1"><i class="fa fa-exclamation-triangle mr-1"></i> Gagal Menyimpan! Periksa Inputan Anda:</p>
                    <ul class="list-disc pl-4 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div id="js-error-alert" class="hidden bg-red-50 border border-red-200 text-red-700 p-3 rounded-xl text-xs flex items-center gap-2 transition-all duration-200">
                <i class="fa fa-times-circle text-sm"></i>
                <span id="js-error-message">Ukuran file maksimal yang diizinkan adalah 2MB.</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="group">
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1.5 tracking-wider transition-colors group-focus-within:text-green-600">Nama Hewan / Jenis Ras</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400 group-focus-within:text-green-600 transition-colors">
                            <i class="fa fa-tag text-sm"></i>
                        </span>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:border-green-600 text-sm outline-none transition-all duration-200 form-input-focus text-gray-700 font-medium" placeholder="Contoh: Sapi PO Super Jumbo" required>
                    </div>
                </div>
                
                <div class="group">
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1.5 tracking-wider group-focus-within:text-green-600">Kategori Jenis</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400 group-focus-within:text-green-600">
                            <i class="fa fa-cow text-sm"></i>
                        </span>
                        <select name="type" class="w-full pl-10 pr-10 py-3 border border-gray-200 bg-white rounded-xl focus:border-green-600 text-sm outline-none transition-all duration-200 form-input-focus text-gray-700 font-medium cursor-pointer appearance-none" required>
                           <option value="" disabled selected>Pilih Jenis Komoditas</option>
    <option value="Sapi" {{ old('type') == 'Sapi' ? 'selected' : '' }}>🐄 Sapi</option>
    <option value="Kambing" {{ old('type') == 'Kambing' ? 'selected' : '' }}>🐐 Kambing</option>
    <option value="Domba" {{ old('type') == 'Domba' ? 'selected' : '' }}>🐑 Domba</option>
                        </select>
                        </select>
                        <span class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 pointer-events-none">
                            <i class="fa fa-chevron-down text-xs"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div class="group">
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1.5 tracking-wider group-focus-within:text-green-600">Harga (Rp)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400 font-bold text-xs group-focus-within:text-green-600">
                            Rp
                        </span>
                        <input type="number" name="price" value="{{ old('price') }}" class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:border-green-600 text-sm outline-none transition-all duration-200 form-input-focus text-gray-700 font-bold text-green-600" placeholder="0" required>
                    </div>
                </div>
                
                <div class="group">
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1.5 tracking-wider group-focus-within:text-green-600">Estimasi Bobot</label>
                    <div class="relative">
                        <input type="number" name="weight" value="{{ old('weight') }}" class="w-full pl-4 pr-10 py-3 border border-gray-200 rounded-xl focus:border-green-600 text-sm outline-none transition-all duration-200 form-input-focus text-gray-700 font-medium" placeholder="450" required>
                        <span class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-xs font-bold text-gray-400 pointer-events-none">Kg</span>
                    </div>
                </div>

                <div class="group">
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1.5 tracking-wider group-focus-within:text-green-600">Umur Hewan</label>
                    <div class="relative">
                        <input type="number" name="age" value="{{ old('age') }}" class="w-full pl-4 pr-14 py-3 border border-gray-200 rounded-xl focus:border-green-600 text-sm outline-none transition-all duration-200 form-input-focus text-gray-700 font-medium" placeholder="24" required>
                        <span class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-xs font-bold text-gray-400 pointer-events-none">Bulan</span>
                    </div>
                </div>
            </div>

            <div class="group">
                <label class="block text-xs font-bold uppercase text-gray-500 mb-1.5 tracking-wider group-focus-within:text-green-600">📍 Lokasi Peternakan / Pengambilan</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400 group-focus-within:text-green-600">
                        <i class="fa fa-map-marker-alt text-sm"></i>
                    </span>
                    <input type="text" name="location" value="{{ old('location') }}" class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:border-green-600 text-sm outline-none transition-all duration-200 form-input-focus text-gray-700 font-medium" placeholder="Contoh: Garut, Jawa Barat" required>
                </div>
            </div>

            <div class="group">
                <label class="block text-xs font-bold uppercase text-gray-500 mb-1.5 tracking-wider group-focus-within:text-green-600">🩺 Status Kesehatan & Kualifikasi</label>
                <div class="relative">
                    <span class="absolute left-3.5 top-3.5 text-gray-400 group-focus-within:text-green-600">
                        <i class="fa fa-heartbeat text-sm"></i>
                    </span>
                    <textarea name="health_status" rows="3" class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:border-green-600 text-sm outline-none transition-all duration-200 form-input-focus text-gray-700 leading-relaxed" placeholder="Jelaskan kondisi kesehatan secara detail..." required>{{ old('health_status') }}</textarea>
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 space-y-3">
                <label class="block text-xs font-bold uppercase text-gray-600 tracking-wider">📸 Visualisasi Hewan Qurban</label>
                <div id="dropzone" class="relative bg-white border-2 border-dashed border-gray-200 hover:border-green-500 rounded-xl p-6 text-center transition-all duration-200 cursor-pointer group/file">
                    <input type="file" name="image" id="image-input" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*" required>
                    <div id="upload-instruction" class="space-y-2">
                        <i class="fa fa-cloud-upload-alt text-gray-400 group-hover/file:text-green-600 text-3xl transition-colors"></i>
                        <p class="text-xs font-semibold text-gray-600">Klik untuk unggah atau seret file gambar komoditas</p>
                        <p class="text-[10px] text-gray-400">PNG, JPG, JPEG, atau WEBP (Maksimal 2MB)</p>
                    </div>
                    <div id="new-preview-container" class="hidden flex flex-col items-center justify-center space-y-2">
                        <img id="new-preview-img" src="#" class="w-32 h-20 object-cover rounded-xl shadow-md border border-gray-100">
                        <p id="file-name-text" class="text-xs text-green-600 font-bold max-w-xs truncate"></p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 mt-6">
                <a href="{{ route('penjual.dashboard') }}" class="px-5 py-3 text-xs font-bold text-gray-500 bg-gray-100 hover:bg-gray-200 rounded-xl transition-all duration-200 text-center min-w-[100px]">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 text-xs font-bold text-white bg-green-600 hover:bg-green-700 rounded-xl shadow-lg shadow-green-600/10 transition-all duration-200 min-w-[140px] flex items-center justify-center gap-1.5">
                    <i class="fa fa-plus-circle"></i> Pasang ke Katalog
                </button>
            </div>
        </form>
    </div>

    <script>
        const imageInput = document.getElementById('image-input');
        const dropzone = document.getElementById('dropzone');
        const uploadInstruction = document.getElementById('upload-instruction');
        const newPreviewContainer = document.getElementById('new-preview-container');
        const newPreviewImg = document.getElementById('new-preview-img');
        const fileNameText = document.getElementById('file-name-text');
        const jsErrorAlert = document.getElementById('js-error-alert');
        const jsErrorMessage = document.getElementById('js-error-message');
        const MAX_FILE_SIZE = 2 * 1024 * 1024;

        function handleFile(files) {
            jsErrorAlert.classList.add('hidden');
            jsErrorAlert.classList.remove('shake-animation');
            if (files.length > 0) {
                const file = files[0];
                if (file.size > MAX_FILE_SIZE) {
                    const ukuranMB = (file.size / (1024 * 1024)).toFixed(2);
                    jsErrorMessage.textContent = `❌ Gagal! File Anda (${ukuranMB}MB) terlalu besar. Batas maksimal 2MB.`;
                    jsErrorAlert.classList.remove('hidden');
                    jsErrorAlert.classList.add('shake-animation');
                    imageInput.value = "";
                    uploadInstruction.classList.remove('hidden');
                    newPreviewContainer.classList.add('hidden');
                    dropzone.classList.remove('border-green-500', 'bg-green-50/30');
                    dropzone.classList.add('border-gray-200');
                    return;
                }
                fileNameText.textContent = `✅ Terpilih: ${file.name}`;
                const reader = new FileReader();
                reader.onload = function(e) {
                    newPreviewImg.src = e.target.result;
                    uploadInstruction.classList.add('hidden');
                    newPreviewContainer.classList.remove('hidden');
                    dropzone.classList.remove('border-gray-200');
                    dropzone.classList.add('border-green-500', 'bg-green-50/30');
                }
                reader.readAsDataURL(file);
            }
        }
        imageInput.addEventListener('change', function() { handleFile(this.files); });
        dropzone.addEventListener('dragover', (e) => { e.preventDefault(); dropzone.classList.add('border-green-500', 'bg-green-50/50'); });
        dropzone.addEventListener('dragleave', () => { if (imageInput.files.length === 0) dropzone.classList.remove('border-green-500', 'bg-green-50/50'); });
        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('border-green-500', 'bg-green-50/50');
            if (e.dataTransfer.files.length > 0) {
                if (e.dataTransfer.files[0].size <= MAX_FILE_SIZE) imageInput.files = e.dataTransfer.files;
                else imageInput.value = "";
                handleFile(e.dataTransfer.files);
            }
        });
    </script>
</body>
</html>