<?php 
namespace App\Controllers;

use App\Core\Db;
use App\Core\Form;
use App\Models\CategoriesModel;
use App\Models\NaturesModel;
use App\Models\CotesModel;
use App\Models\DepotModel;
use App\Models\EmplacementsModel;
use App\Models\EmprunterModel;
use App\Models\EntreesModel;
use App\Models\RayonsModel;
use App\Models\TypesModel;
use App\Models\DossiersModel;
use App\Models\DomainesModel;
use App\Models\UsersModel;
use App\Models\DocumentsModel;


class ArchivesController extends Controller
{


	public function emprunter(int $id=null){

		// listes entree 
   		$entModel = new DocumentsModel;

        // On va chercher toutes les typees
        $entrees = $entModel->requete("SELECT * FROM rayons as ray, etageres as et,boites as bo,salles as sal,categories as c,types as t, usagers as u,dossiers as o,documents as d WHERE sal.id=ray.id_salle AND ray.id=et.id_rayon AND et.id=bo.id_etagere AND bo.id=o.id_boite AND d.actif=1 AND u.id = d.id_usager AND d.id_dos = o.id AND d.id_types = t.id AND c.id= d.id_cat GROUP BY d.reference ORDER BY d.date_creation_doc DESC")->fetchAll();
        $docModel = new DocumentsModel;
      $afficheFile = $docModel->requete("SELECT * FROM categories as c,types as t, usagers as u,dossiers as o,users as us,documents as d WHERE us.id=d.id_user AND u.id = d.id_usager AND d.id_dos = o.id AND d.id_types = t.id AND d.id =? AND c.id= d.id_cat",[$id])->fetch();

      $affiche = $docModel->requete("SELECT c.designation,dos.dossier,t.type as typ,f.fichier,f.type,f.date_creation,usag.usager, f.update_at,f.id FROM categories as c,usagers as usag, types as t, documents as d,dossiers as dos,fichiers as f  WHERE usag.id=d.id_usager AND f.id_doc = ? AND d.id_cat = c.id AND dos.id=d.id_dos AND t.id = d.id_types AND d.id=f.id_doc AND f.actif=?",[$id,1])->fetchAll();
      $typesModel = new TypesModel;
  $types = $typesModel->requete("SELECT * FROM categories,types WHERE categories.id=types.id_cat ORDER BY type asc");

  $servModel = new DossiersModel;
  $dossiers = $servModel->findAll();

  $natModel = new DomainesModel;
  $natures = $natModel->findAll();
  
		$this->Render('/archives/archives',compact('entrees','afficheFile','affiche','types','dossiers','natures'),'admin');
	}


 public function details_piece(int $id){
    $docModel = new DocumentsModel;
      $afficheFile = $docModel->requete("SELECT * FROM categories as c,types as t, usagers as u,dossiers as o,users as us,documents as d WHERE us.id=d.id_user AND u.id = d.id_usager AND d.id_dos = o.id AND d.id_types = t.id AND d.id =? AND c.id= d.id_cat",[$id])->fetch();

      $affiche = $docModel->requete("SELECT c.designation,dos.dossier,t.type as typ,f.fichier,f.type,f.date_creation,usag.usager, f.update_at,f.id FROM categories as c,usagers as usag, types as t, documents as d,dossiers as dos,fichiers as f  WHERE usag.id=d.id_usager AND f.id_doc = ? AND d.id_cat = c.id AND dos.id=d.id_dos AND t.id = d.id_types AND d.id=f.id_doc AND f.actif=?",[$id,1])->fetchAll();


      $this->Render('/archives/details_pieces',compact('afficheFile','affiche'),'admin');
    } 
	

