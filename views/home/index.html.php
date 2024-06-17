<div class="d-flex justify-content-center">
    <h1>Bienvenue sur Airbnb !!</h1>
</div>

</div>
<div class="d-flex justify-content-center">
  <div class="d-flex flex-row flex-wrap my-3 justify-content-center col-lg-10">
    <?php foreach($logements as $logement): ?>
      <div class="card m-2" style="width: 18rem;">
        <div class="card-body">
        <?php foreach($typelogements as $typelogement): ?>

          <p><?= $typelogement->label ?></p>

          <p class="sub-title"><?= $logement->title?></p>
          <p><?= $logement->price ?>€ /nuit</p>
          <a href="/logement/<?= $logement->id ?>" class="call-action">Voir détail</a>
        </div>
      </div>
      
    <?php endforeach ?>
    <?php endforeach ?>
  </div>
 </div>

</main>