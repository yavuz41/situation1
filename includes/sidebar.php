<div class="card card-nav-tabs" style="float:right;text-align: center;width: 15rem;">
  <div class="card-header card-header-info">
    <h3>Derniers articles</h3></br>
  </div>

  <?php 
	  $req = $db->query("SELECT * FROM product ORDER BY id DESC LIMIT 0,3");
	
	$articles = $req->fetchAll();

				
foreach ($articles as $article): ?> 

		

  <ul class="list-group list-group-flush">
    <li class="list-group-item"><?= $article['title']?><br/><br/>Prix : <?= $article['price']?> EUR</p></h5></li>
    
    
  </ul>


	
  <?php endforeach ?>


	

</div>
