<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="/css/authentification.css">
</head>
<body>
    <div>
        <a href="/"><button>Retour Accueil</button></a>
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
        <div class="container">

            <form class="center-form" method="post" action="/create-account/registrationParticulierPost" >  
                @csrf
                <div>
                        <label>Pseudo</label>
                        <small>*</small><br>
                        <input type="text" name="pseudo" required/><br>
                </div><br>
    
                <div>
                        <label>E-mail</label>
                        <small>*</small><br>
                        <input type="email" name="mailparticulier" pattern="^[^\s@]+@[^\s@]+\.[^\s@]{2,}$" required/>
                </div><br>
    
                <div>
                        <label>Mot de passe</label>
                        <small>*</small><br>
                        <div class="password-container">
                            <input type="password" name="passwd" id="password" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W+)[A-Za-z\d\W+]{12,}$" required/>
                            <img class="toggle-password-img" src="/assets/oeil/eye.png" alt="Toggle Password Visibility" onclick="togglePasswordVisibility()">
    
                        </div>                        
                        <small>Au minimum de 12 caractères</small><br>
                        <small>Au moins une lettre majuscule</small><br>
                        <small>Au moins une lettre minuscule</small><br>
                        <small>Au moins un chiffre</small><br>
                        <small>Au moins un caractère spécial</small>

                </div><br>
    
                <div>
                    <label>Téléphone</label>
                    <small>*</small><br>
                    <input type="tel" name="telprofil" pattern="(06|07)[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}|(06|07) [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}" required/><br>
                    <small>Commence par 06 ou 07</small>
                    
                </div><br>
    
                <div>
                    <input type="submit" value="Créer mon compte"/><br>
                    
                </div>    
                <small>* Champs obligatoires</small>
           </form>   
           
        </div>

    </div>
    <script src="/js/oeil.js"></script>
</body>
</html>
