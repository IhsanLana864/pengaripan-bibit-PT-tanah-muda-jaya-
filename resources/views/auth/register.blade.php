<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Akuntansi Persediaan PT Tanah Muda Jaya</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-green-50 to-green-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo dan Judul -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-gradient-to-br from-green-600 to-green-700 rounded-xl mx-auto flex items-center justify-center mb-4 shadow-lg">
                <i class="fas fa-leaf text-3xl text-white"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">PT Tanah Muda Jaya</h1>
            <h2 class="text-xl font-semibold text-gray-700 mt-2">Sistem Akuntansi Persediaan</h2>
            <p class="text-gray-600 mt-2">Daftar akun baru</p>
        </div>

        <!-- Form Register -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Nama -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                            placeholder="Contoh: John Doe"
                            class="pl-11 h-10 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 text-sm">
                    </div>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            placeholder="Contoh: johndoe@gmail.com"
                            class="pl-11 h-10 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 text-sm">
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input id="password" type="password" name="password" required
                            placeholder="Minimal 8 karakter (huruf dan angka)"
                            class="pl-11 h-10 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 text-sm">
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            placeholder="Masukkan ulang password yang sama"
                            class="pl-11 h-10 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 text-sm">
                    </div>
                </div>

                <!-- Register Button -->
                <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                    <i class="fas fa-user-plus mr-2"></i>
                    Daftar
                </button>

                <!-- Login Link -->
                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="text-sm text-green-600 hover:text-green-800">
                        Sudah punya akun? Masuk di sini
                    </a>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <p class="text-center mt-6 text-sm text-gray-600">
            &copy; {{ date('Y') }} Sistem Manajemen Bibit. All rights reserved.
        </p>
    </div>
</body>
</html>
