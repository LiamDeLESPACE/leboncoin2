<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonces</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>          
                <form method="GET" action="/" role="search">
                    <input list="html_elements">
                    <datalist id="html_elements" name="codeinsee">
                    @foreach ($villes as $ville)
                    @csrf
                        <option value="{{ $ville->nomville  .' ('. $ville->codepostalville .')'}}">"{{ $ville->codeinsee }}"</option>
                    @endforeach
                    </datalist>
                    <button type="submit">Rechercher</button>    
                </form>
                @foreach ($annonces as $annonce)
                    <a href="annonce/{{ $annonce->idannonce}}">{{ $annonce->titreannonce }}</a><br>
                @endforeach

</body>
</html>