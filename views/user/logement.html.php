<div class="admin-container">
  <h1><?= $h1 ?></h1>
  <?php include(PATH_ROOT . 'views/_templates/_message.html.php') ?>
</div>

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
        <label href="/logement/<?= $logement->id ?>"> <!-- doit enovoyer sur le détail du logement -->
    
        <div class="card-body">
          <h3 class="card-title sub-title text-center"> <?= $logement->title ?></h3>
          <p><?= $logement->price ?> €</p>
          <a href="/logement/<?= $logement->id ?>" class="call-action">Voir détail</a>
          <div class="d-flex justify-content-center">
            <a onclick="return confirm('Voulez-vous vraiment supprimer ce logement ?')" 
            href="/user/pizza/delete/<?= $logement->id ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
          </div>
        </div>
      </div>
    <?php endforeach ?>
  </div>
</div>

<?php endif ?>