<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
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

            <form class="center-form" method="post" action="/loginEntreprisePost" >  
               @csrf
               <div>
                    <label>SIRET</label>
                    <small>*</small><br>
                    <input type="text" name="siret" required/>
               </div>
    
               <div>
                    <label>Mot de passe</label>
                    <small>*</small><br>
                    <div class="password-container">
                        <input type="password" id="password" name="password" required/>
                        <img class="toggle-password-img" src="/assets/oeil/eye.png" alt="Toggle Password Visibility" onclick="togglePasswordVisibility()">

                    </div>
                    <!-- <a href="">Mot de passe oublié</a> -->
               </div><br>
    
               <div>
                   <input type="submit" value="Connexion"/><br>
                </div>    
                <small>* Champs obligatoires</small><br>   
                <a href="/create-account/registrationEntreprise">Créer un compte</a>
            </form>

           

            
        </div>

    </div>
    <script src="/js/oeil.js"></script>

</body>
</html>