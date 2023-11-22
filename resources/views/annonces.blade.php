<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonces</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>              
    <form method="post" action="annonces/listeVille" role="search">
        <input list="html_elements" name="codeinsee">
        <datalist id="html_elements">
        @foreach ($villes as $ville)
        @csrf
            <option value="{{ $ville->codeinsee }}">"{{ $ville->nomville  .' ('. $ville->codepostalville .')'}}"</option>
        @endforeach     
        </datalist>
        <button type="submit">Rechercher</button>   
    </form>
</body>
</html>