	public function ajout_emprunt(int $id){
			// listes entree 
			if($this->isAdmin()){
          $entModel = new DocumentsModel;
          $afficheFile = $entModel->requete("SELECT * FROM categories as c,types as t, usagers as u,dossiers as o,users as us,documents as d WHERE us.id=d.id_user AND u.id = d.id_usager AND d.id_dos = o.id AND d.id_types = t.id AND d.id =? AND c.id= d.id_cat",[$id])->fetch();
          //affiche fichiers
          $affiche = $entModel->requete("SELECT c.designation,dos.dossier,t.type as typ,f.fichier,f.type,f.date_creation,usag.usager, f.update_at,f.id FROM categories as c,usagers as usag, types as t, documents as d,dossiers as dos,fichiers as f  WHERE usag.id=d.id_usager AND f.id_doc = ? AND d.id_cat = c.id AND dos.id=d.id_dos AND t.id = d.id_types AND d.id=f.id_doc AND f.actif=?",[$id,1])->fetchAll();

   		$entModel = new EntreesModel;

        // On va chercher toutes les typees
        $entrees = $entModel->requete("SELECT * FROM documents WHERE status_doc=? AND id=?",[0,$id])->fetch();

        $usersModel = new UsersModel;
        $users = $usersModel->findAll();

        if(Form::Validate($_POST,['entree','user','datemprunt'])){
        	$entres = strip_tags($_POST['entree']);
        	$use = strip_tags($_POST['user']);
        	$dates = $_POST['datemprunt'];
        	$status=1;


        	   $emprunt = new EmprunterModel;
                            $emprunt->setIdEntrees($entres)
                            		->setIdUser($use)
                            		->setDateEmprunt($dates)
                            		->setStatusEmp($status);
                            $emprunt->Create();
                      //et on met le status entree a 1
                $ent = new EmprunterModel;
                 $modifentre= $ent->requete("UPDATE documents SET status_doc=? WHERE id=?",[1,$id]);

                            Form::setFlash('success',"Un Emprunt vient d'etre éffectué" );
                            header("Location: /archives/liste_emprunts_pending");
                            exit;
        }


       }else{
       	header("Location: /");
       }

		$this->Render('/archives/ajout_emprunt',compact('entrees','users','afficheFile','affiche'),'admin');
	}

	public function liste_emprunts(){


		$this->Render('/archives/liste_emprunts',[],'admin');
	}

	public function liste_emprunts_pending()
	{
		if($this->isAdmin()){
		$listes = new EmprunterModel;

		$listeEmp = $listes->requete("SELECT * FROM categories as c,dossiers as dos,types as t,users as u, documents as d,emprunter as e WHERE c.id=d.id_cat AND dos.id=d.id_dos AND t.id=d.id_types AND u.id = e.id_user AND d.id = e.id_entrees AND e.status_emp=?",[1])->fetchAll();
	}else{
		header("Location: /");
	}

		$this->Render('/archives/liste_emprunts_pending',compact("listeEmp"),'admin');
	}

    public function depot_Emprunt(int $id){


   // listes entree 
      if($this->isAdmin()){
      $entModel = new DocumentsModel;

        // On va chercher toutes les typees
        $entrees = $entModel->requete("SELECT * FROM emprunter as emp,documents as d WHERE d.id=emp.id_entrees AND d.status_doc=? AND emp.id=?",[1,$id])->fetch();

         $afficheFile = $entModel->requete("SELECT * FROM categories as c,types as t, usagers as u,dossiers as o,users as us,documents as d WHERE us.id=d.id_user AND u.id = d.id_usager AND d.id_dos = o.id AND d.id_types = t.id AND d.id =? AND c.id= d.id_cat",[$entrees->id])->fetch();
          //affiche fichiers
          $affiche = $entModel->requete("SELECT c.designation,dos.dossier,t.type as typ,f.fichier,f.type,f.date_creation,usag.usager, f.update_at,f.id FROM categories as c,usagers as usag, types as t, documents as d,dossiers as dos,fichiers as f  WHERE usag.id=d.id_usager AND f.id_doc = ? AND d.id_cat = c.id AND dos.id=d.id_dos AND t.id = d.id_types AND d.id=f.id_doc AND f.actif=?",[$entrees->id,1])->fetchAll();
          $useremp = $entModel->requete("SELECT * FROM users, emprunter WHERE users.id=emprunter.id_user AND emprunter.id=?",[$id])->fetch();

        $usersModel = new UsersModel;
        $users = $usersModel->findAll();

        if(Form::Validate($_POST,['entree','user','datedepot'])){
          $entres = strip_tags($_POST['entree']);
          $use = $_POST['user'];
          $dates = $_POST['datedepot'];
          $status=0;


             $emprunt = new EmprunterModel;
             $emprunt->requete("UPDATE emprunter SET status_emp=? WHERE id = ?",[$status,$id]);

             $deposer = new DepotModel;
                      $deposer->setIdEmprunt($id)
                              ->setDateDepot($dates)
                              ->setIdUserDepot($use);
                             $deposer->Create();
                           // $emprunt->setIdEntrees($entres)
                             //   ->setIdUserDepot($use)
                               // ->setDateDepot($dates)
                                //->setStatusEmp($status);
                            //$emprunt->Update();
                      //et on met le status entree a 1
                $emprt = new EmprunterModel;
                $empp = $emprt->requete("SELECT * FROM emprunter WHERE id=?",[$id])->fetch();
                $ent = new DocumentsModel;
                $modifentre= $ent->requete("UPDATE documents SET status_doc=? WHERE id=?",[0,$empp->id_entrees]);

                

                 // var_dump($empp->id_entrees);
                  //exit;
                
                
                //var_dump($modifentre);
                //exit;
                 //$id_entr =$ent->requete("SELECT id_entrees FROM emprunter WHERE id=?",[$id])->fetch();
                 
                // var_dump($modifentre);
                 //exit;

                            Form::setFlash('success',"Un Emprunt vient d'etre validé" );
                            header("Location: /archives/liste_emprunts_valide");
                            exit;
        }


       }else{
        header("Location: /");
       }

    $this->Render('/archives/depot_emprunt',compact('entrees','users','afficheFile','affiche','useremp'),'admin');
  }


