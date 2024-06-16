<?php

namespace App\Repository;

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
  public function addLogement(array $data):?int
  {
    $query = sprintf('INSERT INTO `%s` (`title`, `description`, `price`, `nb_rooms`, `nb_traveler`, `size`, `user_id`, `information_id`,`type_logement_id`) 
    VALUES (:title, :description, :price, :nb_rooms, :nb_traveler, :size, :user_id, :information_id, :type_id)',
    $this->getTableName());

    $stmt = $this->pdo->prepare($query);

      if(!$stmt)return null;

      //on exécute la requete en passant les paramètres
      $stmt->execute($data);

      return $this->pdo->lastInsertId();
  }

  /**
   * méthode qui permet de récupérer les logements de l'utilisateur en cours
   * @param int $user_id
   * @return array
   */
    
   public function getLogementByUserId(int $user_id): array
   {
     //on déclare un tableau vide
     $array_result = [];
     //on crée la requête SQL
     $query = sprintf(
       'SELECT * FROM `%s` WHERE `user_id` = :user_id ',
       $this->getTableName()
     );
     //on prépare la requête
     $stmt = $this->pdo->prepare($query);
     //on vérifie que la requête est bien préparée
     if(!$stmt) return $array_result;
     //on exécute la requête en passant les valeurs
     $stmt->execute(['user_id'=>$user_id]);
     //on récupère les données
     while($row_data = $stmt->fetch()){
       //a chaque tour de boucle on instancie un objet pizza
       $logement = new Logement($row_data);
       //on va hydrater les ingredients de la pizza
      //  $pizza->ingredients = AppRepoManager::getRm()->getPizzaIngredientRepository()->getIngredientsByPizzaId($pizza->id);
      //  //on va hydrater les prix de la pizza
      //  $pizza->prices = AppRepoManager::getRm()->getPriceRepository()->getPriceByPizzaId($pizza->id);
       //on stocke la pizza dans le tableau
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
      FROM %1$s as l
      INNER JOIN %2$s as u ON l.`user_id` = u.`id`
      WHERE u.`is_active` =1',
      $this->getTableName(),//correspond au %1$s
      AppRepoManager::getRm()->getUserRepository()->getTableName()//correspond au %2%s
    );
    //on exécute la requête
    $stmt = $this->pdo->query($query);

    //on vérifie que la requête est bien exécutée
    if(!$stmt) return $array_result;
    //on récupère les données que l'on stocke dans le tableau
    while($row_data =$stmt->fetch()){
      //a chaque tour de boucle on instancie un objet logement
      $array_result[] = new Logement($row_data);
    }
    //retourne le tableau
    return $array_result;
  }
}