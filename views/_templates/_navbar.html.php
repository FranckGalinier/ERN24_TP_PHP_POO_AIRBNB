<?php

use App\App;
use App\AppRepoManager;
use Core\Session\Session;


if ($auth::isAuth()) $user_id = Session::get(Session::USER)->id;
?>
<!-- logo -->
<div class="nav-logo">
  <a href="/">
    <img src="/assets/icons/Airbnb_Logo_Bélo.svg" alt="logo appli" height="50px" width="100px">
  </a>
</div>

<!--  barre de navigation -->
<div class="nav-user">
  <nav>
    <ul class="d-flex justify-content-center">
      <li><a href="/"> Logements</a></li>
    </ul>
  </nav>
</div>
 <!-- menu du profil -->
  <div class="nav-user">
    <?php if ($auth::isAuth()) : ?>
      <li> <a href="/hosting">Mode hôte</a></li>
    <?php else : ?>
      <li class=""><a href="/connexion">Mettre en ligne mon logement</a></li>
    <?php endif; ?>
  </div>

  <div class="nav-user">
    <div>

    </div>
    <nav>
      <ul>
        <li>
          <?php

          if ($auth::isAuth()) :

          ?>
         
          

            <div class="dropdown custom-link">
              <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                
                <i class="svg-nav bi bi-list"></i>
                <i class="svg-nav bi bi-person-circle"></i></a>

              <?php $user = AppRepoManager::getRm()->getUserRepository()->getUserById($user_id); ?>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <div>
                  Bonjour, <?= $user->firstname ?>  </div><hr class="dropdown-divider">
        
                  <a href="/user/reservation/<?= $user_id ?>" class="dropdown-item custom-link">Voyages</a>
                </li>
                <li>
                  <a href="/list/favoris/<?= $user_id ?>" class="dropdown-item custom-link">Favoris</a>
                </li>
                
                <li><a href="/profil/<?= $user_id ?>" class="dropdown-item custom-link">Profil</a></li>
                <li><a href="/hosting" class="dropdown-item custom-link">Gérer mes annonces</a></li>
        </li>

        <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item custom-link" href="/logout">Se Déconnecter</a></li>
        
      </ul>

  </div>
<?php else : ?>
  <div class="dropdown custom-link">
    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="svg-nav bi bi-list"></i>
      <i class="svg-nav bi bi-person-circle"></i></a>


    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
      <li><a class="dropdown-item custom-link" href="/connexion">Connexion</a></li>
      <li><a class="dropdown-item custom-link" href="/inscription">Inscription</a></li>
    </ul>
  </div>
<?php endif; ?>

</li>
</ul>

</nav>
</div>