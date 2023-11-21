<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonces</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>          
                <form method="POST" action="/" role="search">
                    <input list="html_elements">
                    <datalist id="html_elements" name="codeinsee>
                    @foreach ($villes as $ville)
                    @csrf
                        <option value="{{ $ville->codeinsee }}">"{{ $ville->nomville  .' ('. $ville->codepostalville .')'}}"</option>
                    @endforeach
                    </datalist>
                    <button type="submit">Rechercher</button>    
                </form>
                @foreach ($annonces as $annonce)
                @if({{ $ville->codeinsee }} == $_POST["codeinsee"]){echo "<h2>{{ $annonce->titreannonce }}</h2>"}
                @endforeach

</body>
</html>