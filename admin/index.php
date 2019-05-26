<?php

session_start();

	$user='yavuz'; //pseudo choisi pour admninistration
	$password_definit='1235';

	if(isset($_POST['submit'])){

		$username = $_POST['username'];
		$password = $_POST['password'];

	if($username&&$password){

		if($username==$user&&$password==$password_definit){ 

			$_SESSION['username']=$username; //session valable sur toute les pages que l'on utilise
				header('Location: admin.php');

			}else{
				echo "Identifiant erroné";
			}

			}else{

				echo "veuillez remplir tt les champs";

				}
			}



?>

<link rel="stylesheet" type="text/css" href="../style/bootstrap.css"/>
	<h1>Administration - Connexion</h1>

<form action="" method="POST">
	<h3>Pseudo :</h3><input type="text" name="username"><br/><br/>
	<h3>Mot de passe :</h3><input type="password" name="password"><br/><br/>
	<input type="submit" name="submit"><br/><br/>
</form>