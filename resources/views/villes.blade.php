<?php
use App\Models\Compteutilisateur;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ville</title>
    <link rel="stylesheet" href="public/css/villes.css">
</head>
<body>
    <form method="post" action="/annonces">
        <label for="datedebut">Date de début :</label>
        <input type="date" id="datedebut" name="datedebut">
        <br>
        <label for="codeinsee">Ville : </label>
        <input list="html_elements" name="codeinsee" required>
        <datalist id="html_elements">
        @foreach ($villes as $ville)
        @csrf
            @if($ville->codeinsee < 10000)
                <option value="0{{ $ville->codeinsee }}">"{{ $ville->nomville  .' ('. $ville->codepostalville .')'}}"</option>
            @else
                <option value="{{ $ville->codeinsee }}">"{{ $ville->nomville  .' ('. $ville->codepostalville .')'}}"</option>
            @endif
        @endforeach 
        </datalist>
        <br>
        <button type="submit">Rechercher</button>   
    </form><br>

    @if(Auth::check())
        @csrf

        <form method="post" action="/monCompte">
            @csrf
            <input type="submit" name="mycount" value="Mon compte"/>
        </form>
        <form method="post" action="/sedeconnecter">
            @csrf
            <input type="submit" name="logout" value="Se déconnecter"/>
        </form>
        <a href="/create-annonce">
            <button>Créer une annonce</button>
        </a>
        @if(auth()->user()->codeetatcu==16)
        <a href="/create-typelogement"><button>Gérer TypeLogement</button></a>
        @endif
    @else
        @csrf
        <form method="get" action="loginParticulier">
            @csrf
            <input type="submit" name="loginParticulier" value="Se connecter en tant que particulier"/>
        </form>

        @csrf
        <form method="get" action="loginEntreprise">
            @csrf
            <input type="submit" name="loginEntreprise" value="Se connecter en tant qu'entreprise"/>
        </form>

        <form method="get" action="/create-account">
            @csrf
            <input type="submit" name="registration" value="Créer un compte"/>
        </form>
    @endif <br>

</body>
</html>