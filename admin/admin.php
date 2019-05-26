<?php

	session_start();
?>

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <!-- Material Kit CSS -->
        <link href="assets/css/material-kit.css?v=2.0.5" rel="stylesheet" />
        <link href="assets/css/page.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/css/shop.css">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<h1>Bienvenue, <?php echo $_SESSION['username']; ?></h1>
<br/>
<a href="?action=add">Ajouter un produit</a><br/><br/>
<a href="?action=modifyanddelete">Modifier / Supprimer un produit</a><br/>

<a href="?action=add_category">Ajouter une catégorie</a><br/><br/>
<a href="?action=modifyanddelete_category">Modifier / Supprimer une catégorie</a><br/>


<?php
	try{
		$db = new PDO('mysql:host=yavnetfrulsql.mysql.db;dbname=yavnetfrulsql', 'yavnetfrulsql', 'Yavtestbdd1');
		$db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER); //le noms des champs seront en minuscule
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	//erreurs lancent exception
	} 
	catch(Exception $e){

	echo'Une erreur est survenue lors de la connexion à la base de données';
	die();
	}



	if(isset($_SESSION['username'])){

		if(isset($_GET['action'])){

			if($_GET['action']=='add'){ //ajouter produit

				if(isset($_POST['submit'])){

				$title=$_POST['title'];
				$description=$_POST['description'];
				$price=$_POST['price'];
				$category=$_POST['category'];
				echo $title, $description, $price, $category;
				
				//Ajouter une image
				$img = $_FILES['img']['name']; //tableau multidimensionnel
				$image_tmp = $_FILES['img']['tmp_name']; //stockage temporaire
				if (!empty($image_tmp)){

					$image = explode('.', $img);

					$image_ext = end($image); //extension de l'image

						if(in_array(strtolower($image_ext), array('png','jpg','jpeg')) === false){ //tester si on a insérer une image
							echo "Extensions acceptées : .PNG, .JPG ou JPEG";

						}else{

							$image_size = getimagesize($image_tmp); // s'assurer que le fichier est bien une image et éviter toute tentative d'intrusion // Début

							if($image_size['mime']=='image/jpeg'){

								$image_src = imagecreatefromjpeg($image_tmp);
							}

							elseif($image_size['mime']=='image/png'){

								$image_src = imagecreatefrompng($image_tmp);
							
							}else{

								$image_src = false;
								echo "Veuillez insérer une image valide"; // s'assurer que le fichier est bien une image et éviter toute tentative d'intrusion // FIN
							}

							if ($image_src!==false){

								$image_width = 200;
								if ($image_size[0]==$image_width){
									$image_finale = $image_src;

								}else{
									$new_witdh[0] = $image_width;
									$new_height[1] = 200;
									$image_finale = imagecreatetruecolor($new_witdh[0], $new_height[1]);
									imagecopyresampled($image_finale, $image_src, 0, 0, 0, 0, $new_witdh[0], $new_height[1], $image_size[0], $image_size[1]);
									// s'assurer que le fichier est bien une image et éviter toute tentative d'intrusion // FIN

								}	

									imagejpeg($image_finale,'img/'.$title.'.jpg');
								}

							}


						


					}else{
						echo "Veuillez insérer une image";
						}


					//INSERTION DE DONNEES
					if($title&&$description&&$price){				
						$insert = $db->prepare("INSERT INTO product (title, description, price, category) VALUES (?,?,?,?)");
						$insert->bindParam(1, $title);
						$insert->bindParam(2, $description);
						$insert->bindParam(3, $price);
						$insert->bindParam(4, $category);

						$insert->execute();

					}else{
						echo "Veuillez remplir tout les champs";
					}
				}

			?>

						<form action="" method="post" enctype="multipart/form-data">
						<h3>Titre du produit</h3><input type="text" name="title"/>
						<h3>Description du produit</h3><textarea name="description"/></textarea>
						<h3>Prix</h3><input type="text" name="price"/><br/><br/>
						<input type="file" name="img"/><br/><br/>
						<h3>Catégorie </h3>
							<select name="category"><?php $select=$db->query("SELECT * FROM category");
							while ($s = $select->fetch(PDO::FETCH_OBJ)) {
								?>

								<option><?php echo $s->name; ?></option>

								<?php

								}
							?>



							</select>					
						<input type="submit" name="submit"/>
						</form>

			<?php

			}elseif ($_GET['action']=='modifyanddelete') { //modifier et suppr
				$select = $db->prepare("SELECT * FROM product");
				$select->execute();
				
				while($s=$select->fetch(PDO::FETCH_OBJ)){ //tant qu'il y a des données à afficher
					
					echo $s->title;	// affiche les articles et les liens pour suppr ou modifier
					?>
					<a href="?action=modify&amp;id=<?php echo $s->id; ?>">Modifier</a>
					<a href="?action=delete&amp;id=<?php echo $s->id; ?>">X</a><br/><br/>
					<?php


				}


			}elseif ($_GET['action']=='modify') { //modifier produit : update dans la BDD suivant ce qui est rentré

					

					$id=$_GET['id']; //on recupere id dans l'URL

					$select = $db->prepare("SELECT * FROM product WHERE id=$id"); //id egal a l'id dans l'URL
					$select->execute();

					$data = $select->fetch(PDO::FETCH_OBJ);

					?>
					<form action="" method="post">
					<h3>Titre du produit</h3><input value="<?php echo $data->title?>"type="text" name="title"/>
					<h3>Description du produit</h3><textarea name="description"/><?php echo $data->description?></textarea>
					<h3>Prix</h3><input value="<?php echo $data->price?>" type="text" name="price"/><br/><br/>
					<input type="submit" name="submit" value="Modifier" /> 
					</form>



			<?php

			if(isset($_POST['submit'])){ //si la personne clique sur le bouton 
						$title=$_POST['title'];
						$description=$_POST['description'];
						$price=$_POST['price']; 

						$update= $db->prepare("UPDATE product SET title='$title', description='$description', price='$price' WHERE id=$id");
						$update->execute();

						header('Location: admin.php?action=modifyanddelete');// pour revenir dans la page de modification...........
					}

	 
			}elseif ($_GET['action']=='delete') { //suppr produit

				$id=$_GET['id'];
				$delete = $db->prepare("DELETE FROM product WHERE id=$id");
				$delete->execute();
				header('Location: admin.php?action=modifyanddelete');


				// AJOUTER UNE CATéGORIE
			}else if($_GET['action']=='add_category'){

				if (isset ($_POST['submit'])) {
					$name = $_POST['name'];

					if($name){

						$insert = $db->prepare("INSERT INTO category (name) VALUES (?)");
						
						$insert->bindParam(1, $name);
						$insert->execute();


					}else{
						echo "Veuillez remplir tous les champs";
					}
					
				}
				// FIN AJOUTER UNE CATéGORIE
				?>

				<form action="" method="post">
					<h3>Nom de la catégorie :</h3>
				<input type="text" name="name"/>
				<input type="submit" name="submit" value="Ajouter" />
				</form>



				<?php


			}else if($_GET['action']=='modifyanddelete_category'){ // MODIFIER SUPPRIMER CATGEORIE
				$select = $db->prepare("SELECT * FROM category");
				$select->execute();
				
				while($s=$select->fetch(PDO::FETCH_OBJ)){ //tant qu'il y a des données à afficher
					
					echo $s->name;	// affiche les catégories pour suppr ou modifier
					?>
					<a href="?action=modify_category&amp;id=<?php echo $s->id; ?>">Modifier</a><!--lien pour modifier -->
					<a href="?action=delete_category&amp;id=<?php echo $s->id; ?>">X</a><br/><br/> <!--lien pour suprr -->
					<?php


				}

				}else if($_GET['action']=='modify_category'){ // MODIFIER LA CATEGORIE

					$id=$_GET['id']; //on recupere id dans l'URL

					$select = $db->prepare("SELECT * FROM category WHERE id=$id"); //id egal a l'id dans l'URL
					$select->execute();

					$data = $select->fetch(PDO::FETCH_OBJ);

					?>
					<form action="" method="post">
					<h3>Nom de la catégorie</h3><input value="<?php echo $data->name;?>"type="text" name="title"/>
					<input type="submit" name="submit" value="Modifier" /> 
					</form>
					<!-- Fin MODIFIER LA CATEGORIE-->

			<?php

			if(isset($_POST['submit'])){ //si la personne clique sur le bouton 
						$title=$_POST['title'];

						$update= $db->prepare("UPDATE category SET name='$title' WHERE id=$id");
						$update->execute();

						header('Location: admin.php?action=modifyanddelete_category');// pour revenir dans la page de modification...........
					}




				}else if($_GET['action']=='delete_category'){ // SUPPRIMER CATGEORIE
					
					$id=$_GET['id'];
					$delete = $db->prepare("DELETE FROM category WHERE id=$id");
					$delete->execute(); 

					header('Location: admin.php?action=modifyanddelete_category');


 
				}else{

				die ('Une erreur s\'est produite');
			
			}


			}else{


			}

			}else{

			header('Location: ../index.php');
			}




?>
