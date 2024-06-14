<?php

namespace App\Repository;

use Core\Repository\Repository;

class LogementRepository extends Repository
{
  public function getTableName(): string
  {
    return 'logement';
  }

  /**
   * méthode qui va insérer un logement
   * @param array $data
   * @return ?int
   */
  public function addLogement(array $data):?int
  {
    $query = sprintf('INSERT INTO `%s` (`title`, `description`, `price`, `nb_rooms`, `nb_traveler`, `size`,`user_id`,̀`information_id`) 
    VALUES (:title, :description, :price, :nb_rooms, :nb_traveler, :size, :user_id, :information_id)',
    $this->getTableName());

    $stmt = $this->pdo->prepare($query);

      if(!$stmt)return null;

      //on exécute la requete en passant les paramètres
      $stmt->execute($data);

      return $this->pdo->lastInsertId();
  }
}