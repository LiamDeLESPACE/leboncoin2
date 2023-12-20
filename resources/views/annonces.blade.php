<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonces</title>
    <link rel="stylesheet" href="/css/annonces.css">

    
</head>
<body>
    <a href="/"><button>Retour Accueil</button></a>
    <aside class="filtres">
        <form class="filtre" method="post">
            <span class="date">
            <label for="datedebut">Date de début :</label>
            <input type="date" id="datedebut" name="datedebut" value="{{$datedebut}}" onchange="validateDate()">
            </span>
            <br>
            <span class="typelogement">
            <label for="typelogement">Type de logement :</label>
            @csrf
            @foreach ($typelogements as $typelogement)
            <input type="button" class="typelogement" name="typelogement" id="{{$typelogement->libelletypelogement}}" value="{{$typelogement->libelletypelogement}}"/>
            @endforeach
            <input type="button" class="typelogement" name="typelogement" value="Tout"/>
            </span>

            <br>
            <span class="capacitevoyageur">
            <label for="adulte">Nombre d'adultes</label>
            <input type="number" id="adulte" name="adulte" min="0" value="{{$nbadulte}}">
            <br>
            <label for="enfant">Nombre d'enfants</label>
            <input type="number" id="enfant" name="enfant" min="0" value="{{$nbenfant}}">
            <br>
            <label for="bebes">Nombre de bebes</label>
            <input type="number" id="bebes" name="bebes" min="0" value="{{$nbbebe}}">
            <br>
            <label for="animaux">Nombre d'animaux</label>
            <input type="number" id="animaux" name="animaux" min="0" value="{{$nbanimaux}}">
            </span>
            <br>

            @foreach ($categoriecritere as $catec)
                <div class="{{$catec->libellecategoriecritere}}">
                <h3>{{$catec->libellecategoriecritere}}</h3>
                @foreach ($critere as $crit)
                @if($crit->idcategoriecritere==$catec->idcategoriecritere)
                    @if(in_array($crit->idcritere, $critereliste, true))
                        <input type="checkbox" name="categorie[]" id="{{$crit->idcritere}}" value="{{$crit->idcritere}}" checked/>
                        <label for="{{$crit->idcritere}}">{{$crit->libellecritere}}</label>
                        <br>
                    @else
                        <input type="checkbox" name="categorie[]" id="{{$crit->idcritere}}" value="{{$crit->idcritere}}"/>
                        <label for="{{$crit->idcritere}}">{{$crit->libellecritere}}</label>
                        <br>
                    @endif
                @endif
                @endforeach
                </div>
            @endforeach
            @if($ville->codeinsee < 10000)
            <input type="hidden" id="codeinsee" name="codeinsee" value="0{{$ville->codeinsee}}"/>
            @else
            <input type="hidden" id="codeinsee" name="codeinsee" value="{{$ville->codeinsee}}"/>
            @endif
            <input type="submit" value="Filtrer"/>
            <input type="submit" value="Sauvegarder Recherche"/>
            <label for="recherche">Recherche sauvegardée(s)</label>
            <input list="recherche" name="recherche">
            <input type="submit" value="Charger"/>
            <datalist id="recherche">
            @foreach($recherches as $recherche)
                <option value="{{$recherche->idrecherche}}">{{ $recherche->nomville}}</option>
            @endforeach 
            </datalist>
        </form>
    </aside>
    <main>
    @csrf
        <h1>{{$ville->nomville}}</h1> 
    <div class="annonces">
    @foreach ($annonces as $annonce)
        <a class="annonce" id="{{$annonce->idannonce}}" href="/annonce/{{$annonce->idannonce}}">
            <h2>{{$annonce->titreannonce}}</h2>
            <img src="{{ asset("assets/images_annonce/$annonce->donneesphoto")}}"/>
            <br>
            <span class="nbadultes">{{$annonce->nbadultes}}</span>  pers ▪ <span class="typelogement" id="{{$annonce->idannonce}}">{{$annonce->libelletypelogement}}</span>
        </a>
        <br><br>
    @endforeach
    </div>

    </main>
    <script src="/js/filtre.js" defer></script>
    <script src="/js/date.js" defer></script>
</body>
</html>