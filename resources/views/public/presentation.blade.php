<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $master->judul }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 p-8">
    <div id="presentation-container" class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-3xl font-bold mb-6 text-center">{{ $master->judul }}</h1>
        
        <div id="tutorial-content">
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
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script>
        function fetchUpdates() {
            fetch(window.location.href, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newContent = doc.getElementById('tutorial-content').innerHTML;
                
                const currentContent = document.getElementById('tutorial-content');
                if (currentContent.innerHTML !== newContent) {
                    currentContent.innerHTML = newContent;
                    Prism.highlightAll(); // Re-highlight syntax
                }
            })
            .catch(error => console.error('Error fetching updates:', error));
        }

        // Poll every 5 seconds
        setInterval(fetchUpdates, 5000);
    </script>
</body>
</html>