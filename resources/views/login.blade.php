<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <div>
        <form method="post" action="/create-account" >  
           @csrf
           <div>
                <label>E-mail</label>
                <span>*</span><br>
                <input type="text" name="E-mail"/>
           </div>

           <div>
                <label>Mot de passe</label>
                <span>*</span><br>
                <input type="password" name="password"/><br>
                <a href="">Mot de passe oublié</a>
           </div><br>

           <div>
               <input type="submit" value="Se connecter"/><br>
               <a href="/create-account">Créer un compte</a>
           </div>    
       </form>               

    </div>
</body>
</html>