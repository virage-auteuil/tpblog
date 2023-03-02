<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulaires de connexion</title> 
    <link rel="stylesheet" href="inscription.css">
</head>
<body>
<div class="Inscription">
<h1>Inscription</h1>
<p> bienvenue sur la page d'inscription remplissez les champs demander </p>
<form action="inscription.php" method="post">
<div>
<label for="firtsname">Votre nom</label>
<input type="text" id="firstname" name="firstname" placeholder="Mbappe" required>
</div>
<div>
<label for="lastname">Votre prenom</label>
<input type="text" id="lastname" name="lastname" placeholder="Kylian" required>
</div>
<div>
<label for="email">Votre e-mail</label>
<input type="text" id="email" name="email" placeholder="monadresse@mail.com" required>
</div>
<div>
<label for="password">Votre mots-passe</label>
<input type="text" id="password" name="password" placeholder="" required>
</div>
<div>
<button type="submit">Inscription</button>
</div>
</form>
</div>
</body>
</html>

<?php
include('connexionbd.php');
    if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['password'])){//les champ son vide, on arrête l'exécution du script et on affiche un message d'erreur
    
         /*Verifie si le pseudo est deja inscrit */
     $reponse = $dbh->prepare('SELECT email FROM users WHERE email = :email'); 
     $reponse->execute(array('email' => $_POST['email']));
     $count = $reponse->rowCount(); 
     if($count >= 1) 
         { 
             // Pseudo déjà utilisé 
             echo 'Cette adresse email est déjà utilisé'; 
         } 

     else
         { 
              // Sinon on procede a l'inscription

              $pass_hache = sha1($_POST['password']); // Hache le mdp

               // Ajoute l'inscrit
               $ajou = $dbh->prepare('INSERT INTO users(email, password, firstname, lastname) VALUES(:email, :password, :firstname, :lastname)');
               $ajou->execute(array(
               'email' => $_POST['email'],
               'password' => $pass_hache,
               'firstname' => $_POST['firstname'],
               'lastname' => $_POST['lastname']));
               echo 'Inscription fini';
         }



    }
    else{
        echo "un champ et vide";
    }
