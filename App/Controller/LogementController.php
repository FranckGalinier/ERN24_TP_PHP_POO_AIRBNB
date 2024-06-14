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

class LogementController extends Controller
{
  /**
   * méthode qui va afficher le formulaire de création de logement
   */
  public function LogementForm()
  { 
    $view_data =[
      'form_result' => Session::get(Session::FORM_RESULT),
      'form_success' => Session::get(Session::FORM_SUCCESS),
    ];
    $view = new View('user/create_logement');

    $view->render($view_data);
  }

  /**
   * méthode qui va permettre d'ajouter un logement
   * @param ServerRequest $request
   * @return void
   */

   public function addLogement(ServerRequest $request):void
   {
    $data_form = $request->getParsedBody();
    $form_result= new FormResult();
    $name = $data_form['name'] ?? '';
    $user_id = $data_form['user_id'] ?? '';
    $typelogement = $data_form['typeLogement'];
    $equipements = $data_form['equipements'] ?? [];
    $array_equipements = count($equipements);
    $description = $data_form['description'] ?? '';
    $price = $data_form['price'] ?? '';
    $nb_voyageur = $data_form['nb_voyageur'] ?? '';
    $nb_rooms = $data_form['nb_rooms'] ?? '';
    $size = $data_form['size'] ?? '';
    $address = $data_form['address'] ?? '';
    $city = $data_form['city'] ?? '';
    $zipcode = $data_form['zipcode'] ?? '';
    $country = $data_form['country'] ?? '';
    $phone = $data_form['phone'] ?? '';

    //vérification des données
    if(empty($name) || empty($user_id) || empty($typelogement) || empty($price) || empty($city))
    {
      $form_result->addError(new FormError('Tous les champs sont obligatoires'));

    }else{

      //on reconstruit un tableau pour insérer les adresses
      $logement_information_data=[
        'address'=>$address,
        'city'=>htmlspecialchars(trim($city)),
        'zip_code'=>intval($zipcode),
        'country'=>htmlspecialchars(trim($country)),
        'phone' =>intval($phone)
      ];

      $logement_information = AppRepoManager::getRm()->getInformationRepository()->insertInformation($logement_information_data);
    if(is_null($logement_information))
    {
      $form_result->addError(new FormError('Erreur lors de l\'ajout de l\'adresse'));
    }

    //on reconstruit un tableau de données pour insérer le logement
    $logement_data = [
      'title'=>htmlspecialchars(trim($name)),
      'description' =>htmlspecialchars(trim($description)),
      'price' => floatval($price),
      'user_id' => intval($user_id),
      'nb_traveler' => intval ($nb_voyageur),
      'nb_rooms' => intval ($nb_rooms),
      'size' => intval ($size),
      'information_id' => intval($logement_information)
    ];

    $logement_id = AppRepoManager::getRm()->getLogementRepository()->addLogement($logement_data);

      if(is_null($logement_id))
      {
        $form_result->addError(new FormError('Erreur lors de la création de la pizza'));
      }
    
      //on va boucler sur les equipements
      foreach($equipements as $equipement)
      {
        $logement_equipement_data = [
          'logement_id'=>intval($logement_id),
          'equipement_id'=>intval($equipement)
        ];

         //toujours dans le boucle on appelle la méthode pour ajouter les ingredients dans la table pizza_ingredient

         $logement_equipement = AppRepoManager::getRm()->getLogement_equipementRepository()->insertLogementEquipement($logement_equipement_data);
         if(!$logement_equipement)
         {
           $form_result->addError(new FormError('Erreur lors de l\' ajout des équipements'));
         }
        }

      
    }
      //si tout est ok on envoie un message de succès
      $form_result ->addSuccess(new FormSuccess('Adresse ajoutée avec succès'));

       //si on a des erreurs, on les mets en sessions
    if ($form_result->hasErrors()) {
      Session::set(Session::FORM_RESULT, $form_result);
      //on redirige sur la page detail
      self::redirect('/user/create-logement/' . $user_id);
    }

    //si on a des succès, on les mets en sessions
    if ($form_result->hasSuccess()) {
      Session::remove(Session::FORM_RESULT);
      Session::set(Session::FORM_SUCCESS, $form_result);
      //on redirige sur la page detail
      self::redirect('/user/create-logement/' . $user_id);


    
 
  }

    
}
}