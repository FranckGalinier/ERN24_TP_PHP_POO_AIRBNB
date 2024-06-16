<?php

namespace App\Controller;

use Core\View\View;
use App\AppRepoManager;
use Core\Session\Session;
use Core\Controller\Controller;

class UserController extends Controller
{
  public function listlogementuser()
  {

    $logement = AppRepoManager:: getRm()->getLogementRepository()->getLogementByUserId(Session::get(Session::USER)->id);
    $view_data = [
      'h1' => 'Mes logements',
      'logement'=> $logement,
      'form_result' => Session::get(Session::FORM_RESULT),
      'form_success' => Session::get(Session::FORM_SUCCESS),
    ];
    $view = new View('user/logement');
    $view->render($view_data);
  }
}