<?php

namespace App\Repository;

use App\Model\Media;
use App\Model\Logement;
use Core\Repository\Repository;

class MediaRepository extends Repository
{
  public function getTableName(): string
  {
    return 'media';
  }

  /**
   * méthode qui va récupérer une image en fonction de son id
   * @param int $id
   * @return ?array
   */
  public function getMediaByAnnonceId(int $id): ?array
  {
    $array_result = [];
    $query = sprintf(
      'SELECT * FROM `%s` WHERE `logement_id` = :id',
      $this->getTableName()
    );
    $stmt = $this->pdo->prepare($query);
    if (!$stmt) return $array_result;

    $stmt->execute(['id' => $id]);
    //on récupère les données

    while ($result = $stmt->fetch()) {
      //a chaque tour de boucle on instancie un objet logement
      $logement = new Media($result);
      $array_result[] = $logement;
    }
    //on stocke logement dans le tablea
    //retourne le tableau
    return $array_result;
  }

  /**
   * méthode pour insérer une image en fonction de l'id du logement
   * @param array $data
   * @return bool
   */
  public function insertMedia(array $data): bool
  {
    $query = sprintf(
      'INSERT INTO `%s` (`logement_id`, `image_path`, `is_active`, `label`) VALUES (:logement_id, :image_path, :is_active, :label)',
      $this->getTableName()
    );
    $stmt = $this->pdo->prepare($query);
    if (!$stmt) return false;
    return $stmt->execute($data);
  }
}
