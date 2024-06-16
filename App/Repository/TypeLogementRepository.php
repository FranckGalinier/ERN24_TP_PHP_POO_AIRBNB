<?php

namespace App\Repository;

use App\AppRepoManager;
use App\Model\TypeLogement;
use Core\Repository\Repository;

class TypeLogementRepository extends Repository
{
  public function getTableName(): string
  {
    return 'typeLogement';
  }

  /**
   * méthode pour récupérer les Types de logements actifs
   * @return array
   */
  public function getAllTypeLogement():array
   {
    return $this->readAll(TypeLogement::class);
   }

}