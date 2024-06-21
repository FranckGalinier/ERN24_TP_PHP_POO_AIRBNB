<?php

namespace App\Model;

use Core\Model\Model;

class Favoris extends Model
{
  public int $user_id;
  public int $logement_id;
  public ?string $label;
  public bool $is_active;

  public User $user;
  public Logement $logement;
}