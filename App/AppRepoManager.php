<?php

namespace App;

use App\Model\Media;
use App\Repository\UserRepository;
use App\Repository\MediaRepository;
use App\Repository\FavorisRepository;
use App\Repository\LogementRepository;
use App\Repository\EquipementRepository;
use App\Repository\InformationRepository;
use App\Repository\ReservationRepository;
use App\Repository\TypeLogementRepository;
use Core\Repository\RepositoryManagerTrait;
use App\Repository\Logement_equipementRepository;

class AppRepoManager
{
  //on récupère le trait RepositoryManagerTrait
  use RepositoryManagerTrait;

  //on déclare une propriété privée qui va contenir une instance du repository
  // exemple: private Repository $Repository;
  private EquipementRepository $EquipementRepository;
  private InformationRepository $InformationRepository;
  private Logement_equipementRepository $Logement_equipementRepository;
  private LogementRepository $LogementRepository;
  private MediaRepository $MediaRepository;
  private ReservationRepository $ReservationRepository;
  private TypeLogementRepository $TypeLogementRepository;
  private UserRepository $UserRepository;
  private FavorisRepository $FavorisRepository;


  //on crée ensuite les getter pour accéder à la propriété privée
  //exemple: public function getRepository(): Repository
  //{
  //  return $this->Repository;
  //}
  public function getEquipementRepository(): EquipementRepository
  {
    return $this->EquipementRepository;
  }

  public function getInformationRepository(): InformationRepository
  {
    return $this->InformationRepository;
  }

  public function getLogement_equipementRepository(): Logement_equipementRepository
  {
    return $this->Logement_equipementRepository;
  }

  public function getLogementRepository(): LogementRepository
  {
    return $this->LogementRepository;
  }

  public function getMediaRepository(): MediaRepository
  {
    return $this->MediaRepository;
  }

  public function getReservationRepository(): ReservationRepository
  {
    return $this->ReservationRepository;
  }

  public function getTypeLogementRepository(): TypeLogementRepository
  {
    return $this->TypeLogementRepository;
  }

  public function getUserRepository(): UserRepository
  {
    return $this->UserRepository;
  }
  public function getFavorisRepository(): FavorisRepository
  {
    return $this->FavorisRepository;
  }


  //enfin, on declare un construct qui va instancier les repositories
  protected function __construct()
  {
    $config = App::getApp();
    //on instancie le repository
    //exemple: $this->Repository = new Repository($config);
    $this->EquipementRepository = new EquipementRepository($config);
    $this->InformationRepository = new InformationRepository($config);
    $this->Logement_equipementRepository = new Logement_equipementRepository($config);
    $this->LogementRepository = new LogementRepository($config);
    $this->MediaRepository = new MediaRepository($config);
    $this->ReservationRepository = new ReservationRepository($config);
    $this->TypeLogementRepository = new TypeLogementRepository($config);
    $this->UserRepository = new UserRepository($config);
    $this->FavorisRepository = new FavorisRepository($config);
    
  }
}
