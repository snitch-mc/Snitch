<?php
namespace App\Controllers;

use App\Models\WebsiteModel;

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
        $websiteModel = new WebsiteModel();
        $website = $websiteModel->findAll();
        $this->render('main/maintenance', $website);
    }


}
