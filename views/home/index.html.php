<div class="d-flex justify-content-center">
    <h1>Bienvenue sur Airbnb !!</h1>
</div>

</div>
<div class="d-flex justify-content-center">
  <div class="d-flex flex-row flex-wrap my-3 justify-content-center col-lg-10">
    <?php foreach($logements as $logement): ?>
      <div class="card m-2" style="width: 18rem;">
        <a href="/pizza/<?= $logement->id ?>">
        </a>
        <div class="card-body">
          <h3 class="card-title sub-title text-center"><?= $logement->title ?></h3>
          <p><?= $logement->price ?></p>
        </div>
      </div>
    <?php endforeach ?>
  </div>