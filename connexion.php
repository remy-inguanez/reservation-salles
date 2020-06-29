
<?php
if(isset($_POST['Valider']))
{

$user=htmlspecialchars(trim($_POST['login']));
$pass=htmlspecialchars(trim($_POST['password']));

$base=mysqli_connect("localhost","root","","reservationsalles");
$req= "SELECT * FROM utilisateurs WHERE login='$user'";
$result= mysqli_query($base,$req);
$row= mysqli_fetch_array($result);


  if(password_verify($_POST['password'],$row['password']))
  {
    session_start();
      echo 'Vous êtes connecté ', $user . ' !';
      $_SESSION['login']=$user;
      $_SESSION['password']=$pass;
      header('Location: index.php');
  }
  else
  {
    echo 'Login ou password incorrect';
  }
  
  
}

?>

<!DOCTYPE html>
<html>

<head>
<div class="titre"><img src="https://fontmeme.com/permalink/200207/765d4bf14fd78aea8a7df3fc9a85ab38.png" alt="police-dragon-ball-z" border="0"></a></div>
<link rel="icon" href="maitre_karin_4885.jpg"/>
<link rel="stylesheet" type="text/css" href ="index.css"/>
<meta charset= "utf-8">
<title>Connexion</title>
</head>

<body>

<main class="menu1">
    <article class="menu">
       <br><a href="profil.php">Modifier votre profil</a></br>
       <br><a href="index.php">Accueil</a></br>
       <br><a href="planning.php">Planning</a></br>
       <br><a href="reservation.php">Réservation</a></br>
    </article>
</main>

 <section id="adam">

<div class="dispositon">
<form class="form1" action="" method="post">
<p>Login:</p> <input  required type="text" name="login">
<p>Password:</p><input required type ="password" name="password">
<input required class="button" type="submit" name="Valider"> 
</div>

</section>

<footer>

<p class="page">
Réservation salles &emsp;
Remy.I  Adam.T ©  &emsp; 2020  &emsp; Tous droits réservés.  
</p>

</footer>

</body>

</html>
