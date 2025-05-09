<!DOCTYPE html>
<html>
<head>
    <title>Buch-Bericht</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { color: #3366cc; font-size: 24px; margin-bottom: 20px; }
        .info { margin-bottom: 5px; }
        .description { margin-top: 20px; }
    </style>
</head>
<body>
<!-- 1. Buchtitel anzeigen -->
<div class="header">{{ $book->title }}</div>

<!-- 2. Autorname anzeigen -->
<div class="info"><strong>Autor:</strong> {{ $book->author->name }}</div>

<!-- 3. Kategoriename anzeigen -->
<div class="info"><strong>Kategorie:</strong> {{ $book->category->name }}</div>

<!-- 4. Buchpreis anzeigen -->
<div class="info"><strong>Preis:</strong> {{ $book->price }} €</div>

<!-- 5. Lagerbestand anzeigen -->
<div class="info"><strong>Lagerbestand:</strong> {{ $book->stock }}</div>

<div class="description">
    <h3>Beschreibung:</h3>
    <!-- 6. Buchbeschreibung anzeigen -->
    <p>{{ $book->description }}</p>
</div>

<div style="margin-top: 30px; font-size: 12px; color: #666;">
    <!-- 7. Aktuelles Datum und Uhrzeit anzeigen -->
    Bericht erstellt am {{ date('d.m.Y H:i') }}
</div>
</body>
</html>
