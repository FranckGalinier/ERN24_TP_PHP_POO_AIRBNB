    <div class="d-flex justify-content-around topbar">
      <!-- logo -->
      <div class="nav-logo">
        <a href="/">
          <!-- <img  src="/dir/vers/logo" alt="logo appli"> -->
          <h3>BNB</h3>
        </a>
      </div>

      <!--  barre de navigation -->
      <div>
        <nav>
          <ul class="d-flex justify-content-center">
            <li class="m-1"><a href="/">Accueil</a></li>
            <li class="m-1"><a href="#"></a></li>
            <li class="m-1"><a href="#">lien2</a></li>
            <li class="m-1"><a href="#">lien3</a></li>
          </ul>
        </nav>
      </div>
      <!-- menu du profil -->
      <div >
        <nav >
          <ul >
            <li >
              <?php
              use Core\Session\Session;

              if($auth::isAuth()) $user_id = Session::get(Session::USER)->id;
              if($auth::isAuth()):
?>

<div class="dropdown custom-link">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
              data-bs-toggle="dropdown" aria-expanded="false">
             Mon compte
             <i class="bi bi-person custom-svg"></i></a>
             <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li><a href="#" class="dropdown-item custom-link">Profil</a></li>
              <li><a href="/user/create-pizza/<?= $user_id ?>" class="dropdown-item custom-link">Créer une pizza</a></li>
               <li><hr class="dropdown-divider"></li>
                <li><a href="/user/list-custom-pizza/<?= $user_id ?>" class="dropdown-item custom-link">Mes pizzas</a></li>
                 <li><a href="/user/list-order/<?= $user_id ?>" class="dropdown-item custom-link">Mes commandes</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item custom-link" href="/logout"> La Déconnexion</a></li>
                </ul>
            </div>
            <?php else: ?>
              <a href="/connexion">Se connecter
                <i class="bi bi-person custom-svg"></i>
              </a>
            <?php endif; ?>

            </li>
          </ul>

        </nav>
      </div>


    </div>