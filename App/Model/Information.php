<?php

namespace App\Model;

use Core\Model\Model;

class Information extends Model
{
  public string $address;
  public string $city;
  public string $zip_code;
  public string $country;
  public string $phone;
}