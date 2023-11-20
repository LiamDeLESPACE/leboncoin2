<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chouminage</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <form action="/recherche_annonce" method="GET" role="search">
    {{ csrf_field() }}
        <input list="html_elements" name="villeChoisie">
            <datalist id="html_elements">
                @foreach ($villes as $ville)
                    <option value="{{ $ville->nomville  .' ('. $ville->codepostalville .')'}}"></option>
                @endforeach
            </datalist>
        <button type="submit">Rechercher</button>    
    </form>
</body>
</html>