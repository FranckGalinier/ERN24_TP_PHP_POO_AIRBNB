<?php 

namespace App\Controller;

use Core\View\View;
use App\AppRepoManager;
use Core\Form\FormError;
use Core\Form\FormResult;
use Core\Session\Session;
use Core\Form\FormSuccess;
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
  
  /**
   * méthode qui va ajouter un logement au favorirs
   * @param int $id
   * @return void 
   */
  public function addFavorite($id):void
   {
    $form_result = new FormResult();
    $user_id = Session::get(Session::USER)->id;
    $logement_id = $id;

    if (AppRepoManager::getRm()->getFavorisRepository()->isFavorite($user_id, $logement_id)) {
      $form_result->addError(New FormError('Le logement est déjà dans vos favoris'));
    }else{

    $favorite = AppRepoManager::getRm()->getFavorisRepository()->addFavorite($user_id, $logement_id);
    if ($favorite===false) {
      $form_result->addError(New FormError('Le logement n\'a pas pu être ajouté à vos favoris'));
    } else {
      $form_result->addSuccess(New FormSuccess('Votre logement a bien été ajouté à vos favoris'));
    }
    }
      //si on a des erreurs, on les mets en sessions
      if ($form_result->hasErrors()) {
        Session::set(Session::FORM_RESULT, $form_result);
        //on redirige sur la page detail
        self::redirect('/logement/' . $logement_id);
      }
  
      //si on a des succès, on les mets en sessions
      if ($form_result->hasSuccess()) {
        Session::remove(Session::FORM_RESULT);
        Session::set(Session::FORM_SUCCESS, $form_result);
        //on redirige sur la page detail
        self::redirect('/logement/' . $logement_id);
      }
  
    }

  
    /**
   * méthode qui va afficher la liste des favoris de l'utilisateur
   * @param int $id
   * @return void
   */
  public function listFavorisUser($id): void
  {
    $favoris = AppRepoManager::getRm()->getFavorisRepository()->getFavorisByUserId($id);
    $view_data = [
      'favoris' => $favoris,
      'form_result' => Session::get(Session::FORM_RESULT),
      'form_success' => Session::get(Session::FORM_SUCCESS),
    ];
    $view = new View('user/list_favoris');
    $view->render($view_data);
  }

  /**
   * méthode qui va supprimer un favoris
   * @param int $id
   * @return void
   */
  public function deleteFavorite($id): void{
    $form_result = new FormResult();
    $user_id = Session::get(Session::USER)->id;
    $logement_id = $id;

    if (!AppRepoManager::getRm()->getFavorisRepository()->isFavorite($user_id, $logement_id)) {
      $form_result->addError(New FormError('Le logement n\'est pas dans vos favoris'));
    }else{

    $favorite = AppRepoManager::getRm()->getFavorisRepository()->deleteFavorite($user_id, $logement_id);
    if ($favorite===false) {
      $form_result->addError(New FormError('Le logement n\'a pas pu être supprimé de vos favoris'));
    } else {
      $form_result->addSuccess(New FormSuccess('Votre logement a bien été supprimé de vos favoris'));
    }
    }
      //si on a des erreurs, on les mets en sessions
      if ($form_result->hasErrors()) {
        Session::set(Session::FORM_RESULT, $form_result);
        //on redirige sur la page detail
        self::redirect('/logement/' . $logement_id);
      }
  
      //si on a des succès, on les mets en sessions
      if ($form_result->hasSuccess()) {
        Session::remove(Session::FORM_RESULT);
        Session::set(Session::FORM_SUCCESS, $form_result);
        //on redirige sur la page detail
        self::redirect('/logement/' . $logement_id);
      }
  }
}