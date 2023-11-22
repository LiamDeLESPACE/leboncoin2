<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ville</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
                    @foreach ($annonces as $annonce)
                    @csrf
                        <a href="annonce/{{ $annonce->idannonce}}">{{ $annonce->titreannonce }}</a><br>
                    @endforeach
</body>
</html>