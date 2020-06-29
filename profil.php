
<!DOCTYPE html>
<html>

<head>
<div class="titre"><a href="https://fontmeme.com/fr/police-dragon-ball-z/"><img src="https://fontmeme.com/permalink/200207/afdc294944403f533c1f308d7160d799.png" alt="police-dragon-ball-z" border="0"></a></div>
<link rel="stylesheet" href="index.css"/>
<meta charset= "utf-8">
<link rel="icon" href="maitre_karin_4885.jpg"/>
<title>Profil</title>
</head>

<body class="form">
<div class="form-style-8">

<main class="menu1">
    <article class="menu">
        <br><a href="connexion.php">Connexion</a></br>
       <br><a href="inscription.php">Inscription</a></br>
       <br><a href="profil.php">Modifier votre profil</a></br>
       <br><a href="index.php">Accueil</a></br>
       <br><a href="planning.php">Planning</a></br>
       <br><a href="reservation.php">Réservation</a></br>
    </article>
</main>

<?php
session_start();
?>
  
<form class="formulaire" name="inscription" method="post" action="profil.php">
Entrez votre login: <input type="text" name="login" value="<?php echo $_SESSION ['login'];?>">

        
    Entrez votre mot de passe: <input type="password" name="password" value="<?php echo $_SESSION['password'];?>">
    
    confirmez votre mot de passe : <input type="password" name="password1"value="<?php
    echo $_SESSION['password'];?>"><br/>
        
<input type="submit" name="valider" value="OK"/>
</form>
<?php

if(isset($_POST['valider']))
{   

 $db=mysqli_connect("localhost","root","","reservationsalles");
 $newlogin= $_POST['login']; 
 $login= $_SESSION['login']; 
 $password=$_POST['password'];

 $req= "UPDATE utilisateurs SET login = '".$newlogin."', password = '".$password."' WHERE login= '".$login."' ";
 $query= mysqli_query ($db, $req);
 $_SESSION['login']=$newlogin;
 $_SESSION['password']=$password;
 header('location: index.php');

}
?>

<footer>

<p class="page">
Réservation salles &emsp;
Remy.I  Adam.T ©  &emsp; 2020  &emsp; Tous droits réservés.  
</p>

</footer>

</body>

</html>
