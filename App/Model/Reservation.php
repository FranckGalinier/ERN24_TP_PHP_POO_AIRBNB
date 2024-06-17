<?php

namespace App\Model;

use Core\Model\Model;

class Reservation extends Model
{
  public string $order_number;
  public string $date_start;
  public string $date_end;
  public int $nb_adults;
  public int $nb_child;
  public float $price_total;
  
  public Logement $logement;
  public User $user;

}