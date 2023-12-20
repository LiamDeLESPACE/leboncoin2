<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil de {{$proprietaire->nomparticulier}} {{$proprietaire->prenomparticulier}}</title>
    <link rel="stylesheet" href="/css/proprio.css">
</head>
<body>
    <div class="centrer">
        <h1>{{$proprietaire->nomparticulier}} {{$proprietaire->prenomparticulier}}</h1>
        <div class="img">
        <img src='{{ asset("assets/images_profils/$photo->donneesphoto") }}' class= "pfp" alt="" >
        </div>
        <p>Réponds en {{$profil->tempsreponse}} heure(s)</p>

    </div>
</body>
</html>