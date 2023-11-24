<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonces</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    @csrf
        <h1>{{$ville->nomville}}</h1>  
    
    @foreach ($annonces as $annonce)
    @csrf
        <a href="annonce/{{$annonce->idannonce}}">{{$annonce->titreannonce}}</a>
    @endforeach             
</body>
</html>