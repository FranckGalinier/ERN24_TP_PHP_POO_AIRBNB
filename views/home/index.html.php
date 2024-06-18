<?php include(PATH_ROOT . 'views/_templates/_header.html.php'); ?>
<div class="d-flex justify-content-center">
    <h1>Bienvenue sur Pornhub !!</h1>
</div>

</div>
<div class="d-flex justify-content-center">
  <div class="d-flex flex-row flex-wrap my-3 justify-content-center col-lg-10">
    <?php foreach($logements as $logement): ?>
      <div class="card m-2" style="width: 18rem;">
        
        <div class="card-body">
  
          <p class="title-card"><?= $logement->type_logement->label ?> | <?= $logement->information->city ?></p>

          <p class="sub-title"><?= $logement->title?></p>
          <p<span class="title-card"><?= $logement->price ?>€</span> /nuit</p>
          <a href="/logement/<?= $logement->id?>" class="call-action">Voir les putes</a>
        </div>
      </div>
      
   
    <?php endforeach ?>
  </div>
 </div>

</main>