<?php

namespace App\Repository;

use App\Model\Media;
use App\AppRepoManager;
use App\Model\Logement;
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
      'SELECT * FROM `%s` WHERE `user_id` = :id ',
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
      FROM `%s`',
      $this->getTableName(), //correspond au %1$s//correspond au %2%s
    );
    //on exécute la requête
    $stmt = $this->pdo->query($query);

    //on vérifie que la requête est bien exécutée
    if (!$stmt) return $array_result;
    //on récupère les données que l'on stocke dans le tableau
    while ($row_data = $stmt->fetch()) {
      //a chaque tour de boucle on instancie un objet logement
      $array_result[] = new Logement($row_data);
    }
    //retourne le tableau
    return $array_result;
  }

  /*---------------------------- FUNCTION SQL RECUP ANNONCES ID ------------------------*/
  /**
   * méthode qui permet de récupérer une pizza grace à son id
   * @param int $pizza_id
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

    //si j'ai un résultat, j'instancie un objet Pizza
    $logement = new Logement($result);

    //on va hydrater les ingredients de la pizza
    $logement->equipements = AppRepoManager::getRm()->getLogement_EquipementRepository()->getEquipementByAnnonceId($logement_id);
    //on va hydrater les médias do logement
    $logement->media = AppRepoManager::getRm()->getMediaRepository()->getMediaByAnnonceId($logement_id);

    $logement->user = AppRepoManager::getRm()->getUserRepository()->getUserById($logement->user_id);
    //je retourne l'objet Pizza
    return $logement;
  }
}
