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

class ReservationController extends Controller
{
  /**
   * méthode qui va ajouter les infos récuépérées du formulaire de réservation
   */
  public function addReservation(ServerRequest $request)
  {
    $data_form = $request->getParsedBody();
    $form_result = new FormResult();
    $date_start = $data_form['date_start'] ?? '';
    $date_end = $data_form['date_end'] ?? '';
    $logement_id = $data_form['logement_id'] ?? '';
    $user_id = $data_form['user_id'] ?? '';
    $nb_adult = $data_form['nb_adult'] ?? '';

    if (empty($date_start) || empty($date_end) || empty($logement_id) || empty($user_id) || empty($nb_adult)){
      $form_result->addError(new FormError('Tous les champs sont obligatoires'));
    }else{
      $reservation = AppRepoManager::getReservationRepository()->create([
        'date_start' => $date_start,
        'date_end' => $date_end,
        'logement_id' => $logement_id,
        'user_id' => $user_id,
        'nb_adult' => $nb_adult
      ]);

      
      if ($reservation){
        $form_result->addSuccess(new FormSuccess('Réservation effectuée avec succès'));
      }else{
        $form_result->addError(new FormError('Erreur lors de la réservation'));
      }
    }
    //si tout est ok on envoie un message de succès
    $form_result->addSuccess(new FormSuccess('Adresse ajoutée avec succès'));

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
      self::redirect('/user/mesreservations/' . $user_id);
}
}
}