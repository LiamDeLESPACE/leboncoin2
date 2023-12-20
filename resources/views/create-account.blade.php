<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de compte</title>
    <link rel="stylesheet" href="public/css/create-account.css">
</head>
<body>
    <div>
        <a href="/"><button>Retour Accueil</button></a><br> <br>
        <div>
            <form method="get" action="/create-account/registrationParticulier">  
                @csrf
                <!-- <input type="submit" id="button1" name="choixCompte" value=""> -->
                <!-- <label for="button1">Compte particulier</label><br>   -->
                <button type="submit">Compte particulier</button>
            </form><br>

            <form method="get" action="/create-account/registrationEntreprise">
                @csrf
                <!-- <input type="submit" id="button2" name="choixCompte" value="">
                <label for="button2">Compte entreprise</label> -->
                <button type="submit">Compte entreprise</button>
                    
            </form>
        </div><br>

        <div>
            <span>Vous avez déjà un compte particulier ?</span>
            <a href="/loginParticulier">Se connecter</a>
        </div>

        <div>
            <span>Vous avez déjà un compte entreprise ?</span>
            <a href="/loginEntreprise">Se connecter</a>
        </div>

    </div>
</body>
</html>