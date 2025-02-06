<?php
use App\Autoloader;
use App\Core\Main;

//On definie une constante contenant le dossier racine du projet
define('ROOT',dirname(__DIR__));

//On apporte l'autoloader 
require_once ROOT.'/Autoloader.php';
Autoloader::register();


//On instancie la classe Main(Notre routeur)
$app = new Main();

//On demmarre l'application
$app->start();