	public function valide(int $id){


		if($this->isAdmin()){
        $datesdepot=date('Y-m-d H:i:s');
        $status=0;
		$listes = new EmprunterModel;
		//mise a jour de la table emprunt
		$emprunt = $listes->requete("UPDATE emprunter SET date_depot=?, status_emp=? WHERE id_entrees=?",[$datesdepot,$status,$id]);
		$entrees = new DocumentsModel;
		//on met a jour la table entrees
		$entres = $entrees->requete("UPDATE documents SET update_at=?, status_doc=? WHERE id=?",[$datesdepot,0,$id]);

		$listeEmp = $listes->requete("SELECT * FROM users as u, emprunter as e,depot as dep, documents as d WHERE u.id = dep.id_user_depot AND e.id = dep.id_emprunt AND u.id = e.id_user AND d.id = e.id_entrees AND e.status_emp=?",[0])->fetchAll();
		Form::setFlash('success',"Un depot vient d'etre éffectué" );
		header("Location: /archives/liste_emprunts_valide");
         exit;

	}else{
		header("Location: /");
	}
		$this->Render('/archives/liste_emprunts_pending',compact('listeEmp'),'admin');
	}
	public function liste_emprunts_valide()
	{
		$listes = new EmprunterModel;
		$listeEmp = $listes->requete("SELECT * FROM categories as c, types as t, dossiers as dos,users as u, emprunter as e, depot as dep, documents as d 
      WHERE d.id_dos=dos.id AND c.id=d.id_cat AND t.id=d.id_types AND u.id = e.id_user AND d.id = e.id_entrees AND e.status_emp=? AND e.id = dep.id_emprunt 
      GROUP BY e.id",[0])->fetchAll();

				$this->Render('/archives/liste_emprunts_valide',compact('listeEmp'),'admin');

	}


	public function stats_emprunts()
	{
		$affemp = new EmprunterModel;
		$emprunts = $affemp->requete("SELECT *, COUNT(*) as total FROM categories,types,dossiers,emprunter,documents WHERE categories.id=documents.id_cat AND types.id=documents.id_types AND dossiers.id=documents.id_dos AND emprunter.id_entrees = documents.id GROUP BY emprunter.id_entrees")->fetchAll();
    $domModel = new DomainesModel;
  $domaines = $domModel->findAll();
		$this->Render('/archives/stats_emprunts',compact('emprunts','domaines'),'admin');
	}
  public function emp_stats()
  {
    $affemp = new EmprunterModel;
    $emprunts = $affemp->requete("SELECT *, COUNT(*) as total FROM categories,types,dossiers,emprunter,documents WHERE categories.id=documents.id_cat AND types.id=documents.id_types AND dossiers.id=documents.id_dos AND emprunter.id_entrees = documents.id GROUP BY emprunter.id_entrees")->fetchAll();
    $domModel = new DomainesModel;
  $domaines = $domModel->findAll();
    $this->Render('/archives/liste_emp',compact('emprunts','domaines'),'admin');
  }
public function domaine_stats(){

    $this->Render('/archives/dom_stats',[],'default');
  }
  public function liste_stats(){

    $this->Render('/archives/liste_stats',[],'default');
  }
	public function details_emprunts(int $id){
		$affemp = new EmprunterModel;
		$demprunts = $affemp->requete("SELECT * FROM categories,types,dossiers,documents,users,depot,emprunter WHERE categories.id=documents.id_cat AND types.id=documents.id_types AND dossiers.id=documents.id_dos AND users.id = emprunter.id_user AND depot.id_emprunt= emprunter.id AND emprunter.id_entrees = documents.id AND emprunter.id_entrees = ?",[$id])->fetchAll();
		$this->Render('/archives/details_emprunts',compact('demprunts'),'admin');
	}

    public function details_emprunt(int $id){
   
    $this->Render('/archives/details_emprunt',[],'admin');
  }


}




 ?>