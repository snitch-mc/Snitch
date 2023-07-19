<?php
namespace App\Controllers;

abstract class Controller
{
    protected function render($file, $data = [])
    {
        //On extrait les données de $data
        extract($data);

        //On démarre le buffer de sortie (output buffer (ob))
        ob_start();

        //On créé le chemin de la vue
        require_once ROOT.'/Views/'.$file.'.php';

        //Ici, on rend ce qui a été gardé en mémoire dans la variable $content
        //de notre layout
        $content = ob_get_clean();

        require_once ROOT.'/Views/layout.php';

    }

}
