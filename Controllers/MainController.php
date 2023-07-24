<?php
namespace App\Controllers;

use App\Models\PostsModel;
use App\Models\UsersModel;
use App\Models\WebsiteModel;

class MainController extends Controller
{
    public function index()
    {
        $postsModel = new PostsModel();
        $numberReports = $postsModel->findNumberOfReports();

        $this->render('main/index', ['numberReports' => $numberReports]);

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
