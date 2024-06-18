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
  public function getAllTypeLogement(): array
   {
    return $this->readAll(TypeLogement::class);
   }
   /**
    * méthode pour récupérer les types de logements par id
    * @param int $id
    * @return ?TypeLogement
    */
    public function getTypeByLogementId(int $id): ?TypeLogement
    {
      $query = sprintf(
        'SELECT * FROM `%s` WHERE `id` = :id',
        $this->getTableName()
      );
      $stmt = $this->pdo->prepare($query);
      if (!$stmt) return null;
      $stmt->execute(['id' => $id]);
      $result=$stmt->fetch();

      if(!$result) return null;

      $typeLogement = new TypeLogement($result);

      return $typeLogement;
      
    }
  

}