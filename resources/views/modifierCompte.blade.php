<?php
use App\Models\Particulier;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Compte</title>
    <link rel="stylesheet" href="/css/authentification.css">
    <link rel="stylesheet" href="/css/proprio2.css">
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
            <div>   
                <form method="post" action="/modifierPhoto" enctype="multipart/form-data">
                    @csrf
                    <label for="photo">Changer la photo :</label>
                    <input type="file" name="photo" id="photo" accept="image/*">
                    <input type="submit" value="Changer">
                </form>     
                @if(Particulier::find(auth()->user()->idutilisateur) != null)
                @csrf
                    <form class="center-form" method="post" action="/modificationCompte">  
                        <h4>Informations de compte</h4>
                        @csrf
                        <div class="img">
                            <img src='{{ asset("assets/images_profils/$photo->donneesphoto") }}' class= "pfp" alt="" >
                        </div>

                        <div>
                            @if($particulier->sexeparticulier == 'H')
                                @csrf
                                <input type="radio" id="H" name="sexe" value="H" checked/>
                                <label for="H">Monsieur</label>
            
                                <input type="radio" id="F" name="sexe" value="F"/>
                                <label for="F">Madame</label>
                            @elseif($particulier->sexeparticulier == 'F')
                                @csrf
                                <input type="radio" id="H" name="sexe" value="H"/>
                                <label for="H">Monsieur</label>
            
                                <input type="radio" id="F" name="sexe" value="F" checked/>
                                <label for="F">Madame</label>
                            @else
                                @csrf
                                <input type="radio" id="H" name="sexe" value="H"/>
                                <label for="H">Monsieur</label>
            
                                <input type="radio" id="F" name="sexe" value="F"/>
                                <label for="F">Madame</label>
                            @endif
                        </div><br>
                        
                        <div>
                            <label>Nom</label>
                            <input type="text" name="nomprofil" value="{{$particulier->nomparticulier}}"/>&ensp;
                            
                            <label>Prénom</label>
                            <input type="text" name="prenomprofil" value="{{$particulier->prenomparticulier}}"/>
                        </div><br>
        
                        <div>
                            <label>Date de naissance</label>
                            <input type="date" name="datenaissance" value="{{$particulier->datenaissanceparticulier}}"/>
                        </div><br>
                        
                        <div>
                            <label>Pseudo</label><br>
                            <input type="text" name="pseudo" value="{{$utilisateur->pseudoprofil}}"/><br>
                        </div><br>

                        <div>
                            <label>E-mail</label><br>                        
                            <input type="email" name="mailparticulier" pattern="^[^\s@]+@[^\s@]+\.[^\s@]{2,}$" value="{{$utilisateur->mailparticulier}}"/>
                        </div><br>
                        
                        <div>
                            <label>Mot de passe</label><br>
                            <div class="password-container">
                                <input type="password" name="passwd" id="password" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W+)[A-Za-z\d\W+]{12,}$"/>
                                <img class="toggle-password-img" src="/assets/oeil/eye.png" alt="Toggle Password Visibility" onclick="togglePasswordVisibility()">
        
                            </div>                            
                            <small>Au minimum de 12 caractères</small><br>
                            <small>Au moins une lettre majuscule</small><br>
                            <small>Au moins une lettre minuscule</small><br>
                            <small>Au moins un chiffre</small><br>
                            <small>Au moins un caractère spécial</small>
                        </div><br>
                        
                        <div>
                            <label>Téléphone</label><br>
                            <input type="tel" name="telprofil" pattern="(06|07)[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}|(06|07) [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}" value="{{$utilisateur->telprofil}}"/><br>
                            <small>Commence par 06 ou 07</small>
                            
                        </div><br>

                        <input type="submit" value="Enregistrer les modifications"/><br>
                    </form><br>   
                    
                @else
                    @csrf
                    <form class="center-form" method="post" action="/modificationCompte">  
                        <h4>Informations de compte</h4>
                        @csrf
                        <div class="img">
                            <img src='{{ asset("assets/images_profils/$photo->donneesphoto") }}' class= "pfp" alt="" >
                        </div>
                        <div>
                            <label>Nom de société</label><br>
                            <input type="text" name="nomSociete" value="{{$entreprise->nomsociete}}"/>&ensp;
                            
                        </div><br>
        
                        <div>
                            <label>Secteur d'activité</label><br>
                            <input type="text" name="secteurActivite" value="{{$entreprise->secteuractivite}}"/>
                        </div><br>
                        
                        <div>
                            <label>Siret</label><br>
                            <input type="text" name="siret" pattern="[0-9]{14}" value="{{$utilisateur->siret}}"/><br>
                        </div><br>                        
                        
                        <div>
                            <label>Mot de passe</label><br>                            
                            <div class="password-container">
                                <input type="password" name="passwd" id="password" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W+)[A-Za-z\d\W+]{12,}$"/>
                                <img class="toggle-password-img" src="/assets/oeil/eye.png" alt="Toggle Password Visibility" onclick="togglePasswordVisibility()">
        
                            </div>
                            <small>Au minimum de 12 caractères</small><br>
                            <small>Au moins une lettre majuscule</small><br>
                            <small>Au moins une lettre minuscule</small><br>
                            <small>Au moins un chiffre</small><br>
                            <small>Au moins un caractère spécial</small>
                        </div><br>

                        <input type="submit" value="Enregistrer les modifications"/><br>
                    </form><br>   
                @endif
                
            </div>

            {{-- <div>
                <form class="center-form" method="post" action="/modificationAdresseCompte">
                    @csrf
                    <h4>Adresse</h4>
                    <div>
                        <label>Numéro</label>
                        <input type="text" name="numAdresse"  required />&ensp;
                        {{-- value="{{$adresseProfil->paysadresse}}" 
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
                <form class="center-form" method="post" action="/monCompte/supprimerCompte">
                    @csrf
                    <div>
                        <input type="submit" value="Supprimer mon compte"/><br>                    
                    </div>    
                </form>
            </div>

           
        </div>
        

    </div>
    <script src="/js/oeil.js"></script>

</body>
</html>
