<?php include(PATH_ROOT . 'views/_templates/_header.html.php'); ?>
<div class="admin-container">
<h1 class="title">Mes logements favoris &#x1F5A4; </h1>

<div class="d-flex justify-content-center">
  <div class="d-flex flex-row flex-wrap my-3 justify-content-center col-8">
    <?php foreach ($favoris as $favori) : ?>
      <div class="card card-hover m-2" style="width: 18rem;">
        <a href="/logement/<?= $favori->logement->id ?>">
          <div class="card-body">

            <p class="title-card"><?= $favori->logement->type_logement->label ?> &sdot; <?= $favori->logement->information->city ?></p>
            <p class="sub-title"><?= $favori->logement->title ?></p>
            <p> <span class="price-card"><?= $favori->logement->price ?>€</span> /nuit</p>
          </div>
        </a>
      </div>

    <?php endforeach ?>
  </div>
</div>
</div>
</main>