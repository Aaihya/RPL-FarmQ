<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | FarmQ - Marketplace Qurban</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

    <div class="max-w-md w-full bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
        <!-- Header dengan nuansa Hijau Qurban -->
        <div class="bg-green-600 p-8 text-center text-white">
            <h1 class="text-3xl font-bold italic">FarmQ</h1>
            <p class="text-green-100 mt-2">Selamat Datang di Marketplace Hewan Qurban</p>
        </div>

        <div class="p-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ url('/login') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Email Address</label>
                    <div class="relative mt-1">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <input type="email" name="email" required
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition"
                            placeholder="nama@email.com">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Password</label>
                    <div class="relative mt-1">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fa fa-lock"></i>
                        </span>
                        <input type="password" name="password" required
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition"
                            placeholder="••••••••">
                    </div>
                </div>

                <button type="submit" 
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded-lg transition-all shadow-lg shadow-green-200">
                    Masuk Sekarang
                </button>
            </form>

            <div class="mt-6 text-center text-sm text-gray-600">
                Belum punya akun? 
                <a href="{{ url('/register') }}" class="text-green-600 font-bold hover:underline">Daftar di sini</a>
            </div>
        </div>
    </div>

</body>
</html>