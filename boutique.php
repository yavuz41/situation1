<?php
	require_once('includes/header.php');

	require_once('includes/sidebar.php');


  if(isset($_GET['category'])){

    $category=$_GET['category'];
    $req = $db->query("SELECT * FROM product WHERE category='$category'");
    $articles = $req->fetchAll();


           foreach ($articles as $article): ?> 
        

          <div class="card" style="display: inline-block;margin-left: 10px; width: 20rem;">
          <img height="200" width="50" class="card-img-top" src="admin/img/<?= $article['title']?>.jpg"/>
           <div class="card-body">
           <p style="text-align: center;" class="card-text"><?= $article['title']?><br/><br/><?= $article['description']?><br/><br/>Prix : <?= $article['price']?> EUR</p>
          </div>
          </div>

              
           <?php endforeach ?>

<?php

  }else{

//DEBUT RECUPERATION DONNEES ARTICLE


		$select = $db->query("SELECT * FROM category");

    while($s = $select->fetch(PDO::FETCH_OBJ)){
    ?>
<div class="card card-nav-tabs" style="width: 20rem; display: inline-block; margin-left: 10px;"></br>
  <div class="card-header card-header-info">
    EcoBio - Catégorie
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><a href="?category=<?php echo $s->name;?>"><h3><?php echo $s->name ?></h3></a></li>

  </ul>
</div>
   
    <?php

    }

    

}
	require_once('includes/footer.php');//FIN RECUPERATION DONNEES ARTICLE 
?>

