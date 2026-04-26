<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tutorial - {{ $tutorial->judul }}</title>
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
    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Master Tutorial</h1>
            <a href="/master-tutorial" class="text-blue-500 hover:underline">← Kembali</a>
        </div>

        <form action="{{ url('/master-tutorial/' . $tutorial->id) }}" method="POST">
            @csrf
            @method('PUT') <div class="mb-4">
                <label class="block text-gray-700 dark:text-white font-bold mb-2">Judul Tutorial</label>
                <input type="text" name="judul" value="{{ $tutorial->judul }}" 
                    class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-white font-bold mb-2">Mata Kuliah</label>
                <select name="kode_mata_kuliah" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @if(isset($makulData) && is_array($makulData) && count($makulData) > 0)
                        @foreach($makulData as $mk)
                            <option value="{{ $mk['kdmk'] }}" 
                                {{ $tutorial->kode_mata_kuliah == $mk['kdmk'] ? 'selected' : '' }}>
                                {{ $mk['nama'] }} ({{ $mk['kdmk'] }})
                            </option>
                        @endforeach
                    @endif
                </select>
                @if(empty($makulData))
                    <p class="text-red-500 dark:text-red-400 text-xs italic mt-2">Gagal Memuat Mata Kuliah. Data dari Webservice API tidak dapat ditarik.</p>
                @endif
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 dark:text-white font-bold mb-2">Email Pembuat</label>
                <input type="email" value="{{ $tutorial->creator_email }}" class="w-full p-2 border rounded bg-gray-100" readonly>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">*Email pembuat tidak dapat diubah</p>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white dark:text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition">
                Simpan Perubahan
            </button>
        </form>
    </div>
</body>
</html>