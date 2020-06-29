
<!DOCTYPE html>
<html>

<head>
<link href="planning.css" rel="stylesheet">
<meta charset= "utf-8">
<link rel="icon" href="maitre_karin_4885.jpg"/>
<div class="titre"><a href="https://fontmeme.com/fr/police-dragon-ball-z/"><img src="https://fontmeme.com/permalink/200622/6c0be20bfeaaa513d23bb960b7b3601a.png" alt="police-dragon-ball-z" border="0"></a></div>
<title>Planning</title>
</head>

<body class="planning">

<?php
session_start();

if(isset($_POST['envoyer']))
{
	$_SESSION['id']=$_POST['test'];
	header("Location: reservation.php");
}

if(isset($_POST['deco']))
{
unset($_SESSION['login']);
unset($_SESSION['password']);	
}

if(isset($_SESSION['login']))
{
?>

<header>
<main class="menu">
  <br><a href="index.php">Accueil</a></br>
  <br><a href="reservation-form.php">Réservation-form</a></br>
  <br><a href="reservation.php">Réservation</a></br>
</main>

<ul>
	<div class="form-style-4">
		<form method="post" action="planning.php">
			<input type="submit" name="deco" value="Déconnexion">
		</form>
	</div>	
</ul>
</header>

<?php
}
else
{
?>
<header>
<ul>
  <a href="index.php">Accueil</a>
  <a href="connexion.php">Connexion</a>
  <a href="inscription.php">Inscription</a>
</ul>
</header>

<?php

?>

<?php	
}

	$db=mysqli_connect("localhost","root","","reservationsalles");
	mysqli_set_charset($db, "utf8");
	$date="SELECT * FROM reservations";
	$query=mysqli_query($db, $date);
	$result=mysqli_fetch_all($query);
	
?>

<section class="tableaux">

<article class="tableplanning">
<table class="Table">
	<thead>
		<tr>
			<th>
				<div class="phototable">
				<img src="maitre_karin_4885.jpg" width=80px height=80px >
                </div>
			</th>
			<th>
				Lundi
			</th>
			<th>
				Mardi
			</th>
			<th>
				Mercredi
			</th>
			<th>
				Jeudi
			</th>
			<th>
				Vendredi
			</th>
			<th>
				Samedi
			</th>
			<th>
				Dimanche
			</th>
		</tr>
	</thead>
	<tbody>
		<?php
		
		for($ligne =8; $ligne <= 19; $ligne++ )
		{
			echo "<tr>";
			echo "<td><b>".$ligne."h</b></td>";

			for($colonne = 1; $colonne <= 7; $colonne++)
			{
				echo "<td>";
				foreach($result as $value)
				{
				$jour=date("w", strtotime($value[3]));
				$h=date("H", strtotime($value[3]));
				if($h==$ligne && $jour== $colonne)
				{
					echo $value[1];
				?>

					<form method="post">	
						<input name="envoyer" type="submit" value="Détail">
						<input name="test" type="hidden" value="<?php echo $value[0]; ?>">
					</form>	
				<?php					
				}
			}
				echo "</td>";
			}
		}
		echo "</tr>";

?>

</tbody>
		
</table>

</article>

</section>

<footer>

<p class="page">
Réservation salles &emsp;
Remy.I  Adam.T ©  &emsp; 2020  &emsp; Tous droits réservés.  
</p>

</footer>

</body>

</html>
