
<!DOCTYPE html>
<html>

<head>
<div class="titre"><img src="https://fontmeme.com/permalink/200207/2e266d67b4bc13d2a150599028cc35c6.png" alt="police-dragon-ball-z" border="0"></a><div>
<link rel="stylesheet" type="text/css" href ="index.css"/>
<meta charset= "utf-8">
<title>Inscription</title>
<link rel="icon" href="maitre_karin_4885.jpg"/>
</head>

<body class="inscription">

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

<h1> Inscription </h1>

<?php

?>

<article class="form">

<form class="inscriptionform" method="post" action="inscription.php"> 

<?php

if(!empty($_POST['inscription']))
{
	$connexion= mysqli_connect("localhost", "root", "", "reservationsalles");
	$login=$_POST['login'];
	$checkdups="SELECT  *from utilisateurs WHERE login='$login'";
    $checkdups2=mysqli_query($connexion, $checkdups) or die(mysqli_error($connexion));
    $checkdups3=mysqli_num_rows($checkdups2);
	
	if((($_POST['password']!=$_POST['passwordagain'])||($checkdups3>0))||(strlen($_POST['password'])< 5))
	{
		if(($_POST['password']!=$_POST['passwordagain'])&&($checkdups3>0))
		{
			?>

			<div class="affichage">
			<?php
			echo"*Mots de passes rentrés différents";
			?>

			</div>
			<div class="affichage">
			<?php
			echo"*Veuillez renseigner un autre login";
			mysqli_close($connexion);
			?>

			</div>
			<?php
		}
		else if((strlen($_POST['password'])< 5)&&($checkdups3>0))
		{  
			?>

			<div class="affichage">
			<?php
			echo"*Veuillez renseigner un autre login";
			?>

			</div>
			<div class="affichage">
			<?php
			echo"*Mots de passes trop courts";
			echo" 5 caractères minimum";
			mysqli_close($connexion);
			?>

			</div>
			<?php			
		}	
		else if($checkdups3>0)
		{	  
			?>

			<div class="affichage">
			<?php
			echo "*Veuillez renseigner un autre login";
			?>

			</div>
			<?php
			mysqli_close($connexion);	
		}
		else if($_POST['password']!=$_POST['passwordagain'])
		{  
			?>

			<div class="affichage">
			<?php
			echo"*Mots de passes rentrés différents";
			mysqli_close($connexion);
			?>

			</div>
			<?php			
		}
		else if(strlen($_POST['password']< 5))
		{  
			?>

			<div class="affichage">
			<?php
			echo"*Mots de passes trop courts";
			echo " 5 caractères minimum";
			mysqli_close($connexion);
			?>

			</div>
			<?php			
		}	
	}	
	else
	{	

			$hash = password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 12]);					
			$connexion= mysqli_connect("localhost", "root", "", "reservationsalles"); 
			$query = 'INSERT INTO `utilisateurs`(`login`,`password`)VALUES
			("'.$_POST['login'].'", "'.$hash.'");';		
			mysqli_query($connexion, $query);		 
			mysqli_close($connexion);
			header('Location: connexion.php');	
			
			
	}
}
	
?>
		<p>Login:</p><input type="text" required placeholder="Login" name="login"></br>
		<p>Password:</p><input type="password" required placeholder="Password (5 caractères minimum)"  name="password"></br>
		<p>Confirm Password:</p><input type="password" required placeholder="Confirm Password"  name="passwordagain"></br></br>
		<input type="submit" value="Inscription" name="inscription"></br></br>
		<input type="reset" value="Effacer" name="reset">
	</form>

</article>

<footer>

<p class="page">
Réservation salles &emsp;
Remy.I  Adam.T Jeremy.B ©  &emsp; 2020  &emsp; Tous droits réservés.  
</p>

</footer>

</body>

</html>
