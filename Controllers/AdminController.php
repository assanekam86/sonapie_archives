<?php 
namespace App\Controllers;

use App\Core\Form;
use App\Models\AnnoncesModel;

class AdminController extends Controller
{
	public function index()
	{ //var_dump($_SESSION);
		//On verifie si on est admin
		if ($this->isAdmin()) {
			//echo "vous etes admin";
			 $this->Render('admin/index',[],'admin');
		}

	}

	public function annonces()
	{
		if ($this->isAdmin()) {
			//echo "vous    etes admin";
			
			$annoncesModel= new AnnoncesModel;
			$annonces = $annoncesModel->findAll();
			 $this->Render('admin/annonces',compact('annonces'),'admin');
		}

	}
	/**
	 * supprimer une annonce si on est admin
	 * @param  int    $id de l'annonce
	 * @return [type]     [description]
	 */
	public function supprimeAnnonce( int $id){
		if ($this->isAdmin()) {
			// on est Admin
			$annonce = new AnnoncesModel;
			$annonce->Delete($id);
			header("Location: ".$_SERVER['HTTP_REFERER']);
		}
	}
/**
 * [activer ou desactiver une annonce]
 * @param  int    $id 
 * @return void
 */
	public function activer($id)
	{
		if($this->isAdmin()){
			$annoncesModel = new AnnoncesModel;

			$annonceArray = $annoncesModel->find($id);
			if($annonceArray){
				$annonce = $annoncesModel->hydrate($annonceArray);

				//equivalent 
				if($annonce->getActif()){
					$annonce->setActif(0);
				}else{
					$annonce->setActif(1);
				}
				//$annonce->setActif($annonce->getActif() ? 0 : 1);
				$annonce->update();
			}
		}
	}
	/**
	 * Verifie si on est admin
	 * @return boolean true
	 */
	private function isAdmin() 
	{
		//On verifie si on est connecté et si "ROLE_ADMIN" est dans mon role
		if(isset($_SESSION['user']) && in_array('ROLE_ADMIN',$_SESSION['user']['roles'])){
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



 ?>