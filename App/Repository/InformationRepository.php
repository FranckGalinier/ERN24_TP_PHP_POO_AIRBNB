<?php

namespace App\Repository;

use Core\Repository\Repository;

class InformationRepository extends Repository
{
  public function getTableName(): string
  {
    return 'information';
  }
  /**
   * méthode qui va permettre d'ajouter des addresses
   * @param array $data
   * @return ?int
   */
  public function insertInformation(array $data):?int
  {
    $query = sprintf('INSERT INTO `%s` (`address`, `zip_code`, `city`, `country`, `phone`) VALUES (:address, :zip_code, :city, :country, :phone)',
    $this->getTableName());
    $stmt = $this->pdo->prepare($query);

      if(!$stmt)return null;

      //on exécute la requete en passant les paramètres
      $stmt->execute($data);
      //on regarder si on a au moins une ligne qui a été ionsérere
      return $this->pdo->lastInsertId();
  }
}