<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tutorial - Presentin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto bg-white p-8 rounded-lg shadow-md">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Master Tutorial</h1>
            <div class="flex gap-2">
                <a href="/master-tutorial/create" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                    + Tambah Tutorial Baru
                </a>
                <a href="/logout-action" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition" onclick="return confirm('Apakah Anda yakin ingin logout?')">
                    Logout
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="p-3 border">No</th>
                        <th class="p-3 border">Judul</th>
                        <th class="p-3 border">Mata Kuliah</th>
                        <th class="p-3 border">URL (Presentasi / Finish)</th>
                        <th class="p-3 border text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tutorials as $index => $item)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border text-center">{{ $index + 1 }}</td>
                            <td class="p-3 border font-semibold">{{ $item->judul }}</td>
                            <td class="p-3 border text-sm text-gray-600">{{ $item->kode_mata_kuliah }}</td>
                            <td class="p-3 border">
                                <div class="flex flex-col gap-1 text-xs">
                                    <a href="{{ $item->url_presentation }}" target="_blank" class="text-blue-500 hover:underline">🔗 Link Presentasi</a>
                                    <a href="{{ $item->url_finished }}" target="_blank" class="text-purple-500 hover:underline">🔗 Link Finish (PDF)</a>
                                </div>
                            </td>
                            <td class="p-3 border">
                                <div class="flex justify-center gap-2">
                                    <a href="/master-tutorial/{{ $item->id }}/detail" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">
                                        Isi Materi
                                    </a>

                                    <a href="/master-tutorial/{{ $item->id }}/edit" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                                        Edit
                                    </a>

                                    <form action="{{ url('/master-tutorial/'.$item->id) }}" method="POST" onsubmit="return confirm('Hapus tutorial ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-500 italic">Belum ada data tutorial.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>