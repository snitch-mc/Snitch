<?php

namespace App\Controllers;

use App\Models\PostsModel;
use App\Models\ReportedModel;

class ReportedController extends Controller
{
    public function index()
    {
        //On vérifie si l'utilisateur est connecté
        if (!isset($_SESSION["user"])){
            header("Location: /users/login");
            exit();
        }
        //On instancie le modèle correspondant à la table "posts"
        $reportedsModel = new ReportedModel();

        //On va chercher tous les posts par ordre du plus récent au plus ancien
        $reporteds = $reportedsModel->findAllDESC();

        $this->render('reported/index', $reporteds);
    }
}