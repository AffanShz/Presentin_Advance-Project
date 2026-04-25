<link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet" />

<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Tambah Detail Langkah Tutorial</h2>
    
    <form action="/detail-tutorial" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        
        <input type="hidden" name="master_tutorial_id" value="{{ $master_id }}"> 

        <div>
            <label class="block">Teks Penjelasan</label>
            <textarea name="text" class="w-full border p-2 rounded"></textarea>
        </div>

        <div>
            <label class="block">Upload Gambar</label>
            <input type="file" name="gambar" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block">Potongan Kode (Code)</label>
            <textarea name="code" rows="4" class="w-full border p-2 rounded font-mono"></textarea>
        </div>

        <div>
            <label class="block">URL Referensi</label>
            <input type="url" name="url" class="w-full border p-2 rounded">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block">Urutan Langkah (Order)</label>
                <input type="number" name="order" class="w-full border p-2 rounded" required>
            </div>
            <div>
                <label class="block">Status</label>
                <select name="status" class="w-full border p-2 rounded">
                    <option value="hide">Hide</option>
                    <option value="show">Show</option>
                </select>
            </div>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Detail</button>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>