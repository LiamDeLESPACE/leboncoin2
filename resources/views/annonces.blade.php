<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonce</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<form>
        <input list="typeslogement" name="typelogement">
            <datalist id="typeslogement">
                @foreach ($typeslogement as $typelogement)
                    <option value="{{ $typelogement->libelletypelogement}}"></option>
                @endforeach
            </datalist>
        <button type="submit">Filtrer</button>    
    </form>
    @foreach($annonce as $ann)
        <h3>"{{ $ann->titreannonce}}"</h3>
        "{{ $ann->codeinsee}}"
    @endforeach
</body>
</html>