<?php

namespace App;
class Autoloader
{
    static function register(): void
    {
        spl_autoload_register([
            __CLASS__,
            'autoload'
        ]);
    }

    static function autoload($class)
    {
        //On récupère dans $class la totalité du namespace
        //On enlève "App\"
        $class = str_replace(__NAMESPACE__ . "\\", "", $class);

        //On remplace les "\" par des "/" pour écrire le chemin d'accès de nos classes
        $class = str_replace("\\", "/", $class);

        //On écrit le chemin d'accès pour le require
        $file = __DIR__ . "/" . $class . ".php";
        if (file_exists($file)){
            require_once $file;
        }
    }
}