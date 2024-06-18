<?php

namespace App\Repository;

use App\AppRepoManager;
use App\Model\Reservation;
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
    $sql = sprintf(
      'INSERT INTO %s (order_number, date_start, date_end, logement_id, user_id, nb_adults, nb_child, price_total)
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

    if (!$stmt) return null;

    $result = $stmt->fetchObject();

    return $result->id ?? 0;
  }

  /**
   * méthode qui permet de récupérer les réservations d'un utilisateur
   * @param int $user_id
   * @return array
   */
  public function findReservationByUser($id): array
  {
    $array_result = [];
    $query = sprintf(
      'SELECT *
      FROM `%s`
      WHERE `user_id` = :id',
      $this->getTableName()
    );
    //on prépare la requête
    $stmt = $this->pdo->prepare($query);
    //on vérifie que la requête est bien préparée
    if (!$stmt) return $array_result;
    //on exécute la requête en passant les valeurs
    $stmt->execute(['id' => $id]);
    //on récupère les données
    while ($row_data = $stmt->fetch()) {
      //a chaque tour de boucle on instancie un objet logement
      $logement = new Reservation($row_data);

      //on stocke logement dans le tableau
      $array_result[] = $logement;
    }
    //retourne le tableau
    return $array_result;
  }

  /**
   * méthode qui permet de récupérer les réservations de tout les logements d'un utilisateur
   * @param int $id
   * @return array
   */
  public function findReservationsByLogementUserId($id): array
  {
    $array_result = [];

    $query = sprintf(
      'SELECT * FROM %1$s as r
  INNER JOIN %2$s as l ON r.`logement_id` = l.`id`
  INNER JOIN %3$s as u ON l.`user_id` = u.`id`
  WHERE u. `id` = :id',
      $this->getTableName(), // correspond à la table reservation
      AppRepoManager::getRm()->getLogementRepository()->getTableName(), // correspond à la table logement
      AppRepoManager::getRm()->getUserRepository()->getTableName() // correspond à la table user
    );
    $stmt = $this->pdo->prepare($query);

    if (!$stmt) return $array_result;

    $stmt->execute(['id'=>$id]);

    while ($row_data = $stmt->fetch()) {
      $reservation = new Reservation($row_data);
      //on va hydrater l'objet logement*
      $reservation->logement = AppRepoManager::getRm()->getLogementRepository()->getAnnonceById($row_data['logement_id']);

      $array_result[] = $reservation;
    }
    return $array_result;
  }
}
