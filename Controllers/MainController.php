<?php
namespace App\Controllers;

class MainController extends Controller
{
    public function index()
    {
        $this->render('main/index');

    }
    public function error()
    {
        $this->render('main/404');
    }

    public function maintenance()
    {
        $this->render('main/maintenance');
    }


}
