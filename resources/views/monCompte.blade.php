<?php
use App\Models\Particulier;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="/css/proprio.css">
</head>
<body>
    <a href="/"><button>Retour Accueil</button></a>
    <div class="container">
        <div class="img">
            <img src='{{ asset("assets/images_profils/$photo->donneesphoto") }}' class="pfp" alt="">
        </div>
        <div class="text-center"> <!-- Add the text-center class here -->
            @if(Particulier::find(auth()->user()->idutilisateur) != null)
                @csrf
                <label>{{$utilisateur->pseudoprofil }}</label><br><br>
            @else
                @csrf
                <label>{{$entreprise->nomsociete }}</label><br><br>
            @endif
            <form method="get" action="/monCompte/modifierCompte">
                @csrf
                <input type="submit" name="modifierCompte" value="Modifier mon compte"/>
            </form>
        </div>
    </div>
</body>
</html>
