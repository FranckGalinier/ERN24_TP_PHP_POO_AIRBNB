<?php

namespace App\Repository;

use App\App;
use App\Model\Media;
use App\AppRepoManager;
use App\Model\Logement;
use App\Model\TypeLogement;
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
  public function addLogement(array $data): ?int
  {
    $query = sprintf(
      'INSERT INTO `%s` (`title`, `description`, `price`, `nb_rooms`, `nb_traveler`, `size`, `user_id`, `information_id`,`type_logement_id`) 
    VALUES (:title, :description, :price, :nb_rooms, :nb_traveler, :size, :user_id, :information_id, :type_id)',
      $this->getTableName()
    );

    $stmt = $this->pdo->prepare($query);

    if (!$stmt) return null;

    //on exécute la requete en passant les paramètres
    $stmt->execute($data);

    return $this->pdo->lastInsertId();
  }

  /**
   * méthode qui permet de récupérer les logements de l'utilisateur en cours
   * @param int $user_id
   * @return array
   */

  public function getLogementByUserId(int $id): array
  {
    //on déclare un tableau vide
    $array_result = [];
    //on crée la requête SQL
    $query = sprintf(
      'SELECT * FROM `%s` WHERE `user_id` = :id',
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
      $logement = new Logement($row_data);
      //on va hydrater les informations du logement
      $logement->information = AppRepoManager::getRm()->getInformationRepository()->getInformationByLogementId($logement->information_id);
      //ainsi qu le type de logement 
      $logement->type_logement = AppRepoManager::getRm()->getTypeLogementRepository()->getTypeByLogementId($logement->type_logement_id);
      //on stocke logement dans le tableau
      $array_result[] = $logement;
    }
    //retourne le tableau
    return $array_result;
  }

  /**
   * méthode qui permet de récupérer toutes les logements mis en ligne par les utilisateurs
   * @return array
   */
  public function getAllLogements(): array
  {
    //on déclare un tableau vide
    $array_result = [];
    //on crée la requête SQL
    $query = sprintf(
      'SELECT *
      FROM `%s`
      WHERE `is_active` = 1',
      $this->getTableName(), //correspond au %1$s
    );
    //on exécute la requête
    $stmt = $this->pdo->query($query);

    //on vérifie que la requête est bien exécutée
    if (!$stmt) return $array_result;
    
    //on récupère les données que l'on stocke dans le tableau
    while ($row_data = $stmt->fetch()) {
      //a chaque tour de boucle on instancie un objet logement
      $logement = new Logement($row_data);

      $logement->type_logement = AppRepoManager::getRm()->getTypeLogementRepository()->getTypeByLogementId($logement->type_logement_id);

      $logement->information = AppRepoManager::getRm()->getInformationRepository()->getInformationByLogementId($logement->information_id);

      //on stocke logement dans le tableau 
      $array_result[] = $logement;
    }
    //retourne le tableau
    return $array_result;
  }


  /**
   * méthode qui permet de récupérer un logement grace à son id
   * @param int $logement_id
   * @return ?Logement
   */
  public function getAnnonceById(int $logement_id): ?Logement
  {
    //on crée la requete SQL
    $q = sprintf(
      'SELECT * FROM %s WHERE `id` = :id',
      $this->getTableName()
    );

    //on prépare la requete
    $stmt = $this->pdo->prepare($q);

    //on vérifie que la requete est bien préparée
    if (!$stmt) return null;

    //on execute la requete en passant les paramètres
    $stmt->execute(['id' => $logement_id]);

    //on récupère le résultat
    $result = $stmt->fetch();

    //si je n'ai pas de résultat, je retourne null
    if (!$result) return null;

    //si j'ai un résultat, j'instancie un objet Logement
    $logement = new Logement($result);

    //on va hydrater les ingredients du logement
    $logement->equipements = AppRepoManager::getRm()->getLogement_EquipementRepository()->getEquipementByAnnonceId($logement_id);
    // //on va hydrater les médias do logement
    $logement->media = AppRepoManager::getRm()->getMediaRepository()->getMediaByAnnonceId($logement_id);

    $logement->user = AppRepoManager::getRm()->getUserRepository()->getUserById($logement->user_id);

    $logement->information = AppRepoManager::getRm()->getInformationRepository()->getInformationByLogementId($logement->information_id);

    $logement->type_logement = AppRepoManager::getRm()->getTypeLogementRepository()->getTypeByLogementId($logement->type_logement_id);
    //je retourne l'objet Logement
    return $logement;
  }

  /**
   * méthode qui permet de désactiver un logement
   * @param int $id
   * @return bool
   */
  public function DesactivationLogement(int $id): bool
  {
    //on crée la requete SQL
    $q = sprintf(
      'UPDATE `%s` SET `is_active` = 0 WHERE `id` = :id',
      $this->getTableName()
    );

    //on prépare la requete
    $stmt = $this->pdo->prepare($q);

    //on vérifie que la requete est bien préparée
    if (!$stmt) return false;

    //on execute la requete en passant les paramètres
    $stmt->execute(['id' => $id]);
    //on hydrate les autres tables pour supprimer les données liées


    //on retourne true si la requete a été exécutée
    return true;
  }

  /**
   * méthode qui va réactiover une annonce de logement
   * @param int $id
   * @return bool
   */
  public function ActivationLogement(int $id): bool
  {
    //on crée la requete SQL
    $q = sprintf(
      'UPDATE `%s` SET `is_active` = 1 WHERE `id` = :id',
      $this->getTableName()
    );

    //on prépare la requete
    $stmt = $this->pdo->prepare($q);

    //on vérifie que la requete est bien préparée
    if (!$stmt) return false;

    //on execute la requete en passant les paramètres
    $stmt->execute(['id' => $id]);

    //on retourne true si la requete a été exécutée
    return true;
  }
  /**
   *  méthode qui va ajouter l'id de la table information à information_id dans la table user
   * @param int $id
   * @return bool */
  public function insertIdInformation(int $information_id, int $user_id): bool
  {
    $query = sprintf('UPDATE %s SET `information_id` = :information_id WHERE `id` = :user_id',
      $this->getTableName());
    $stmt = $this->pdo->prepare($query);
    if (!$stmt) return false;
    $stmt->execute(['information_id' => $information_id, 'user_id' => $user_id]);
    return true;
  }
}
