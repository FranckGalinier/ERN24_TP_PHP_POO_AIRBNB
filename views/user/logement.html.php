<?php include(PATH_ROOT . 'views/_templates/_header_hosting.html.php'); ?>
<div class="admin-container">
  <h1 class="title"><?= $h1 ?></h1>
  <?php include(PATH_ROOT . 'views/_templates/_message.html.php') ?>


<?php if(empty($logements)): ?>
<div class="d-flex justify-content-center">
  <div class="d-flex flex-row flex-wrap my-3 justify-content-center col-lg-10">
    <div class="alert alert-info" role="alert"> 
      Vous n'avez pas encore de logements
    </div>
  </div>
</div>


<?php else : ?>
<!-- //ici on va afficher les pizzas -->
<div class="d-flex justify-content-center">
  <div class="d-flex flex-row flex-wrap my-3 justify-content-center col-lg-10">
    <?php foreach($logements as $logement): ?>
      <div class="card m-2" style="width: 18rem;">
      <a href="/logement/<?= $logement->id ?>">
    
        <div class="card-body">
          <p><p class="title-card"><?= $logement->type_logement->label ?> &sdot; <?= $logement->information->city ?></p></p>
          <p class="sub-title"><?= $logement->title ?></p>
          <p class="sub-title"><?= $logement->price ?> €</p>

          <div class="d-flex justify-content-center">
            <?php if($logement->is_active===false): ?>
              <a href="/user/logement/active/<?= $logement->id ?>" class="btn btn-success"><i class="bi bi-eye"></i></a>
           <?php else: ?>
              <a href="/user/logement/delete/<?= $logement->id ?>" class="btn btn-danger"><i class="bi bi-eye-slash"></i></a>
            <!-- <a onclick="return confirm('Voulez-vous vraiment supprimer ce logement ?')" 
            href="/user/logement/delete/<?= $logement->id ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a> -->
            <?php endif ?>
          </div>
        </div>
        </a>
      </div>
    <?php endforeach ?>
  </div>
</div>

<?php endif ?>
  </div>