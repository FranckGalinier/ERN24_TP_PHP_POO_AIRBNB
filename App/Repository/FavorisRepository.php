<?php

namespace App\Repository;

use App\App;
use App\AppRepoManager;
use App\Model\Favoris;
use Core\Repository\Repository;

class FavorisRepository extends Repository
{

  public function getTableName(): string
  {
    return 'favoris';
  }
  /**
   * métgohde qui va permettre d'ajouter un favoris
   * @param int $user_id, int $logement_id
   * @return bool
   */
  public function addFavorite(int $user_id, int $logement_id):bool
  {
    $query = sprintf('INSERT INTO %s (`user_id`, `logement_id`) VALUES (:user_id, :logement_id)',
     $this->getTableName());
    $stmt = $this->pdo->prepare($query);
    if (!$stmt) return false;
    return $stmt->execute(['user_id' => $user_id, 'logement_id' => $logement_id]);
  }
  
  /**
   * méthode qui va permettre de récupérer les favoris d'un utilisateur
   * @param int $user_id
   * @return ?array
   */
  public function getFavorisByUserId(int $user_id): ?array
  {
    $array_result = [];
    $query = sprintf(
      'SELECT * FROM `%s` WHERE `user_id` = :user_id',
      $this->getTableName()
    );
    $stmt = $this->pdo->prepare($query);
    if (!$stmt) return $array_result;

    $stmt->execute(['user_id' => $user_id]);
    //on récupère les données

    while ($result = $stmt->fetch()) {
      //a chaque tour de boucle on instancie un objet logement
      $favoris = new Favoris($result);
      //on va hydrater l'objet logement
      $favoris->logement = AppRepoManager::getRm()->getLogementRepository()->getAnnonceById($favoris->logement_id);
      $array_result[] = $favoris;
    }
    //on stocke logement dans le tablea
    //retourne le tableau
    return $array_result;

  }

  /**
   * méthode qui va permettre de vérifier si un logement est dans les favoris
   * @param int $user_id, int $logement_id
   * @return bool
   */
  public function isFavorite(int $user_id, int $logement_id):bool{
    $query = sprintf('SELECT * FROM %s WHERE `user_id` = :user_id AND `logement_id` = :logement_id',
     $this->getTableName());
    $stmt = $this->pdo->prepare($query);
    if (!$stmt) return false;
    $stmt->execute(['user_id' => $user_id, 'logement_id' => $logement_id]);
    return $stmt->fetch() !== false;
  }

  /**
   * méthode qui va permettre de supprimer un favoris
   * @param int $user_id, int $logement_id
   * @return bool
   */
  public function deleteFavorite(int $user_id, int $logement_id):bool{
    $query = sprintf('DELETE FROM %s WHERE `user_id` = :user_id AND `logement_id` = :logement_id',
     $this->getTableName());
    $stmt = $this->pdo->prepare($query);
    if (!$stmt) return false;
    return $stmt->execute(['user_id' => $user_id, 'logement_id' => $logement_id]);
  }
}