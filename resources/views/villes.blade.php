<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ville</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <form method="post" action="/annonces" role="search">
        <input list="html_elements" name="codeinsee">
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
        <button type="submit">Rechercher</button>   
    </form><br>

    <form method="post" action="/login">
        <input type="submit" name="login" value="Se connecter"/>
    </form>

</body>
</html>