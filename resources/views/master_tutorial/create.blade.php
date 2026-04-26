<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Master Tutorial - presentin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
        if (localStorage.getItem('dark-mode') === 'true') {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 p-8">

    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Tambah Master Tutorial Baru</h2>

        <form action="{{ url('/master-tutorial') }}" method="POST">
            @csrf 

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-white text-sm font-bold mb-2">Judul Tutorial</label>
                <input type="text" name="judul" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-white text-sm font-bold mb-2">Kode Mata Kuliah</label>
                <select name="kode_mata_kuliah" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Pilih Mata Kuliah</option>
                    @if(isset($makulData) && is_array($makulData) && count($makulData) > 0)
                        @foreach($makulData as $makul)
                            <option value="{{ $makul['kdmk'] ?? '' }}">
                                {{ $makul['nama'] ?? ($makul['kdmk'] ?? 'Unknown') }}
                            </option>
                        @endforeach
                    @endif
                </select>
                @if(empty($makulData))
                    <p class="text-red-500 text-xs italic mt-2">Gagal Memuat Mata Kuliah. Data dari Webservice API tidak dapat ditarik.</p>
                @endif
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 dark:text-white text-sm font-bold mb-2">Email Pembuat</label>
                <input type="email" name="creator_email" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required placeholder="email@domain.com">
            </div>

            <div class="flex justify-end mt-6">
                <a href="{{ url('/master-tutorial') }}" class="mr-4 text-gray-600 dark:text-gray-300 px-4 py-2 hover:underline">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>

</body>
</html>