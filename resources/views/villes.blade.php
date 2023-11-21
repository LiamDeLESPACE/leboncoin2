<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ville</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    @csrf
                
                <form method="get" action="/annonces/" role="search">
                    <input list="html_elements">
                    <datalist id="html_elements">
                    @foreach ($villes as $ville)
                            <option value="{{ $ville->codeinsee }}">"{{ $ville->nomville  .' ('. $ville->codepostalville .')'}}"</option>
                    @endforeach
                    </datalist>
                    <button type="submit">Rechercher</button>    
                </form>
</body>
</html>