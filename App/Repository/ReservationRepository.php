<?php

namespace App\Repository;

use Core\Repository\Repository;

class ReservationRepository extends Repository
{
  public function getTableName(): string
  {
    return 'reservation';
  }

  /**
   * méthode qui va ajoute une réservation
   * @param array $reservation_data
   * @return bool
   */
  public function addReservation(array $reservation_data): bool
  {
    $sql = sprintf('INSERT INTO %s (order_number, date_start, date_end, logement_id, user_id, nb_adults, nb_child, price_total)
    VALUES (:order_number, :date_start, :date_end, :logement_id, :user_id, :nb_adults, :nb_child, :price_total)',
      $this->getTableName()
    );
    $stmt = $this->pdo->prepare($sql);
    //si la requete n'est pas bien préparée
    if (!$stmt) return false;
    //on bind les valeurs
    //on exécute la requete en passant les paramètres
    $stmt->execute($reservation_data);

    return $this->pdo->lastInsertId();
  }

  /**
   * méthode qui permet de récupérer le numéro de la dernière commande
   * @return int
   */
  public function findLastOrder(): ?int
  {
      $query = sprintf(
        'SELECT *
        FROM `%s`
        ORDER BY id DESC LIMIT 1',
        $this->getTableName()
      );
      $stmt = $this->pdo->query($query);
  
      if(!$stmt)return null;
  
      $result = $stmt->fetchObject();
  
      return $result->id ?? 0;
   
  }
  /**
   * méthode qui permet de récupérer les réservations d'un utilisateur
   * @param int $user_id
   * @return array
   */
  public function findReservationByUser($user_id): array
  {
    $query = sprintf(
      'SELECT *
      FROM `%s`
      WHERE `user_id` = :user_id',
      $this->getTableName()
    );
    $stmt = $this->pdo->prepare($query);
    $stmt->execute(['user_id' => $user_id]);
    return $stmt->fetchAll();
  }
}