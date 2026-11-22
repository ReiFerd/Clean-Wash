<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CleanWash Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[#edf2fa] flex flex-col items-center justify-center px-4 py-8 text-slate-800">
    <h1 class="text-2xl font-bold text-[#0b2545] mb-4">CleanWash Register</h1>

    @if ($errors->any())
        <div class="w-full max-w-sm mb-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg px-4 py-3">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST" class="w-full max-w-sm bg-white p-6 rounded-lg shadow-sm border border-slate-200 space-y-4">
        @csrf

        <div>
            <label for="nama_pelanggan" class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap:</label>
            <input type="text" id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}" required autofocus class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500">
        </div>

        <div>
            <label for="no_telepon" class="block text-sm font-medium text-slate-700 mb-1">No. Telepon:</label>
            <input type="tel" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" required class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500">
        </div>

        <div>
            <label for="alamat" class="block text-sm font-medium text-slate-700 mb-1">Alamat:</label>
            <textarea id="alamat" name="alamat" rows="2" required class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500">{{ old('alamat') }}</textarea>
        </div>

        <div>
            <label for="username_pelanggan" class="block text-sm font-medium text-slate-700 mb-1">Username:</label>
            <input type="text" id="username_pelanggan" name="username_pelanggan" value="{{ old('username_pelanggan') }}" required class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500">
        </div>

        <div>
            <label for="password_pelanggan" class="block text-sm font-medium text-slate-700 mb-1">Password:</label>
            <input type="password" id="password_pelanggan" name="password_pelanggan" required class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500">
        </div>

        <div class="pt-1">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2.5 px-4 rounded-md transition">Register</button>
        </div>
    </form>

    <p class="mt-4 text-sm text-slate-600">Sudah punya akun? <a href="{{ route('login') }}" class="text-sky-600 hover:text-sky-700 font-medium hover:underline">Login</a></p>
</body>
</html>
