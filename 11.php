<?php

use App\Autoloader;
use App\Models\AnnoncesModel;
use App\Models\UsersModel;
require_once 'Autoloader.php';
Autoloader::register();

$table1 = new AnnoncesModel;
//var_dump($table1->findBy(['actif'=>1]));
//var_dump($table1->find(2));
/*
$model = new AnnoncesModel;
//$annonce = $model->setTitre('Mon New Titre')
  //              ->setDescription('My describe')
    //            ->setActif('1');
    $donnees = [
        'titre'=>'Annonce mon titre modifie',
        'description'=> 'Annonce la description modifie',
        'actif'=> 0
    ];
    $annonce = $model->hydrate($donnees);

    //$model->Create($annonce);
    $model->Update(3,$annonce);

#var_dump($model->Create($annonce));
var_dump($annonce);
//$model->Delete(4);
*/
$model = new UsersModel;

$users = $model->setEmail('agentkamara06@gmail.com')
      ->setPassword(password_hash('killer@123', PASSWORD_ARGON2I));

      $model->Create($users);


 ?>