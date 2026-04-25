<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Master Tutorial - presentin</title>
    @vite('resources/css/app.css') 
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Master Tutorial Baru</h2>

        <form action="{{ url('/master-tutorial') }}" method="POST">
            @csrf 

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Judul Tutorial</label>
                <input type="text" name="judul" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Kode Mata Kuliah</label>
                <select name="kode_matkul" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih Mata Kuliah</option>
                    </select>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>

</body>
</html>