<?php
namespace App\Controllers;

use App\Core\Form;


abstract class Controller
{
// protected $template = "default";
public function Render(string $fichier, array $donnees= [], string $template = "admin"){
	//On extrait le contenu de $donnees
	extract($donnees);

	//on demarre un buffer de sortie
	ob_start();
	//A partir de ce point toute sortie est conservé en memoire 
	//
	//On cree le chemin vers la vue
	 require_once ROOT.'/Views/'.$fichier.'.php';

	 //Transfert le buffer dans $contenu
	$contenu = ob_get_clean();

//Template de page
	require_once ROOT.'/Views/'.$template.'.php'; 

}

protected function isAdmin() 
	{
		//On verifie si on est connecté et si "ROLE_ADMIN" est dans mon role
		if(isset($_SESSION['user']) && ($_SESSION['user']['roles'] =='ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER')){
			//on est admin
			return true;
		}else{
			//On est pas admin
			Form::setFlash('danger',"Vous n'avez pas accès à cette page");
			header("Location: /");
			exit;
		}
	}

}
