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
      $form_result->addSuccess(New FormSuccess('Votre logement a bien été sdésactivé'));
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
      var_dump($view_data);
      $view = new View('user/profil');
      $view->render($view_data);
    }

  /**
   * méthode qui va afficher le formulaire d'ajout d'information
   * @param int $id
   * @return void
   */
  public function addInformationUserForm($id): void
  {
    $view_data = [
      'form_result' => Session::get(Session::FORM_RESULT),
      'form_success' => Session::get(Session::FORM_SUCCESS),
    ];
    $view = new View('user/add_information');
    $view->render($view_data);
  }

  /**
   * méthode qui va permettre d'ajouter des informations à un utilisateur
   * @param int $id
   * @return void
   */
  public function addInformationUser(ServerRequest $request): void
  { $data_form = $request->getParsedBody(); var_dump($data_form);
    $form_result = new FormResult();
    $address = $data_form['address'] ?? '';
    $zip_code = $data_form['zip_code'];
    $city = $data_form['city'];
    $country = $data_form['country'];
    $phone = $data_form['phone'];
    $user_id = Session::get(Session::USER)->id;
   
  
    if(empty($adress) || empty($zip_code) || empty($city) || empty($country) || empty($phone)){
      $form_result->addError(New FormError('Veuillez remplir tous les champs'));
    }
    $information_data=[
      'address' => $address,
      'zip_code' => $zip_code,
      'city' => $city,
      'country' => $country,
      'phone' => $phone,
    ];
    $addInformation = AppRepoManager::getRm()->getInformationRepository()->InsertInformation($information_data);

    if ($addInformation===false) {
      $form_result->addError(New FormError('Une erreur est survenue lors de l\'ajout de vos informations'));
    } else {
      $form_result->addSuccess(New FormSuccess('Vos informations ont bien été ajoutées'));
    }
      //si on a des erreurs, on les mets en sessions
      if ($form_result->hasErrors()) {
        Session::set(Session::FORM_RESULT, $form_result);
        //on redirige sur la page detail
        self::redirect('/add_information_user/' . $user_id);
      }
  
      //si on a des succès, on les mets en sessions
      if ($form_result->hasSuccess()) {
        Session::remove(Session::FORM_RESULT);
        Session::set(Session::FORM_SUCCESS, $form_result);
        //on redirige sur la page detail
        self::redirect('/user/profil/' . $user_id);
      }
}
}