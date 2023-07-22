<?php
namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\WebsiteModel;

class MainController extends Controller
{
    public function index()
    {
        $usersModel = new UsersModel();
        $numberUsers = $usersModel->findNumberOfRegistered();


        $this->render('main/index', ['numberUsers' => $numberUsers]);

    }
    public function error()
    {
        $this->render('main/404');
    }

    public function maintenance()
    {
        $websiteModel = new WebsiteModel();
        $website = $websiteModel->findAll();
        $this->render('main/maintenance', $website);
    }


}
