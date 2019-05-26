<?php

	session_start();


	try{

		$db = new PDO('mysql:host=yavnetfrulsql.mysql.db;dbname=yavnetfrulsql', 'yavnetfrulsql', 'Yavtestbdd1');
		$db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER); //le noms des champs seront en minuscule
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	//erreurs lancent exception
	}


	catch(Exception $e){
		echo'Une erreur est survenue lors de la connexion à la base de données';
		die();
	}

?>


<!DOCTYPE html>
<html>
	<head>
		 <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <!-- Material Kit CSS -->
        <link href="assets/css/material-kit.css?v=2.0.5" rel="stylesheet" />
        <link href="assets/css/page.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/css/shop.css">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	</head>
	<header>
		  <nav>
    <div class="navbar navbar-expand-lg bg-info">
  <!-- Navbar content -->
   <div class="container">
    <a class="navbar-brand" href="#">Site EcoBio</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="sr-only">Toggle navigation</span>
    <span class="navbar-toggler-icon"></span>
    <span class="navbar-toggler-icon"></span>
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="boutique.php">Boutique</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Panier</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cgu.php">Condition Générales de Vente</a>
        </li>
       <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown link
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>-->
      </ul>
    </div>
  </div>
</nav>
	</header>
	  <body>
         <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
         <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
         <script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
         <script src="assets/js/plugins/moment.min.js"></script>
         <!--Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
          <script src="assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
          <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
          <script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
          <!-- Place this tag in your head or just before your close body tag. -->
          <script async defer src="https://buttons.github.io/buttons.js"></script>
          <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
          <script src="assets/js/material-kit.js?v=2.0.5" type="text/javascript"></script>
            </body>
</html>


