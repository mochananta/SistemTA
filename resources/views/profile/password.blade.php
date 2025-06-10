@extends('user.landing')

@section('content')
    @if ($errors->any())
        <div class="text-red-600">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="text-green-600 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-12 py-16 flex items-center justify-center bg-gray-100 dark:bg-gray-900 px-1">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800 dark:text-white">Ganti Password</h2>

                <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-4">
                    @csrf

                    @if (is_null(Auth::user()->google_id))
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password Saat
                                Ini</label>
                            <input type="password" name="current_password" autocomplete="current-password" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-green-600 focus:border-green-600"
                                autofocus>
                        </div>
                    @else
                        <p class="text-sm text-gray-500 mb-4">
                            Anda login menggunakan akun Google. Silakan isi password baru untuk mengatur password login
                            manual.
                        </p>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password Baru</label>
                        <input type="password" name="password" autocomplete="new-password"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-green-600 focus:border-green-600" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Konfirmasi Password
                            Baru</label>
                        <input type="password" name="password_confirmation" autocomplete="new-password" required
                            class="w-full px-3 py-2 border rounded bg-white dark:bg-gray-800 text-sm text-gray-900 dark:text-white">
                    </div>

                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-md font-semibold transition">
                        Ubah Password
                    </button>
                </form>
            </div>
        </div>
@endsection
