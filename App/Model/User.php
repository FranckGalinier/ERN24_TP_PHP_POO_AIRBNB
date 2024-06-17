<?php

namespace App\Model;

use Core\Model\Model;

class User extends Model
{
  public string $email;
  public string $password;
  public ?string $firstname;
  public ?string $lastname;
  public bool $is_active;
  public bool $is_verified;

  public Information $information;
}
