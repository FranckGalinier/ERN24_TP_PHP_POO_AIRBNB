<?php

namespace App\Model;

use Core\Model\Model;

class Equipement extends Model
{
  public string $label;
  public string $image_path;
  public bool $is_active;
}