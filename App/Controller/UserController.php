<?php

namespace App\Controller;

use Core\View\View;
use App\AppRepoManager;
use Core\Form\FormError;
use Core\Form\FormResult;
use Core\Session\Session;
use Core\Form\FormSuccess;
use Core\Controller\Controller;
use Laminas\Diactoros\ServerRequest;

class UserController extends Controller
{
  public function listlogementuser()
  {

    $logement = AppRepoManager:: getRm()->getLogementRepository()->getLogementByUserId(Session::get(Session::USER)->id);
    $view_data = [
      'h1' => 'Mes logements',
      'logements'=> $logement,
      'form_result' => Session::get(Session::FORM_RESULT),
      'form_success' => Session::get(Session::FORM_SUCCESS),
    ];
    $view = new View('user/logement');
    $view->render($view_data);
  }

  /** méthode qui va supprimer une annonce de logement logement */
  public function DesactivationLogement($id):void
  {
    $form_result = new FormResult();
    $user_id = Session::get(Session::USER)->id;
    $deleteLogement = AppRepoManager::getRm()->getLogementRepository()->DesactivationLogement($id);
    if ($deleteLogement===false) {
      $form_result->addError(New FormError('Une erreur est survenue lors de la suppression de votre logement'));
    } else {
      $form_result->addSuccess(New FormSuccess('Votre logement a bien été désactivé'));
    }
      //si on a des erreurs, on les mets en sessions
      if ($form_result->hasErrors()) {
        Session::set(Session::FORM_RESULT, $form_result);
        //on redirige sur la page detail
        self::redirect('/user/list-my-logement/' . $user_id);
      }
  
      //si on a des succès, on les mets en sessions
      if ($form_result->hasSuccess()) {
        Session::remove(Session::FORM_RESULT);
        Session::set(Session::FORM_SUCCESS, $form_result);
        //on redirige sur la page detail
        self::redirect('/user/list-my-logement/' . $user_id);
      }
  }

  /**
   * méthode qui va réactiver une annonce de logement
   * @param int $id
   * @return void
   */
  public function ActivationLogement($id): void
  {
    $form_result = new FormResult();
    $user_id = Session::get(Session::USER)->id;
    $activeLogement = AppRepoManager::getRm()->getLogementRepository()->ActivationLogement($id);
    if ($activeLogement===false) {
      $form_result->addError(New FormError('Votre logement n\'a pas pu être réactivé'));
    } else {
      $form_result->addSuccess(New FormSuccess('Votre logement a bien été réactivé'));
    }
      //si on a des erreurs, on les mets en sessions
      if ($form_result->hasErrors()) {
        Session::set(Session::FORM_RESULT, $form_result);
        //on redirige sur la page detail
        self::redirect('/user/list-my-logement/' . $user_id);
      }
  
      //si on a des succès, on les mets en sessions
      if ($form_result->hasSuccess()) {
        Session::remove(Session::FORM_RESULT);
        Session::set(Session::FORM_SUCCESS, $form_result);
        //on redirige sur la page detail
        self::redirect('/user/list-my-logement/' . $user_id);
      }
  }

  /**
   * méthode qui va afficher le profil de l'utilisateur en cours
   * @param int $id
   * @return void
   */
    public function profil($id): void
    {
      $user = AppRepoManager::getRm()->getUserRepository()->getUserById($id);
      $view_data = [
        'user' => $user,
        'form_result' => Session::get(Session::FORM_RESULT),
        'form_success' => Session::get(Session::FORM_SUCCESS),
      ];
      $view = new View('user/profil');
      $view->render($view_data);
    }

}