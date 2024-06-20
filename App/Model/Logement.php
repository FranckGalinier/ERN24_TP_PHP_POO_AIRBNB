<?php

namespace App\Model;

use Core\Model\Model;

class Logement extends Model
{
  public string $title;
  public string $description;
  public float $price;
  public int $nb_rooms;
  public int $nb_traveler;
  public int $size;
  public int $user_id;
  public int $type_logement_id;
  public ?int $information_id;
  public ?bool $is_active;
  //ici on va hydrater l'objet Information
  public Information $information;
  public User $user;
  public TypeLogement $type_logement;
  public array $equipements;
  public array $media;
}