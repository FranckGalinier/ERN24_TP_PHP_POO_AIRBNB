<?php

namespace App\Repository;

use Core\Repository\Repository;

class Logement_equipementRepository extends Repository
{
  public function getTableName(): string
  {
    return 'logement_equipement';
  }
}