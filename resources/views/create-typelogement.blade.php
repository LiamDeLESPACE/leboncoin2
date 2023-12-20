<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Type Logement</title>
</head>
<body>
    <div>
        @if($errors->any())
            <div>
                @foreach($errors->all() as $error)
                    <div>{{$error}}</div>
                @endforeach
            </div>
        @endif

        @if(session()->has('error'))
            <div>{{session('error')}}</div>
        @endif

        @if(session()->has('success'))
            <div>{{session('success')}}</div>
        @endif
    </div>
    <a href="/"><button>Retour Accueil</button></a>
    <h1>Créer un typelogement</h1>
    <form action="/create-typelogement/registration" method="post">
        @csrf
        <label for="libelletypelogement">Type de logement :</label>
        <input type="text" id="libelletypelogement" name="libelletypelogement" required minlength="4" maxlength="20" pattern="[A-Z]{1}[a-z]+"/>
        <input type="submit" value="Créer" /><br>
        <small>* Majuscule pour la première lettre</small>
    </form>
    @foreach($annonces as $annonce)
    <form action="/update-typelogement/{{$annonce->idannonce}}" method="post">
    @csrf
    <input list="typelogements" name="typelogement" value="{{$annonce->idtypelogement}}" required>
        <datalist id="typelogements">
        @foreach ($typeslogement as $type)
            <option value="{{ $type->idtypelogement }}">{{$type->libelletypelogement}}</option>
        @endforeach 
        </datalist><input type="submit" name="registration" value="Changer Type Logement"/>
        <a class="annonce" id="{{$annonce->idannonce}}" href="/annonce/{{$annonce->idannonce}}"><h3>{{$annonce->titreannonce}}</h3></a>
    </form>
    @endforeach
</body>
</html>