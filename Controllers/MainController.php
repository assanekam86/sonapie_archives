<?php
namespace App\Controllers;

class MainController extends Controller
{
    public function index(){
        //echo "Ceci est la page d'accueil";
        //$this->template = 'home';
        $this->Render('users/accueil',[],'default');
    }
}
