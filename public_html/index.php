<?php

//On définit une constance contenant le dossier racine du projet
define('ROOT', dirname(__DIR__));

//On définit les use
use App\Autoloader;
use App\Core\Main;

//On importe l'autoloader
require_once ROOT.'/Autoloader.php';
Autoloader::register();

//On instancie Main
$app = new Main();

//On démarre l'application
$app->start();