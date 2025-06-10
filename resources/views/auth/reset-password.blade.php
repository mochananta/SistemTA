@extends('user.landing')

@section('content')
    <div class="mt-12 py-16 flex items-center justify-center bg-gray-100 dark:bg-gray-900 px-1">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800 dark:text-white">Reset Kata Sandi</h2>

            @if (session('status'))
                <div class="mb-4 text-green-600 dark:text-green-300 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 text-red-600 dark:text-red-400 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-green-600 focus:border-green-600"
                        required autofocus>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Password
                        Baru</label>
                    <input id="password" type="password" name="password"
                        class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-600"
                        placeholder="Masukkan kata sandi baru" required>
                </div>

                <div class="mb-6">
                    <label for="password_confirmation"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-600"
                        placeholder="Ulangi kata sandi baru" required>
                </div>

                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-md font-semibold transition">
                    Reset Password
                </button>
            </form>
        </div>
    </div>
@endsection
