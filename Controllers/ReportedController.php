<?php

namespace App\Controllers;

use App\Models\PostsModel;
use App\Models\ReportedModel;

class ReportedController extends Controller
{
    public function index()
    {
        $error = false;
        //On vérifie si l'utilisateur est connecté
        if (!isset($_SESSION["user"])){
            header("Location: /users/login");
            exit();
        }
        //On instancie le modèle correspondant à la table "posts"
        $reportedsModel = new ReportedModel();

        if (empty($_POST["recherche"])){
            //On va chercher tous les utilisateurs par ordre du plus récent au plus ancien
            $reporteds = $reportedsModel->findAllDESC();
        } else {
            $recherche = strip_tags($_POST["recherche"]);
            if (!preg_match('/^[a-zA-Z0-9_]{2,16}$/', $recherche)){
                if (!preg_match('/^[A-F\d]{8}-[A-F\d]{4}-4[A-F\d]{3}-[89AB][A-F\d]{3}-[A-F\d]{12}$/i', $recherche)){
                    $error = true;
                    $_SESSION["errorMessage"] = "Ce n'est ni un pseudo ni un UUID. Merci de vérifier votre demande.";
                }
            }
            if (!$error){
                $reporteds = $reportedsModel->findReportedPlayer($recherche, $recherche);
                if (empty($reporteds)){
                    $_SESSION["errorMessage"] = "Aucun joueur ayant ce pseudo ou UUID n'a été trouvé.";
                }
            } else {
                $reporteds = [];
            }

        }

        $this->render('reported/index', $reporteds);
    }
}