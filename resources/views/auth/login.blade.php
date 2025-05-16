<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Kementerian Agama</title>
    <link rel="stylesheet" href="{{ asset('user/auth/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-green-50 flex items-center justify-center min-h-screen">

    <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-md">
        <div class="flex justify-center mb-6">
            <img src="https://www.freepnglogos.com/uploads/logo-kemenag-png/makna-lambang-kementerian-agama-9.png"
                alt="Logo" class="h-16 w-16">
        </div>

        <h2 class="text-center text-2xl font-bold text-gray-800 mb-2">Kementerian Agama</h2>
        <p class="text-center text-sm text-gray-500 mb-6">Masuk ke akun Anda untuk mengakses sistem</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i data-feather="mail" class="w-5 h-5"></i>
                    </span>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-700"
                        placeholder="nama@email.com">
                </div>
            </div>

            <!-- Password -->
            <div class="mb-6">
                <div class="flex justify-between mb-1">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs text-green-600 hover:underline">Lupa
                            password?</a>
                    @endif
                </div>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i data-feather="lock" class="w-5 h-5"></i>
                    </span>
                    <input type="password" id="password" name="password" required
                        class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-700"
                        placeholder="••••••••">
                    <button type="button" onclick="togglePassword()"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500">
                        <i id="eyeIcon" data-feather="eye" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mb-4">
                <input id="remember_me" name="remember" type="checkbox"
                    class="h-4 w-4 text-green-600 border-gray-300 rounded">
                <label for="remember_me" class="ml-2 block text-sm text-gray-900">Ingat saya</label>
            </div>

            <button type="submit" class="btn-kemenag w-full text-white py-2 rounded-md transition">Masuk</button>
        </form>

        <div class="flex items-center my-4">
            <div class="flex-grow h-px bg-gray-300"></div>
            <span class="px-2 text-sm text-gray-400">atau masuk dengan</span>
            <div class="flex-grow h-px bg-gray-300"></div>
        </div>

        <a href="#"
            class="w-full flex items-center justify-center border border-gray-300 rounded-md py-2 hover:bg-gray-100">
            <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google" class="h-5 w-5 mr-2">
            Masuk dengan Google
        </a>

        <p class="mt-6 text-sm text-center text-gray-600">Belum punya akun?
            <a href="{{ route('register') }}" class="text-green-600 hover:underline">Daftar sekarang</a>
        </p>
    </div>

    <script src="https://unpkg.com/feather-icons"></script>
    <script src="{{ asset('user/auth/eye.js') }}"></script>
</body>

</html>
