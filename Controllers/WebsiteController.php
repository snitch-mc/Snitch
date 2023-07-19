<?php

namespace App\Controllers;

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

        $this->render('website/index');
    }

}