<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="{{$annonce->titreannonce}}" />
    <meta property="og:description" content="{{$annonce->descriptionannonce}}" />
    <meta property="og:image" content="{{ asset("assets/images_annonce/$annonce->donneesphoto")}}" />
    <meta property="og:url" content="http://51.83.36.122:8052/annonce/{{$annonce->idannonce}}" />
    <title>[Annonce]{{$annonce->titreannonce}}</title>
	<link rel="stylesheet" href="/css/annonce.css">
</head>
<body>
    @csrf
    <h1>{{$annonce->titreannonce}} ▪ {{$ville->nomville}}
    @foreach($proprietaire as $prop)
     ▪ <a href="../proprietaire/{{$prop->idutilisateur}}">{{$prop->nomparticulier}} {{$prop->prenomparticulier}}</a>
    @endforeach
    </h1>
    <div class="img">
        @foreach($photos as $photo)
            <img src='{{ asset("assets/images_annonce/$photo->donneesphoto") }}' class="lightbox" alt="" >
        @endforeach
    </div>
    <div class="textField">
        <h3><span>{{$typelogement->libelletypelogement}}</span> ▪ <span>{{$capacitevoyageur->nbadultes}} adulte(s) ▪ {{$capacitevoyageur->nbenfants}} enfant(s) ▪ {{$capacitevoyageur->nbbebes}} bebe(s) ▪ </span>
        <span>{{$annonce->etoile}}⭐</span>
        </h3>
        @if($capacitevoyageur->nbanimaux > 0)
            <h3>Animaux Autorisés</h3>
        @endif
        <p>{{$annonce->descriptionannonce}}
    </div>
    <small>Date de publication : {{$annonce->datepublication}}</small>
</body>
<footer>

    <main>
        @csrf
            <h1> Autres annonces pour la ville de {{$ville->nomville}} dans {{$typelogement->libelletypelogement}}</h1> 
        @foreach ($annoncesimilaires as $ann)
        @if(!($ann->idannonce==$annonce->idannonce))
            <a class="annonce" id="{{$ann->idannonce}}" href="{{$ann->idannonce}}">
                <h2>{{$ann->titreannonce}}</h2>
                <img src="{{ asset("assets/images_annonce/$ann->donneesphoto")}}"/>
                <br>
                <span class="nbadultes">{{$ann->nbadultes}}</span>  pers ▪ <span class="typelogement" id="{{$ann->idannonce}}">{{$ann->libelletypelogement}}</span></h3>
            </a>
            <br><br>
        @endif
        @endforeach 
    </main>
    <script src="{{ asset('js/Image.js') }}"></script>
    @php
    $nonce = bin2hex(random_bytes(16)); // Génération d'un nonce aléatoire
    @endphp
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v18.0&appId=1414076776131818&autoLogAppEvents=1" nonce="{{ $nonce }}"></script>

<!-- Bouton de partage Facebook -->
<div class="fb-share-button" data-href="http://51.83.36.122:8052/annonce/{{$annonce->idannonce}}" data-layout="button_count"></div>

</footer>
</html>