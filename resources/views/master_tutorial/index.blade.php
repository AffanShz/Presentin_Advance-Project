<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Master Tutorial</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-800">

<div class="container mx-auto p-4 mt-10 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Manajemen Master Tutorial</h1>
    <a href="/master-tutorial/create" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded inline-block mb-4">Tambah Tutorial</a>

    <div class="overflow-x-auto">
        <table id="tutorialTable" class="w-full mt-4 border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="border p-2">Judul</th>
                    <th class="border p-2">Kode MK</th>
                    <th class="border p-2">URL Presentation</th>
                    <th class="border p-2">URL Finished</th>
                    <th class="border p-2">Creator Email</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tutorials as $item)
                <tr>
                    <td class="border p-2">{{ $item->judul }}</td>
                    <td class="border p-2">{{ $item->kode_mata_kuliah }}</td>
                    <td class="border p-2"><a href="{{ $item->url_presentation }}" class="text-blue-500 hover:underline">Link</a></td>
                    <td class="border p-2"><a href="{{ $item->url_finished }}" class="text-blue-500 hover:underline">Link</a></td>
                    <td class="border p-2">{{ $item->creator_email }}</td>
                    <td class="border p-2">
                        </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTables
        $('#tutorialTable').DataTable();
    });
</script>

</body>
</html>