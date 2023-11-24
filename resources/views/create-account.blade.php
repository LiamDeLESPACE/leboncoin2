<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de compte</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <div>
        
        <div>
            <form method="post" action="/login">  
                @csrf
                <input type="submit" id="button1" name="choixCompte" value="">
                <label for="button1">Compte particulier</label><br>  
            </form>

            <form method="post" action="/">
                <input type="submit" id="button2" name="choixCompte" value="">
                <label for="button2">Compte entreprise</label>
                    
            </form>
        </div><br>

        <div>
            <span>Vous avez déjà un compte ?</span>
            <a href="/login">Se connecter</a>
        </div>

    </div>
</body>
</html>