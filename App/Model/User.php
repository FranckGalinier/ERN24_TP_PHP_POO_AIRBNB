<?php

namespace App\Model;

use Core\Model\Model;

class User extends Model
{
 public string $email;
 public string $password;
 public ?string $first_name;
 public ?string $last_name;
 public bool $is_active;
 public bool $is_verified;

  public Information $information;
}