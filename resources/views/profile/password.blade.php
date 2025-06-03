@extends('user.landing')

@section('content')
<section class="mt-12 py-16 bg-white dark:bg-gray-900">
    <div class="container mx-auto px-4 max-w-md">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-center text-green-700 dark:text-green-400 mb-4">Ganti Password</h2>

            <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password Saat Ini</label>
                    <input type="password" name="current_password" required
                        class="w-full px-3 py-2 border rounded bg-white dark:bg-gray-800 text-sm text-gray-900 dark:text-white">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password Baru</label>
                    <input type="password" name="new_password" required
                        class="w-full px-3 py-2 border rounded bg-white dark:bg-gray-800 text-sm text-gray-900 dark:text-white">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Konfirmasi Password Baru</label>
                    <input type="password" name="new_password_confirmation" required
                        class="w-full px-3 py-2 border rounded bg-white dark:bg-gray-800 text-sm text-gray-900 dark:text-white">
                </div>

                <div class="text-center">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        Ubah Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
