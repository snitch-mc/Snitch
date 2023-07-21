<?php

namespace App\Controllers;

use App\Models\WebsiteModel;

class WebsiteController extends Controller
{
    public function index()
    {
        $error = false;
        //On vérifie si l'utilisateur est connecté
        if (!isset($_SESSION["user"])){
            header("Location: /users/login");
            exit();
        }

        //On vérifie si l'utilisateur a la permission
        if ($_SESSION["user"]["permissions"] < 1){
            $_SESSION["errorMessage"] = "Tu n'as pas la permission. Si tu penses que c'est une erreur, contacte l'administration.";
            header("Location: /");
            exit();
        }

        if (!empty($_POST)){

            foreach ($_POST as $field => $value){
                if (empty($value)){
                    $_SESSION["errorMessage"] = "Merci de remplir le champ $field";
                    $error = true;
                }
            }

            //Je protège les données de mon post
            $maintenanceTitle = strip_tags($_POST["maintenance-title"]);
            $maintenanceDescription = strip_tags($_POST["maintenance-description"]);

            //Je sauvegarde la valeur du mode maintenance
            if (isset($_POST["maintenance-mode"])){
                $maintenanceEnabled = 1;
            } else {
                $maintenanceEnabled = 0;
            }

            if (!$error){
                $websiteUpdatedStatus = new WebsiteModel();
                $websiteUpdatedStatus->setId(1);
                $websiteUpdatedStatus->setValue($maintenanceEnabled);
                $websiteUpdatedStatus->update(1);

                $websiteUpdatedTitle = new WebsiteModel();
                $websiteUpdatedTitle->setId(2);
                $websiteUpdatedTitle->setValue($maintenanceTitle);
                $websiteUpdatedTitle->update(2);

                $websiteUpdatedDesc = new WebsiteModel();
                $websiteUpdatedDesc->setId(3);
                $websiteUpdatedDesc->setValue($maintenanceDescription);
                $websiteUpdatedDesc->update(3);

                $_SESSION["successMessage"] = "Les données ont été mises à jour.";
            } else {
                header("Location: /website");
                exit();
            }


        }

        $websiteModel = new WebsiteModel();
        $settings = $websiteModel->findAll();


        $this->render('website/index', $settings);
    }

}