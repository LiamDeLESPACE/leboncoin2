<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Annonce</title>
    <link rel="stylesheet" href="/css/create-annonce.css">
</head>

<body>
    <form  method="post" action="{{ route('create-annonce.save') }}" enctype="multipart/form-data">
        @csrf

        <label for="titreannonce">Titre de l'annonce:</label>
        <input type="text" name="titreannonce" required>

        <label for="adulte">Nombre d'adultes</label>
        <input type="number" id="adulte" name="adulte" min="0" required>

        <label for="enfant">Nombre d'enfants</label>
        <input type="number" id="enfant" name="enfant" min="0" required>

        <label for="bebes">Nombre de bébés</label>
        <input type="number" id="bebes" name="bebes" min="0" required>

        <label for="bebes">Nombre d'animaux</label>
        <input type="number" id="animaux" name="animaux" min="0" required>

        <label for="codeinsee">Ville : </label>
        <input list="html_elements" name="codeinsee" id="villeInput" required>
        <datalist id="html_elements">
            @foreach ($villes as $ville)
                <option value="{{ $ville->nomville }}" data-nom="{{ $ville->nomville }}" data-codepostal="{{ $ville->codepostalville }}">{{ $ville->nomville .' ('. $ville->codepostalville .')'}}</option>
            @endforeach
        </datalist>

        <label for="codepostal">Code postal:</label>
        <input type="text" name="codepostal" id="codepostal" disabled>

        <label for="numero">Numéro:</label>
        <input type="number" name="numero" required>

        <label for="adresse">Adresse:</label>
        <input type="text" name="adresse" required>

        <label for="idproprietaire">Propriétaire (ID):</label>
        <input type="text" name="idproprietaire" value="{{ $idproprietaire }}" disabled>

        <label for="idtypelogement">Type de logement:</label>
        <select name="idtypelogement" required>
            @foreach($typesLogement as $typeLogement)
                <option value="{{ $typeLogement->idtypelogement }}">{{ $typeLogement->libelletypelogement }}</option>
            @endforeach
        </select>

        <label for="dureeminimumsejour">Durée minimum du séjour (en jours):</label>
        <input type="number" name="dureeminimumsejour" required>

        <label for="estactive">Est active:</label>
        <input type="checkbox" name="estactive" value="1" checked disabled>

        <label for="datepublication">Date de publication:</label>
        <input type="text" name="datepublication" value="{{ now()->format('d/m/Y') }}" disabled>

        <label for="descriptionannonce">Description de l'annonce:</label>
        <input type="text" name="descriptionannonce" required>

        <label for="etoile">Étoile:</label>
        <div class="stars" id="etoile">
            @for ($i = 1; $i <= 5; $i++)
                <span class="star" data-value="{{ $i }}">&#9733;</span>
            @endfor
        </div>

        <input type="hidden" name="etoile" id="etoileValue" value="1">

        <label for="photos">Photos (une ou plusieurs):</label>
        <input type="file" name="photos[]" accept="image/*" multiple required>

        <button type="submit">Créer l'annonce</button>

    </form>
    <a class="annuler" href="/">
        <button>Annuler</button>
    </a>
    <script src="/js/create-annonce.js" defer></script>
</body>

</html>
