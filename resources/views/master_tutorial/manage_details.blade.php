<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Materi - {{ $master->judul }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6">
    <div class="max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Isi Materi: {{ $master->judul }}</h1>
            <a href="/master-tutorial" class="text-blue-600 hover:underline">← Kembali ke Daftar Tutorial</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-8">
            <h2 class="text-lg font-semibold mb-4 text-gray-700">Tambah Langkah Baru</h2>
            <form action="{{ url('/detail-tutorial') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="master_tutorial_id" value="{{ $master->id }}">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Penjelasan Langkah / Teks Materi</label>
                        <textarea name="text" rows="3" placeholder="Masukkan penjelasan langkah..." class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Urutan Langkah</label>
                        <input type="number" name="order" placeholder="Contoh: 1" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Publikasi</label>
                        <select name="status" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="hide">Hide (Draft)</option>
                            <option value="show">Show (Publish)</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode Program (Opsional)</label>
                        <textarea name="code" rows="4" placeholder="<?php echo 'Hello World'; ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 font-mono text-sm bg-gray-50 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Upload Gambar (Opsional)</label>
                        <input type="file" name="gambar" id="gambar" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border p-1 rounded-md">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">URL Referensi (Opsional)</label>
                        <input type="url" name="url" placeholder="https://example.com" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition font-medium shadow-sm">Simpan Langkah</button>
                </div>
            </form>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h2 class="text-lg font-semibold mb-4 text-gray-700">Daftar Langkah Tersimpan</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 text-sm">
                            <th class="border-b p-3 font-semibold text-center w-16">Urutan</th>
                            <th class="border-b p-3 font-semibold">Preview Materi</th>
                            <th class="border-b p-3 font-semibold text-center w-24">Status</th>
                            <th class="border-b p-3 font-semibold text-center w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($details as $detail)
                        <tr class="hover:bg-gray-50 border-b last:border-0">
                            <td class="p-3 text-center font-medium">{{ $detail->order }}</td>
                            <td class="p-3">
                                @if($detail->text)
                                    <p class="text-gray-800">{{ Str::limit($detail->text, 80) }}</p>
                                @endif
                                <div class="mt-1 flex gap-2">
                                    @if($detail->code) <span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded">💻 Ada Kode</span> @endif
                                    @if($detail->gambar) <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded">🖼️ Ada Gambar</span> @endif
                                    @if($detail->url) <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded">🔗 Ada Tautan</span> @endif
                                </div>
                            </td>
                            <td class="p-3 text-center">
                                <form action="{{ url('/detail-tutorial/'.$detail->id) }}" method="POST" class="inline-block">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="{{ $detail->status == 'show' ? 'hide' : 'show' }}">
                                    <button type="submit" class="px-2 py-1 rounded text-xs font-semibold {{ $detail->status == 'show' ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                        {{ strtoupper($detail->status) }}
                                    </button>
                                </form>
                            </td>
                            <td class="p-3 text-center">
                                <form action="{{ url('/detail-tutorial/'.$detail->id) }}" method="POST" class="inline-block">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-xs hover:underline" onclick="return confirm('Yakin ingin menghapus langkah ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-6 text-center text-gray-500 italic">Belum ada materi/langkah. Silakan tambahkan pada form di atas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>