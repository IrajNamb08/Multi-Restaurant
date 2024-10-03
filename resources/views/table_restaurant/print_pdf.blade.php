<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Codes des Tables de {{ $pointdevente->adresse }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .qr-code { text-align: center; margin-bottom: 20px; page-break-inside: avoid; }
        .qr-code img { max-width: 200px; height: auto; }
    </style>
</head>
<body>
    <h1>QR Codes des Tables <br>{{$restaurant->nom_resto}} - <small>{{ $pointdevente->adresse }}</small></h1>
    @foreach($tables as $table)
        <div class="qr-code">
            <h2>{{ $table->numero_table }}</h2>
            @if($table->qr_code)
                <img src="{{ public_path('storage/' . $table->qr_code) }}" alt="QR Code Table {{ $table->numero_table }}">
            @else
                <p>Pas de QR code disponible</p>
            @endif
        </div>
    @endforeach
</body>
</html>