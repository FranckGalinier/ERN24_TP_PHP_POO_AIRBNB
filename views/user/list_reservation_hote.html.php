<?php include(PATH_ROOT . 'views/_templates/_header_hosting.html.php'); ?>
<div class="admin-container">
  <h1 class="title">Les réservations de mes logements &#x23F0;</h1>

  <?php

  use App\Model\Order;
  use Core\Session\Session;

  $user_id = Session::get(SESSION::USER)->id;

  include(PATH_ROOT . '/views/_templates/_message.html.php')
  ?>
  <table class="table table-striped w-75 m-auto">
    <thead>
      <tr>
        <th>Numéro de commande</th>
        <th>Nom du logement (Ville)</th>
        <th>Date début</th>
        <th>Date de fin</th>
        <th>Prix</th>
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
        </tr> <?php endforeach; ?>
    </tbody>
  </table>






</div>