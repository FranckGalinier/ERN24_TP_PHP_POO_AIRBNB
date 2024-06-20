<?php

namespace App\Repository;

use App\Model\User;
use App\AppRepoManager;
use App\Model\Logement;
use App\Model\Information;
use Core\Repository\Repository;

class UserRepository extends Repository
{
  public function getTableName(): string
  {
    return 'user';
  }

  /**
   * méthode qui va permettre de récupérer un utilisateur en fonction de son email
   * @param string $email
   * @return User|null
   */
  public function findUserByEmail(string $email): ?User
  {
    $q = sprintf(
      'SELECT * FROM %s WHERE email = :email',
      $this->getTableName()
    );

    //on prépare la requête
    $stmt = $this->pdo->prepare($q);
    //on vérifie que la requête est bien préparée
    if (!$stmt) return null;
    //si tout est ok, on bind les valeurs
    //ici on a pas beaucoup de paramètres, du coup on peut exécuter la requête en une seule fois
    $stmt->execute(['email' => $email]);

    while ($result = $stmt->fetch()) {
      $user = new User($result);
    }

    return $user ?? null;
  }

  /**
   * méthode pour ajouter un utilisateur
   * 
   */
  public function addUser(array $data): ?User
  {
    //on crée un tableau pour que le client ne soit pas admin et soit actif
    $data_more = [
      'is_active' => 1,
      'is_verified' => 0,
    ];
    //on fusionne les deux tableaux
    $data = array_merge($data, $data_more);

    //on crée notre requête SQL pour ajouter un utilisateur
    $query = sprintf(
      'INSERT INTO %s (`email`, `password`, `firstname`, `lastname`, `is_active`, `is_verified`) 
    VALUES (:email, :password, :firstname, :lastname, :is_active, :is_verified)',
      $this->getTableName()
    );
    //on prépare la requête
    $stmt = $this->pdo->prepare($query);
    //on vérifie que la requête est bien préparée
    if (!$stmt) return null;
    //on exécute la requête en passant les valeurs
    $stmt->execute($data);

    //on récupère l'id de l'utilisateur fraichement créée
    $id = $this->pdo->lastInsertId();
    //On peux retourner l'objet user grace à la méthode readById
    return $this->readById(User::class, $id);
  }


  /**
   * méthode qui permet de récupérer un logement grace à son id
   * @param int $user_id
   * @return ?user
   */
  public function getUserById(int $user_id): ?User
  {
    //on crée la requete SQL
    $q = sprintf(
      'SELECT * FROM %s WHERE `id` = :user_id',
      $this->getTableName()
    );

    //on prépare la requete
    $stmt = $this->pdo->prepare($q);

    //on vérifie que la requete est bien préparée
    if (!$stmt) return null;

    //on execute la requete en passant les paramètres
    $stmt->execute(['user_id' => $user_id]);

    //on récupère le résultat
    $result = $stmt->fetch();

    //si je n'ai pas de résultat, je retourne null
    if (!$result) return null;

    //si j'ai un résultat, j'instancie un objet User
    $user = new User($result);
    //on hydrate la table information
    $user->information = AppRepoManager::getRm()->getInformationRepository()->getInformationByLogementId($user->id);

    //je retourne l'objet Pizza
    return $user;
  }

  /**
   * méthode qui va permettre de récupérer les informations d'un utilisateur
   * @param int $id
   * @return ?Information
   */
  public function getInformationByUserId(int $id): ?Information
  {
    $query = sprintf('SELECT * FROM %1$s u INNER JOIN %2$s as i on i.id = u.information_id WHERE `id` = :id',
      $this->getTableName(),
      AppRepoManager::getRm()->getInformationRepository()->getTableName());
    $stmt = $this->pdo->prepare($query);
    if (!$stmt) return null;
    $stmt->execute(['id' => $id]);
    $result = $stmt->fetch();

    if (!$result) return null;

    $information = new Information($result);

    return $information;
  }

  /**
   * méthode qui va permettre d'ajouter'les informations d'un utilisateur
   * @param int $id
   * @return ?Information
   */
  public function addInformationUser(array $information): ?bool
  {
    $query = sprintf('INSERT INTO %1$s as i (`address`, `city`, `zip_code`, `country`, `phone`)
    VALUES (:address, :city, :zip_code, :country, :phone)',
      AppRepoManager::getRm()->getInformationRepository()->getTableName());
    $stmt = $this->pdo->prepare($query);
    if (!$stmt) return null;
    $stmt->execute([
      'address' => $information['address'],
      'city' => $information['city'],
      'zip_code' => $information['zip_code'],
      'country' => $information['country'],
      'phone' => $information['phone']
    ]);
    

  }
}
