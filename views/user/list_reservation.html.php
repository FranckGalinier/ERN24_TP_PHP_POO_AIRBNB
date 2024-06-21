
<?php include(PATH_ROOT . 'views/_templates/_header.html.php'); ?>
<div class="admin-container">
  <h1 class="title">Mes réservations &#x23F0;</h1>

  <?php

  use App\Model\Order;
  use Core\Session\Session;
  $user_id = Session::get(SESSION::USER)->id;

  include(PATH_ROOT . '/views/_templates/_message.html.php');

   if(empty($reservations)): ?>
    <div class="d-flex justify-content-center">
      <div class="d-flex flex-row flex-wrap my-3 justify-content-center col-lg-10">
        <div class="alert alert-info" role="alert"> 
          Vous n'avez pas encore de réservation
        </div>
      </div>
    </div>
    
    
    <?php else: ?>
  <table class="table table-striped w-75 m-auto">
    <thead>
      <tr>
        <th class="footer-description">Numéro de commande</th>
        <th class="footer-description">Nom du logement (Ville)</th>
        <th class="footer-description">Date début</th>
        <th class="footer-description">Date de fin</th>
        <th class="footer-description">Prix</th>
        <th>Annulez la réservation</th>
      </tr>
    </thead>
    <tbody>

      <?php foreach ($reservations as $row) : ?>
        <tr>
          <td class="footer-description"><?= $row->order_number ?></td>
          <td class="footer-description"><?= $row->logement->title ?> (<?= $row->logement->information->city ?>)</td>
          <td class="footer-description"><?= $row->date_start ?></td>
          <td class="footer-description"><?= $row->date_end ?></td>
          <td class="footer-description"><?= $row->price_total ?> €</td>
          <td>
            <a href="/user/cancel-reservation/<?= $row->id ?>" class="btn btn-danger">Annuler</a>
          </td>
        </tr> <?php endforeach; ?>
    </tbody>
  </table>

<?php endif ?>




</div>