<?php 

namespace App\Controller;

use Core\View\View;
use App\AppRepoManager;
use Core\Session\Session;
use Core\Controller\Controller;

class HomeController extends Controller 
{
  public function home()
  {
    $logements = AppRepoManager:: getRm()->getLogementRepository()->getAllLogements();
    $view_data = [
      'logements'=> $logements,
      'form_result' => Session::get(Session::FORM_RESULT),
      'form_success' => Session::get(Session::FORM_SUCCESS),
    ];
    $view = new View('home/index');
    $view->render($view_data);
  }


  public function hosting()
  {
    $reservations = AppRepoManager::getRm()->getReservationRepository()->findReservationsByLogementUserId(Session::get(Session::USER)->id);
    $view_data = [
      'form_result' => Session::get(Session::FORM_RESULT),
      'form_success' => Session::get(Session::FORM_SUCCESS),
      'reservations' => $reservations,
    ];
    $view = new View('user/list_reservation_hote');
    $view->render($view_data);
  }
}