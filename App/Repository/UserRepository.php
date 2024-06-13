<?php

namespace App\Repository;

use App\Model\User;
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
    $q = sprintf('SELECT * FROM %s WHERE email = :email',
    $this->getTableName());

    //on prépare la requête
    $stmt = $this->pdo->prepare($q);
    //on vérifie que la requête est bien préparée
    if(!$stmt) return null;
    //si tout est ok, on bind les valeurs
    //ici on a pas beaucoup de paramètres, du coup on peut exécuter la requête en une seule fois
    $stmt->execute(['email' => $email]);
    
    while($result = $stmt->fetch())
    {
      $user = new User($result);
    }
    
    return $user ?? null;

  }

  /**
   * méthode pour ajouter un utilisateur
   * 
  */
  public function addUser(array $data):?User
  {
    //on crée un tableau pour que le client ne soit pas admin et soit actif
    $data_more = [
      'is_active' => 1,
      'is_verified' => 0
    ];
    //on fusionne les deux tableaux
    $data = array_merge($data, $data_more);

    //on crée notre requête SQL pour ajouter un utilisateur
    $query = sprintf('INSERT INTO %s (`email`, `password`, `firstname`, `lastname`, `is_active`, `is_verified`) 
    VALUES (:email, :password, :firstname, :lastname, :is_active, :is_verified)',
    $this->getTableName()); 
    //on prépare la requête
    $stmt = $this->pdo->prepare($query);
    //on vérifie que la requête est bien préparée
    if(!$stmt) return null;
    //on exécute la requête en passant les valeurs
    $stmt->execute($data);

    //on récupère l'id de l'utilisateur fraichement créée
    $id = $this->pdo->lastInsertId();
    //On peux retourner l'objet user grace à la méthode readById
    return $this->readById(User::class, $id);

  }
}