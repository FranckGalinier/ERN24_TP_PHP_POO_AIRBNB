<?php

namespace App;

use MiladRahimi\PhpRouter\Router;
use App\Controller\AuthController;
use App\Controller\HomeController;
use App\Controller\UserController;
use App\Controller\LogementController;
use App\Controller\ReservationController;
use App\Repository\UserRepository;
use Core\Database\DatabaseConfigInterface;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use MiladRahimi\PhpRouter\Exceptions\InvalidCallableException;

class App implements DatabaseConfigInterface
{
  //on définit des constantes de la base de données
  private const DB_HOST = "database";
  private const DB_NAME = "nom_de_bdd";
  private const DB_USER = "nom_utilisateur";
  private const DB_PASS = "mdp_utilisateur";

  private static ?self $instance = null;
  //on crée une méthode public appelé au demarrage de l'appli dans index.php
  public static function getApp(): self
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  //on crée une propriété privée pour stocker le routeur
  private Router $router;
  //méthode qui récupère les infos du routeur
  public function getRouter()
  {
    return $this->router;
  }

  private function __construct()
  {
    //on crée une instance de Router
    $this->router = Router::create();
  }

  //on a 3 méthodes a définir 
  // 1. méthode start pour activer le router
  public function start(): void
  {
    //on ouvre l'accès aux sessions
    session_start();
    //enregistrements des routes
    $this->registerRoutes();
    //démarrage du router
    $this->startRouter();
  }

  //2. méthode qui enregistre les routes
  private function registerRoutes(): void
  {
    //on va définir des patterns de routes
    $this->router->pattern('id', '[0-9]\d*'); //autorise que l'id soit un nombre de 0 à 9 
    $this->router->pattern('order_id', '[0-9]\d*'); //autorise que l'id soit un nombre de 0 à 9 

    //ON ENREGISTRE LES ROUTES ICI
    $this->router->get('/', [HomeController::class, 'home']);
    
    //INFO: si on veut renvoyer une vue à l'utilisateur => route en "get"
    //INFO: si on veut traiter des données d'un formulaire => route en "post"
    //PARTIE AUTHENTIFICATION
    $this->router->get('/connexion', [AuthController::class, 'loginForm']);
    $this->router->get('/inscription', [AuthController::class, 'registerForm']);
    $this->router->get('/logout', [AuthController::class, 'logout']);

    //PARTIE Réception des données du formulaire
    $this->router->post('/login', [AuthController::class, 'login']);
    $this->router->post('/register', [AuthController::class, 'register']);

    //PARTIE USER 
    $this->router->get('/user/create-logement/{id}', [LogementController::class, 'LogementForm']);
    $this->router->post('/add-annonce-form', [LogementController::class, 'addLogement']);
    $this->router->get('/user/list-my-logement/{id}', [UserController::class, 'listlogementuser']);
    $this->router->get('/user/logement/delete/{id}', [UserController::class, 'DesactivationLogement']);
    $this->router->get('/user/logement/active/{id}', [UserController::class, 'ActivationLogement']);
    $this->router->get('/profil/{id}', [UserController::class, 'profil']);
    $this->router->get('/add_information_user/{id}', [UserController::class, 'addInformationUserForm']);
    $this->router->post('/add_info_user', [UserController::class, 'addInformationUser']); 

    //Partie Logement
    $this->router->get('/logement/{id}', [LogementController::class, 'getAnnonceById']);

    //Partie Reservation
    $this->router->post('/add/reservation', [ReservationController::class, 'addReservation']);
    $this->router->get('/user/reservation/{id}', [ReservationController::class, 'listReservationUser']);
    $this->router->get('/user/list-order/{id}', [ReservationController::class, 'listAllReservationLogementUser']);
    $this->router->get('/user/cancel-reservation/{id}', [ReservationController::class, 'cancelReservation']);
    //Partie Host
    $this->router->get('/hosting', [HomeController::class, 'hosting']);
    //partie favoris
    $this->router->get('/add-favorite/{id}', [HomeController::class, 'addFavorite']);
    $this->router->get('/delete-favorite/{id}', [HomeController::class, 'deleteFavorite']);
    $this->router->get('/list/favoris/{id}', [HomeController::class, 'listFavorisUser']);
  }

  //3. méthode qui démarre le router
  private function startRouter(): void
  {
    try {
      $this->router->dispatch();
    } catch (RouteNotFoundException $e) {
      echo $e;
    } catch (InvalidCallableException $e) {
      echo $e;
    }
  }

  public function getHost(): string
  {
    return DB_HOST;
  }

  public function getName(): string
  {
    return DB_NAME;
  }

  public function getUser(): string
  {
    return DB_USER;
  }

  public function getPass(): string
  {
    return DB_PASS;
  }
}
