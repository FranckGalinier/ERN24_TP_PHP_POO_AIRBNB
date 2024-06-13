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
}