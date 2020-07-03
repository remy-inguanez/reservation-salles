
<!DOCTYPE html>
<html>

<head>
<title>Réservation</title>
<link href="index.css" rel="stylesheet">
<meta charset= "utf-8">
<link rel="icon" href="maitre_karin_4885.jpg"/>
<div class="titre"><a href="https://fontmeme.com/fr/police-dragon-ball-z/"><img src="https://fontmeme.com/permalink/200622/9f468b6c3e61ca5ebb35dfbe79494289.png" alt="police-dragon-ball-z" border="0"></a></div>
</head>

<body class="reservation">

<?php
session_start();

if(isset($_POST['deco']))
{
unset($_SESSION['login']);
unset($_SESSION['password']);	
}

if(isset($_SESSION['login']))
{
?>

<header>

<main class="menu1">
<article class="menu">
       <br><a href="index.php">Accueil</a></br>
	   <br><a href="planning.php">Planning</a></br>
	   <br><a href="reservation-form.php">Réservation-form</a></br>   
</article>
	<div class="form-style-4">
		<form method="post" action="reservation.php">
			<input type="submit" name="deco" value="Déconnexion">
		</form>
	</div>
</main>
		
</header>

<?php	
}
else
{
?>

<?php
}

	$detail=$_SESSION['id'];
	$connexion= mysqli_connect("localhost", "root", "", "reservationsalles"); 
	$query="SELECT *FROM reservations WHERE id=$detail";
	$result= mysqli_query($connexion, $query);
	$row=mysqli_fetch_array($result);
	
	$query1="SELECT login, id_utilisateur FROM utilisateurs, reservations WHERE utilisateurs.id = '".$row['id_utilisateur']."'";
	$result1= mysqli_query($connexion, $query1);
	$row1=mysqli_fetch_array($result1);
	
?>

<article class="formulairereservation2">	
<div class="form-style-5">
	<form method="post" action="reservation.php">

	<legend><span class="rond"></span>Détail de réservation</legend>
		
<?php
	
	if(isset($_POST['Supprimer']))
	{
	$id=$_SESSION['id'];
	$query5="DELETE FROM `reservations` WHERE `reservations`.`id` = $id;";
	$result5= mysqli_query($connexion, $query5);
	header('location: planning.php');
	}
	
	$date1= date("Y-m-d");
	$date2= date("H:i");
	$date = $date1."T".$date2;
	
	if(isset($_POST['Modifier']))
	{
	$debut1=$_POST['datedebut'];
	$query="SELECT *FROM reservations WHERE debut='$debut1'";
	$result= mysqli_query($connexion, $query);
	$resultat=mysqli_num_rows($result);
	
	$min="08";
	$max="19";

	if(($_POST['titre'] != $row['titre']) || ($_POST['description'] != $row['description']))
	{
			$login=$_SESSION['login'];
			$query2="SELECT  id from utilisateurs WHERE login='$login'";
			$result2= mysqli_query($connexion, $query2);
			$row2 = mysqli_fetch_array($result2);
				
			$query3="SELECT *FROM reservations WHERE id='".$row2['id']."'";
			$result3= mysqli_query($connexion, $query3);
			$resultat3=mysqli_num_rows($result3);
					
			
			$query4="UPDATE `reservations` SET `titre` ='".$_POST['titre']."', `description` ='".$_POST['description']."'  WHERE `id` ='".$_SESSION['id']."'";
			$result4= mysqli_query($connexion, $query4);
			header ('location: planning.php');
		
	}				
	else
	{
	?>

	<div class="affichage">
	<?php
	echo "*Aucune modification faite";
	?>

	</div>
	<?php
	}	
}	
if(isset($_SESSION['login'])&&($_SESSION['login']==$row1['login']))
{
?>

	<label>Login :</label>
			<input disabled="disabled" type="text" name="login" value="<?php  echo $row1['login']; ?>">
		<label>Titre :</label>	
			<input required type="text" name="titre" value="<?php  echo $row['titre']; ?>">
		<label>Description :</label>
			<textarea name="description"><?php  echo $row['description']; ?></textarea>
		<label>Début :</label>
			<input required disabled="disabled"  name="datedebut" type="datetime-local" id="meeting-time" value="<?php echo SUBSTR($row['debut'], 0, 10)?>T<?php echo SUBSTR($row['debut'], 11, 8); ?>">
			
			
			
		<label>Fin :</label>
			<input required disabled="disabled" name="datefin" type="datetime-local" id="meeting-time" value="<?php echo SUBSTR($row['fin'], 0, 10)?>T<?php echo SUBSTR($row['fin'], 11, 8); ?>">	

<?php	
	if($_SESSION['login']==$row1['login'])
	{
?>

		<input name="Modifier" type="submit" value="Modifier" />
		<input name="Supprimer" type="submit" value="Supprimer" />
	</form>
</div>

	<?php
	}
}
else
{
?>	

<form method="post">
	<label>Login :</label>
			<input disabled="disabled" type="text" name="login" value="<?php  echo $row1['login']; ?>">
		<label>Titre :</label>	
			<input disabled="disabled" required type="text" name="titre" value="<?php  echo $row['titre']; ?>">
		<label>Description :</label>
			<textarea disabled="disabled" name="description"><?php  echo $row['description']; ?></textarea>
		<label>Début :</label>
			<input disabled="disabled" required name="datedebut" type="datetime-local" id="meeting-time" value="<?php echo SUBSTR($row['debut'], 0, 10)?>T<?php echo SUBSTR($row['debut'], 11, 8); ?>">
			
			
			
		<label>Fin :</label>
			<input disabled="disabled" required name="datefin" type="datetime-local" id="meeting-time" value="<?php echo SUBSTR($row['fin'], 0, 10)?>T<?php echo SUBSTR($row['fin'], 11, 8); ?>">	
	</fieldset>
</form>
<?php
}
?>

</article>

<footer>

<p class="page">
Réservation salles &emsp;
Remy.I  Adam.T Jeremy.B ©  &emsp; 2020  &emsp; Tous droits réservés.  
</p>

</footer>

</body>

</html>
