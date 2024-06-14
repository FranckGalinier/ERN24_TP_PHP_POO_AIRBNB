<?php

namespace App\Repository;

use App\Model\Equipement;
use Core\Repository\Repository;

class EquipementRepository extends Repository
{
  public function getTableName(): string
  {
    return 'equipements';
  }

  /**
   * méthode qui va récupérer tout les équipements
   * @return array
   */
  public function getAllEquipement():array
  {
    return $this->readAll(Equipement::class);
  }
}
