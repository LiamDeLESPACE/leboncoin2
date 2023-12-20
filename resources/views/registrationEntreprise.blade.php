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

            <form class="center-form" method="post" action="/create-account/registrationEntreprisePost" >  
                @csrf
                
                <div>
                    <label>Nom de société</label>
                    <small>*</small><br>
                    <input type="text" name="nomSociete" required/><br>
                </div><br>
                
                <div>
                    <label>Secteur d'activité</label>
                    <small>*</small><br>
                    <input type="text" name="secteurActivite" required/><br>
                    
                </div><br>
                    
                <div>
                    <label>Siret</label>
                    <small>*</small><br>
                    <input type="text" name="siret" pattern="[0-9]{14}" required/>
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
    
                {{-- <div>
                    <form class="center-form" method="post" action="/modificationAdresseCompte">
                        @csrf
                        <h4>Adresse</h4>
                        <div>
                            <label>Numéro</label>
                            <input type="text" name="numAdresse"  required />&ensp;
                             
                            <label>Adresse</label>
                            <input type="text" name="nomAdresse" required/>&ensp;
                            
                            <label>Ville ou code postal</label>
                            <input list="html_elements" name="codeinsee" required>
                            <datalist id="html_elements">
                            @foreach ($villes as $ville)
                            @csrf
                                @if($ville->codeinsee < 10000)
                                    <option>{{ $ville->nomville  .' ('. $ville->codepostalville .')'}}</option>
                                @else
                                    <option>{{ $ville->nomville  .' ('. $ville->codepostalville .')'}}</option>
                                @endif
                            @endforeach 
                            </datalist>
                    
                        </div><br>
                        
                        <div>
                            <input type="submit" value="Enregistrer les modifications"/><br>                    
                        </div>    
                    </form>
                </div><br><br> --}}

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
