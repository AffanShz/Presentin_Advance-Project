<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="5">
    <title>{{ $master->judul }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-3xl font-bold mb-6 text-center">{{ $master->judul }}</h1>
        
        @foreach($details as $detail)
            <div class="mb-8 border-b pb-4">
                <h3 class="font-bold text-lg mb-2">Langkah {{ $detail->order }}</h3>
                
                @if($detail->text)
                    <p class="mb-2">{{ $detail->text }}</p>
                @endif
                
                @if($detail->gambar)
                    <img src="{{ asset('storage/' . $detail->gambar) }}" class="my-4 max-w-full h-auto rounded">
                @endif
                
                @if($detail->code)
                    <pre><code class="language-php">{{ $detail->code }}</code></pre>
                @endif
                
                @if($detail->url)
                    <a href="{{ $detail->url }}" target="_blank" class="text-blue-500 underline">Referensi URL</a>
                @endif
            </div>
        @endforeach
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
</body>
</html>