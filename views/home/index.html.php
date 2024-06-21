<?php include(PATH_ROOT . 'views/_templates/_header.html.php'); ?>
<div class="admin-container">

<div class="d-flex justify-content-center">
  <div class="d-flex flex-row flex-wrap my-3 justify-content-center col-8">
    <?php foreach ($logements as $logement) : ?>
      <div class="card card-hover m-2" style="width: 18rem;">
        <a href="/logement/<?= $logement->id ?>">
          <div class="card-body">

            <p class="title-card"><?= $logement->type_logement->label ?> &sdot; <?= $logement->information->city ?></p>
            <p class="sub-title"><?= $logement->title ?></p>
            <p> <span class="price-card"><?= $logement->price ?>€</span> /nuit</p>
    
          </div>
        </a>
      </div>

    <?php endforeach ?>
  </div>
</div>
</div>
</main>