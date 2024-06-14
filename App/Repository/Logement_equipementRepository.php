<?php

namespace App\Repository;

use Core\Repository\Repository;

class Logement_equipementRepository extends Repository
{
  public function getTableName(): string
  {
    return 'logement_equipement';
  }

  /**
   * méthode sui permet d'ajouter les équipements d'un logement
   * @param array $data
   * @return bool
   */
  public function insertLogementEquipement(array $data):bool
  {
    $query = sprintf('INSERT INTO `%s` (`logement_id`, `equipement_id`) VALUES ( :logement_id, : equipement_id)',
    $this->getTableName());

    $stmt = $this->pdo->prepare($query);

      if(!$stmt)return false;

      //on exécute la requete en passant les paramètres
      $stmt->execute($data);
      //on regarder si on a au moins une ligne qui a été ionsérere
      return $stmt->rowCount() > 0;
  }
}