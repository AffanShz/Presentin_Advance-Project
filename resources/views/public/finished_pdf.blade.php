<!DOCTYPE html>
<html>
<head>
    <title>{{ $master->judul }}</title>
    <style>
        body { font-family: sans-serif; line-height: 1.5; }
        .step { margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #ddd; }
        .code-block { background: #f4f4f4; padding: 10px; border-radius: 5px; font-family: monospace; white-space: pre-wrap; }
        img { max-width: 100%; height: auto; }
    </style>
</head>
<body>
    <h1 style="text-align: center;">{{ $master->judul }}</h1>
    <hr>

    @foreach($details as $detail)
        <div class="step">
            <h3>Langkah {{ $detail->order }}</h3>
            @if($detail->text)
                <p>{{ $detail->text }}</p>
            @endif
            
            @if($detail->gambar)
                <img src="{{ public_path('storage/' . $detail->gambar) }}">
            @endif

            @if($detail->code)
                <div class="code-block">{{ $detail->code }}</div>
            @endif
        </div>
    @endforeach
</body>
</html>