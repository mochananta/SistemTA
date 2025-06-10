@extends('user.landing')

@section('content')
    <div class="mt-20 py-20 flex items-center justify-center bg-gray-100 dark:bg-gray-900">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800 dark:text-white">Verifikasi Email</h2>

            @if (session('status'))
                <div class="mb-4 text-green-600 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 text-red-600 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-green-600 focus:border-green-600"
                        placeholder="Isi email anda..." required autofocus>
                </div>

                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-md font-semibold transition">
                    Kirim Link Reset
                </button>
            </form>
        </div>
    </div>
@endsection
