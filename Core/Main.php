<?php
namespace App\Core;
use App\Controllers\MainController;
use App\Models\WebsiteModel;

class Main
{
    public function start()
    {
        //On démarre la session
        session_start();

        //On retire le trailing "/" éventuel de l'url
        //On récupère l'url
        $uri = $_SERVER["REQUEST_URI"];

        //Si le mode maintenance est activé, seul la page index sera accessible
        $websiteModel = new WebsiteModel();
        $website = $websiteModel->findOneByName("maintenance.enabled");


        if (isset($website)){
            if ($website->value){
                if (isset($_SESSION["user"])){
                    if ($_SESSION["user"]["permissions"] != 1){
                        //Si l'utilisateur existe et n'est pas admin, on affiche le mode maintenance
                        $controller = new MainController();
                        //Puis on charge la page maintenance
                        $controller->maintenance();
                        exit();
                    }
                } else {
                    //Si le mode maintenance est activé, on instancie le controller par défaut
                    $controller = new MainController();
                    //Puis on charge la page maintenance
                    $controller->maintenance();
                    exit();
                }
            }
        }

        //On vérifie que uri n'est pas vide et se termine pas un "/"
        if(!empty($uri) && $uri[-1] === "/"){
            $uri = substr($uri, 0, -1);

            //On envoie un code de redirection
            http_response_code(301);

            //On redirige vers l'url sans le "/"
            header("Location: ".$uri);
        }

        //http://monsite/blog/detail/3
        //On gère les paramètre dans l'URL
        $params = explode('/', $_GET["p"]);

        if($params[0] !== ""){
            //Ici, on a au moins 1 paramètre
            //On récupère le nom du contrôleur à instancier (on fabrique son nom)
            //on reçoit "blog" et on a besoin de "BlogController.php"
            //On met une majuscule, on ajoute le namespace, on ajoute "Controller"
            $controller = '\\App\\Controllers\\' . ucfirst(array_shift($params)) .'Controller';



            //ICI ON CHECK SI LE CONTROLLER EXISTE, SINON RENVOIE 404 OU 500
            if (class_exists($controller)){
                //J'appelle le contrôleur
                $controller = new $controller;

                //Si on a un deuxième paramètre, c'est une méthode pour notre controleur. Sinon, on envoie
                //vers la méthode "index" du contrôleur.
                $action = (isset($params[0])) ? array_shift($params) : 'index';

                //On vérifie si la méthode existe dans le contrôleur, sinon 404
                if(method_exists($controller, $action)) {
                    //On vérifie s'il reste des paramètres (transmis à la méthode),
                    // et on appelle notre contrôleur et sa méthode
                    (isset($params[0])) ? call_user_func_array([$controller, $action], $params) : $controller->$action();

                } else {
                    http_response_code(404);
                    //On instancie le contrôleur par défaut
                    $controller = new MainController();
                    //On appelle notre méthode index
                    $controller->error();
                }
            } else {
                http_response_code(404);
                //On instancie le contrôleur par défaut
                $controller = new MainController();
                //On appelle notre méthode index
                $controller->error();
            }




        }else {
            //On a pas de paramètre, on renvoie vers la home (ou 404)
            //On instancie le contrôleur par défaut
            $controller = new MainController();
            //On appelle notre méthode index
            $controller->index();
        }

    }
}
