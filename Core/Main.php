<?php
namespace App\Core;
use App\Controllers\MainController;
/**
 * ROuteur principale
 * 
 */
class Main
{

    public function start()
    {
        // On demarre la session
session_start();
$_SESSION['copie']=1;
        //echo "Sa fonctionne";
        // http://projetc.local/controleur/methode/parametres
        //hppt://project.local/annonces/details/brouette
        //http://project.local/index.php?=annonces/details/brouett
        //On recuperer l'adresse passé a l'url
        $uri = $_SERVER['REQUEST_URI'];
       // var_dump($uri);
       //On veut enlever le slash a la fin de l'url
       //On verifie que uri nest pas vide et qu'elle se termine par un slash
       if(!empty($uri) && $uri != "/" && $uri[-1] === "/"){
           //on enleve le /
           $uri = substr($uri,0,-1);
           //On envoie un code de redirection permanente 
           http_response_code(301);
           //on redirige vers l'url sans le /
       header('Location: '.$uri);
       } 
    //On gere les parametres
    //p=controller/methode/parametres
       //On separe le parametre dans un tableau
       $params = explode('/',$_GET['p']);
       //var_dump($params);
       if($params[0] != ""){
           //On a au moin 1 parametre 
           //On recupere le nom du controlleur à instancier
           //On met une majuscule en premiere lettre,
           // on ajoute le namespace complet avant et on ajoute "controller" apres
            $controller = "\\App\\Controllers\\".ucfirst(array_shift($params)).'Controller';
            //array_shift() enleve la premiere valeur d'un tableau
           //On instancie le controlleur
          if (class_exists($controller)) {
                $controller = new $controller();
                //var_dump($controller);
                //on recupere le second parametre de l'url
                $action =(isset($params[0])) ? array_shift($params) : 'index';
                if (method_exists($controller, $action)) {
                    // Si il reste des parametres on les passe a la methode
                    (isset($params[0])) ? call_user_func_array([$controller,$action], $params): $controller->$action();
                } else {
                    http_response_code(404);
                    echo "La page recherchée n'existe pas!";
                }
          }else{ http_response_code(404);
            echo "La page recherchée n'existe pas!";}
           
        }else{
           //on a pas de parametres,
           // on instancie le controleur par defaut
           $controlleur = new MainController;
           //on appelle la methode index
           $controlleur->index();
       }


}
    


}


?>