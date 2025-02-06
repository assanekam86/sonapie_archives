<?php 

namespace App\Controllers;

use App\Controllers\FichiersController;
use App\Controllers\UsersController;
use App\Core\Db;
use App\Core\Form;
use App\Models\DomainesModel;
use App\Models\DocumentsModel;
use App\Models\DossiersModel;
use App\Models\FichiersModel;
use App\Models\NaturesModel;
use App\Models\DirectionsModel;
use App\Models\TypesModel;
use App\Models\UsersModel;
use App\Models\UsagersModel;


class DocumentsController extends Controller
{

//liste des documents
	public function liste_documents(int $id=null)
	{

		if($this->isAdmin()){

			$docModel = new DocumentsModel;
		$afficheDoc = $docModel->requete("
			SELECT v.ville,v.id as idvil,c.id as idcat,c.designation,b.id as idboit,b.boite,et.id as idet,et.etagere,
			sal.id as idsal,sal.salle,ray.id as idray,ray.rayon,u.nom,u.prenom,o.id,o.dossier,o.date_creation_dossier,o.update_at
			 FROM villes as v,categories as c,boites as b,etageres as et,salles as sal, rayons as ray, users as u,dossiers as o WHERE v.id=sal.id_ville AND u.id = o.id_user AND b.id_etagere= et.id AND o.id_boite=b.id AND et.id_rayon= ray.id AND ray.id_salle=sal.id AND c.id = o.id_cat  GROUP BY o.dossier ORDER BY o.date_creation_dossier DESC")->fetchAll();


		
		/*$afficheFile = $docModel->requete("
			SELECT d.reference,d.libelle, d.id as id_doc, f.id, f.fichier,f.type, s.designation, c.designation as designat, n.nature, t.type as typ 
			FROM 
			documents as d,services as s,categories as c, natures as n, types as t,fichiers as f 
			WHERE 
			d.id = f.id_doc AND d.id_serv=s.id AND d.id_cat = c.id AND d.id_natures = n.id AND d.id_types = t.id 
			AND d.id=? AND d.actif=? AND f.actif=? 
			ORDER BY d.date_creation_doc DESC
			",[$id,1,1])->fetchAll();*/
	}
		
     
		
		$this->Render('/documents/liste_documents',compact('afficheDoc'),'admin');
	}

	public function pieces_domaine(int $id)
	{

		if($this->isAdmin()){

			$docModel = new DocumentsModel;
		$afficheFile = $docModel->requete("SELECT * FROM categories as c, villes as v, salles as sal,boites as b, rayons as ray,etageres as et,types as t, usagers as u,dossiers as o,documents as d WHERE v.id=sal.id_ville AND sal.id=ray.id_salle AND ray.id=et.id_rayon AND et.id=b.id_etagere AND d.actif=? AND u.id = d.id_usager AND d.id_dos = o.id AND d.id_types = t.id AND c.id= d.id_cat AND c.id=? GROUP BY d.reference ORDER BY d.date_creation_doc DESC",[1,$id])->fetchAll();
$pieces = $docModel->requete("SELECT * FROM villes as v, salles as sal,boites as b, rayons as ray,etageres as et,types as t, usagers as u,dossiers as o,documents as d, categories as c WHERE v.id=sal.id_ville AND sal.id=ray.id_salle AND ray.id=et.id_rayon AND et.id=b.id_etagere AND d.actif=? AND u.id = d.id_usager AND d.id_dos = o.id AND d.id_types = t.id AND c.id= d.id_cat AND c.id=? GROUP BY d.reference ORDER BY d.date_creation_doc DESC",[1,$id])->fetch();
		
		/*$afficheFile = $docModel->requete("
			SELECT d.reference,d.libelle, d.id as id_doc, f.id, f.fichier,f.type, s.designation, c.designation as designat, n.nature, t.type as typ 
			FROM 
			documents as d,services as s,categories as c, natures as n, types as t,fichiers as f 
			WHERE 
			d.id = f.id_doc AND d.id_serv=s.id AND d.id_cat = c.id AND d.id_natures = n.id AND d.id_types = t.id 
			AND d.id=? AND d.actif=? AND f.actif=? 
			ORDER BY d.date_creation_doc DESC
			",[$id,1,1])->fetchAll();*/
	}
		
     
		
$this->Render('/documents/pieces_domaine',compact('afficheFile','pieces'),'admin');
	}

	public function liste_pieces1(int $id)
	{

		if($this->isAdmin()){

			$docModel = new DocumentsModel;
		$afficheFile = $docModel->requete("SELECT * FROM categories as c, villes as v, salles as sal,boites as b, rayons as ray,etageres as et,types as t, usagers as u,dossiers as o,documents as d WHERE v.id=sal.id_ville AND sal.id=ray.id_salle AND ray.id=et.id_rayon AND et.id=b.id_etagere AND d.actif=? AND u.id = d.id_usager AND d.id_dos = o.id AND d.id_types = t.id AND d.id_dos =? AND c.id= d.id_cat GROUP BY d.reference ORDER BY d.date_creation_doc DESC",[1,$id])->fetchAll();
		//$affiche = $docModel->requete("SELECT * FROM categories as c, villes as v, salles as sal,boites as b, rayons as ray,etageres as et,types as t, usagers as u,documents as d,dossiers as o WHERE v.id=sal.id_ville AND sal.id=ray.id_salle AND ray.id=et.id_rayon AND et.id=b.id_etagere AND d.actif=? AND u.id = d.id_usager AND d.id_dos = o.id AND d.id_types = t.id AND d.id_dos =? AND c.id= d.id_cat GROUP BY d.reference ORDER BY d.date_creation_doc DESC",[1,$id])->fetch();
		//$affiche = $docModel->requete("SELECT * FROM categories as c, villes as v, salles as sal,boites as b, rayons as ray,etageres as et,types as t, usagers as u,dossiers as o WHERE v.id=sal.id_ville AND sal.id=ray.id_salle AND ray.id=et.id_rayon AND et.id=b.id_etagere AND u.id = d.id_usager AND d.id_dos = o.id AND d.id_types = t.id AND d.id_dos =? AND c.id= d.id_cat GROUP BY d.reference ORDER BY d.date_creation_doc DESC",[1,$id])->fetch();
        $affiche = $docModel->requete("SELECT * FROM dossiers WHERE id = ?", [$id])->fetch();

            /*$afficheFile = $docModel->requete("
			SELECT d.reference,d.libelle, d.id as id_doc, f.id, f.fichier,f.type, s.designation, c.designation as designat, n.nature, t.type as typ
			FROM
			documents as d,services as s,categories as c, natures as n, types as t,fichiers as f
			WHERE
			d.id = f.id_doc AND d.id_serv=s.id AND d.id_cat = c.id AND d.id_natures = n.id AND d.id_types = t.id
			AND d.id=? AND d.actif=? AND f.actif=?
			ORDER BY d.date_creation_doc DESC
			",[$id,1,1])->fetchAll();*/
	}

		
     
		
		$this->Render('/documents/liste_pieces',compact('afficheFile','affiche'),'admin');
	}

    public function liste_pieces(int $id)
    {

        if ($this->isAdmin()) {

            $docModel = new DocumentsModel;
            $afficheFile = $docModel->requete("select d.id,d.reference,o.dossier,b.boite,et.etagere,ray.rayon,sal.salle,v.ville,c.designation,t.type,u.usager,d.date_creation_doc,d.update_at FROM villes as v JOIN salles as sal ON v.id = sal.id_ville JOIN rayons as ray ON sal.id = ray.id_salle JOIN etageres as et ON ray.id = et.id_rayon JOIN boites as b ON et.id = b.id_etagere JOIN categories as c ON c.id = b.id_cat JOIN dossiers as o ON b.id = o.id_boite JOIN documents as d ON o.id = d.id_dos LEFT JOIN usagers as u ON u.id = d.id_usager JOIN types as t ON d.id_types = t.id WHERE d.actif = ? AND d.id_dos = ? GROUP BY d.reference ORDER BY d.date_creation_doc DESC", [1, $id])->fetchAll();
            //$affiche = $docModel->requete("SELECT * FROM categories as c, villes as v, salles as sal,boites as b, rayons as ray,etageres as et,types as t, usagers as u,documents as d,dossiers as o WHERE v.id=sal.id_ville AND sal.id=ray.id_salle AND ray.id=et.id_rayon AND et.id=b.id_etagere AND d.actif=? AND u.id = d.id_usager AND d.id_dos = o.id AND d.id_types = t.id AND d.id_dos =? AND c.id= d.id_cat GROUP BY d.reference ORDER BY d.date_creation_doc DESC",[1,$id])->fetch();
            //$affiche = $docModel->requete("SELECT * FROM categories as c, villes as v, salles as sal,boites as b, rayons as ray,etageres as et,types as t, usagers as u,dossiers as o WHERE v.id=sal.id_ville AND sal.id=ray.id_salle AND ray.id=et.id_rayon AND et.id=b.id_etagere AND u.id = d.id_usager AND d.id_dos = o.id AND d.id_types = t.id AND d.id_dos =? AND c.id= d.id_cat GROUP BY d.reference ORDER BY d.date_creation_doc DESC",[1,$id])->fetch();
            $affiche = $docModel->requete("SELECT * FROM dossiers WHERE id = ?", [$id])->fetch();

            /*$afficheFile = $docModel->requete("
			SELECT d.reference,d.libelle, d.id as id_doc, f.id, f.fichier,f.type, s.designation, c.designation as designat, n.nature, t.type as typ
			FROM
			documents as d,services as s,categories as c, natures as n, types as t,fichiers as f
			WHERE
			d.id = f.id_doc AND d.id_serv=s.id AND d.id_cat = c.id AND d.id_natures = n.id AND d.id_types = t.id
			AND d.id=? AND d.actif=? AND f.actif=?
			ORDER BY d.date_creation_doc DESC
			",[$id,1,1])->fetchAll();*/
        }
        $this->Render('/documents/liste_pieces',compact('afficheFile','affiche'),'admin');

    }
		public function pieces_type(int $id)
	{

		if($this->isAdmin()){

			$docModel = new DocumentsModel;
		//$afficheFile = $docModel->requete("SELECT * FROM categories as c, villes as v, salles as sal,boites as b, rayons as ray,etageres as et,types as t, usagers as u,dossiers as o,documents as d WHERE v.id=sal.id_ville AND sal.id=ray.id_salle AND ray.id=et.id_rayon AND et.id=b.id_etagere AND d.actif=? AND u.id = d.id_usager AND d.id_dos = o.id AND d.id_types = t.id AND d.id_types =? AND c.id= d.id_cat GROUP BY d.reference ORDER BY d.date_creation_doc DESC",[1,$id])->fetchAll();
		//$affiche = $docModel->requete("SELECT * FROM categories as c, villes as v, salles as sal,boites as b, rayons as ray,etageres as et, usagers as u,dossiers as o,documents as d ,types as t WHERE v.id=sal.id_ville AND sal.id=ray.id_salle AND ray.id=et.id_rayon AND et.id=b.id_etagere AND d.actif=? AND u.id = d.id_usager AND d.id_dos = o.id AND d.id_types = t.id AND d.id_types =? AND c.id= d.id_cat GROUP BY d.reference ORDER BY d.date_creation_doc DESC",[1,$id])->fetch();
            $afficheFile = $docModel->requete("
				select d.id,d.id_types,d.reference,o.dossier,b.boite,et.etagere,ray.rayon,sal.salle,v.ville,c.designation,t.type,u.usager,d.date_creation_doc,d.update_at 
				FROM villes as v 
				    JOIN salles as sal ON v.id = sal.id_ville 
				    JOIN rayons as ray ON sal.id = ray.id_salle 
				    JOIN etageres as et ON ray.id = et.id_rayon 
				    JOIN boites as b ON et.id = b.id_etagere 
				    JOIN dossiers as o ON b.id = o.id_boite 
				    JOIN documents as d ON o.id = d.id_dos
				    JOIN types as t ON d.id_types = t.id
				    JOIN categories as c ON c.id = t.id_cat  
				    LEFT JOIN usagers as u ON u.id = d.id_usager 
			WHERE d.actif=? AND d.id_types =? GROUP BY d.reference ORDER BY d.date_creation_doc DESC",[1,$id])->fetchAll();

            //$affiche = $docModel->requete("select t.id,d.reference,o.dossier,b.boite,et.etagere,ray.rayon,sal.salle,v.ville,c.designation,t.type,u.usager,d.date_creation_doc,d.update_at FROM villes as v JOIN salles as sal ON v.id = sal.id_ville JOIN rayons as ray ON sal.id = ray.id_salle JOIN etageres as et ON ray.id = et.id_rayon JOIN boites as b ON et.id = b.id_etagere JOIN categories as c ON c.id = b.id_cat JOIN dossiers as o ON b.id = o.id_boite JOIN documents as d ON o.id = d.id_dos LEFT JOIN usagers as u ON u.id = d.id_usager JOIN types as t ON d.id_types = t.id WHERE d.actif=? AND d.id_types =? GROUP BY d.reference ORDER BY d.date_creation_doc DESC",[1,$id])->fetch();
            $affiche = $docModel->requete("select t.id,t.type FROM categories as c    
                                              JOIN boites as b ON c.id = b.id_cat 
                                              JOIN dossiers as o ON c.id = o.id_cat  
                                              JOIN types as t ON c.id = t.id_cat 
                                              WHERE t.id =? GROUP BY t.type",[$id])->fetch();
            /*$afficheFile = $docModel->requete("
			SELECT d.reference,d.libelle, d.id as id_doc, f.id, f.fichier,f.type, s.designation, c.designation as designat, n.nature, t.type as typ
			FROM
			documents as d,services as s,categories as c, natures as n, types as t,fichiers as f
			WHERE
			d.id = f.id_doc AND d.id_serv=s.id AND d.id_cat = c.id AND d.id_natures = n.id AND d.id_types = t.id
			AND d.id=? AND d.actif=? AND f.actif=?
			ORDER BY d.date_creation_doc DESC
			",[$id,1,1])->fetchAll();*/
	}
	$this->Render('/documents/pieces_type',compact('afficheFile','affiche'),'admin');

}
	//details des pieces
	//
    public function details1(int $id){
		$docModel = new DocumentsModel;
    	$afficheFile = $docModel->requete("SELECT * FROM categories as c,types as t, usagers as u,dossiers as o,users as us,documents as d WHERE us.id=d.id_user AND u.id = d.id_usager AND d.id_dos = o.id AND d.id_types = t.id AND d.id =? AND c.id= d.id_cat",[$id])->fetch();

    	$affiche = $docModel->requete("SELECT c.designation,dos.dossier,t.type as typ,f.fichier,f.type,f.date_creation,usag.usager, f.update_at,f.id FROM categories as c,usagers as usag, types as t, documents as d,dossiers as dos,fichiers as f  WHERE usag.id=d.id_usager AND f.id_doc = ? AND d.id_cat = c.id AND dos.id=d.id_dos AND t.id = d.id_types AND d.id=f.id_doc AND f.actif=?",[$id,1])->fetchAll();


    	$this->Render('/documents/details_pieces',compact('afficheFile','affiche'),'admin');
    }
    public function details(int $id){
        $docModel = new DocumentsModel;
        $afficheFile = $docModel->requete("SELECT * FROM categories as c
											JOIN documents as d ON c.id= d.id_cat 
											JOIN types as t ON d.id_types = t.id
											LEFT JOIN usagers as u ON u.id = d.id_usager 
											JOIN dossiers as o ON d.id_dos = o.id 
											JOIN users as us ON us.id=d.id_user 
											WHERE d.id=?",[$id])->fetch();

        $affiche = $docModel->requete("SELECT c.designation,dos.dossier,t.type as typ,f.fichier,f.type,f.date_creation,usag.usager, f.update_at,f.id
						    			FROM categories as c
										JOIN documents as d ON d.id_cat = c.id
										LEFT JOIN usagers as usag ON usag.id=d.id_usager
										JOIN types as t ON  t.id = d.id_types
										JOIN dossiers as dos ON dos.id=d.id_dos
										JOIN fichiers as f ON d.id=f.id_doc 
										WHERE f.id_doc = ? AND f.actif=?",[$id,1])->fetchAll();


        $this->Render('/documents/details_pieces',compact('afficheFile','affiche'),'admin');
    }
    //mes documents
	public function mes_documents(int $id=null)
	{

		//var_dump($users->id_service);
		//var_dump($users);
		$user = new UsersModel;
		$userss = $user->requete('SELECT rl_types.id_type FROM users,types,rl_types WHERE users.id = rl_types.id_user AND types.id = rl_types.id_type AND users.id=? GROUP BY rl_types.id_type',[$_SESSION['user']['id']])->fetchAll();

		$docModel = new DocumentsModel;

		$afficheDos = $docModel->requete("SELECT * FROM documents as d,categories as c,types as t,boites as b,etageres as et,salles as sal, rayons as ray, users as u,dossiers as o WHERE d.actif=? AND u.id = d.id_user AND d.id_dos = o.id AND d.id_types = t.id AND b.id_etagere= et.id AND o.id_boite=b.id AND et.id_rayon= ray.id AND ray.id_salle=sal.id AND c.id= d.id_cat  GROUP BY o.dossier ORDER BY d.date_creation_doc DESC",[1])->fetchAll();


		$afficheFile = $docModel->requete("SELECT * FROM categories as c,types as t, usagers as u,dossiers as o,documents as d WHERE d.actif=? AND u.id = d.id_usager AND d.id_dos = o.id AND d.id_types = t.id AND d.id_dos =? AND c.id= d.id_cat GROUP BY d.reference ORDER BY d.date_creation_doc DESC",[1,$id])->fetchAll();


		//$afficheFile = $docModel->requete(
		//	"SELECT * FROM categories as c,types as t, usagers as u,dossiers as o,documents as d WHERE u.id = d.id_usager AND d.id_dos = o.id AND d.id_types = t.id AND d.id_dos =? AND c.id= d.id_cat AND d.actif=? AND d.actif=? AND d.id_types=? GROUP BY d.reference ORDER BY d.date_creation_doc DESC",
		  //[$id,1,1,$users->id_type])->fetchAll();

		/*$afficheFile = $docModel->requete(
			"SELECT
			d.reference,d.libelle as document, d.id as id_doc, f.id, f.fichier,f.type, s.designation, c.designation as designat, n.nature, t.type as typ
		 FROM
		 documents as d,services as s,categories as c, natures as n, types as t,fichiers as f
		 WHERE
		 d.id = f.id_doc AND d.id_serv=s.id AND d.id_cat = c.id AND d.id_natures = n.id AND d.id_types = t.id
			AND
		  d.id = f.id_doc AND d.id=? AND d.actif=? AND f.actif=? AND d.id_serv=? ORDER BY d.date_creation_doc DESC ",
		  [$id,1,1,$users->id_type])->fetchAll();
     */
    $typesModel = new TypesModel;
	$types = $typesModel->requete("SELECT * FROM categories,types WHERE categories.id=types.id_cat ORDER BY type asc");

	$servModel = new DossiersModel;
	$dossiers = $servModel->findAll();

	$natModel = new DomainesModel;
	$natures = $natModel->findAll();

		$this->Render('/documents/mes_documents',compact('afficheDos','userss','afficheFile','types','dossiers','natures'),'admin');

	}

	//imprimer pdf
	public function imprimer(int $id)
	{

		//var_dump($users->id_service);
		//var_dump($users);
		$user = new UsersModel;
		$users = $user->requete('SELECT * FROM users as u,types as s,rl_types as r,documents as d WHERE d.id_user = u.id AND d.id_types = r.id_type AND s.id = d.id_types')->fetch();

		$docModel = new DocumentsModel;

		$afficheFile = $docModel->requete(
			"SELECT c.designation,dos.dossier,t.type as typ,f.fichier,f.type,f.date_creation, f.update_at,f.id FROM categories as c, types as t, documents as d,dossiers as dos,fichiers as f  WHERE f.id = ? AND d.id_cat = c.id AND dos.id=d.id_dos AND t.id = d.id_types AND d.id=f.id_doc AND f.actif=? AND d.actif=? ",
		  [$id,1,1])->fetch();


		$this->Render('/documents/imp',compact('afficheFile'),'default');

	}

		//imprimer image
	public function imprime(int $id)
	{

		//var_dump($users->id_service);
		//var_dump($users);
		$user = new UsersModel;
		$users = $user->requete('SELECT * FROM users as u,types as s,rl_types as r,documents as d WHERE d.id_user = u.id AND d.id_types = r.id_type AND s.id = d.id_types')->fetch();

		$docModel = new DocumentsModel;

		$afficheFile = $docModel->requete(
			"SELECT c.designation,dos.dossier,t.type as typ,f.fichier,f.type,f.date_creation, f.update_at,f.id FROM categories as c, types as t, documents as d,dossiers as dos,fichiers as f  WHERE f.id = ? AND d.id_cat = c.id AND dos.id=d.id_dos AND t.id = d.id_types AND d.id=f.id_doc AND f.actif=? AND d.actif=? ",
		  [$id,1,1])->fetch();


		$this->Render('documents/imprime',compact('afficheFile'),'admin');

	}

	//modier document

	public function supprimeDocument(int $id){
		$docModel = new DocumentsModel;
		$dates = date('Y-m-d H:i:s');
		$afficheDoc = $docModel->requete("UPDATE documents SET actif=?,update_at=? WHERE id=?",[0,$dates,$id]);
		Form::setFlash('success','Un document à été supprimé');
		 header("Location: ".$_SERVER['HTTP_REFERER']);
		 exit;
	}

	//restaurer document
	public function restaureDocuments(int $id){
		$docModel = new DocumentsModel;
		$dates = date('Y-m-d H:i:s');
		$afficheDoc = $docModel->requete("UPDATE documents SET actif=? ,update_at=? WHERE id=?",[1,$dates,$id]);
		Form::setFlash('success','Une Pièce a été restaurée');
		 header("Location: ".$_SERVER['HTTP_REFERER']);
		 exit;
	}
	//corbeille documents admin
	public function corbeille_documents(int $id=null)
	{
		if($this->isAdmin()){

			$docModel = new DocumentsModel;
		$afficheDoc = $docModel->requete("SELECT * FROM types as s,usagers as us,categories as c,dossiers as dos, users as u,documents as d WHERE c.id=d.id_cat AND dos.id=d.id_dos AND d.id_usager= us.id AND s.id = d.id_types AND u.id = d.id_user AND d.actif=? GROUP BY d.reference",[0])->fetchAll();

		$afficheFile = $docModel->requete("SELECT * FROM documents as d,fichiers as f, users as u WHERE d.id = f.id_doc AND u.id = d.id_user AND d.id=? AND d.actif=? AND f.actif=?",[$id,0,1])->fetchAll();
	}

			$this->Render('/documents/corbeille_documents',compact('afficheDoc','afficheFile'),'admin');



}
//corbeille document utilisteur

public function corbeille_user(int $id=null)
	{
		if(isset($_SESSION['user'])){
		$user = new UsersModel;
		$users = $user->requete('SELECT * FROM users WHERE id=?',[$_SESSION['user']['id']])->fetch();
		//var_dump($users->id_service);

			$docModel = new DocumentsModel;
		$afficheDoc = $docModel->requete("SELECT * FROM types as s,rl_types as r ,usagers as us,categories as c,dossiers as dos, users as u,documents as d WHERE c.id=d.id_cat AND dos.id=d.id_dos AND d.id_usager= us.id AND r.id_type = d.id_cat AND s.id = d.id_types AND u.id = d.id_user AND d.actif=? GROUP BY d.reference ORDER BY d.id DESC",[0])->fetchAll();

		$afficheFile = $docModel->requete("SELECT * FROM documents as d,fichiers as f, users as u WHERE d.id = f.id_doc AND u.id = d.id_user AND d.id=? AND d.actif=? AND f.actif=? AND d.id_user=?",[$id,0,1,$_SESSION['user']['id']])->fetchAll();


		$this->Render('/documents/corbeille_user',compact('afficheDoc','afficheFile'),'admin');
	}else{
		header("Location: /");
		exit;
	}
	}

	//ajouter un documents

	public function ajout_documents()

	{
		///var_dump($_POST);
		//var_dump(scandir('../public/scann'));

     if (Form::Validate($_POST,['dossier','domaine','types','cases'])) {
			//le formulaire est valide
			$nbr = 1;

			//$ref = strtoupper(strip_tags($_POST['reference']));

			$dom = $_POST['domaine'];
			$dos = $_POST['dossier'];
			$typ = $_POST['types'];
			$cases = $_POST['cases'];
			$lib = strip_tags($_POST['libelle']);
			//$lib1 = strip_tags($_POST['libelle1']);
			$lib2 = strip_tags($_POST['libelle2']);
			$lib5 = strip_tags($_POST['libelle5']);
			$lib10 = strip_tags($_POST['libelle10']);
			$lib12 = strip_tags($_POST['libelle12']);
			$lib14 = strip_tags($_POST['libelle14']);
			$lib15 = strip_tags($_POST['libelle15']);
			$lib16 = strip_tags($_POST['libelle16']);
			$lib19 = strip_tags($_POST['libelle19']);
			$lib20 = strip_tags($_POST['libelle20']);
			$lib22 = strip_tags($_POST['libelle22']);
			//$desc1 = strip_tags($_POST['objet1']);
			$desc10 = strip_tags($_POST['objet10']);
			$desc11 = strip_tags($_POST['objet11']);
			$desc12 = strip_tags($_POST['objet12']);
			$desc13 = strip_tags($_POST['objet13']);
			$desc14 = strip_tags($_POST['objet14']);
			$desc15 = strip_tags($_POST['objet15']);
			$desc16 = strip_tags($_POST['objet16']);
			$desc17 = strip_tags($_POST['objet17']);
			$desc19 = strip_tags($_POST['objet19']);
			$desc20 = strip_tags($_POST['objet20']);
			$desc21 = strip_tags($_POST['objet21']);
			$desc22 = strip_tags($_POST['objet22']);
			$numero = strip_tags($_POST['numero']);
			$numero2 = strip_tags($_POST['numero2']);
			$numero1 = strip_tags($_POST['numero1']);
			//$numero3 = strip_tags($_POST['numero3']);
			$numero4 = strip_tags($_POST['numero4']);
			$numero5 = strip_tags($_POST['numero5']);
			$numero7 = strip_tags($_POST['numero7']);
			$numero8 = strip_tags($_POST['numero8']);
			$numero9 = strip_tags($_POST['numero9']);
			$numero10 = strip_tags($_POST['numero10']);
			$numero11 = strip_tags($_POST['numero11']);
			$numero12 = strip_tags($_POST['numero12']);
			$numero13 = strip_tags($_POST['numero13']);
			$numero14 = strip_tags($_POST['numero14']);
			$numero15 = strip_tags($_POST['numero15']);
			$numero16 = strip_tags($_POST['numero16']);
			$numero17 = strip_tags($_POST['numero17']);
			$numero18 = strip_tags($_POST['numero18']);
			$numero19 = strip_tags($_POST['numero19']);
			$numero20 = strip_tags($_POST['numero20']);
			$numero21 = strip_tags($_POST['numero21']);
			$numero22 = strip_tags($_POST['numero22']);
			$etabli = $_POST['etabli'];
			$etabli1 = $_POST['etabli1'];
			$etabli2 = $_POST['etabli2'];
			$etabli4 = $_POST['etabli4'];
			$etabli5 = $_POST['etabli5'];
			$etabli8 = $_POST['etabli8'];
			$etabli10 = $_POST['etabli10'];
			$etabli11 = $_POST['etabli11'];
			$etabli12 = $_POST['etabli12'];
			$etabli13 = $_POST['etabli13'];
			$etabli14 = $_POST['etabli14'];
			$etabli15 = $_POST['etabli15'];
			$etabli16 = $_POST['etabli16'];
			$etabli17 = $_POST['etabli17'];
			$etabli19 = $_POST['etabli19'];
			$etabli20 = $_POST['etabli20'];
			$etabli21 = $_POST['etabli21'];
			$etabli22 = $_POST['etabli22'];
			$indem = strip_tags($_POST['indemnite']);
			$gains = strip_tags($_POST['gains']);
			$retenues = strip_tags($_POST['retenues']);
			$montant5 = strip_tags($_POST['montant5']);
			$montant7 = strip_tags($_POST['montant7']);
			$montant8 = strip_tags($_POST['montant8']);
			$montant9 = strip_tags($_POST['montant9']);
			$montant20 = strip_tags($_POST['montant20']);
			$reglement5 = strip_tags($_POST['reglement5']);
			$reglement20 = strip_tags($_POST['reglement20']);
			$compte5 = strip_tags($_POST['compte5']);
			$compte18 = strip_tags($_POST['compte18']);
			$decision9 = strip_tags($_POST['decision9']);
			$datedecision = $_POST['datedecision'];
			$expertise = strip_tags($_POST['expertise']);
			$nbrep = $_POST['nbrep'];
			$solde = strip_tags($_POST['solde']);
			$arriere = strip_tags($_POST['arriere']);
			//$logement = strip_tags($_POST['logement']);
			$logement7 = strip_tags($_POST['logement7']);
			$baille = strip_tags($_POST['baille']);
			$logroupe= strip_tags($_POST['logroupe']);
			$pieces= strip_tags($_POST['pieces']);
			$ville= strip_tags($_POST['ville']);
			$duree= strip_tags($_POST['duree']);
			$duree20= strip_tags($_POST['duree20']);
			$compte5= strip_tags($_POST['compte5']);
			$compte20= strip_tags($_POST['compte20']);
			$codebanque= strip_tags($_POST['codebanque']);
			$codeguichet= strip_tags($_POST['codeguichet']);
			$domicile= strip_tags($_POST['domicile']);
			$domicile5= strip_tags($_POST['domicile5']);
			$domicile20= strip_tags($_POST['domicile20']);
			$contrat19=strip_tags($_POST['contrat19']);
			$contrat20=strip_tags($_POST['contrat20']);
			$rib= strip_tags($_POST['rib']);
			//$depart= $_POST['effet'];
			$depart13= $_POST['effet13'];
			$effet19= $_POST['effet19'];
			$effet20= $_POST['effet20'];
			$retour= $_POST['retour'];
			$imputation = strip_tags($_POST['imputation']);
			//$nat_id = strip_tags($_POST['natures']);
			$id_usager =$_POST['usager'];

			if($id_usager==''){
				$id_usager=1;
			}

			$id_user= $_SESSION['user']['id'];

			$annee = date('y');
			$catesModel = new DomainesModel;
			$findcat = $catesModel->find($dom);

			$dosModel = new DossiersModel;
			$finddos = $dosModel->find($dos);

			$typModel = new TypesModel;
			$findtyp = $typModel->find($typ);

//			$subserv = strtoupper(substr($findserv->designation, 0,4));
//			$subcat = strtoupper(substr($findcat->designation, 0,3));
				$chaf = rand(1,9999);
				//var_dump($findtyp->code."".$chaf);exit;
				//recuperer le nom categorie
			$Nomtyp = strtoupper($findtyp->type);
			$Nomdom = strtoupper($findcat->designation);
			$Nomdos = strtoupper($finddos->dossier);
			$code=$findtyp->code.$chaf;

				//$chaf = uniqid($chif,5);

			//$ref = $subserv.'-'.$subcat.'-'.$chaf.'-'.$annee;

//var_dump($_POST);exit;



			$db = Db::getInstance();
			  if($typ==1){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([$numero1,$typ]);
                $verif = $exe->fetch();
            		}
              elseif($typ==2){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([$numero2,$typ]);
                $verif = $exe->fetch();
            		}
             elseif($typ==3){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([$numero1,$typ]);
                $verif = $exe->fetch();
            		}
              elseif($typ==4){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([$numero4,$typ]);
                $verif = $exe->fetch();
            		}

            		elseif($typ==5 || $typ==6){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([$numero5,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==7){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([$numero7,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==8){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([$numero8,$typ]);
                $verif = $exe->fetch();
            		}

            		elseif($typ==9){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero9,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==10){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero10,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==11){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero11,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==12){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero12,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==13){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero13,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==14){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero14,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==15){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero15,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==16){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero16,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==17){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero17,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==18){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero18,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==19){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero19,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==20){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero20,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==21){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero21,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==22){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero22,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==23){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero22,$typ]);
                $verif = $exe->fetch();
            		}
            		else{
            			$req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero,$typ]);
                $verif = $exe->fetch();
            		}
                 //verirfie si le contact existe
                    if(!$verif){
                    			if($typ==1 || $typ==3){
                    				//CERTIFICAT DE NON HEBERGEMENT//
                    				////CERTIFICAT DE PREMIERE PRISE DE SERVICE
                    				$user = new DocumentsModel;
							$user->setReference($code)
								 ->setNumero($numero1)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								 ->setEtabli($etabli1)
								 ->setIdUsager($id_usager)
								 ->setIdUser($id_user);

						$user->Create();

                    				}
                    			elseif($typ==2)
                    			 {
                    			 	//ARRETE DE NOMMINATION//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero2)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle(strip_tags($_POST['libelle2']))
								 ->setEtabli($etabli2);
							$user->Create();
                    			}
                    			elseif($typ==4)
                    			 {//ATTESTATION DE NON LOGEMENT//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero4)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setTauxindem($indem)
								 ->setEtabli($etabli4);
							$user->Create();
                    			}
                    				elseif($typ==5 || $typ==6)
                    			 {//BELLETIN DE SOLDE//
                    			 	$user = new DocumentsModel;
                    			$user->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setReference($code)
								 ->setNumero($numero5)
								 ->setGains($gains)
								 ->setRetenues($retenues)
								 ->setLibelle($lib5)
								 ->setMontant($montant5)
								 ->setCompte($compte5)
								 ->setDomiciliation($domicile5)
								 ->setReglement($reglement5)
								 ->setEtabli($etabli5);
								$user->Create();
                    			}

								elseif($typ==7)
                    			 {//DECISION AFFECTATION DE LOGEMENT//
                    			 	$user = new DocumentsModel;
                    			$user->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setReference($code)
								 ->setNumero($numero7)
								 ->setLogement($logement7)
								 ->setLogroupe($logroupe)
								 ->setMontant($montant7)
								 ->setPieces($pieces)
								 ->setBaille($baille);
								$user->Create();
                    			}
                    			elseif($typ==8)
                    			 {//ATTESTATION DE FIN DE PAIEMENT//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero8)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setMontant($montant8)
								 ->setEtabli($etabli8);
							$user->Create();
                    			}

                    			elseif($typ==9)
                    			 {
                    			 	//SITUATION REGLEMENT ACQUEREUR//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero9)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setMontant($montant9)
								 ->setDecision($decision9)
								 ->setEffet($datedecision)
								 ->setArriere($arriere)
								 ->setNbrep($nbrep)
								 ->setExpertise($expertise)
								 ->setSolde($solde);
							$user->Create();
                    			}
                    			elseif($typ==10)
                    			 {
                    			 //NOTE INTERNE//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero10)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib10)
								 ->setDescription($desc10)
								 ->setEtabli($etabli10);
							$user->Create();
                    			}
                    			elseif($typ==11)
                    			 {
                    			 //FICHE DE PRESENCE//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero11)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc11)
								 ->setEtabli($etabli11);
							$user->Create();
                    			}
                    			elseif($typ==12)
                    			 {
                    			 //FICHE DE SORTIE DE FOURNITURE//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero12)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc12)
								 ->setLibelle($lib12)
								 ->setEtabli($etabli12);
							$user->Create();
                    			}
                    			elseif($typ==13)
                    			 {
                    			 //ORDRE DE MISSION//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero13)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc13)
								 ->setRetour($retour)
								 ->setEffet($depart13)
								 ->setImputation($imputation)
								 ->setEtabli($etabli13);
							$user->Create();
                    			}
                    			elseif($typ==14)
                    			 {
                    			 //PERSONNEL//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero14)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib14)
								 ->setDescription($desc14)
								 ->setEtabli($etabli14);
							$user->Create();
                    			}
                    			elseif($typ==15)
                    			 {
                    			 //ATTESTATION//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero15)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib15)
								 ->setDescription($desc15)
								 ->setEtabli($etabli15);
							$user->Create();
                    			}
                    			elseif($typ==16)
                    			 {
                    			 //DECISION//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero16)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib16)
								 ->setDescription($desc16)
								 ->setEtabli($etabli16);
							$user->Create();
                    			}
                    			elseif($typ==17)
                    			 {
                    			 //PROCURATION//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero17)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc17)
								 ->setEtabli($etabli17);
							$user->Create();
                    			}
                    			elseif($typ==18)
                    			 {
                    			 //RIB//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero18)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setCodebanque($codebanque)
								 ->setCodeguichet($codeguichet)
								 ->setDomiciliation($domicile)
								 ->setRib($rib)
								 ->setCompte($compte18);

							$user->Create();
                    			}
                    			elseif($typ==19)
                    			 {
                    			 //AVENANTS//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero19)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib19)
								 ->setEffet($effet19)
								 ->setDuree($duree)
								 ->setDescription($desc19)
								 ->setContrat($contrat19)
								 ->setEtabli($etabli19);
							$user->Create();
                    			}

                    			elseif($typ==20)
                    			 {
                    			 //CONTRAT DE BAIL//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero20)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib20)
								 ->setEffet($effet20)
								 ->setDuree($duree20)
								 ->setDescription($desc20)
								 ->setCompte($compte20)
								 ->setMontant($montant20)
								 ->setReglement($reglement20)
								 ->setDomiciliation($domicile20)
								 ->setVille($ville)
								 ->setContrat($contrat20)
								 ->setEtabli($etabli20);
							$user->Create();
                    			}

                    			elseif($typ==21)
                    			 {
                    			 //ACTE INDIViDUALITE//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero21)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc21)
								 ->setEtabli($etabli21);
							$user->Create();
                    			}elseif($typ==22)
                    			 {
                    			 //ARRIVEE//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero22)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc22)
								 ->setLibelle($lib22)
								 ->setEtabli($etabli22);
							$user->Create();
                    			}elseif($typ==23)
                    			 {
                    			 //DEPART//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero22)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc22)
								 ->setLibelle($lib22)
								 ->setEtabli($etabli22);
							$user->Create();
                    			}
                    			else{
                    				$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib)
								 ->setEtabli($etabli);
							$user->Create();
                    			}

							$last_id = $db->lastInsertId();
//var_dump($last_id); die();
							//creation des rêpertoires

		if(!is_dir("archives")){
								$rep = mkdir("archives",0777);
								//echo"ok";
							}
							if(!is_dir("archives/$Nomdom")){

								$rep = mkdir("archives/$Nomdom",0777);
							//	fopen($rep, "rw");
							//echo"ok1";
							//
							}
							if(!is_dir("archives/$Nomdom/$Nomtyp")){
								$rep = mkdir("archives/$Nomdom/$Nomtyp",0777);
								//echo"ok2";
							//	fopen($rep, "rw");
							//
							}
							if(!is_dir("archives/$Nomdom/$Nomtyp/$Nomdos")){
								$rep = mkdir("archives/$Nomdom/$Nomtyp/$Nomdos",0777);
								//echo"ok3";
							//	fopen($rep, "rw");
							//
							}
							/*
							if(!is_dir("archives/$Nomserv/$Nomcat/$Nomnat/$Nomtyp")){
								$rep = mkdir("archives/$Nomserv/$Nomcat/$Nomnat/$Nomtyp",0777);
								//echo"ok4";
							//	fopen($rep, "rw");
							//
							}
							if(!is_dir("archives/$Nomserv/$Nomcat/$Nomnat/$Nomtyp/$lib")){
								$rep = mkdir("archives/$Nomserv/$Nomcat/$Nomnat/$Nomtyp/$lib",0777);
								//echo"ok5";
							//	fopen($rep, "rw");
							//
							}*/

							//fin de repertoire
						 // Fusion des fichiers pdf


$fileArray= glob($_SERVER['DOCUMENT_ROOT'].'/pros/*.pdf');
//var_dump($fileArray);
 $datadir =$_SERVER['DOCUMENT_ROOT'].'/mydoc/';
 //var_dump($fileArray);
 $outputName = $datadir.rand(1,100).".pdf";
  $cmd = "gswin64c -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile=$outputName ";
//var_dump($cmd); die()
  //Add each pdf file to the end of the command

  foreach($fileArray as $file) {

    if ($file != "." && $file != "..") {

       $cmd .= $file." ";
    }

}


//var_dump($cmd);exit();

$result = shell_exec($cmd);
//var_dump($result);die();

	 // FIN fusion pdf

//var_dump($last_id); exit;
// Insertion des fichiers scanner
			 $src = 'mydoc/';
			 $mon='pdf-compatible/';
			// $uploaded='pdf-uploaded/';
		$dst = "archives/$Nomdom/$Nomtyp/$Nomdos/";
		$late =$last_id;
		//$name_img =$_POST['image'];
		//
		$req="SELECT dossier FROM dossiers WHERE id=?";
		$exe=Db::getInstance()->prepare($req);
		$exe->execute([$_POST['dossier']]);
		$data=$exe->fetch();
		$noms=[$data->dossier];
		$name_img =str_replace('/','',$noms);
		//var_dump();exit;




//copy($src, $dst);  //Call function
//Function to Copy folders and files
			function rcopy($src, $dst,$late,$name) {

				//global $ose; $result= $osse;
				//global $last_id;

 			   if (file_exists ( $dst ))
        	//rrmdir( $dst );
    		if (is_dir( $src )) {
        //mkdir ( $dst );
       		 $files =scandir( $src );
       		 $i=0;
       		 $chaf=rand(1,999);
       		 //$oss=$Nomdos;
       			 foreach ($files as $key=>$file ){
       	$req="SELECT dossier FROM dossiers WHERE id=?";
		$exe=Db::getInstance()->prepare($req);
		$exe->execute([$_POST['dossier']]);
		$data=$exe->fetch();
		$noms=[$data->dossier];
		$ext="pdf";
		$name_img =str_replace('/','',$noms);
           				 if ($file != "." && $file != ".."){
                           	$explode =explode('.', $file);
                           	$extension = end($explode);
                           	$new = $chaf.'_'.$name[$i].'.'.$extension;
               				 copy ("$src/$file","$dst/$new");
               				 //copy ( "$src/$file", "$dst/$chaf.'-'.$name[$i].'.'.$extension");
               				 //copy("$file", "$uploaded");
               				// var_dump($name[$i]);exit ;
               				//$new = $name[$i].'.'.$extension;

               				 $i++;
               				 $sendScann = new FichiersModel;

                        $sendScann->requete('INSERT INTO fichiers (fichier, type, id_doc) VALUES (?,?,?)',[$new,$ext,$late]);
                        	$chaf++;
                             	}
           		 //var_dump($src/$file);
							}
   						 } elseif (file_exists ( $src ))
        				copy( $src, $dst );
                    rrmdir( $src );
					}

				//Function to remove folders and files
				function rrmdir($dir) {
   						 if (is_dir($dir)) {
        					$files = scandir($dir);
        					foreach ($files as $file){
            				if ($file != "." && $file != "..") rrmdir("$dir/$file");
            			}
        					//rmdir($dir);
   								 }
   							 elseif (file_exists($dir)) unlink($dir);
							}

							rcopy($src,$dst,$late,$name_img);

							rrmdir($src);


							//supprimer le contenu de scann //
							$scann="scann/";
							rrmdir($scann);
								/*$ouverture=opendir($scann);
								$fichier=readdir($ouverture);
								$fichier=readdir($ouverture);
								while ($fichier=readdir($ouverture)) {
								unlink("$scann/$fichier");
									}
									closedir($ouverture);*/
							// Fin suppression scann//

							//supprimer le contenu de pros //
							$pros="pros/";
							rrmdir($pros);
								/*$ouverture=opendir($pros);
								$fichier=readdir($ouverture);
								$fichier=readdir($ouverture);
								while ($fichier=readdir($ouverture)) {
								unlink("$pros/$fichier");
									}
									closedir($ouverture);*/
							// Fin suppression pros//


// insertion fichiers uploadés
							 $phpFileUploadErrors = array(
           0 => "Vos informations ont &eacute;t&eacute; prise en compte. Merci",
           1 => "Le taille du fichiers est trop volumineux",
           2 => "Le fichier exc&eacute;de la taille demand&eacute;",
           3 => "Le fichier a &eacute;t&eacute; partiellement upload&eacute;",
           4 => " Pas de fichiers charg&eacute;",#App::Redirect("show_prestation.php"),
           5 => "Un dossier temporaire manquant",
           6 => "Echec d'ecriture sur le disk",
           7 => "Une extensions PHP a stopp&eacute; le fichier charg&eacute;",
       );
        function reArrayFiles($file_post){
            $file_ary = array();
            $file_count = count($file_post['name']);
            $file_key = array_keys($file_post);

            for($i=0; $i<$file_count; $i++){
                foreach ($file_key as $key):
                    $file_ary[$i][$key] = $file_post[$key][$i];
                endforeach;
            }
            return $file_ary;
        }

        //$tmp = $_FILES['fichier']['tmp_name'];
        if(isset($_FILES['fichier']))
         {
    //$repertoire =strtoupper(strip_tags($ref));
							if(!is_dir("archives")){
								$rep = mkdir("archives",0777);
								//echo"ok";
							}
							if(!is_dir("archives/$Nomdom")){
								$rep = mkdir("archives/$Nomdom",0777);
							//	fopen($rep, "rw");
							//echo"ok1";
							//
							}
							if(!is_dir("archives/$Nomdom/$Nomtyp")){
								$rep = mkdir("archives/$Nomdom/$Nomtyp",0777);
								//echo"ok2";
							//	fopen($rep, "rw");
							//
							}
							if(!is_dir("archives/$Nomdom/$Nomtyp/$Nomdos")){
								$rep = mkdir("archives/$Nomdom/$Nomtyp/$Nomdos",0777);
								//echo"ok3";
							//	fopen($rep, "rw");
							//
							}

							//var_dump($chemin);

           // $alpha = "azertyuiopmlkjhgfdsqwxcvbn0123654789";
            #$rep = $up.mkdir(uniqid($alpha,6)).'/';
            #$mon_rep = uniqid(substr(str_shuffle(str_repeat($alpha,5)),0,8));
            #$rep = mkdir($up.$mon_rep);
            #fopen($rep, "r+");
            #var_dump($rep);
            $file_array = reArrayFiles($_FILES['fichier']);
           // pre_r($file_array);
            for ($i=0;$i<count($file_array); $i++){
                if($file_array[$i]['error']){

             Form::setFlash('danger',$file_array[$i]['name'].''.$phpFileUploadErrors[$file_array[$i]['error']]);

                }else{
                    $extensions = array('jpg','png','gif','jpeg','html','php','doc','docx','csv','pdf','xlsx','xls','xlsm','rar','zip','3gp','mp4','mpeg','flv','mp3','amr','accdb','avi');
                    $file_ext = explode('.',$file_array[$i]['name']);
                    $file_ext = strtolower(end($file_ext));


                    if(!in_array($file_ext,$extensions)){

                         Form::setFlash('danger',$file_array[$i]['name']." - Extention Invalid");


                    }else{

                    	//var_dump(dirname(getcwd()));
                        #move_uploaded_file($file_array[$i]['tmp_name'], "uploads/".$file_array[$i]['name']);
                        #$last = $db->lastInsertId();
                        $sendFiles = new FichiersModel;
                        $monfile = str_replace(' ','_',$file_array[$i]['name']);
                        $sendFiles->requete('INSERT INTO fichiers (fichier, type, id_doc) VALUES (?,?,?)',[$chaf.'_'.$monfile,$file_ext,$last_id]);

						move_uploaded_file($file_array[$i]['tmp_name'],"archives/$Nomdom/$Nomtyp/$Nomdos/".$chaf.'_'.$monfile);

                     	//file_put_contents('pdf-compatible/'.$chaf.'_'.$monfile);

                             //  $sendFiles->setFichier($file_array[$i]['name'])
                              // 			 ->setType($file_ext)
                               //			 ->setIdDoc($last_id);
                              // $sendFiles->CreateFile();
                              // $sql = "INSERT INTO fichiers (fichier, type, id_doc) VALUES (?,?,?)";
                               //$insert = Db::getInstance()->prepare($sql);
                              //$insert->execute([$file_array[$i]['name'],$file_ext,$last_id]);

                        //var_dump("$repertoire/".$file_array[$i]['name']);
                        Form::setFlash('success',$phpFileUploadErrors[$file_array[$i]['error']]);
							}
                }
            }
        }


// FIn d'insertion de fichier scannes






								Form::setFlash('success','La pièce '.$code.' a été crée avec succès');
								header("Location:/documents/mes_documents");
								exit;
	}
	else{
							Form::setFlash('danger','Ce numéro de pièce est déjà utilsé pour cette typologie');
						}


					}	else{
			Form::setFlash('info','Veuillez à bien remplir le formulaire');
		}


		//modal usager

		if (Form::Validate($_POST,['usagers','typos','domaines'])) {
            //le formulaire est valide
            $usagers = strtoupper(strip_tags($_POST['usagers']));
            $types = strtoupper(strip_tags($_POST['typos']));
            $contact = strtoupper(strip_tags($_POST['contact']));
            $email = strtoupper(strip_tags($_POST['email']));
            $adresse = strip_tags($_POST['adresse']);
            $matricule = strip_tags($_POST['matricule']);
            $fonction = strip_tags($_POST['fonction']);
            $grade = strip_tags($_POST['grade']);
            $etab = strip_tags($_POST['etable']);
            $iddom= $_POST['domaines'];
            $dateserv = strip_tags($_POST['dateserv']);




                        $db = db::getInstance();
                        // code...

                    //on insert le service

                        if($types == 1)
                        {
                            $req= "select * FROM usagers WHERE usager=?";

                        $exe = $db->prepare($req);
                        $exe->execute([$usagers]);
                        $verif = $exe->fetch();
                            if(!$verif){
                            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                          //on hydrate l'usager entreprise
                            $usage = new UsagersModel;
                            $usage->setUsager($usagers)
                                    ->setTypeUsager($types)
                                    ->setContact($contact)
                                    ->setEmail($email)
                                    ->setAdresse($adresse)
                                    ->setIdCat($iddom);
                            $usage->Create();
                            }else{
                             Form::setFlash('danger',"Entrer un format d'email valide" );
                            }}else{
                         Form::setFlash('danger',"Cet usager exite déjà" );
                        }
                        }else{
                            // on hydrate l'usage particulier
                            //on hydrate le service
                        $req= "select * FROM usagers WHERE usager=? AND matricule=?";

                        $exe = $db->prepare($req);
                        $exe->execute([$usagers,$matricule]);
                        $verif = $exe->fetch();
                            if(!$verif){
                            $usage = new UsagersModel;
                            $usage->setUsager($usagers)
                                    ->setTypeUsager($types)
                                    ->setContact($contact)
                                    ->setMatricule($matricule)
                                    ->setFonction($fonction)
                                    ->setEtablissement($etab)
                                    ->setGrade($grade)
                                    ->setIdCat($iddom)
                                    ->setDateService($dateserv);
                            $usage->Create();
                        }else{
                         Form::setFlash('danger',"Cet usager exite déjà" );
                        }
                        }

                            Form::setFlash('success',"Un usager vient d'etre créer" );
                           // header("Location:/usagers/liste_usagers");
                            //exit;
                        }


		//fin modal usager

	$categorie = new DomainesModel;
	$dossier = new DossiersModel;
	$service = new DirectionsModel;
	$type = new TypesModel;
	$nature = new NaturesModel;
    $services = $service->findAll();
    $domaines = $categorie->findAll();
    $dossiers = $dossier->requete("SELECT * FROM rayons,etageres,boites,dossiers
	 WHERE 
	 rayons.id=etageres.id_rayon AND boites.id_etagere=etageres.id AND dossiers.id_boite=boites.id
	  ORDER BY dossier asc")->fetchAll();
    $natures = $nature->findAll();
    $types = $type->findAll();

	$this->Render('/documents/ajout_documents',compact('services','domaines','types','dossiers'),'admin');
	}


	public function ajout_pieces(int $id)

	{
		///var_dump($_POST);
		//var_dump(scandir('../public/scann'));

$dossiersModel = new DossiersModel;
        // On va chercher toutes les annonces
        $doss = $dossiersModel->requete(
            "SELECT villes.ville,villes.id as idvil,salles.salle,salles.id as idsal,rayons.rayon,rayons.id as idray,etageres.id as idet,etageres.etagere,categories.id as idcat,categories.designation,boites.id as idboit,boites.boite,dossiers.dossier,dossiers.id,dossiers.desc_dossier,dossiers.id_boite,boites.id as idboite,categories.id as idcat,etageres.id as idetag,rayons.id as idray,salles.id as idsal,villes.id as idvil,dossiers.date_creation_dossier,dossiers.update_at,dossiers.id,users.nom,users.prenom 
            FROM villes,salles,rayons,etageres,categories,boites,users,dossiers 
            WHERE villes.id=salles.id_ville AND salles.id=rayons.id_salle AND rayons.id=etageres.id_rayon AND etageres.id=boites.id_etagere AND dossiers.id_cat = categories.id AND dossiers.id_boite = boites.id AND users.id=dossiers.id_user AND dossiers.id=?
            ",[$id]
        )->fetch();

     if (Form::Validate($_POST,['dossier','domaine','types','cases'])) {
			//le formulaire est valide
			$nbr = 1;

			//$ref = strtoupper(strip_tags($_POST['reference']));

			$dom = $_POST['domaine'];
			$dos = $_POST['dossier'];
			$typ = $_POST['types'];
			$cases = $_POST['cases'];
			$lib = strip_tags($_POST['libelle']);
			//$lib1 = strip_tags($_POST['libelle1']);
			$lib2 = strip_tags($_POST['libelle2']);
			$lib5 = strip_tags($_POST['libelle5']);
			$lib10 = strip_tags($_POST['libelle10']);
			$lib12 = strip_tags($_POST['libelle12']);
			$lib14 = strip_tags($_POST['libelle14']);
			$lib15 = strip_tags($_POST['libelle15']);
			$lib16 = strip_tags($_POST['libelle16']);
			$lib19 = strip_tags($_POST['libelle19']);
			$lib20 = strip_tags($_POST['libelle20']);
			$lib22 = strip_tags($_POST['libelle22']);
			//$desc1 = strip_tags($_POST['objet1']);
			$desc10 = strip_tags($_POST['objet10']);
			$desc11 = strip_tags($_POST['objet11']);
			$desc12 = strip_tags($_POST['objet12']);
			$desc13 = strip_tags($_POST['objet13']);
			$desc14 = strip_tags($_POST['objet14']);
			$desc15 = strip_tags($_POST['objet15']);
			$desc16 = strip_tags($_POST['objet16']);
			$desc17 = strip_tags($_POST['objet17']);
			$desc19 = strip_tags($_POST['objet19']);
			$desc20 = strip_tags($_POST['objet20']);
			$desc21 = strip_tags($_POST['objet21']);
			$desc22 = strip_tags($_POST['objet22']);
			$numero = strip_tags($_POST['numero']);
			$numero2 = strip_tags($_POST['numero2']);
			$numero1 = strip_tags($_POST['numero1']);
			//$numero3 = strip_tags($_POST['numero3']);
			$numero4 = strip_tags($_POST['numero4']);
			$numero5 = strip_tags($_POST['numero5']);
			$numero7 = strip_tags($_POST['numero7']);
			$numero8 = strip_tags($_POST['numero8']);
			$numero9 = strip_tags($_POST['numero9']);
			$numero10 = strip_tags($_POST['numero10']);
			$numero11 = strip_tags($_POST['numero11']);
			$numero12 = strip_tags($_POST['numero12']);
			$numero13 = strip_tags($_POST['numero13']);
			$numero14 = strip_tags($_POST['numero14']);
			$numero15 = strip_tags($_POST['numero15']);
			$numero16 = strip_tags($_POST['numero16']);
			$numero17 = strip_tags($_POST['numero17']);
			$numero18 = strip_tags($_POST['numero18']);
			$numero19 = strip_tags($_POST['numero19']);
			$numero20 = strip_tags($_POST['numero20']);
			$numero21 = strip_tags($_POST['numero21']);
			$numero22 = strip_tags($_POST['numero22']);
			$etabli = $_POST['etabli'];
			$etabli1 = $_POST['etabli1'];
			$etabli2 = $_POST['etabli2'];
			$etabli4 = $_POST['etabli4'];
			$etabli5 = $_POST['etabli5'];
			$etabli8 = $_POST['etabli8'];
			$etabli10 = $_POST['etabli10'];
			$etabli11 = $_POST['etabli11'];
			$etabli12 = $_POST['etabli12'];
			$etabli13 = $_POST['etabli13'];
			$etabli14 = $_POST['etabli14'];
			$etabli15 = $_POST['etabli15'];
			$etabli16 = $_POST['etabli16'];
			$etabli17 = $_POST['etabli17'];
			$etabli19 = $_POST['etabli19'];
			$etabli20 = $_POST['etabli20'];
			$etabli21 = $_POST['etabli21'];
			$etabli22 = $_POST['etabli22'];
			$indem = strip_tags($_POST['indemnite']);
			$gains = strip_tags($_POST['gains']);
			$retenues = strip_tags($_POST['retenues']);
			$montant5 = strip_tags($_POST['montant5']);
			$montant7 = strip_tags($_POST['montant7']);
			$montant8 = strip_tags($_POST['montant8']);
			$montant9 = strip_tags($_POST['montant9']);
			$montant20 = strip_tags($_POST['montant20']);
			$reglement5 = strip_tags($_POST['reglement5']);
			$reglement20 = strip_tags($_POST['reglement20']);
			$compte5 = strip_tags($_POST['compte5']);
			$compte18 = strip_tags($_POST['compte18']);
			$decision9 = strip_tags($_POST['decision9']);
			$datedecision = $_POST['datedecision'];
			$expertise = strip_tags($_POST['expertise']);
			$nbrep = $_POST['nbrep'];
			$solde = strip_tags($_POST['solde']);
			$arriere = strip_tags($_POST['arriere']);
			//$logement = strip_tags($_POST['logement']);
			$logement7 = strip_tags($_POST['logement7']);
			$baille = strip_tags($_POST['baille']);
			$logroupe= strip_tags($_POST['logroupe']);
			$pieces= strip_tags($_POST['pieces']);
			$ville= strip_tags($_POST['ville']);
			$duree= strip_tags($_POST['duree']);
			$duree20= strip_tags($_POST['duree20']);
			$compte5= strip_tags($_POST['compte5']);
			$compte20= strip_tags($_POST['compte20']);
			$codebanque= strip_tags($_POST['codebanque']);
			$codeguichet= strip_tags($_POST['codeguichet']);
			$domicile= strip_tags($_POST['domicile']);
			$domicile5= strip_tags($_POST['domicile5']);
			$domicile20= strip_tags($_POST['domicile20']);
			$rib= strip_tags($_POST['rib']);
			$contrat19=strip_tags($_POST['contrat19']);
			$contrat20=strip_tags($_POST['contrat20']);
			//$depart= $_POST['effet'];
			$depart13= $_POST['effet13'];
			$effet19= $_POST['effet19'];
			$effet20= $_POST['effet20'];
			$retour= $_POST['retour'];
			$imputation = strip_tags($_POST['imputation']);
			//$nat_id = strip_tags($_POST['natures']);
			$id_usager =$_POST['usager'];

			if($id_usager==''){
				$id_usager=1;
			}

			$id_user= $_SESSION['user']['id'];

			$annee = date('y');
			$catesModel = new DomainesModel;
			$findcat = $catesModel->find($dom);

			$dosModel = new DossiersModel;
			$finddos = $dosModel->find($dos);

			$typModel = new TypesModel;
			$findtyp = $typModel->find($typ);

//			$subserv = strtoupper(substr($findserv->designation, 0,4));
//			$subcat = strtoupper(substr($findcat->designation, 0,3));
				$chaf = rand(1,9999);
				//var_dump($findtyp->code."".$chaf);exit;
				//recuperer le nom categorie
			$Nomtyp = strtoupper($findtyp->type);
			$Nomdom = strtoupper($findcat->designation);
			$Nomdos = strtoupper($finddos->dossier);
			$code=$findtyp->code.$chaf;

				//$chaf = uniqid($chif,5);

			//$ref = $subserv.'-'.$subcat.'-'.$chaf.'-'.$annee;

//var_dump($_POST);exit;



			$db = Db::getInstance();
			  if($typ==1){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([$numero1,$typ]);
                $verif = $exe->fetch();
            		}
              elseif($typ==2){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([$numero2,$typ]);
                $verif = $exe->fetch();
            		}
             elseif($typ==3){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([$numero1,$typ]);
                $verif = $exe->fetch();
            		}
              elseif($typ==4){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([$numero4,$typ]);
                $verif = $exe->fetch();
            		}

            		elseif($typ==5 || $typ==6){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([$numero5,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==7){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([$numero7,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==8){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([$numero8,$typ]);
                $verif = $exe->fetch();
            		}

            		elseif($typ==9){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero9,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==10){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero10,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==11){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero11,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==12){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero12,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==13){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero13,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==14){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero14,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==15){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero15,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==16){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero16,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==17){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero17,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==18){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero18,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==19){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero19,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==20){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero20,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==21){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero21,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==22){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero22,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==23){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero22,$typ]);
                $verif = $exe->fetch();
            		}
            		else{
            			$req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero,$typ]);
                $verif = $exe->fetch();
            		}
                 //verirfie si le contact existe
                    if(!$verif){
                    			if($typ==1 || $typ==3){
                    				//CERTIFICAT DE NON HEBERGEMENT//
                    				////CERTIFICAT DE PREMIERE PRISE DE SERVICE
                    				$user = new DocumentsModel;
							$user->setReference($code)
								 ->setNumero($numero1)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								 ->setEtabli($etabli1)
								 ->setIdUsager($id_usager)
								 ->setIdUser($id_user);

						$user->Create();

                    				}
                    			elseif($typ==2)
                    			 {
                    			 	//ARRETE DE NOMMINATION//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero2)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib2)
								 ->setEtabli($etabli2);
							$user->Create();
                    			}
                    			elseif($typ==4)
                    			 {//ATTESTATION DE NON LOGEMENT//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero4)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setTauxindem($indem)
								 ->setEtabli($etabli4);
							$user->Create();
                    			}
                    				elseif($typ==5 || $typ==6)
                    			 {//BELLETIN DE SOLDE//
                    			 	$user = new DocumentsModel;
                    			$user->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setReference($code)
								 ->setNumero($numero5)
								 ->setGains($gains)
								 ->setRetenues($retenues)
								 ->setLibelle($lib5)
								 ->setMontant($montant5)
								 ->setCompte($compte5)
								 ->setDomiciliation($domicile5)
								 ->setReglement($reglement5)
								 ->setEtabli($etabli5);
								$user->Create();
                    			}

								elseif($typ==7)
                    			 {//DECISION AFFECTATION DE LOGEMENT//
                    			 	$user = new DocumentsModel;
                    			$user->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setReference($code)
								 ->setNumero($numero7)
								 ->setLogement($logement7)
								 ->setLogroupe($logroupe)
								 ->setMontant($montant7)
								 ->setPieces($pieces)
								 ->setBaille($baille);
								$user->Create();
                    			}
                    			elseif($typ==8)
                    			 {//ATTESTATION DE FIN DE PAIEMENT//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero8)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setMontant($montant8)
								 ->setEtabli($etabli8);
							$user->Create();
                    			}

                    			elseif($typ==9)
                    			 {
                    			 	//SITUATION REGLEMENT ACQUEREUR//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero9)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setMontant($montant9)
								 ->setDecision($decision9)
								 ->setEffet($datedecision)
								 ->setArriere($arriere)
								 ->setNbrep($nbrep)
								 ->setExpertise($expertise)
								 ->setSolde($solde);
							$user->Create();
                    			}
                    			elseif($typ==10)
                    			 {
                    			 //NOTE INTERNE//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero10)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib10)
								 ->setDescription($desc10)
								 ->setEtabli($etabli10);
							$user->Create();
                    			}
                    			elseif($typ==11)
                    			 {
                    			 //FICHE DE PRESENCE//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero11)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc11)
								 ->setEtabli($etabli11);
							$user->Create();
                    			}
                    			elseif($typ==12)
                    			 {
                    			 //FICHE DE SORTIE DE FOURNITURE//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero12)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc12)
								 ->setLibelle($lib12)
								 ->setEtabli($etabli12);
							$user->Create();
                    			}
                    			elseif($typ==13)
                    			 {
                    			 //ORDRE DE MISSION//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero13)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc13)
								 ->setRetour($retour)
								 ->setEffet($depart13)
								 ->setImputation($imputation)
								 ->setEtabli($etabli13);
							$user->Create();
                    			}
                    			elseif($typ==14)
                    			 {
                    			 //PERSONNEL//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero14)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib14)
								 ->setDescription($desc14)
								 ->setEtabli($etabli14);
							$user->Create();
                    			}
                    			elseif($typ==15)
                    			 {
                    			 //ATTESTATION//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero15)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib15)
								 ->setDescription($desc15)
								 ->setEtabli($etabli15);
							$user->Create();
                    			}
                    			elseif($typ==16)
                    			 {
                    			 //DECISION//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero16)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib16)
								 ->setDescription($desc16)
								 ->setEtabli($etabli16);
							$user->Create();
                    			}
                    			elseif($typ==17)
                    			 {
                    			 //PROCURATION//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero17)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc17)
								 ->setEtabli($etabli17);
							$user->Create();
                    			}
                    			elseif($typ==18)
                    			 {
                    			 //RIB//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero18)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setCodebanque($codebanque)
								 ->setCodeguichet($codeguichet)
								 ->setDomiciliation($domicile)
								 ->setRib($rib)
								 ->setCompte($compte18);

							$user->Create();
                    			}
                    			elseif($typ==19)
                    			 {
                    			 //AVENANTS//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero19)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib19)
								 ->setEffet($effet19)
								 ->setDuree($duree)
								 ->setDescription($desc19)
								 ->setContrat($contrat19)
								 ->setEtabli($etabli19);
							$user->Create();
                    			}

                    			elseif($typ==20)
                    			 {
                    			 //CONTRAT DE BAIL//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero20)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib20)
								 ->setEffet($effet20)
								 ->setDuree($duree20)
								 ->setDescription($desc20)
								 ->setCompte($compte20)
								 ->setMontant($montant20)
								 ->setReglement($reglement20)
								 ->setDomiciliation($domicile20)
								 ->setContrat($contrat20)
								 ->setVille($ville)
								 ->setEtabli($etabli20);
							$user->Create();
                    			}

                    			elseif($typ==21)
                    			 {
                    			 //ACTE INDIViDUALITE//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero21)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc21)
								 ->setEtabli($etabli21);
							$user->Create();
                    			}elseif($typ==22)
                    			 {
                    			 //ARRIVEE//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero22)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc22)
								 ->setLibelle($lib22)
								 ->setEtabli($etabli22);
							$user->Create();
                    			}elseif($typ==23)
                    			 {
                    			 //DEPART//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero22)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc22)
								 ->setLibelle($lib22)
								 ->setEtabli($etabli22);
							$user->Create();
                    			}
                    			else{
                    				$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib)
								 ->setEtabli($etabli);
							$user->Create();
                    			}

							$last_id = $db->lastInsertId();

							//creation des rêpertoires

		if(!is_dir("archives")){
								$rep = mkdir("archives",0777);
								//echo"ok";
							}
							if(!is_dir("archives/$Nomdom")){
								$rep = mkdir("archives/$Nomdom",0777);
							//	fopen($rep, "rw");
							//echo"ok1";
							//
							}
							if(!is_dir("archives/$Nomdom/$Nomtyp")){
								$rep = mkdir("archives/$Nomdom/$Nomtyp",0777);
								//echo"ok2";
							//	fopen($rep, "rw");
							//
							}
							if(!is_dir("archives/$Nomdom/$Nomtyp/$Nomdos")){
								$rep = mkdir("archives/$Nomdom/$Nomtyp/$Nomdos",0777);
								//echo"ok3";
							//	fopen($rep, "rw");
							//
							}
							/*
							if(!is_dir("archives/$Nomserv/$Nomcat/$Nomnat/$Nomtyp")){
								$rep = mkdir("archives/$Nomserv/$Nomcat/$Nomnat/$Nomtyp",0777);
								//echo"ok4";
							//	fopen($rep, "rw");
							//
							}
							if(!is_dir("archives/$Nomserv/$Nomcat/$Nomnat/$Nomtyp/$lib")){
								$rep = mkdir("archives/$Nomserv/$Nomcat/$Nomnat/$Nomtyp/$lib",0777);
								//echo"ok5";
							//	fopen($rep, "rw");
							//
							}*/

							//fin de repertoire

		 // Fusion des fichiers pdf


$fileArray= glob($_SERVER['DOCUMENT_ROOT'].'/pros/*.pdf');
//var_dump($fileArray);exit();
 $datadir =$_SERVER['DOCUMENT_ROOT'].'/mydoc/';
 //var_dump($fileArray);
 $outputName = $datadir.rand(1,100).".pdf";
  $cmd = "gswin64c -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile=$outputName ";
  //Add each pdf file to the end of the command

  foreach($fileArray as $file) {

    if ($file != "." && $file != "..") {

       $cmd .= $file." ";
    }

}


//var_dump($cmd);

$result = shell_exec($cmd);


	 // FIN fusion pdf

//var_dump($last_id); exit;
// Insertion des fichiers scanner
			 $src = 'mydoc/';
			 $mon='pdf-compatible/';
			// $uploaded='pdf-uploaded/';
		$dst = "archives/$Nomdom/$Nomtyp/$Nomdos/";
		$late =$last_id;
		//$name_img =$_POST['image'];
		//
		$req="SELECT dossier FROM dossiers WHERE id=?";
		$exe=Db::getInstance()->prepare($req);
		$exe->execute([$_POST['dossier']]);
		$data=$exe->fetch();
		$noms=[$data->dossier];
		$name_img =str_replace('/','',$noms);
		//var_dump();exit;



//copy($src, $dst);  //Call function
//Function to Copy folders and files
			function rcopy($src, $dst,$late,$name) {

				//global $ose; $result= $osse;
				//global $last_id;

 			   if (file_exists ( $dst ))
        	//rrmdir( $dst );
    		if (is_dir( $src )) {
        //mkdir ( $dst );
       		 $files =scandir( $src );
       		 $i=0;
       		 $chaf=rand(1,999);
       		 //$oss=$Nomdos;
       			 foreach ($files as $key=>$file ){
       	$req="SELECT dossier FROM dossiers WHERE id=?";
		$exe=Db::getInstance()->prepare($req);
		$exe->execute([$_POST['dossier']]);
		$data=$exe->fetch();
		$noms=[$data->dossier];
		$ext="pdf";
		$name_img =str_replace('/','',$noms);
           				 if ($file != "." && $file != ".."){
                           	$explode =explode('.', $file);
                           	$extension = end($explode);
                           	$new = $chaf.'_'.$name[$i].'.'.$extension;
               				 copy ("$src/$file","$dst/$new");
               				 //copy ( "$src/$file", "$dst/$chaf.'-'.$name[$i].'.'.$extension");
               				 //copy("$file", "$uploaded");
               				// var_dump($name[$i]);exit ;
               				//$new = $name[$i].'.'.$extension;

               				 $i++;
               				 $sendScann = new FichiersModel;

                        $sendScann->requete('INSERT INTO fichiers (fichier, type, id_doc) VALUES (?,?,?)',[$new,$ext,$late]);
                        	$chaf++;
                             	}
           		 //var_dump($src/$file);
							}
   						 } elseif (file_exists ( $src ))
        				copy( $src, $dst );
                    rrmdir( $src );
					}

				//Function to remove folders and files
				function rrmdir($dir) {
   						 if (is_dir($dir)) {
        					$files = scandir($dir);
        					foreach ($files as $file){
            				if ($file != "." && $file != "..") rrmdir("$dir/$file");
            			}
        					//rmdir($dir);
   								 }
   							 elseif (file_exists($dir)) unlink($dir);
							}

							rcopy($src,$dst,$late,$name_img);

							rrmdir($src);

							//supprimer le contenu de scann //
							$scann="scann/";
							rrmdir($scann);
								/*$ouverture=opendir($scann);
								$fichier=readdir($ouverture);
								$fichier=readdir($ouverture);
								while ($fichier=readdir($ouverture)) {
								unlink("$scann/$fichier");
									}
									closedir($ouverture);*/

							// Fin suppression scann//

							//supprimer le contenu de pros //
							$pros="pros/";
								rrmdir($pros);
							/*	$ouverture=opendir($pros);
								$fichier=readdir($ouverture);
								$fichier=readdir($ouverture);
								while ($fichier=readdir($ouverture)) {
								unlink("$pros/$fichier");
									}
									closedir($ouverture);*/

							// Fin suppression pros//


// insertion fichiers uploadés
							 $phpFileUploadErrors = array(
           0 => "Vos informations ont &eacute;t&eacute; prise en compte. Merci",
           1 => "Le taille du fichiers est trop volumineux",
           2 => "Le fichier exc&eacute;de la taille demand&eacute;",
           3 => "Le fichier a &eacute;t&eacute; partiellement upload&eacute;",
           4 => " Pas de fichiers charg&eacute;",#App::Redirect("show_prestation.php"),
           5 => "Un dossier temporaire manquant",
           6 => "Echec d'ecriture sur le disk",
           7 => "Une extensions PHP a stopp&eacute; le fichier charg&eacute;",
       );
        function reArrayFiles($file_post){
            $file_ary = array();
            $file_count = count($file_post['name']);
            $file_key = array_keys($file_post);

            for($i=0; $i<$file_count; $i++){
                foreach ($file_key as $key):
                    $file_ary[$i][$key] = $file_post[$key][$i];
                endforeach;
            }
            return $file_ary;
        }

       // $tmp = $_FILES['fichier']['tmp_name'];
        if(isset($_FILES['fichier']))
         {
    //$repertoire =strtoupper(strip_tags($ref));
							if(!is_dir("archives")){
								$rep = mkdir("archives",0777);
								//echo"ok";
							}
							if(!is_dir("archives/$Nomdom")){
								$rep = mkdir("archives/$Nomdom",0777);
							//	fopen($rep, "rw");
							//echo"ok1";
							//
							}
							if(!is_dir("archives/$Nomdom/$Nomtyp")){
								$rep = mkdir("archives/$Nomdom/$Nomtyp",0777);
								//echo"ok2";
							//	fopen($rep, "rw");
							//
							}
							if(!is_dir("archives/$Nomdom/$Nomtyp/$Nomdos")){
								$rep = mkdir("archives/$Nomdom/$Nomtyp/$Nomdos",0777);
								//echo"ok3";
							//	fopen($rep, "rw");
							//
							}

							//var_dump($chemin);

           // $alpha = "azertyuiopmlkjhgfdsqwxcvbn0123654789";
            #$rep = $up.mkdir(uniqid($alpha,6)).'/';
            #$mon_rep = uniqid(substr(str_shuffle(str_repeat($alpha,5)),0,8));
            #$rep = mkdir($up.$mon_rep);
            #fopen($rep, "r+");
            #var_dump($rep);
            $file_array = reArrayFiles($_FILES['fichier']);
           // pre_r($file_array);
            for ($i=0;$i<count($file_array); $i++){
                if($file_array[$i]['error']){

             Form::setFlash('danger',$file_array[$i]['name'].''.$phpFileUploadErrors[$file_array[$i]['error']]);

                }else{
                    $extensions = array('jpg','png','gif','jpeg','html','php','doc','docx','csv','pdf','xlsx','xls','xlsm','rar','zip','3gp','mp4','mpeg','flv','mp3','amr','accdb','avi');
                    $file_ext = explode('.',$file_array[$i]['name']);
                    $file_ext = strtolower(end($file_ext));


                    if(!in_array($file_ext,$extensions)){

                         Form::setFlash('danger',$file_array[$i]['name']." - Extention Invalid");


                    }else{

                    	//var_dump(dirname(getcwd()));
                        #move_uploaded_file($file_array[$i]['tmp_name'], "uploads/".$file_array[$i]['name']);
                        #$last = $db->lastInsertId();
                        $sendFiles = new FichiersModel;
                        $monfile = str_replace(' ','_',$file_array[$i]['name']);
                        $sendFiles->requete('INSERT INTO fichiers (fichier, type, id_doc) VALUES (?,?,?)',[$chaf.'_'.$monfile,$file_ext,$last_id]);

						move_uploaded_file($file_array[$i]['tmp_name'],"archives/$Nomdom/$Nomtyp/$Nomdos/".$chaf.'_'.$monfile);

                     	//file_put_contents('pdf-compatible/'.$chaf.'_'.$monfile);

                             //  $sendFiles->setFichier($file_array[$i]['name'])
                              // 			 ->setType($file_ext)
                               //			 ->setIdDoc($last_id);
                              // $sendFiles->CreateFile();
                              // $sql = "INSERT INTO fichiers (fichier, type, id_doc) VALUES (?,?,?)";
                               //$insert = Db::getInstance()->prepare($sql);
                              //$insert->execute([$file_array[$i]['name'],$file_ext,$last_id]);

                        //var_dump("$repertoire/".$file_array[$i]['name']);
                        Form::setFlash('success',$phpFileUploadErrors[$file_array[$i]['error']]);
							}
                }
            }
        }


// FIn d'insertion de fichier scannes






								Form::setFlash('success','La pièce '.$code.' a été crée avec succès');
							//	header("Location:/documents/mes_documents");
								header("Location:/documents/liste_pieces/$id");
								exit;
	}
	else{
							Form::setFlash('danger','Ce numéro de pièce est déjà utilsé pour cette typologie');
						}


					}	else{
			Form::setFlash('info','Veuillez à bien remplir le formulaire');
		}


		//modal usager

		if (Form::Validate($_POST,['usagers','typos','domaines'])) {
            //le formulaire est valide
            $usagers = strtoupper(strip_tags($_POST['usagers']));
            $types = strtoupper(strip_tags($_POST['typos']));
            $contact = strtoupper(strip_tags($_POST['contact']));
            $email = strtoupper(strip_tags($_POST['email']));
            $adresse = strip_tags($_POST['adresse']);
            $matricule = strip_tags($_POST['matricule']);
            $fonction = strip_tags($_POST['fonction']);
            $grade = strip_tags($_POST['grade']);
            $etab = strip_tags($_POST['etable']);
            $iddom= $_POST['domaines'];
            $dateserv = strip_tags($_POST['dateserv']);




                        $db = db::getInstance();
                        // code...

                    //on insert le service

                        if($types == 1)
                        {
                            $req= "select * FROM usagers WHERE usager=?";

                        $exe = $db->prepare($req);
                        $exe->execute([$usagers]);
                        $verif = $exe->fetch();
                            if(!$verif){
                            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                          //on hydrate l'usager entreprise
                            $usage = new UsagersModel;
                            $usage->setUsager($usagers)
                                    ->setTypeUsager($types)
                                    ->setContact($contact)
                                    ->setEmail($email)
                                    ->setAdresse($adresse)
                                    ->setIdCat($iddom);
                            $usage->Create();
                            }else{
                             Form::setFlash('danger',"Entrer un format d'email valide" );
                            }}else{
                         Form::setFlash('danger',"Cet usager exite déjà" );
                        }
                        }else{
                            // on hydrate l'usage particulier
                            //on hydrate le service
                        $req= "select * FROM usagers WHERE usager=? AND matricule=?";

                        $exe = $db->prepare($req);
                        $exe->execute([$usagers,$matricule]);
                        $verif = $exe->fetch();
                            if(!$verif){
                            $usage = new UsagersModel;
                            $usage->setUsager($usagers)
                                    ->setTypeUsager($types)
                                    ->setContact($contact)
                                    ->setMatricule($matricule)
                                    ->setFonction($fonction)
                                    ->setEtablissement($etab)
                                    ->setGrade($grade)
                                    ->setIdCat($iddom)
                                    ->setDateService($dateserv);
                            $usage->Create();
                        }else{
                         Form::setFlash('danger',"Cet usager exite déjà" );
                        }
                        }

                            Form::setFlash('success',"Un usager vient d'etre créer" );
                           // header("Location:/usagers/liste_usagers");
                            //exit;
                        }


		//fin modal usager
$usagers = new UsagersModel;
	$categorie = new DomainesModel;
	$dossier = new DossiersModel;
	$service = new DirectionsModel;
	$type = new TypesModel;
	$nature = new NaturesModel;
    $services = $service->findAll();
    $domaines = $categorie->findAll();
    $dossiers = $dossier->requete("SELECT * FROM rayons,etageres,boites,dossiers
	 WHERE 
	 rayons.id=etageres.id_rayon AND boites.id_etagere=etageres.id AND dossiers.id_boite=boites.id
	  ORDER BY dossier asc")->fetchAll();
    $natures = $nature->findAll();
    $types = $type->findAll();
    $typos=$type->requete("SELECT * FROM types WHERE id_cat=?",[$doss->idcat])->fetchAll();
    $usages = $usagers->requete("SELECT * FROM usagers WHERE id_cat=?",[$doss->idcat])->fetchAll();

	$this->Render('/documents/ajout_pieces',compact('services','domaines','types','dossiers','doss','typos','usages'),'admin');
	}

	//ajouter pieces par typologie
	public function ajoutes_pieces(int $id)

	{
		///var_dump($_POST);
		//var_dump(scandir('../public/scann'));

$dossiersModel = new DossiersModel;
        // On va chercher toutes les annonces
        $doss = $dossiersModel->requete(
            "SELECT villes.ville,villes.id as idvil,salles.salle,salles.id as idsal,rayons.rayon,rayons.id as idray,etageres.id as idet,etageres.etagere,categories.id as idcat,categories.designation,boites.id as idboit,boites.boite,dossiers.dossier,dossiers.id as iddos,dossiers.desc_dossier,dossiers.id_boite,boites.id as idboite,categories.id as idcat,etageres.id as idetag,rayons.id as idray,salles.id as idsal,villes.id as idvil,dossiers.date_creation_dossier,dossiers.update_at,dossiers.id,users.nom,users.prenom,types.id as id, types.type 
            FROM villes,salles,rayons,etageres,categories,boites,users,dossiers,types
            WHERE villes.id=salles.id_ville AND salles.id=rayons.id_salle AND rayons.id=etageres.id_rayon AND etageres.id=boites.id_etagere AND dossiers.id_cat = categories.id AND dossiers.id_boite = boites.id AND users.id=dossiers.id_user AND types.id_cat=categories.id AND types.id=?
            ",[$id]
        )->fetch();

        $dossiers = $dossiersModel->requete("SELECT * FROM villes,salles,rayons,etageres,boites,categories,dossiers
        		WHERE villes.id=salles.id_ville AND salles.id=rayons.id_salle AND rayons.id=etageres.id_rayon AND etageres.id=boites.id_etagere AND boites.id=dossiers.id_boite AND categories.id=dossiers.id_cat AND categories.id=?
        	",[$doss->idcat])->fetchAll();

     if (Form::Validate($_POST,['dossier','domaine','types','cases'])) {
			//le formulaire est valide
			$nbr = 1;

			//$ref = strtoupper(strip_tags($_POST['reference']));

			$dom = $_POST['domaine'];
			$dos = $_POST['dossier'];
			$typ = $_POST['types'];
			$cases = $_POST['cases'];
			$lib = strip_tags($_POST['libelle']);

			//$lib1 = strip_tags($_POST['libelle1']);
		/*	$lib2 = strip_tags($_POST['libelle2']);
			$lib5 = strip_tags($_POST['libelle5']);
			$lib10 = strip_tags($_POST['libelle10']);
			$lib12 = strip_tags($_POST['libelle12']);
			$lib14 = strip_tags($_POST['libelle14']);
			$lib15 = strip_tags($_POST['libelle15']);
			$lib16 = strip_tags($_POST['libelle16']);
			$lib19 = strip_tags($_POST['libelle19']);
			$lib20 = strip_tags($_POST['libelle20']);
			$lib22 = strip_tags($_POST['libelle22']);*/
			//$desc1 = strip_tags($_POST['objet1']);
			/* $desc10 = strip_tags($_POST['objet10']);
			$desc11 = strip_tags($_POST['objet11']);
			$desc12 = strip_tags($_POST['objet12']);
			$desc13 = strip_tags($_POST['objet13']);
			$desc14 = strip_tags($_POST['objet14']);
			$desc15 = strip_tags($_POST['objet15']);
			$desc16 = strip_tags($_POST['objet16']);
			$desc17 = strip_tags($_POST['objet17']);
			$desc19 = strip_tags($_POST['objet19']);
			$desc20 = strip_tags($_POST['objet20']);
			$desc21 = strip_tags($_POST['objet21']);
			$desc22 = strip_tags($_POST['objet22']);
			$numero = strip_tags($_POST['numero']);
			$numero2 = strip_tags($_POST['numero2']);
			$numero1 = strip_tags($_POST['numero1']);*/
			//$numero3 = strip_tags($_POST['numero3']);
			/*$numero4 = strip_tags($_POST['numero4']);
			$numero5 = strip_tags($_POST['numero5']);
			$numero7 = strip_tags($_POST['numero7']);
			$numero8 = strip_tags($_POST['numero8']);
			$numero9 = strip_tags($_POST['numero9']);
			$numero10 = strip_tags($_POST['numero10']);
			$numero11 = strip_tags($_POST['numero11']);
			$numero12 = strip_tags($_POST['numero12']);
			$numero13 = strip_tags($_POST['numero13']);
			$numero14 = strip_tags($_POST['numero14']);
			$numero15 = strip_tags($_POST['numero15']);
			$numero16 = strip_tags($_POST['numero16']);
			$numero17 = strip_tags($_POST['numero17']);
			$numero18 = strip_tags($_POST['numero18']);
			$numero19 = strip_tags($_POST['numero19']);
			$numero20 = strip_tags($_POST['numero20']);
			$numero21 = strip_tags($_POST['numero21']);
			$numero22 = strip_tags($_POST['numero22']);
			$etabli = $_POST['etabli'];
			$etabli1 = $_POST['etabli1'];
			$etabli2 = $_POST['etabli2'];
			$etabli4 = $_POST['etabli4'];
			$etabli5 = $_POST['etabli5'];
			$etabli8 = $_POST['etabli8'];
			$etabli10 = $_POST['etabli10'];
			$etabli11 = $_POST['etabli11'];
			$etabli12 = $_POST['etabli12'];
			$etabli13 = $_POST['etabli13'];
			$etabli14 = $_POST['etabli14'];
			$etabli15 = $_POST['etabli15'];
			$etabli16 = $_POST['etabli16'];
			$etabli17 = $_POST['etabli17'];
			$etabli19 = $_POST['etabli19'];
			$etabli20 = $_POST['etabli20'];
			$etabli21 = $_POST['etabli21'];
			$etabli22 = $_POST['etabli22'];*/
			/*$indem = strip_tags($_POST['indemnite']);
			$gains = strip_tags($_POST['gains']);
			$retenues = strip_tags($_POST['retenues']);
			$montant5 = strip_tags($_POST['montant5']);
			$montant7 = strip_tags($_POST['montant7']);
			$montant8 = strip_tags($_POST['montant8']);
			$montant9 = strip_tags($_POST['montant9']);
			$montant20 = strip_tags($_POST['montant20']);
			$reglement5 = strip_tags($_POST['reglement5']);
			$reglement20 = strip_tags($_POST['reglement20']);
			$compte5 = strip_tags($_POST['compte5']);
			$compte18 = strip_tags($_POST['compte18']);
			$decision9 = strip_tags($_POST['decision9']);
			$datedecision = $_POST['datedecision'];
			$expertise = strip_tags($_POST['expertise']);
			$nbrep = $_POST['nbrep'];
			$solde = strip_tags($_POST['solde']);
			$arriere = strip_tags($_POST['arriere']);*/
			//$logement = strip_tags($_POST['logement']);
			/*
			$logement7 = strip_tags($_POST['logement7']);
			$baille = strip_tags($_POST['baille']);
			$logroupe= strip_tags($_POST['logroupe']);
			$pieces= strip_tags($_POST['pieces']);
			$ville= strip_tags($_POST['ville']);
			$duree= strip_tags($_POST['duree']);
			$duree20= strip_tags($_POST['duree20']);
			$compte5= strip_tags($_POST['compte5']);
			$compte20= strip_tags($_POST['compte20']);
			$codebanque= strip_tags($_POST['codebanque']);
			$codeguichet= strip_tags($_POST['codeguichet']);
			$domicile= strip_tags($_POST['domicile']);
			$domicile5= strip_tags($_POST['domicile5']);
			$domicile20= strip_tags($_POST['domicile20']);
			$rib= strip_tags($_POST['rib']);
			$contrat19=strip_tags($_POST['contrat19']);
			$contrat20=strip_tags($_POST['contrat20']);
			//$depart= $_POST['effet'];
			$depart13= $_POST['effet13'];
			$effet19= $_POST['effet19'];
			$effet20= $_POST['effet20'];
			$retour= $_POST['retour'];
			$imputation = strip_tags($_POST['imputation']);*/
			//$nat_id = strip_tags($_POST['natures']);
			$id_usager =$_POST['usager'];

			if($id_usager==''){
				$id_usager=1;
			}

			$id_user= $_SESSION['user']['id'];

			$annee = date('y');
			$catesModel = new DomainesModel;
			$findcat = $catesModel->find($dom);

			$dosModel = new DossiersModel;
			$finddos = $dosModel->find($dos);

			$typModel = new TypesModel;
			$findtyp = $typModel->find($typ);

//			$subserv = strtoupper(substr($findserv->designation, 0,4));
//			$subcat = strtoupper(substr($findcat->designation, 0,3));
				$chaf = rand(1,9999);
				//var_dump($findtyp->code."".$chaf);exit;
				//recuperer le nom categorie
			$Nomtyp = strtoupper($findtyp->type);
			$Nomdom = strtoupper($findcat->designation);
			$Nomdos = strtoupper($finddos->dossier);
			$code=$findtyp->code.$chaf;

				//$chaf = uniqid($chif,5);

			//$ref = $subserv.'-'.$subcat.'-'.$chaf.'-'.$annee;

//var_dump($_POST);exit;



			$db = Db::getInstance();
			  if($typ==1){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([strip_tags($_POST['numero1']),$typ]);
                $verif = $exe->fetch();
            		}
              elseif($typ==2){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([strip_tags($_POST['numero2']),$typ]);
                $verif = $exe->fetch();
            		}
             elseif($typ==3){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([strip_tags($_POST['numero1']),$typ]);
                $verif = $exe->fetch();
            		}
              elseif($typ==4){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([strip_tags($_POST['numero4']),$typ]);
                $verif = $exe->fetch();
            		}

            		elseif($typ==5 || $typ==6){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([strip_tags($_POST['numero5']),$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==7){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([strip_tags($_POST['numero7']),$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==8){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([strip_tags($_POST['numero8']),$typ]);
                $verif = $exe->fetch();
            		}

            		elseif($typ==9){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([strip_tags($_POST['numero9']),$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==10){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([strip_tags($_POST['numero10']),$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==11){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([strip_tags($_POST['numero11']),$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==12){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([strip_tags($_POST['numero12']),$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==13){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([strip_tags($_POST['numero13']),$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==14){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([strip_tags($_POST['numero14']),$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==15){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([strip_tags($_POST['numero15']),$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==16){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([strip_tags($_POST['numero16']),$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==17){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([strip_tags($_POST['numero17']),$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==18){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([strip_tags($_POST['numero18']),$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==19){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([strip_tags($_POST['numero19']),$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==20){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([strip_tags($_POST['numero20']),$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==21){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([strip_tags($_POST['numero21']),$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==22){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([strip_tags($_POST['numero22']),$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==23){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([strip_tags($_POST['numero22']),$typ]);
                $verif = $exe->fetch();
            		}
            		else{
            			$req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([strip_tags($_POST['numero']),$typ]);
                $verif = $exe->fetch();
            		}

                 //verirfie si le contact existe
                    if(!$verif){
                    			if($typ==1 || $typ==3){
                    				//CERTIFICAT DE NON HEBERGEMENT//
                    				////CERTIFICAT DE PREMIERE PRISE DE SERVICE
                    				$user = new DocumentsModel;
							$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero1']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								 ->setEtabli(strip_tags($_POST['etabli1']))
								 ->setIdUsager($id_usager)
								 ->setIdUser($id_user);

							$user->Create();

                    				}
                    			elseif($typ==2)
                    			 {
                    			 	//ARRETE DE NOMMINATION//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero2']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle(strip_tags($_POST['libelle2']))
								 ->setEtabli(strip_tags($_POST['etabli2']));
							$user->Create();
                    			}
                    			elseif($typ==4)
                    			 {//ATTESTATION DE NON LOGEMENT//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero4']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setTauxindem(strip_tags($_POST['indemnite']))
								 ->setEtabli(strip_tags($_POST['etabli4']));
							$user->Create();
                    			}
                    				elseif($typ==5 || $typ==6)
                    			 {//BELLETIN DE SOLDE//
                    			 	$user = new DocumentsModel;
                    			$user->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setReference($code)
								 ->setNumero(strip_tags($_POST['numero5']))
								 ->setGains(strip_tags($_POST['gains']))
								 ->setRetenues(strip_tags($_POST['retenues']))
								 ->setLibelle(strip_tags($_POST['libelle5']))
								 ->setMontant(strip_tags($_POST['montant5']))
								 ->setCompte(strip_tags($_POST['compte5']))
								 ->setDomiciliation(strip_tags($_POST['domicile5']))
								 ->setReglement(strip_tags($_POST['reglement5']))
								 ->setEtabli(strip_tags($_POST['etabli5']));
								$user->Create();
                    			}

								elseif($typ==7)
                    			 {//DECISION AFFECTATION DE LOGEMENT//
                    			 	$user = new DocumentsModel;
                    			$user->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setReference($code)
								 ->setNumero(strip_tags($_POST['numero7']))
								 ->setLogement(strip_tags($_POST['logement7']))
								 ->setLogroupe(strip_tags($_POST['logroupe']))
								 ->setMontant(strip_tags($_POST['montant7']))
								 ->setPieces(strip_tags($_POST['pieces']))
								 ->setBaille(strip_tags($_POST['baille']));
								$user->Create();
                    			}
                    			elseif($typ==8)
                    			 {//ATTESTATION DE FIN DE PAIEMENT//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero8']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setMontant(strip_tags($_POST['montant8']))
								 ->setEtabli(strip_tags($_POST['etabli8']));
							$user->Create();
                    			}

                    			elseif($typ==9)
                    			 {
                    			 	//SITUATION REGLEMENT ACQUEREUR//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero9']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setMontant(strip_tags($_POST['montant9']))
								 ->setDecision(strip_tags($_POST['decision9']))
								 ->setEffet(strip_tags($_POST['datedecision']))
								 ->setArriere(strip_tags($_POST['arriere']))
								 ->setNbrep(strip_tags($_POST['nbrep']))
								 ->setExpertise(strip_tags($_POST['expertise']))
								 ->setSolde(strip_tags($_POST['solde']));
							$user->Create();
                    			}
                    			elseif($typ==10)
                    			 {
                    			 //NOTE INTERNE//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero10']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle(strip_tags($_POST['libelle10']))
								 ->setDescription(strip_tags($_POST['objet10']))
								 ->setEtabli(strip_tags($_POST['etabli10']));
							$user->Create();
                    			}
                    			elseif($typ==11)
                    			 {
                    			 //FICHE DE PRESENCE//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero11']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription(strip_tags($_POST['objet11']))
								 ->setEtabli(strip_tags($_POST['etabli11']));
							$user->Create();
                    			}
                    			elseif($typ==12)
                    			 {
                    			 //FICHE DE SORTIE DE FOURNITURE//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero12']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription(strip_tags($_POST['objet12']))
								 ->setLibelle(strip_tags($_POST['libelle12']))
								 ->setEtabli(strip_tags($_POST['etabli12']));
							$user->Create();
                    			}
                    			elseif($typ==13)
                    			 {
                    			 //ORDRE DE MISSION//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero13']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription(strip_tags($_POST['objet13']))
								 ->setRetour(strip_tags($_POST['retour']))
								 ->setEffet(strip_tags($_POST['effet13']))
								 ->setImputation(strip_tags($_POST['imputation']))
								 ->setEtabli(strip_tags($_POST['etabli13']));
							$user->Create();
                    			}
                    			elseif($typ==14)
                    			 {
                    			 //PERSONNEL//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero14']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle(strip_tags($_POST['libelle14']))
								 ->setDescription(strip_tags($_POST['objet14']))
								 ->setEtabli(strip_tags($_POST['etabli14']));
							$user->Create();
                    			}
                    			elseif($typ==15)
                    			 {
                    			 //ATTESTATION//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero15']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle(strip_tags($_POST['libelle15']))
								 ->setDescription(strip_tags($_POST['objet15']))
								 ->setEtabli(strip_tags($_POST['etabli15']));
							$user->Create();
                    			}
                    			elseif($typ==16)
                    			 {
                    			 //DECISION//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero16']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle(strip_tags($_POST['libelle16']))
								 ->setDescription(strip_tags($_POST['objet16']))
								 ->setEtabli(strip_tags($_POST['etabli16']));
							$user->Create();
                    			}
                    			elseif($typ==17)
                    			 {
                    			 //PROCURATION//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero17']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc17)
								 ->setEtabli($etabli17);
							$user->Create();
                    			}
                    			elseif($typ==18)
                    			 {
                    			 //RIB//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero18']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setCodebanque(strip_tags($_POST['codebanque']))
								 ->setCodeguichet(strip_tags($_POST['codeguichet']))
								 ->setDomiciliation(strip_tags($_POST['domicile']))
								 ->setRib(strip_tags($_POST['rib']))
								 ->setCompte(strip_tags($_POST['compte18']));

							$user->Create();
                    			}
                    			elseif($typ==19)
                    			 {
                    			 //AVENANTS//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero19']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle(strip_tags($_POST['libelle19']))
								 ->setEffet(strip_tags($_POST['effet19']))
								 ->setDuree(strip_tags($_POST['duree']))
								 ->setDescription(strip_tags($_POST['objet19']))
								 ->setContrat(strip_tags($_POST['contrat19']))
								 ->setEtabli(strip_tags($_POST['etabli19']));
							$user->Create();
                    			}

                    			elseif($typ==20)
                    			 {
                    			 //CONTRAT DE BAIL//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero20']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle(strip_tags($_POST['effet20']))
								 ->setEffet(strip_tags($_POST['effet20']))
								 ->setDuree(strip_tags($_POST['duree20']))
								 ->setDescription(strip_tags($_POST['objet20']))
								 ->setCompte(strip_tags($_POST['compte20']))
								 ->setMontant(strip_tags($_POST['montant20']))
								 ->setReglement(strip_tags($_POST['reglement20']))
								 ->setDomiciliation(strip_tags($_POST['domicile20']))
								 ->setContrat(strip_tags($_POST['contrat20']))
								 ->setVille(strip_tags($_POST['ville']))
								 ->setEtabli(strip_tags($_POST['etabli20']));
							$user->Create();
                    			}

                    			elseif($typ==21)
                    			 {
                    			 //ACTE INDIViDUALITE//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero21']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription(strip_tags($_POST['objet21']))
								 ->setEtabli(strip_tags($_POST['etabli21']));
							$user->Create();
                    			}elseif($typ==22)
                    			 {
                    			 //ARRIVEE//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero22']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription(strip_tags($_POST['objet22']))
								 ->setLibelle(strip_tags($_POST['libelle22']))
								 ->setEtabli(strip_tags($_POST['etabli22']));
							$user->Create();
                    			}elseif($typ==23)
                    			 {
                    			 //DEPART//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero22']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription(strip_tags($_POST['objet22']))
								 ->setLibelle(strip_tags($_POST['libelle22']))
								 ->setEtabli(strip_tags($_POST['etabli22']));
							$user->Create();
                    			}
                    			else{
                    				$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle(strip_tags($_POST['libelle']))
								 ->setEtabli(strip_tags($_POST['etabli']));
							$user->Create();
                    			}

							$last_id = $db->lastInsertId();

							//creation des rêpertoires

		if(!is_dir("archives")){
								$rep = mkdir("archives",0777);
								//echo"ok";
							}
							if(!is_dir("archives/$Nomdom")){
								$rep = mkdir("archives/$Nomdom",0777);
							//	fopen($rep, "rw");
							//echo"ok1";
							//
							}
							if(!is_dir("archives/$Nomdom/$Nomtyp")){
								$rep = mkdir("archives/$Nomdom/$Nomtyp",0777);
								//echo"ok2";
							//	fopen($rep, "rw");
							//
							}
							if(!is_dir("archives/$Nomdom/$Nomtyp/$Nomdos")){
								$rep = mkdir("archives/$Nomdom/$Nomtyp/$Nomdos",0777);
								//echo"ok3";
							//	fopen($rep, "rw");
							//
							}
							/*
							if(!is_dir("archives/$Nomserv/$Nomcat/$Nomnat/$Nomtyp")){
								$rep = mkdir("archives/$Nomserv/$Nomcat/$Nomnat/$Nomtyp",0777);
								//echo"ok4";
							//	fopen($rep, "rw");
							//
							}
							if(!is_dir("archives/$Nomserv/$Nomcat/$Nomnat/$Nomtyp/$lib")){
								$rep = mkdir("archives/$Nomserv/$Nomcat/$Nomnat/$Nomtyp/$lib",0777);
								//echo"ok5";
							//	fopen($rep, "rw");
							//
							}*/

							//fin de repertoire
	 // Fusion des fichiers pdf


$fileArray= glob($_SERVER['DOCUMENT_ROOT'].'/pros/*.pdf');
//var_dump($fileArray);exit();
 $datadir =$_SERVER['DOCUMENT_ROOT'].'/mydoc/';
 //var_dump($fileArray);
 $outputName = $datadir.rand(1,100).".pdf";
  $cmd = "gswin64c -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile=$outputName ";
  //Add each pdf file to the end of the command

  foreach($fileArray as $file) {

    if ($file != "." && $file != "..") {

       $cmd .= $file." ";
    }

}


//var_dump($cmd);

$result = shell_exec($cmd);


	 // FIN fusion pdf

//var_dump($last_id); exit;
// Insertion des fichiers scanner
			 $src = 'mydoc/';
			 $mon='pdf-compatible/';
			// $uploaded='pdf-uploaded/';
		$dst = "archives/$Nomdom/$Nomtyp/$Nomdos/";
		$late =$last_id;
		//$name_img =$_POST['image'];
		//
		$req="SELECT dossier FROM dossiers WHERE id=?";
		$exe=Db::getInstance()->prepare($req);
		$exe->execute([$_POST['dossier']]);
		$data=$exe->fetch();
		$noms=[$data->dossier];
		$name_img =str_replace('/','',$noms);
		//var_dump();exit;


//copy($src, $dst);  //Call function
//Function to Copy folders and files
			function rcopy($src, $dst,$late,$name) {

				//global $ose; $result= $osse;
				//global $last_id;

 			   if (file_exists ( $dst ))
        	//rrmdir( $dst );
    		if (is_dir( $src )) {
        //mkdir ( $dst );
       		 $files =scandir( $src );
       		 $i=0;
       		 $chaf=rand(1,999);
       		 //$oss=$Nomdos;
       			 foreach ($files as $key=>$file ){
       	$req="SELECT dossier FROM dossiers WHERE id=?";
		$exe=Db::getInstance()->prepare($req);
		$exe->execute([$_POST['dossier']]);
		$data=$exe->fetch();
		$noms=[$data->dossier];
		$ext="pdf";
		$name_img =str_replace('/','',$noms);
           				 if ($file != "." && $file != ".."){
                           	$explode =explode('.', $file);
                           	$extension = end($explode);
                           	$new = $chaf.'_'.$name[$i].'.'.$extension;
               				 copy ("$src/$file","$dst/$new");
               				 //copy ( "$src/$file", "$dst/$chaf.'-'.$name[$i].'.'.$extension");
               				 //copy("$file", "$uploaded");
               				// var_dump($name[$i]);exit ;
               				//$new = $name[$i].'.'.$extension;

               				 $i++;
               				 $sendScann = new FichiersModel;

                        $sendScann->requete('INSERT INTO fichiers (fichier, type, id_doc) VALUES (?,?,?)',[$new,$ext,$late]);
                        	$chaf++;
                             	}
           		 //var_dump($src/$file);
							}
   						 } elseif (file_exists ( $src ))
        				copy( $src, $dst );
                    rrmdir( $src );
					}

				//Function to remove folders and files
				function rrmdir($dir) {
   						 if (is_dir($dir)) {
        					$files = scandir($dir);
        					foreach ($files as $file){
            				if ($file != "." && $file != "..") rrmdir("$dir/$file");
            			}
        					//rmdir($dir);
   								 }
   							 elseif (file_exists($dir)) unlink($dir);
							}

							rcopy($src,$dst,$late,$name_img);

							rrmdir($src);

							//supprimer le contenu de scann //
							$scann="scann/";
								rrmdir($scann);
							// Fin suppression scann//

							//supprimer le contenu de pros //
							$pros="pros/";
								rrmdir($pros);
							// Fin suppression pros//


// insertion fichiers uploadés
		 /*					 $phpFileUploadErrors = array(
           0 => "Vos informations ont &eacute;t&eacute; prise en compte. Merci",
           1 => "Le taille du fichiers est trop volumineux",
           2 => "Le fichier exc&eacute;de la taille demand&eacute;",
           3 => "Le fichier a &eacute;t&eacute; partiellement upload&eacute;",
           4 => " Pas de fichiers charg&eacute;",#App::Redirect("show_prestation.php"),
           5 => "Un dossier temporaire manquant",
           6 => "Echec d'ecriture sur le disk",
           7 => "Une extensions PHP a stopp&eacute; le fichier charg&eacute;",
       );
        function reArrayFiles($file_post){
            $file_ary = array();
            $file_count = count($file_post['name']);
            $file_key = array_keys($file_post);

            for($i=0; $i<$file_count; $i++){
                foreach ($file_key as $key):
                    $file_ary[$i][$key] = $file_post[$key][$i];
                endforeach;
            }
            return $file_ary;
        }

      //  $tmp = $_FILES['fichier']['tmp_name'];
       if(isset($_FILES['fichier']))
         {
    //$repertoire =strtoupper(strip_tags($ref));
							if(!is_dir("archives")){
								$rep = mkdir("archives",0777);
								//echo"ok";
							}
							if(!is_dir("archives/$Nomdom")){
								$rep = mkdir("archives/$Nomdom",0777);
							//	fopen($rep, "rw");
							//echo"ok1";
							//
							}
							if(!is_dir("archives/$Nomdom/$Nomtyp")){
								$rep = mkdir("archives/$Nomdom/$Nomtyp",0777);
								//echo"ok2";
							//	fopen($rep, "rw");
							//
							}
							if(!is_dir("archives/$Nomdom/$Nomtyp/$Nomdos")){
								$rep = mkdir("archives/$Nomdom/$Nomtyp/$Nomdos",0777);
								//echo"ok3";
							//	fopen($rep, "rw");
							//
							}

							//var_dump($chemin);

           // $alpha = "azertyuiopmlkjhgfdsqwxcvbn0123654789";
            #$rep = $up.mkdir(uniqid($alpha,6)).'/';
            #$mon_rep = uniqid(substr(str_shuffle(str_repeat($alpha,5)),0,8));
            #$rep = mkdir($up.$mon_rep);
            #fopen($rep, "r+");
            #var_dump($rep);
            $file_array = reArrayFiles($_FILES['fichier']);
           // pre_r($file_array);
            for ($i=0;$i<count($file_array); $i++){
                if($file_array[$i]['error']){

             Form::setFlash('danger',$file_array[$i]['name'].''.$phpFileUploadErrors[$file_array[$i]['error']]);

                }else{
                    $extensions = array('jpg','png','gif','jpeg','html','php','doc','docx','csv','pdf','xlsx','xls','xlsm','rar','zip','3gp','mp4','mpeg','flv','mp3','amr','accdb','avi');
                    $file_ext = explode('.',$file_array[$i]['name']);
                    $file_ext = strtolower(end($file_ext));


                    if(!in_array($file_ext,$extensions)){

                         Form::setFlash('danger',$file_array[$i]['name']." - Extention Invalid");


                    }else{

                    	//var_dump(dirname(getcwd()));
                        #move_uploaded_file($file_array[$i]['tmp_name'], "uploads/".$file_array[$i]['name']);
                        #$last = $db->lastInsertId();
                        $sendFiles = new FichiersModel;
                        $monfile = str_replace(' ','_',$file_array[$i]['name']);
                        $sendFiles->requete('INSERT INTO fichiers (fichier, type, id_doc) VALUES (?,?,?)',[$chaf.'_'.$monfile,$file_ext,$last_id]);

						move_uploaded_file($file_array[$i]['tmp_name'],"archives/$Nomdom/$Nomtyp/$Nomdos/".$chaf.'_'.$monfile);

                     	//file_put_contents('pdf-compatible/'.$chaf.'_'.$monfile);

                             //  $sendFiles->setFichier($file_array[$i]['name'])
                              // 			 ->setType($file_ext)
                               //			 ->setIdDoc($last_id);
                              // $sendFiles->CreateFile();
                              // $sql = "INSERT INTO fichiers (fichier, type, id_doc) VALUES (?,?,?)";
                               //$insert = Db::getInstance()->prepare($sql);
                              //$insert->execute([$file_array[$i]['name'],$file_ext,$last_id]);

                        //var_dump("$repertoire/".$file_array[$i]['name']);
                        Form::setFlash('success',$phpFileUploadErrors[$file_array[$i]['error']]);
							}
                }
            }
        }

*/
// FIn d'insertion de fichier scannes






								Form::setFlash('success','La pièce '.$code.' a été crée avec succès');
								header("Location: /documents/mes_documents");
								exit;
	}
	else{
							Form::setFlash('danger','Ce numéro de pièce est déjà utilsé pour cette typologie');
						}


					}	else{
			Form::setFlash('info','Veuillez à bien remplir le formulaire');
		}


		//modal usager

		if (Form::Validate($_POST,['usagers','typos','domaines'])) {
            //le formulaire est valide
            $usagers = strtoupper(strip_tags($_POST['usagers']));
            $types = strtoupper(strip_tags($_POST['typos']));
            $contact = strtoupper(strip_tags($_POST['contact']));
            $email = strtoupper(strip_tags($_POST['email']));
            $adresse = strip_tags($_POST['adresse']);
            $matricule = strip_tags($_POST['matricule']);
            $fonction = strip_tags($_POST['fonction']);
            $grade = strip_tags($_POST['grade']);
            $etab = strip_tags($_POST['etable']);
            $iddom= $_POST['domaines'];
            $dateserv = strip_tags($_POST['dateserv']);




                        $db = db::getInstance();
                        // code...

                    //on insert le service

                        if($types == 1)
                        {
                            $req= "select * FROM usagers WHERE usager=?";

                        $exe = $db->prepare($req);
                        $exe->execute([$usagers]);
                        $verif = $exe->fetch();
                            if(!$verif){
                            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                          //on hydrate l'usager entreprise
                            $usage = new UsagersModel;
                            $usage->setUsager($usagers)
                                    ->setTypeUsager($types)
                                    ->setContact($contact)
                                    ->setEmail($email)
                                    ->setAdresse($adresse)
                                    ->setIdCat($iddom);
                            $usage->Create();
                            }else{
                             Form::setFlash('danger',"Entrer un format d'email valide" );
                            }}else{
                         Form::setFlash('danger',"Cet usager exite déjà" );
                        }
                        }else{
                            // on hydrate l'usage particulier
                            //on hydrate le service
                        $req= "select * FROM usagers WHERE usager=? AND matricule=?";

                        $exe = $db->prepare($req);
                        $exe->execute([$usagers,$matricule]);
                        $verif = $exe->fetch();
                            if(!$verif){
                            $usage = new UsagersModel;
                            $usage->setUsager($usagers)
                                    ->setTypeUsager($types)
                                    ->setContact($contact)
                                    ->setMatricule($matricule)
                                    ->setFonction($fonction)
                                    ->setEtablissement($etab)
                                    ->setGrade($grade)
                                    ->setIdCat($iddom)
                                    ->setDateService($dateserv);
                            $usage->Create();
                        }else{
                         Form::setFlash('danger',"Cet usager exite déjà" );
                        }
                        }

                            Form::setFlash('success',"Un usager vient d'etre créer" );
                           // header("Location:/usagers/liste_usagers");
                            //exit;
                        }


		//fin modal usager
$usagers = new UsagersModel;
	$categorie = new DomainesModel;
	$dossier = new DossiersModel;
	$service = new DirectionsModel;
	$type = new TypesModel;
	$nature = new NaturesModel;
    $services = $service->findAll();
    $domaines = $categorie->findAll();
    $dossierss = $dossier->requete("SELECT * FROM rayons,etageres,boites,dossiers
	 WHERE 
	 rayons.id=etageres.id_rayon AND boites.id_etagere=etageres.id AND dossiers.id_boite=boites.id
	  ORDER BY dossier asc")->fetchAll();
    $natures = $nature->findAll();
    $types = $type->findAll();
    $typos=$type->requete("SELECT * FROM types WHERE id_cat=?",[$doss->idcat])->fetchAll();
    $usages = $usagers->requete("SELECT * FROM usagers WHERE id_cat=?",[$doss->idcat])->fetchAll();

	$this->Render('/documents/ajoutes_pieces',compact('services','domaines','types','dossiers','doss','typos','usages'),'admin');
	}


	//Fin ajout pieces par typologie





	public function ajouter_piece(int $id)

	{
		///var_dump($_POST);
		//var_dump(scandir('../public/scann'));

     if (Form::Validate($_POST,['dossier','domaine','types','cases'])) {
			//le formulaire est valide
			$nbr = 1;

			//$ref = strtoupper(strip_tags($_POST['reference']));

			$dom = $_POST['domaine'];
			$dos = $_POST['dossier'];
			$typ = $_POST['types'];
			$cases = $_POST['cases'];
			$lib = strip_tags($_POST['libelle']);
			//$lib1 = strip_tags($_POST['libelle1']);
			$lib2 = strip_tags($_POST['libelle2']);
			$lib5 = strip_tags($_POST['libelle5']);
			$lib10 = strip_tags($_POST['libelle10']);
			$lib12 = strip_tags($_POST['libelle12']);
			$lib14 = strip_tags($_POST['libelle14']);
			$lib15 = strip_tags($_POST['libelle15']);
			$lib16 = strip_tags($_POST['libelle16']);
			$lib19 = strip_tags($_POST['libelle19']);
			$lib20 = strip_tags($_POST['libelle20']);
			$lib22 = strip_tags($_POST['libelle22']);
			//$desc1 = strip_tags($_POST['objet1']);
			$desc10 = strip_tags($_POST['objet10']);
			$desc11 = strip_tags($_POST['objet11']);
			$desc12 = strip_tags($_POST['objet12']);
			$desc13 = strip_tags($_POST['objet13']);
			$desc14 = strip_tags($_POST['objet14']);
			$desc15 = strip_tags($_POST['objet15']);
			$desc16 = strip_tags($_POST['objet16']);
			$desc17 = strip_tags($_POST['objet17']);
			$desc19 = strip_tags($_POST['objet19']);
			$desc20 = strip_tags($_POST['objet20']);
			$desc21 = strip_tags($_POST['objet21']);
			$desc22 = strip_tags($_POST['objet22']);
			$numero = strip_tags($_POST['numero']);
			$numero2 = strip_tags($_POST['numero2']);
			$numero1 = strip_tags($_POST['numero1']);
			//$numero3 = strip_tags($_POST['numero3']);
			$numero4 = strip_tags($_POST['numero4']);
			$numero5 = strip_tags($_POST['numero5']);
			$numero7 = strip_tags($_POST['numero7']);
			$numero8 = strip_tags($_POST['numero8']);
			$numero9 = strip_tags($_POST['numero9']);
			$numero10 = strip_tags($_POST['numero10']);
			$numero11 = strip_tags($_POST['numero11']);
			$numero12 = strip_tags($_POST['numero12']);
			$numero13 = strip_tags($_POST['numero13']);
			$numero14 = strip_tags($_POST['numero14']);
			$numero15 = strip_tags($_POST['numero15']);
			$numero16 = strip_tags($_POST['numero16']);
			$numero17 = strip_tags($_POST['numero17']);
			$numero18 = strip_tags($_POST['numero18']);
			$numero19 = strip_tags($_POST['numero19']);
			$numero20 = strip_tags($_POST['numero20']);
			$numero21 = strip_tags($_POST['numero21']);
			$numero22 = strip_tags($_POST['numero22']);
			$etabli = $_POST['etabli'];
			$etabli1 = $_POST['etabli1'];
			$etabli2 = $_POST['etabli2'];
			$etabli4 = $_POST['etabli4'];
			$etabli5 = $_POST['etabli5'];
			$etabli8 = $_POST['etabli8'];
			$etabli10 = $_POST['etabli10'];
			$etabli11 = $_POST['etabli11'];
			$etabli12 = $_POST['etabli12'];
			$etabli13 = $_POST['etabli13'];
			$etabli14 = $_POST['etabli14'];
			$etabli15 = $_POST['etabli15'];
			$etabli16 = $_POST['etabli16'];
			$etabli17 = $_POST['etabli17'];
			$etabli19 = $_POST['etabli19'];
			$etabli20 = $_POST['etabli20'];
			$etabli21 = $_POST['etabli21'];
			$etabli22 = $_POST['etabli22'];
			$indem = strip_tags($_POST['indemnite']);
			$gains = strip_tags($_POST['gains']);
			$retenues = strip_tags($_POST['retenues']);
			$montant5 = strip_tags($_POST['montant5']);
			$montant7 = strip_tags($_POST['montant7']);
			$montant8 = strip_tags($_POST['montant8']);
			$montant9 = strip_tags($_POST['montant9']);
			$montant20 = strip_tags($_POST['montant20']);
			$reglement5 = strip_tags($_POST['reglement5']);
			$reglement20 = strip_tags($_POST['reglement20']);
			$compte5 = strip_tags($_POST['compte5']);
			$compte18 = strip_tags($_POST['compte18']);
			$decision9 = strip_tags($_POST['decision9']);
			$datedecision = $_POST['datedecision'];
			$expertise = strip_tags($_POST['expertise']);
			$nbrep = $_POST['nbrep'];
			$solde = strip_tags($_POST['solde']);
			$arriere = strip_tags($_POST['arriere']);
			//$logement = strip_tags($_POST['logement']);
			$logement7 = strip_tags($_POST['logement7']);
			$baille = strip_tags($_POST['baille']);
			$logroupe= strip_tags($_POST['logroupe']);
			$pieces= strip_tags($_POST['pieces']);
			$ville= strip_tags($_POST['ville']);
			$duree= strip_tags($_POST['duree']);
			$duree20= strip_tags($_POST['duree20']);
			$compte5= strip_tags($_POST['compte5']);
			$compte20= strip_tags($_POST['compte20']);
			$codebanque= strip_tags($_POST['codebanque']);
			$codeguichet= strip_tags($_POST['codeguichet']);
			$domicile= strip_tags($_POST['domicile']);
			$domicile5= strip_tags($_POST['domicile5']);
			$domicile20= strip_tags($_POST['domicile20']);
			$rib= strip_tags($_POST['rib']);
			$contrat19 = strip_tags($_POST['contrat19']);
			$contrat20 = strip_tags($_POST['contrat20']);
			//$depart= $_POST['effet'];
			$depart13= $_POST['effet13'];
			$effet19= $_POST['effet19'];
			$effet20= $_POST['effet20'];
			$retour= $_POST['retour'];
			$imputation = strip_tags($_POST['imputation']);
			//$nat_id = strip_tags($_POST['natures']);
			$id_usager =$_POST['usager'];

			if($id_usager==''){
				$id_usager=1;
			}

			$id_user= $_SESSION['user']['id'];

			$annee = date('y');
			$catesModel = new DomainesModel;
			$findcat = $catesModel->find($dom);

			$dosModel = new DossiersModel;
			$finddos = $dosModel->find($dos);

			$typModel = new TypesModel;
			$findtyp = $typModel->find($typ);

//			$subserv = strtoupper(substr($findserv->designation, 0,4));
//			$subcat = strtoupper(substr($findcat->designation, 0,3));
				$chaf = rand(1,9999);
				//var_dump($findtyp->code."".$chaf);exit;
				//recuperer le nom categorie
			$Nomtyp = strtoupper($findtyp->type);
			$Nomdom = strtoupper($findcat->designation);
			$Nomdos = strtoupper($finddos->dossier);
			$code=$findtyp->code.$chaf;

				//$chaf = uniqid($chif,5);

			//$ref = $subserv.'-'.$subcat.'-'.$chaf.'-'.$annee;

//var_dump($_POST);exit;



			$db = Db::getInstance();
			  if($typ==1){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([$numero1,$typ]);
                $verif = $exe->fetch();
            		}
              elseif($typ==2){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([$numero2,$typ]);
                $verif = $exe->fetch();
            		}
             elseif($typ==3){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([$numero1,$typ]);
                $verif = $exe->fetch();
            		}
              elseif($typ==4){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([$numero4,$typ]);
                $verif = $exe->fetch();
            		}

            		elseif($typ==5 || $typ==6){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([$numero5,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==7){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([$numero7,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==8){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";


                $exe = $db->prepare($req);
                $exe->execute([$numero8,$typ]);
                $verif = $exe->fetch();
            		}

            		elseif($typ==9){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero9,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==10){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero10,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==11){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero11,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==12){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero12,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==13){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero13,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==14){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero14,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==15){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero15,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==16){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero16,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==17){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero17,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==18){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero18,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==19){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero19,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==20){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero20,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==21){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero21,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==22){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero22,$typ]);
                $verif = $exe->fetch();
            		}
            		elseif($typ==23){
				 $req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero22,$typ]);
                $verif = $exe->fetch();
            		}
            		else{
            			$req= "select * FROM documents WHERE numero=? AND id_types=?";

                $exe = $db->prepare($req);
                $exe->execute([$numero,$typ]);
                $verif = $exe->fetch();
            		}
                 //verirfie si le contact existe
                    if(!$verif){
                    			if($typ==1 || $typ==3){
                    				//CERTIFICAT DE NON HEBERGEMENT//
                    				////CERTIFICAT DE PREMIERE PRISE DE SERVICE
                    				$user = new DocumentsModel;
							$user->setReference($code)
								 ->setNumero($numero1)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								 ->setEtabli($etabli1)
								 ->setIdUsager($id_usager)
								 ->setIdUser($id_user);

						$user->Create();

                    				}
                    			elseif($typ==2)
                    			 {
                    			 	//ARRETE DE NOMMINATION//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero2)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle(strip_tags($_POST['libelle2']))
								 ->setEtabli($etabli2);
							$user->Create();
                    			}
                    			elseif($typ==4)
                    			 {//ATTESTATION DE NON LOGEMENT//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero4)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setTauxindem($indem)
								 ->setEtabli($etabli4);
							$user->Create();
                    			}
                    				elseif($typ==5 || $typ==6)
                    			 {//BELLETIN DE SOLDE//
                    			 	$user = new DocumentsModel;
                    			$user->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setReference($code)
								 ->setNumero($numero5)
								 ->setGains($gains)
								 ->setRetenues($retenues)
								 ->setLibelle($lib5)
								 ->setMontant($montant5)
								 ->setCompte($compte5)
								 ->setDomiciliation($domicile5)
								 ->setReglement($reglement5)
								 ->setEtabli($etabli5);
								$user->Create();
                    			}

								elseif($typ==7)
                    			 {//DECISION AFFECTATION DE LOGEMENT//
                    			 	$user = new DocumentsModel;
                    			$user->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setReference($code)
								 ->setNumero($numero7)
								 ->setLogement($logement7)
								 ->setLogroupe($logroupe)
								 ->setMontant($montant7)
								 ->setPieces($pieces)
								 ->setBaille($baille);
								$user->Create();
                    			}
                    			elseif($typ==8)
                    			 {//ATTESTATION DE FIN DE PAIEMENT//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero8)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setMontant($montant8)
								 ->setEtabli($etabli8);
							$user->Create();
                    			}

                    			elseif($typ==9)
                    			 {
                    			 	//SITUATION REGLEMENT ACQUEREUR//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero9)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setMontant($montant9)
								 ->setDecision($decision9)
								 ->setEffet($datedecision)
								 ->setArriere($arriere)
								 ->setNbrep($nbrep)
								 ->setExpertise($expertise)
								 ->setSolde($solde);
							$user->Create();
                    			}
                    			elseif($typ==10)
                    			 {
                    			 //NOTE INTERNE//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero10)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib10)
								 ->setDescription($desc10)
								 ->setEtabli($etabli10);
							$user->Create();
                    			}
                    			elseif($typ==11)
                    			 {
                    			 //FICHE DE PRESENCE//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero11)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc11)
								 ->setEtabli($etabli11);
							$user->Create();
                    			}
                    			elseif($typ==12)
                    			 {
                    			 //FICHE DE SORTIE DE FOURNITURE//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero12)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc12)
								 ->setLibelle($lib12)
								 ->setEtabli($etabli12);
							$user->Create();
                    			}
                    			elseif($typ==13)
                    			 {
                    			 //ORDRE DE MISSION//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero13)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc13)
								 ->setRetour($retour)
								 ->setEffet($depart13)
								 ->setImputation($imputation)
								 ->setEtabli($etabli13);
							$user->Create();
                    			}
                    			elseif($typ==14)
                    			 {
                    			 //PERSONNEL//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero14)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib14)
								 ->setDescription($desc14)
								 ->setEtabli($etabli14);
							$user->Create();
                    			}
                    			elseif($typ==15)
                    			 {
                    			 //ATTESTATION//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero15)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib15)
								 ->setDescription($desc15)
								 ->setEtabli($etabli15);
							$user->Create();
                    			}
                    			elseif($typ==16)
                    			 {
                    			 //DECISION//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero16)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib16)
								 ->setDescription($desc16)
								 ->setEtabli($etabli16);
							$user->Create();
                    			}
                    			elseif($typ==17)
                    			 {
                    			 //PROCURATION//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero17)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc17)
								 ->setEtabli($etabli17);
							$user->Create();
                    			}
                    			elseif($typ==18)
                    			 {
                    			 //RIB//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero18)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setCodebanque($codebanque)
								 ->setCodeguichet($codeguichet)
								 ->setDomiciliation($domicile)
								 ->setRib($rib)
								 ->setCompte($compte18);

							$user->Create();
                    			}
                    			elseif($typ==19)
                    			 {
                    			 //AVENANTS//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero19)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib19)
								 ->setEffet($effet19)
								 ->setDuree($duree)
								 ->setDescription($desc19)
								 ->setContrat($contrat19)
								 ->setEtabli($etabli19);
							$user->Create();
                    			}

                    			elseif($typ==20)
                    			 {
                    			 //CONTRAT DE BAIL//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero20)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib20)
								 ->setEffet($effet20)
								 ->setDuree($duree20)
								 ->setDescription($desc20)
								 ->setCompte($compte20)
								 ->setMontant($montant20)
								 ->setReglement($reglement20)
								 ->setDomiciliation($domicile20)
								 ->setContrat($contrat20)
								 ->setVille($ville)
								 ->setEtabli($etabli20);
							$user->Create();
                    			}

                    			elseif($typ==21)
                    			 {
                    			 //ACTE INDIViDUALITE//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero21)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc21)
								 ->setEtabli($etabli21);
							$user->Create();
                    			}elseif($typ==22)
                    			 {
                    			 //ARRIVEE//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero22)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc22)
								 ->setLibelle($lib22)
								 ->setEtabli($etabli22);
							$user->Create();
                    			}elseif($typ==23)
                    			 {
                    			 //DEPART//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero22)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc22)
								 ->setLibelle($lib22)
								 ->setEtabli($etabli22);
							$user->Create();
                    			}
                    			else{
                    				$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero($numero)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib)
								 ->setEtabli($etabli);
							$user->Create();
                    			}

							$last_id = $db->lastInsertId();

							//creation des rêpertoires

		if(!is_dir("archives")){
								$rep = mkdir("archives",0777);
								//echo"ok";
							}
							if(!is_dir("archives/$Nomdom")){
								$rep = mkdir("archives/$Nomdom",0777);
							//	fopen($rep, "rw");
							//echo"ok1";
							//
							}
							if(!is_dir("archives/$Nomdom/$Nomtyp")){
								$rep = mkdir("archives/$Nomdom/$Nomtyp",0777);
								//echo"ok2";
							//	fopen($rep, "rw");
							//
							}
							if(!is_dir("archives/$Nomdom/$Nomtyp/$Nomdos")){
								$rep = mkdir("archives/$Nomdom/$Nomtyp/$Nomdos",0777);
								//echo"ok3";
							//	fopen($rep, "rw");
							//
							}
							/*
							if(!is_dir("archives/$Nomserv/$Nomcat/$Nomnat/$Nomtyp")){
								$rep = mkdir("archives/$Nomserv/$Nomcat/$Nomnat/$Nomtyp",0777);
								//echo"ok4";
							//	fopen($rep, "rw");
							//
							}
							if(!is_dir("archives/$Nomserv/$Nomcat/$Nomnat/$Nomtyp/$lib")){
								$rep = mkdir("archives/$Nomserv/$Nomcat/$Nomnat/$Nomtyp/$lib",0777);
								//echo"ok5";
							//	fopen($rep, "rw");
							//
							}*/

							//fin de repertoire
									 // Fusion des fichiers pdf


$fileArray= glob($_SERVER['DOCUMENT_ROOT'].'/pros/*.pdf');
//var_dump($fileArray);exit();
 $datadir =$_SERVER['DOCUMENT_ROOT'].'/mydoc/';
 //var_dump($fileArray);
 $outputName = $datadir.rand(1,100).".pdf";
  $cmd = "gswin64c -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile=$outputName ";
  //Add each pdf file to the end of the command

  foreach($fileArray as $file) {

    if ($file != "." && $file != "..") {

       $cmd .= $file." ";
    }

}


//var_dump($cmd);

$result = shell_exec($cmd);


	 // FIN fusion pdf
//var_dump($last_id); exit;
// Insertion des fichiers scanner
			 $src = 'mydoc/';
			 $mon='pdf-compatible/';
			// $uploaded='pdf-uploaded/';
		$dst = "archives/$Nomdom/$Nomtyp/$Nomdos/";
		$late =$last_id;
		//$name_img =$_POST['image'];
		//
		$req="SELECT dossier FROM dossiers WHERE id=?";
		$exe=Db::getInstance()->prepare($req);
		$exe->execute([$_POST['dossier']]);
		$data=$exe->fetch();
		$noms=[$data->dossier];
		$name_img =str_replace('/','',$noms);
		//var_dump();exit;


//copy($src, $dst);  //Call function
//Function to Copy folders and files
			function rcopy($src, $dst,$late,$name) {

				//global $ose; $result= $osse;
				//global $last_id;

 			   if (file_exists ( $dst ))
        	//rrmdir( $dst );
    		if (is_dir( $src )) {
        //mkdir ( $dst );
       		 $files =scandir( $src );
       		 $i=0;
       		 $chaf=rand(1,999);
       		 //$oss=$Nomdos;
       			 foreach ($files as $key=>$file ){
       	$req="SELECT dossier FROM dossiers WHERE id=?";
		$exe=Db::getInstance()->prepare($req);
		$exe->execute([$_POST['dossier']]);
		$data=$exe->fetch();
		$noms=[$data->dossier];
		$ext="pdf";
		$name_img =str_replace('/','',$noms);
           				 if ($file != "." && $file != ".."){
                           	$explode =explode('.', $file);
                           	$extension = end($explode);
                           	$new = $chaf.'_'.$name[$i].'.'.$extension;
               				 copy ("$src/$file","$dst/$new");
               				 //copy ( "$src/$file", "$dst/$chaf.'-'.$name[$i].'.'.$extension");
               				 //copy("$file", "$uploaded");
               				// var_dump($name[$i]);exit ;
               				//$new = $name[$i].'.'.$extension;

               				 $i++;
               				 $sendScann = new FichiersModel;

                        $sendScann->requete('INSERT INTO fichiers (fichier, type, id_doc) VALUES (?,?,?)',[$new,$ext,$late]);
                        	$chaf++;
                             	}
           		 //var_dump($src/$file);
							}
   						 } elseif (file_exists ( $src ))
        				copy( $src, $dst );
                    rrmdir( $src );
					}

				//Function to remove folders and files
				function rrmdir($dir) {
   						 if (is_dir($dir)) {
        					$files = scandir($dir);
        					foreach ($files as $file){
            				if ($file != "." && $file != "..") rrmdir("$dir/$file");
            			}
        					//rmdir($dir);
   								 }
   							 elseif (file_exists($dir)) unlink($dir);
							}

							rcopy($src,$dst,$late,$name_img);

							rrmdir($src);

							//supprimer le contenu de scann //
							$scann="scann/";
								rrmdir($scann);
								/*$ouverture=opendir($scann);
								$fichier=readdir($ouverture);
								$fichier=readdir($ouverture);
								while ($fichier=readdir($ouverture)) {
								unlink("$scann/$fichier");
									}
									closedir($ouverture);*/
							// Fin suppression scann//

							//supprimer le contenu de pros //
							$pros="pros/";
								rrmdir($pros);
								/*$ouverture=opendir($pros);
								$fichier=readdir($ouverture);
								$fichier=readdir($ouverture);
								while ($fichier=readdir($ouverture)) {
								unlink("$pros/$fichier");
									}
									closedir($ouverture);*/
							// Fin suppression pros//


// insertion fichiers uploadés
							 $phpFileUploadErrors = array(
           0 => "Vos informations ont &eacute;t&eacute; prise en compte. Merci",
           1 => "Le taille du fichiers est trop volumineux",
           2 => "Le fichier exc&eacute;de la taille demand&eacute;",
           3 => "Le fichier a &eacute;t&eacute; partiellement upload&eacute;",
           4 => " Pas de fichiers charg&eacute;",#App::Redirect("show_prestation.php"),
           5 => "Un dossier temporaire manquant",
           6 => "Echec d'ecriture sur le disk",
           7 => "Une extensions PHP a stopp&eacute; le fichier charg&eacute;",
       );
        function reArrayFiles($file_post){
            $file_ary = array();
            $file_count = count($file_post['name']);
            $file_key = array_keys($file_post);

            for($i=0; $i<$file_count; $i++){
                foreach ($file_key as $key):
                    $file_ary[$i][$key] = $file_post[$key][$i];
                endforeach;
            }
            return $file_ary;
        }

       // $tmp = $_FILES['fichier']['tmp_name'];
        if(isset($_FILES['fichier']))
         {
    //$repertoire =strtoupper(strip_tags($ref));
							if(!is_dir("archives")){
								$rep = mkdir("archives",0777);
								//echo"ok";
							}
							if(!is_dir("archives/$Nomdom")){
								$rep = mkdir("archives/$Nomdom",0777);
							//	fopen($rep, "rw");
							//echo"ok1";
							//
							}
							if(!is_dir("archives/$Nomdom/$Nomtyp")){
								$rep = mkdir("archives/$Nomdom/$Nomtyp",0777);
								//echo"ok2";
							//	fopen($rep, "rw");
							//
							}
							if(!is_dir("archives/$Nomdom/$Nomtyp/$Nomdos")){
								$rep = mkdir("archives/$Nomdom/$Nomtyp/$Nomdos",0777);
								//echo"ok3";
							//	fopen($rep, "rw");
							//
							}

							//var_dump($chemin);

           // $alpha = "azertyuiopmlkjhgfdsqwxcvbn0123654789";
            #$rep = $up.mkdir(uniqid($alpha,6)).'/';
            #$mon_rep = uniqid(substr(str_shuffle(str_repeat($alpha,5)),0,8));
            #$rep = mkdir($up.$mon_rep);
            #fopen($rep, "r+");
            #var_dump($rep);
            $file_array = reArrayFiles($_FILES['fichier']);
           // pre_r($file_array);
            for ($i=0;$i<count($file_array); $i++){
                if($file_array[$i]['error']){

             Form::setFlash('danger',$file_array[$i]['name'].''.$phpFileUploadErrors[$file_array[$i]['error']]);

                }else{
                    $extensions = array('jpg','png','gif','jpeg','html','php','doc','docx','csv','pdf','xlsx','xls','xlsm','rar','zip','3gp','mp4','mpeg','flv','mp3','amr','accdb','avi');
                    $file_ext = explode('.',$file_array[$i]['name']);
                    $file_ext = strtolower(end($file_ext));


                    if(!in_array($file_ext,$extensions)){

                         Form::setFlash('danger',$file_array[$i]['name']." - Extention Invalid");


                    }else{

                    	//var_dump(dirname(getcwd()));
                        #move_uploaded_file($file_array[$i]['tmp_name'], "uploads/".$file_array[$i]['name']);
                        #$last = $db->lastInsertId();
                        $sendFiles = new FichiersModel;
                        $monfile = str_replace(' ','_',$file_array[$i]['name']);
                        $sendFiles->requete('INSERT INTO fichiers (fichier, type, id_doc) VALUES (?,?,?)',[$chaf.'_'.$monfile,$file_ext,$last_id]);

						move_uploaded_file($file_array[$i]['tmp_name'],"archives/$Nomdom/$Nomtyp/$Nomdos/".$chaf.'_'.$monfile);

                     	//file_put_contents('pdf-compatible/'.$chaf.'_'.$monfile);

                             //  $sendFiles->setFichier($file_array[$i]['name'])
                              // 			 ->setType($file_ext)
                               //			 ->setIdDoc($last_id);
                              // $sendFiles->CreateFile();
                              // $sql = "INSERT INTO fichiers (fichier, type, id_doc) VALUES (?,?,?)";
                               //$insert = Db::getInstance()->prepare($sql);
                              //$insert->execute([$file_array[$i]['name'],$file_ext,$last_id]);

                        //var_dump("$repertoire/".$file_array[$i]['name']);
                        Form::setFlash('success',$phpFileUploadErrors[$file_array[$i]['error']]);
							}
                }
            }
        }


// FIn d'insertion de fichier scannes






								Form::setFlash('success','La pièce '.$code.' a été crée avec succès');
								header("Location:/documents/mes_documents");
								exit;
	}
	else{
							Form::setFlash('danger','Ce numéro de pièce est déjà utilsé pour cette typologie');
						}


					}	else{
			Form::setFlash('info','Veuillez à bien remplir le formulaire');
		}


		//modal usager

		if (Form::Validate($_POST,['usagers','typos','domaines'])) {
            //le formulaire est valide
            $usagers = strtoupper(strip_tags($_POST['usagers']));
            $types = strtoupper(strip_tags($_POST['typos']));
            $contact = strtoupper(strip_tags($_POST['contact']));
            $email = strtoupper(strip_tags($_POST['email']));
            $adresse = strip_tags($_POST['adresse']);
            $matricule = strip_tags($_POST['matricule']);
            $fonction = strip_tags($_POST['fonction']);
            $grade = strip_tags($_POST['grade']);
            $etab = strip_tags($_POST['etable']);
            $iddom= $_POST['domaines'];
            $dateserv = strip_tags($_POST['dateserv']);




                        $db = db::getInstance();
                        // code...

                    //on insert le service

                        if($types == 1)
                        {
                            $req= "select * FROM usagers WHERE usager=?";

                        $exe = $db->prepare($req);
                        $exe->execute([$usagers]);
                        $verif = $exe->fetch();
                            if(!$verif){
                            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                          //on hydrate l'usager entreprise
                            $usage = new UsagersModel;
                            $usage->setUsager($usagers)
                                    ->setTypeUsager($types)
                                    ->setContact($contact)
                                    ->setEmail($email)
                                    ->setAdresse($adresse)
                                    ->setIdCat($iddom);
                            $usage->Create();
                            }else{
                             Form::setFlash('danger',"Entrer un format d'email valide" );
                            }}else{
                         Form::setFlash('danger',"Cet usager exite déjà" );
                        }
                        }else{
                            // on hydrate l'usage particulier
                            //on hydrate le service
                        $req= "select * FROM usagers WHERE usager=? AND matricule=?";

                        $exe = $db->prepare($req);
                        $exe->execute([$usagers,$matricule]);
                        $verif = $exe->fetch();
                            if(!$verif){
                            $usage = new UsagersModel;
                            $usage->setUsager($usagers)
                                    ->setTypeUsager($types)
                                    ->setContact($contact)
                                    ->setMatricule($matricule)
                                    ->setFonction($fonction)
                                    ->setEtablissement($etab)
                                    ->setGrade($grade)
                                    ->setIdCat($iddom)
                                    ->setDateService($dateserv);
                            $usage->Create();
                        }else{
                         Form::setFlash('danger',"Cet usager exite déjà" );
                        }
                        }

                            Form::setFlash('success',"Un usager vient d'etre créer" );
                           // header("Location:/usagers/liste_usagers");
                            //exit;
                        }


		//fin modal usager

	$categorie = new DomainesModel;
	$dossier = new DossiersModel;
	$service = new DirectionsModel;
	$type = new TypesModel;
	$nature = new NaturesModel;
    $services = $service->findAll();
    $domaines = $categorie->findAll();
    $dossiers = $dossier->requete("SELECT * FROM rayons,etageres,boites,dossiers
	 WHERE 
	 rayons.id=etageres.id_rayon AND boites.id_etagere=etageres.id AND dossiers.id_boite=boites.id
	  ORDER BY dossier asc")->fetchAll();
    $natures = $nature->findAll();
    $types = $type->findAll();
    $domain = $categorie->requete("SELECT * FROM rayons,salles,villes,etageres,boites,dossiers,categories WHERE villes.id=salles.id_ville AND rayons.id_salle=salles.id AND rayons.id =etageres.id_rayon AND boites.id_etagere = etageres.id AND dossiers.id_boite=boites.id AND categories.id=boites.id_cat AND categories.id=?",[$id])->fetch();
        $doss = $categorie->requete("SELECT * FROM rayons,salles,villes,etageres,boites,categories,dossiers WHERE villes.id=salles.id_ville AND rayons.id_salle=salles.id AND rayons.id =etageres.id_rayon AND boites.id_etagere = etageres.id AND dossiers.id_boite=boites.id AND categories.id=boites.id_cat AND categories.id=?",[$id])->fetchAll();

    $typos = $type->requete("SELECT * FROM categories,types WHERE categories.id=types.id_cat AND categories.id=?",[$id])->fetchAll();
    $usages = $categorie->requete("SELECT * FROM categories,usagers WHERE categories.id = usagers.id_cat AND categories.id=?",[$id])->fetchAll();

	$this->Render('/documents/ajout_piece',compact('services','domaines','types','dossiers','domain','typos','usages','doss'),'admin');
	}








	//modifier un document

public function modifier(int $id)
{


       // l'utilisateur est connecté
       // //on va verifier si le document exite dans la base
      $docModel = new DocumentsModel;
	 // $docs = $docModel->find($id);
	  $docs = $docModel->requete("SELECT * FROM categories as c,types as t, usagers as u,dossiers as o,documents as d WHERE d.actif=? AND u.id = d.id_usager AND d.id_dos = o.id AND d.id_types = t.id AND d.id =? AND c.id= d.id_cat GROUP BY d.reference ORDER BY d.date_creation_doc DESC",[1,$id])->fetch();
	  $fileModel = $docModel->requete("SELECT * FROM fichiers WHERE actif=? AND id_doc=?",[1,$id])->fetchAll();

//var_dump($fileModel);
	  //si l'annonce n'existe pas, on retourne ala liste des annonces
       if(!$docs){
        http_response_code(404);
        Form::setFlash('danger',"L'utilisateur rechercher n'existe pas");
        header("Location: /documents/mes_documents");
        exit;
       }


if (Form::Validate($_POST,['domaine','types','dossier','cases'])) {
			//le formulaire est valide


			$dom = $_POST['domaine'];
			$dos = $_POST['dossier'];
			$typ = $_POST['types'];
			$code=$_POST['reference'];
			$lib = strip_tags($_POST['libelle']);
			//$lib1 = strip_tags($_POST['libelle1']);
			/*$lib2 = strip_tags($_POST['libelle2']);
			$lib5 = strip_tags($_POST['libelle5']);
			$lib10 = strip_tags($_POST['libelle10']);
			$lib12 = strip_tags($_POST['libelle12']);
			$lib14 = strip_tags($_POST['libelle14']);
			$lib15 = strip_tags($_POST['libelle15']);
			$lib16 = strip_tags($_POST['libelle16']);
			$lib19 = strip_tags($_POST['libelle19']);
			$lib20 = strip_tags($_POST['libelle20']);
			$lib22 = strip_tags($_POST['libelle22']);
			//$desc1 = strip_tags($_POST['objet1']);
			$desc10 = strip_tags($_POST['objet10']);
			$desc11 = strip_tags($_POST['objet11']);
			$desc12 = strip_tags($_POST['objet12']);
			$desc13 = strip_tags($_POST['objet13']);
			$desc14 = strip_tags($_POST['objet14']);
			$desc15 = strip_tags($_POST['objet15']);
			$desc16 = strip_tags($_POST['objet16']);
			$desc17 = strip_tags($_POST['objet17']);
			$desc19 = strip_tags($_POST['objet19']);
			$desc20 = strip_tags($_POST['objet20']);
			$desc21 = strip_tags($_POST['objet21']);
			$desc22 = strip_tags($_POST['objet22']);*/
			$numero = strip_tags($_POST['numero']);
			/*$numero2 = strip_tags($_POST['numero2']);
			$numero1 = strip_tags($_POST['numero1']);
			$numero3 = strip_tags($_POST['numero3']);
			$numero4 = strip_tags($_POST['numero4']);
			$numero5 = strip_tags($_POST['numero5']);
			$numero7 = strip_tags($_POST['numero7']);
			$numero8 = strip_tags($_POST['numero8']);
			$numero9 = strip_tags($_POST['numero9']);
			$numero10 = strip_tags($_POST['numero10']);
			$numero11 = strip_tags($_POST['numero11']);
			$numero12 = strip_tags($_POST['numero12']);
			$numero13 = strip_tags($_POST['numero13']);
			$numero14 = strip_tags($_POST['numero14']);
			$numero15 = strip_tags($_POST['numero15']);
			$numero16 = strip_tags($_POST['numero16']);
			$numero17 = strip_tags($_POST['numero17']);
			$numero18 = strip_tags($_POST['numero18']);
			$numero19 = strip_tags($_POST['numero19']);
			$numero20 = strip_tags($_POST['numero20']);
			$numero21 = strip_tags($_POST['numero21']);*/
			/*$etabli = $_POST['etabli'];
			$etabli1 = $_POST['etabli1'];
			$etabli2 = $_POST['etabli2'];
			$etabli4 = $_POST['etabli4'];
			$etabli5 = $_POST['etabli5'];
			$etabli8 = $_POST['etabli8'];
			$etabli10 = $_POST['etabli10'];
			$etabli11 = $_POST['etabli11'];
			$etabli12 = $_POST['etabli12'];
			$etabli13 = $_POST['etabli13'];
			$etabli14 = $_POST['etabli14'];
			$etabli15 = $_POST['etabli15'];
			$etabli16 = $_POST['etabli16'];
			$etabli17 = $_POST['etabli17'];
			$etabli19 = $_POST['etabli19'];
			$etabli20 = $_POST['etabli20'];
			$etabli21 = $_POST['etabli21'];
			$etabli22 = $_POST['etabli22'];
			$indem = strip_tags($_POST['indemnite']);
			$gains = strip_tags($_POST['gains']);
			$retenues = strip_tags($_POST['retenues']);
			$montant5 = strip_tags($_POST['montant5']);
			$montant7 = strip_tags($_POST['montant7']);
			$montant8 = strip_tags($_POST['montant8']);
			$montant9 = strip_tags($_POST['montant9']);
			$montant20 = strip_tags($_POST['montant20']);
			$reglement5 = strip_tags($_POST['reglement5']);
			$reglement20 = strip_tags($_POST['reglement20']);
			$compte5 = strip_tags($_POST['compte5']);
			$compte18 = strip_tags($_POST['compte18']);
			$decision9 = strip_tags($_POST['decision9']);
			$datedecision = $_POST['datedecision'];
			$expertise = strip_tags($_POST['expertise']);
			$nbrep = $_POST['nbrep'];
			$solde = strip_tags($_POST['solde']);
			$arriere = strip_tags($_POST['arriere']);
			//$logement = strip_tags($_POST['logement']);
			$logement7 = strip_tags($_POST['logement7']);
			$baille = strip_tags($_POST['baille']);
			$logroupe= strip_tags($_POST['logroupe']);
			$pieces= strip_tags($_POST['pieces']);
			$ville= strip_tags($_POST['ville']);
			$duree= strip_tags($_POST['duree']);
			$duree20= strip_tags($_POST['duree20']);
			$compte5= strip_tags($_POST['compte5']);
			$compte20= strip_tags($_POST['compte20']);
			$codebanque= strip_tags($_POST['codebanque']);
			$codeguichet= strip_tags($_POST['codeguichet']);
			$domicile= strip_tags($_POST['domicile']);
			$domicile5= strip_tags($_POST['domicile5']);
			$domicile20= strip_tags($_POST['domicile20']);
			$rib= strip_tags($_POST['rib']);
			$contrat19=strip_tags($_POST['contrat19']);
			$contrat20=strip_tags($_POST['contrat20']);
			//$depart= $_POST['effet'];
			$depart13= $_POST['effet13'];
			$effet19= $_POST['effet19'];
			$effet20= $_POST['effet20'];
			$retour= $_POST['retour'];
			$imputation = strip_tags($_POST['imputation']);*/
			$cases=$_POST['cases'];
			//$nat_id = strip_tags($_POST['natures']);
			$id_usager =$_POST['usager'];
			$id_user = $_SESSION['user']['id'];

			$dates= date('Y-m-d H:i:s');


			$catesModel = new DomainesModel;
			$findcat = $catesModel->find($dom);
			//$servModel = new DirectionsModel;
			//$findserv = $servModel->find($serv_id);

			$dosModel = new DossiersModel;
			$finddos = $dosModel->find($dos);

			$typModel = new TypesModel;
			$findtyp = $typModel->find($typ);
				$chaf = mt_rand(1,9999);
				//recuperer le nom categorie
			//$Nomserv = strtoupper($findserv->designation);
			$Nomcat = strtoupper($findcat->designation) ;
			$Nomdos = strtoupper($finddos->dossier);
			$Nomtyp = strtoupper($findtyp->type) ;
if($etabli5=""){
	$etabli5="0000-00-00";
}else{
	$etabli5;
}
			$chaf = mt_rand(1,9999);

			$db = Db::getInstance();
				// var_dump($etabli5);
                    //on insert le service
							/*$user = new DocumentsModel;
							$user->setId($id)
								 ->setLibelle($lib)
								 ->setIdCat($cat_id)
								 ->setIdServ($serv_id)
								  ->setIdNatures($nat_id)
								  ->setIdTypes($typ_id)
								 ->setDescription($desc)
								 ->setIdUser($id_user)
								 ->setUpdateAt($dates);

							$user->update();
*/
							/*if($typ==1 || $typ==3){
                    				//CERTIFICAT DE NON HEBERGEMENT//
                    				////CERTIFICAT DE PREMIERE PRISE DE SERVICE
                    				$user = new DocumentsModel;
							$user->setId($id)
								 ->setReference($code)
								 ->setNumero($numero)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setCases($cases)
								 ->setIdCat($dom)
								 ->setEtabli($etabli1)
								 ->setIdUsager($id_usager)
								 ->setIdUser($id_user);

						$user->update();

                    				}
                    			elseif($typ==2)
                    			 {
                    			 	//ARRETE DE NOMMINATION//
                    			 	$user = new DocumentsModel;
                    			$user->setId($id)
                    			->setReference($code)
                    			 ->setNumero($numero)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setCases($cases)
								 ->setIdCat($dom)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle(strip_tags($_POST['libelle2']))
								 ->setEtabli($etabli2);
							$user->update();
                    			}
                    			elseif($typ==4)
                    			 {//ATTESTATION DE NON LOGEMENT//
                    			 	$user = new DocumentsModel;
                    			$user->setId($id)
                    			->setReference($code)
                    			 ->setNumero($numero)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setCases($cases)
								 ->setIdCat($dom)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setTauxindem($indem)
								 ->setEtabli($etabli4);
							$user->update();
                    			}
                    				elseif($typ==5 || $typ==6)
                    			 {//BELLETIN DE SOLDE//
                    			 	$user = new DocumentsModel;
                    			$user->setId($id)
                    			->setReference($code)
                    			->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setCases($cases)
								 ->setIdCat($dom)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setNumero($numero)
								 ->setGains($gains)
								 ->setRetenues($retenues)
								 ->setLibelle($lib5)
								 ->setMontant($montant5)
								 ->setCompte($compte5)
								 ->setReglement($reglement5)
								 ->setDomiciliation($domicile5)
								 ->setEtabli($etabli5);
								$user->update();
                    			}

								elseif($typ==7)
                    			 {//DECISION AFFECTATION DE LOGEMENT//
                    			 	$user = new DocumentsModel;
                    			$user->setId($id)
                    			->setReference($code)
                    			   ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setCases($cases)
								 ->setIdCat($dom)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setNumero($numero)
								 ->setLogement($logement7)
								 ->setLogroupe($logroupe)
								 ->setMontant($montant7)
								 ->setPieces($pieces)
								 ->setBaille($baille);
								$user->update();
                    			}
                    			elseif($typ==8)
                    			 {//ATTESTATION DE FIN DE PAIEMENT//
                    			 	$user = new DocumentsModel;
                    			$user->setId($id)
                    			->setReference($code)
                    			    ->setNumero($numero)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setCases($cases)
								 ->setIdCat($dom)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setMontant($montant8)
								 ->setEtabli($etabli8);
							$user->update();
                    			}

                    			elseif($typ==9)
                    			 {
                    			 	//SITUATION REGLEMENT ACQUEREUR//
                    			 	$user = new DocumentsModel;
                    			$user->setId($id)
                    			->setReference($code)
                    			 ->setNumero($numero)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setCases($cases)
								 ->setIdCat($dom)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setMontant($montant9)
								 ->setDecision($decision9)
								 ->setEffet($datedecision)
								 ->setArriere($arriere)
								 ->setNbrep($nbrep)
								 ->setExpertise($expertise)
								 ->setSolde($solde);
							$user->update();
                    			}
                    			elseif($typ==10)
                    			 {
                    			 //NOTE INTERNE//
                    			 	$user = new DocumentsModel;
                    			$user->setId($id)
                    			->setReference($code)
                    			 ->setNumero($numero)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setCases($cases)
								 ->setIdCat($dom)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib10)
								 ->setDescription($desc10)
								 ->setEtabli($etabli10);
							$user->update();
                    			}
                    			elseif($typ==11)
                    			 {
                    			 //FICHE DE PRESENCE//
                    			 	$user = new DocumentsModel;
                    			$user->setId($id)
                    			->setReference($code)
                    			->setNumero($numero)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setCases($cases)
								 ->setIdCat($dom)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc11)
								 ->setEtabli($etabli11);
							$user->update();
                    			}
                    			elseif($typ==12)
                    			 {
                    			 //FICHE DE SORTIE DE FOURNITURE//
                    			 	$user = new DocumentsModel;
                    			$user->setId($id)
                    			->setReference($code)
                    			 ->setNumero($numero)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setCases($cases)
								 ->setIdCat($dom)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc12)
								 ->setLibelle($lib12)
								 ->setEtabli($etabli12);
							$user->update();
                    			}
                    			elseif($typ==13)
                    			 {
                    			 //ORDRE DE MISSION//
                    			 	$user = new DocumentsModel;
                    			$user->setId($id)
                    			->setReference($code)
                    			 ->setNumero($numero)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setCases($cases)
								 ->setIdCat($dom)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc13)
								 ->setRetour($retour)
								 ->setEffet($depart13)
								 ->setImputation($imputation)
								 ->setEtabli($etabli13);
							$user->update();
                    			}
                    			elseif($typ==14)
                    			 {
                    			 //PERSONNEL//
                    			 	$user = new DocumentsModel;
                    			$user->setId($id)
                    			->setReference($code)
                    			 ->setNumero($numero)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setCases($cases)
								 ->setIdCat($dom)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib14)
								 ->setDescription($desc14)
								 ->setEtabli($etabli14);
							$user->update();
                    			}
                    			elseif($typ==15)
                    			 {
                    			 //ATTESTATION//
                    			 	$user = new DocumentsModel;
                    			$user->setId($id)
                    			->setReference($code)
                    			  ->setNumero($numero)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setCases($cases)
								 ->setIdCat($dom)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib15)
								 ->setDescription($desc15)
								 ->setEtabli($etabli15);
							$user->update();
                    			}
                    			elseif($typ==16)
                    			 {
                    			 //DECISION//
                    			 	$user = new DocumentsModel;
                    			$user->setId($id)
                    			->setReference($code)
                    			->setNumero($numero)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setCases($cases)
								 ->setIdCat($dom)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib16)
								 ->setDescription($desc16)
								 ->setEtabli($etabli16);
							$user->update();
                    			}
                    			elseif($typ==17)
                    			 {
                    			 //PROCURATION//
                    			 	$user = new DocumentsModel;
                    			$user->setId($id)
                    			->setReference($code)
                    				->setNumero($numero)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setCases($cases)
								 ->setIdCat($dom)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc17)
								 ->setEtabli($etabli17);
							$user->update();
                    			}
                    			elseif($typ==18)
                    			 {
                    			 //RIB//
                    			 	$user = new DocumentsModel;
                    			$user->setId($id)
                    			->setReference($code)
                    			  ->setNumero($numero)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setCases($cases)
								 ->setIdCat($dom)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setCodebanque($codebanque)
								 ->setCodeguichet($codeguichet)
								 ->setDomiciliation($domicile)
								 ->setRib($rib)
								 ->setCompte($compte18);

							$user->update();
                    			}
                    			elseif($typ==19)
                    			 {
                    			 //AVENANTS//
                    			 	$user = new DocumentsModel;
                    			$user->setId($id)
                    			->setReference($code)
                    				->setNumero($numero)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setCases($cases)
								 ->setIdCat($dom)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib19)
								 ->setEffet($effet19)
								 ->setDuree($duree)
								 ->setDescription($desc19)
								 ->setContrat($contrat19)
								 ->setEtabli($etabli19);
							$user->update();
                    			}

                    			elseif($typ==20)
                    			 {
                    			 //CONTRAT DE BAIL//
                    			 	$user = new DocumentsModel;
                    			$user->setId($id)
                    			->setReference($code)
                    			  ->setNumero($numero)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setCases($cases)
								 ->setIdCat($dom)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib20)
								 ->setEffet($effet20)
								 ->setDuree($duree20)
								 ->setDescription($desc20)
								 ->setCompte($compte20)
								 ->setMontant($montant20)
								 ->setReglement($reglement20)
								 ->setDomiciliation($domicile20)
								 ->setContrat($contrat20)
								 ->setVille($ville)
								 ->setEtabli($etabli20);
							$user->update();
                    			}

                    			elseif($typ==21)
                    			 {
                    			 //ACTE INDIViDUALITE//
                    			 	$user = new DocumentsModel;
                    			$user->setId($id)
                    			->setReference($code)
                    			 ->setNumero($numero)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setCases($cases)
								 ->setIdCat($dom)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc21)
								 ->setEtabli($etabli21);
							$user->update();
                    			}elseif($typ==22)
                    			 {
                    			 //FICHE DE SORTIE DE FOURNITURE//
                    			 	$user = new DocumentsModel;
                    			$user->setId($id)
                    			->setReference($code)
                    			 ->setNumero($numero)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setCases($cases)
								 ->setIdCat($dom)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc22)
								 ->setLibelle($lib22)
								 ->setEtabli($etabli22);
							$user->update();
                    			}elseif($typ==23)
                    			 {
                    			 //FICHE DE SORTIE DE FOURNITURE//
                    			 	$user = new DocumentsModel;
                    			$user->setId($id)
                    			->setReference($code)
                    			 ->setNumero($numero)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setCases($cases)
								 ->setIdCat($dom)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription($desc22)
								 ->setLibelle($lib22)
								 ->setEtabli($etabli22);
							$user->update();
                    			}
                    			else{
                    				$user = new DocumentsModel;
                    			$user->setId($id)
                    			->setReference($code)
                    			 ->setNumero($numero)
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setCases($cases)
								 ->setIdCat($dom)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle($lib)
								 ->setEtabli($etabli);
							$user->update();
                    			}*/


                    			if($typ==1 || $typ==3){
                    				//CERTIFICAT DE NON HEBERGEMENT//
                    				////CERTIFICAT DE PREMIERE PRISE DE SERVICE
                    				$user = new DocumentsModel;
							$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								 ->setEtabli(strip_tags($_POST['etabli1']))
								 ->setIdUsager($id_usager)
								 ->setIdUser($id_user);

							$user->update();

                    				}
                    			elseif($typ==2)
                    			 {
                    			 	//ARRETE DE NOMMINATION//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle(strip_tags($_POST['libelle2']))
								 ->setEtabli(strip_tags($_POST['etabli2']));
								 $user->update();
							//$user->Create();
                    			}
                    			elseif($typ==4)
                    			 {//ATTESTATION DE NON LOGEMENT//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setTauxindem(strip_tags($_POST['indemnite']))
								 ->setEtabli(strip_tags($_POST['etabli4']));
								 $user->update();
							//$user->Create();
                    			}
                    				elseif($typ==5 || $typ==6)
                    			 {//BELLETIN DE SOLDE//
                    			 	$user = new DocumentsModel;
                    			$user->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setReference($code)
								 ->setNumero(strip_tags($_POST['numero']))
								 ->setGains(strip_tags($_POST['gains']))
								 ->setRetenues(strip_tags($_POST['retenues']))
								 ->setLibelle(strip_tags($_POST['libelle5']))
								 ->setMontant(strip_tags($_POST['montant5']))
								 ->setCompte(strip_tags($_POST['compte5']))
								 ->setDomiciliation(strip_tags($_POST['domicile5']))
								 ->setReglement(strip_tags($_POST['reglement5']))
								 ->setEtabli(strip_tags($_POST['etabli5']));
								 $user->update();
								//$user->Create();
                    			}

								elseif($typ==7)
                    			 {//DECISION AFFECTATION DE LOGEMENT//
                    			 	$user = new DocumentsModel;
                    			$user->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setReference($code)
								 ->setNumero(strip_tags($_POST['numero']))
								 ->setLogement(strip_tags($_POST['logement7']))
								 ->setLogroupe(strip_tags($_POST['logroupe']))
								 ->setMontant(strip_tags($_POST['montant7']))
								 ->setPieces(strip_tags($_POST['pieces']))
								 ->setBaille(strip_tags($_POST['baille']));
								 $user->update();
								//$user->Create();
                    			}
                    			elseif($typ==8)
                    			 {//ATTESTATION DE FIN DE PAIEMENT//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setMontant(strip_tags($_POST['montant8']))
								 ->setEtabli(strip_tags($_POST['etabli8']));
								 $user->update();
							//$user->Create();
                    			}

                    			elseif($typ==9)
                    			 {
                    			 	//SITUATION REGLEMENT ACQUEREUR//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setMontant(strip_tags($_POST['montant9']))
								 ->setDecision(strip_tags($_POST['decision9']))
								 ->setEffet(strip_tags($_POST['datedecision']))
								 ->setArriere(strip_tags($_POST['arriere']))
								 ->setNbrep(strip_tags($_POST['nbrep']))
								 ->setExpertise(strip_tags($_POST['expertise']))
								 ->setSolde(strip_tags($_POST['solde']));
								 $user->update();
							//$user->Create();
                    			}
                    			elseif($typ==10)
                    			 {
                    			 //NOTE INTERNE//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle(strip_tags($_POST['libelle10']))
								 ->setDescription(strip_tags($_POST['objet10']))
								 ->setEtabli(strip_tags($_POST['etabli10']));
								 $user->update();
						//$user->Create();
                    			}
                    			elseif($typ==11)
                    			 {
                    			 //FICHE DE PRESENCE//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription(strip_tags($_POST['objet11']))
								 ->setEtabli(strip_tags($_POST['etabli11']));
								 $user->update();
							//$user->Create();
                    			}
                    			elseif($typ==12)
                    			 {
                    			 //FICHE DE SORTIE DE FOURNITURE//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription(strip_tags($_POST['objet12']))
								 ->setLibelle(strip_tags($_POST['libelle12']))
								 ->setEtabli(strip_tags($_POST['etabli12']));
								 $user->update();
							//$user->Create();
                    			}
                    			elseif($typ==13)
                    			 {
                    			 //ORDRE DE MISSION//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription(strip_tags($_POST['objet13']))
								 ->setRetour(strip_tags($_POST['retour']))
								 ->setEffet(strip_tags($_POST['effet13']))
								 ->setImputation(strip_tags($_POST['imputation']))
								 ->setEtabli(strip_tags($_POST['etabli13']));
								 $user->update();
							//$user->Create();
                    			}
                    			elseif($typ==14)
                    			 {
                    			 //PERSONNEL//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle(strip_tags($_POST['libelle14']))
								 ->setDescription(strip_tags($_POST['objet14']))
								 ->setEtabli(strip_tags($_POST['etabli14']));
								 $user->update();
							//$user->Create();
                    			}
                    			elseif($typ==15)
                    			 {
                    			 //ATTESTATION//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle(strip_tags($_POST['libelle15']))
								 ->setDescription(strip_tags($_POST['objet15']))
								 ->setEtabli(strip_tags($_POST['etabli15']));
								 $user->update();
							//$user->Create();
                    			}
                    			elseif($typ==16)
                    			 {
                    			 //DECISION//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle(strip_tags($_POST['libelle16']))
								 ->setDescription(strip_tags($_POST['objet16']))
								 ->setEtabli(strip_tags($_POST['etabli16']));
								 $user->update();
							//$user->Create();
                    			}
                    			elseif($typ==17)
                    			 {
                    			 //PROCURATION//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription(strip_tags($_POST['objet17']))
								 ->setEtabli(strip_tags($_POST['etabli17']));
								 $user->update();
							//$user->Create();
                    			}
                    			elseif($typ==18)
                    			 {
                    			 //RIB//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setCodebanque(strip_tags($_POST['codebanque']))
								 ->setCodeguichet(strip_tags($_POST['codeguichet']))
								 ->setDomiciliation(strip_tags($_POST['domicile']))
								 ->setRib(strip_tags($_POST['rib']))
								 ->setCompte(strip_tags($_POST['compte18']));
							$user->update();
							//$user->Create();
                    			}
                    			elseif($typ==19)
                    			 {
                    			 //AVENANTS//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle(strip_tags($_POST['libelle19']))
								 ->setEffet(strip_tags($_POST['effet19']))
								 ->setDuree(strip_tags($_POST['duree']))
								 ->setDescription(strip_tags($_POST['objet19']))
								 ->setContrat(strip_tags($_POST['contrat19']))
								 ->setEtabli(strip_tags($_POST['etabli19']));
								 $user->update();
							//$user->Create();
                    			}

                    			elseif($typ==20)
                    			 {
                    			 //CONTRAT DE BAIL//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle(strip_tags($_POST['effet20']))
								 ->setEffet(strip_tags($_POST['effet20']))
								 ->setDuree(strip_tags($_POST['duree20']))
								 ->setDescription(strip_tags($_POST['objet20']))
								 ->setCompte(strip_tags($_POST['compte20']))
								 ->setMontant(strip_tags($_POST['montant20']))
								 ->setReglement(strip_tags($_POST['reglement20']))
								 ->setDomiciliation(strip_tags($_POST['domicile20']))
								 ->setContrat(strip_tags($_POST['contrat20']))
								 ->setVille(strip_tags($_POST['ville']))
								 ->setEtabli(strip_tags($_POST['etabli20']));
								 $user->update();
							//$user->Create();
                    			}

                    			elseif($typ==21)
                    			 {
                    			 //ACTE INDIViDUALITE//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription(strip_tags($_POST['objet21']))
								 ->setEtabli(strip_tags($_POST['etabli21']));
							$user->update();
                    			}elseif($typ==22)
                    			 {
                    			 //ARRIVEE//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription(strip_tags($_POST['objet22']))
								 ->setLibelle(strip_tags($_POST['libelle22']))
								 ->setEtabli(strip_tags($_POST['etabli22']));
							$user->update();
                    			}elseif($typ==23)
                    			 {
                    			 //DEPART//
                    			 	$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero22']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setDescription(strip_tags($_POST['objet22']))
								 ->setLibelle(strip_tags($_POST['libelle22']))
								 ->setEtabli(strip_tags($_POST['etabli22']));
							$user->update();
                    			}
                    			else{
                    				$user = new DocumentsModel;
                    			$user->setReference($code)
								 ->setNumero(strip_tags($_POST['numero']))
							     ->setIdDos($dos)
								 ->setIdTypes($typ)
								 ->setIdCat($dom)
								 ->setCases($cases)
								  ->setIdUsager($id_usager)
								 ->setIdUser($id_user)
								 ->setLibelle(strip_tags($_POST['libelle']))
								 ->setEtabli(strip_tags($_POST['etabli']));
							$user->update();
                    			}

		 // Fusion des fichiers pdf


$fileArray= glob($_SERVER['DOCUMENT_ROOT'].'/pros/*.pdf');
//var_dump($fileArray);exit();
 $datadir =$_SERVER['DOCUMENT_ROOT'].'/mydoc/';
 //var_dump($fileArray);
 $outputName = $datadir.rand(1,100).".pdf";
  $cmd = "gswin64c -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile=$outputName ";
  //Add each pdf file to the end of the command

  foreach($fileArray as $file) {

    if ($file != "." && $file != "..") {

       $cmd .= $file." ";
    }

}


//var_dump($cmd);

$result = shell_exec($cmd);


	 // FIN fusion pdf

		$last_id = $db->lastInsertId();
		//$uploaded='pdf-uploaded';
		$mon='pdf-compatible/';
        $src = 'mydoc/';
		$dst = "archives/$Nomcat/$Nomtyp/$Nomdos/";
		$ose = $Nomdos;
		$late =$id;
		//var_dump($ose);exit;


		$name_img =str_replace("/","",$_POST['dosier']);
		//var_dump();exit;


//copy($src, $dst);  //Call function
//Function to Copy folders and files
			function rcopy($src, $dst,$late,$name) {

				//global $ose; $result= $osse;
				//global $last_id;

 			   if (file_exists ( $dst ))
        	//rrmdir( $dst );
    		if (is_dir( $src )) {
        //mkdir ( $dst );
       		 $files =scandir( $src );
       		 $i=0;
       		 $chaf=rand(1,999);
       		 //$oss=$Nomdos;
       			 foreach ( $files as $key=>$file ){
           				 if ($file != "." && $file != ".."){
                           	$explode =explode('.', $file);
                           	$extension = end($explode);
                           	$new = $chaf.'_'.$name[$i].'.'.$extension;
               				 copy ("$src/$file","$dst/$new");
               				 //copy ( "$src/$file", "$dst/$chaf.'-'.$name[$i].'.'.$extension");
               				 //copy("$file", "$uploaded");
               				// var_dump($name[$i]);exit ;
               				//$new = $name[$i].'.'.$extension;

               				 $i++;
               				 $sendScann = new FichiersModel;
							$ext="pdf";
                        $sendScann->requete('INSERT INTO fichiers (fichier, type, id_doc) VALUES (?,?,?)',[$new,$ext,$late]);
                        	$chaf++;
                             	}
           		 //var_dump($src/$file);
							}
   						 } elseif (file_exists ( $src ))
        				copy( $src, $dst );
                    rrmdir( $src );
					}

				//Function to remove folders and files
				function rrmdir($dir) {
   						 if (is_dir($dir)) {
        					$files = scandir($dir);
        					foreach ($files as $file){
            				if ($file != "." && $file != "..") rrmdir("$dir/$file");
            			}
        					//rmdir($dir);
   								 }
   							 elseif (file_exists($dir)) unlink($dir);
							}

							rcopy($src,$dst,$late,$name_img);

							rrmdir($src);

							//supprimer le contenu de scann //
							$scann="scann/";
								rrmdir($scann);
							/*	$ouverture=opendir($scann);
								$fichier=readdir($ouverture);
								$fichier=readdir($ouverture);
								while ($fichier=readdir($ouverture)) {
								unlink("$scann/$fichier");
									}
									closedir($ouverture);*/
							// Fin suppression scann//

							//supprimer le contenu de pros //
							$pros="pros/";
								rrmdir($pros);
							/*	$ouverture=opendir($pros);
								$fichier=readdir($ouverture);
								$fichier=readdir($ouverture);
								while ($fichier=readdir($ouverture)) {
								unlink("$pros/$fichier");
									}
									closedir($ouverture);*/
							// Fin suppression pros//

//copy($src, $dst);  //Call function
//Function to Copy folders and files
		/*	function rcopy($src, $dst,$late) {
				//global $last_id;
 			   if (file_exists($dst))
        	//rrmdir( $dst );
    		if (is_dir( $src )) {
        //mkdir ( $dst );
       		 $files =scandir( $src );
       			 foreach ( $files as $file ){
           				 if ($file != "." && $file != ".."){
               				 copy ( "$src/$file", "$dst/$file" );
               				// copy("$file", "$uploaded");
               				 $sendScann = new FichiersModel;

                        $sendScann->requete('INSERT INTO fichiers (fichier, type, id_doc) VALUES (?,?,?)',[$file,'jpg',$late]);
                             	}
           		 //var_dump($src/$file);
							}
   						 } elseif (file_exists ( $src ))
        				copy( $src, $dst );
                    rrmdir( $src );
					}

				//Function to remove folders and files
				function rrmdir($dir) {
   						 if (is_dir($dir)) {
        					$files = scandir($dir);
        					foreach ($files as $file){
            				if ($file != "." && $file != "..") rrmdir("$dir/$file");
            			}
        					//rmdir($dir);
   								 }
   							 elseif (file_exists($dir)) unlink($dir);
							}

							rcopy($src,$dst,$late);

							rrmdir($src);*/

// FIn d'insertion de fichier scannes

		/*					 $phpFileUploadErrors = array(
           0 => "Vos informations ont &eacute;t&eacute; prise en compte. Merci",
           1 => "Le taille du fichiers est trop volumineux",
           2 => "Le fichier exc&eacute;de la taille demand&eacute;",
           3 => "Le fichier a &eacute;t&eacute; partiellement upload&eacute;",
           4 => " Pas de fichiers charg&eacute;",#App::Redirect("show_prestation.php"),
           5 => "Un dossier temporaire manquant",
           6 => "Echec d'ecriture sur le disk",
           7 => "Une extensions PHP a stopp&eacute; le fichier charg&eacute;",
       );
        function reArrayFiles($file_post){
            $file_ary = array();
            $file_count = count($file_post['name']);
            $file_key = array_keys($file_post);

            for($i=0; $i<$file_count; $i++){
                foreach ($file_key as $key):
                    $file_ary[$i][$key] = $file_post[$key][$i];
                endforeach;
            }
            return $file_ary;
        }
      //  $tmp = $_FILES['fichier']['tmp_name'];
        if(isset($_FILES['fichier']))
         {

    //$repertoire =strtoupper(strip_tags($_POST['reference']));
							if(!is_dir("archives")){
								$rep = mkdir("archives",0777);
								//echo"ok";
							}
							if(!is_dir("archives/$Nomdom")){
								$rep = mkdir("archives/$Nomdom",0777);
							//	fopen($rep, "rw");
							//echo"ok1";
							//
							}
							if(!is_dir("archives/$Nomdom/$Nomtyp")){
								$rep = mkdir("archives/$Nomdom/$Nomtyp",0777);
								//echo"ok2";
							//	fopen($rep, "rw");
							//
							}
							if(!is_dir("archives/$Nomdom/$Nomtyp/$Nomdos")){
								$rep = mkdir("archives/$Nomdom/$Nomtyp/$Nomdos",0777);
								//echo"ok3";
							//	fopen($rep, "rw");
							//
							}

							//var_dump($chemin);

          // $alpha = "azertyuiopmlkjhgfdsqwxcvbn0123654789";
            #$rep = $up.mkdir(uniqid($alpha,6)).'/';
            #$mon_rep = uniqid(substr(str_shuffle(str_repeat($alpha,5)),0,8));
            #$rep = mkdir($up.$mon_rep);
            #fopen($rep, "r+");
            #var_dump($rep);
            $file_array = reArrayFiles($_FILES['fichier']);
           // pre_r($file_array);
            for ($i=0;$i<count($file_array); $i++){
                if($file_array[$i]['error']){

             Form::setFlash('danger',$file_array[$i]['name'].''.$phpFileUploadErrors[$file_array[$i]['error']]);

                }else{
                    $extensions = array('jpg','png','gif','jpeg','html','php','doc','docx','csv','pdf','xlsx','xls','xlsm','rar','zip','3gp','mp4','mpeg','flv','mp3','amr','accdb','avi');
                    $file_ext = explode('.',$file_array[$i]['name']);
                    $file_ext = strtolower(end($file_ext));


                    if(!in_array($file_ext,$extensions)){

                         Form::setFlash('danger',$file_array[$i]['name']." - Extention Invalid");


                    }else{
                    		$dates= date('Y-m-d H:i:s');
                    	//var_dump(dirname(getcwd()));
                        #move_uploaded_file($file_array[$i]['tmp_name'], "uploads/".$file_array[$i]['name']);
                        #$last = $db->lastInsertId();
                        $sendFiles = new FichiersModel;
                        	$monfile = str_replace(' ','_',$file_array[$i]['name']);
                        $sendFiles->requete('INSERT INTO fichiers SET fichier=? , type=?, update_at=?, id_doc=?',[$chaf.'_'.$monfile,$file_ext,$dates,$id]);





                             //  $sendFiles->setFichier($file_array[$i]['name'])
                              // 			 ->setType($file_ext)
                               //			 ->setIdDoc($last_id);
                              // $sendFiles->CreateFile();
                              // $sql = "INSERT INTO fichiers (fichier, type, id_doc) VALUES (?,?,?)";
                               //$insert = Db::getInstance()->prepare($sql);
                              //$insert->execute([$file_array[$i]['name'],$file_ext,$last_id]);
                        	move_uploaded_file($file_array[$i]['tmp_name'],"archives/$Nomcat/$Nomtyp/$Nomdos/".$chaf.'_'.$monfile);
                        	//file_put_contents('pdf-compatible/'.$chaf.'_'.$monfile);
                        //var_dump("$repertoire/".$file_array[$i]['name']);
                        Form::setFlash('success',$phpFileUploadErrors[$file_array[$i]['error']]);
							}
                }
            }
        }*/


								Form::setFlash('success','La Pièce '.$code.' a été modifiée avec succès');
								header("Location: /documents/mes_documents");
								exit;


					}	else{
			Form::setFlash('info','Veuillez à bien remplir le formulaire');
		}


		//modal usager

		if (Form::Validate($_POST,['usagers','typos','domaines'])) {
            //le formulaire est valide
            $usagers = strtoupper(strip_tags($_POST['usagers']));
            $types = strtoupper(strip_tags($_POST['typos']));
            $contact = strtoupper(strip_tags($_POST['contact']));
            $email = strtoupper(strip_tags($_POST['email']));
            $adresse = strip_tags($_POST['adresse']);
            $matricule = strip_tags($_POST['matricule']);
            $fonction = strip_tags($_POST['fonction']);
            $grade = strip_tags($_POST['grade']);
            $etab = strip_tags($_POST['etable']);
            $iddom= $_POST['domaines'];
            $dateserv = strip_tags($_POST['dateserv']);




                        $db = db::getInstance();
                        // code...

                    //on insert le service

                        if($types == 1)
                        {
                            $req= "select * FROM usagers WHERE usager=?";

                        $exe = $db->prepare($req);
                        $exe->execute([$usagers]);
                        $verif = $exe->fetch();
                            if(!$verif){
                            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                          //on hydrate l'usager entreprise
                            $usage = new UsagersModel;
                            $usage->setUsager($usagers)
                                    ->setTypeUsager($types)
                                    ->setContact($contact)
                                    ->setEmail($email)
                                    ->setAdresse($adresse)
                                    ->setIdCat($iddom);
                            $usage->Create();
                            }else{
                             Form::setFlash('danger',"Entrer un format d'email valide" );
                            }}else{
                         Form::setFlash('danger',"Cet usager exite déjà" );
                        }
                        }else{
                            // on hydrate l'usage particulier
                            //on hydrate le service
                        $req= "select * FROM usagers WHERE usager=? AND matricule=?";

                        $exe = $db->prepare($req);
                        $exe->execute([$usagers,$matricule]);
                        $verif = $exe->fetch();
                            if(!$verif){
                            $usage = new UsagersModel;
                            $usage->setUsager($usagers)
                                    ->setTypeUsager($types)
                                    ->setContact($contact)
                                    ->setMatricule($matricule)
                                    ->setFonction($fonction)
                                    ->setEtablissement($etab)
                                    ->setGrade($grade)
                                    ->setIdCat($iddom)
                                    ->setDateService($dateserv);
                            $usage->Create();
                        }else{
                         Form::setFlash('danger',"Cet usager exite déjà" );
                        }
                        }

                            Form::setFlash('success',"Un usager vient d'etre créer" );
                           // header("Location:/usagers/liste_usagers");
                            //exit;
                        }


	$categorie = new DomainesModel;
	$dossier = new DossiersModel;
	$nature = new NaturesModel;
	$type = new TypesModel;
    $dossiers = $dossier->findAll();
    $categories = $categorie->findAll();
    $natures = $nature->findAll();
    $types = $type->findAll();

	$this->Render('/documents/modifier_documents',compact('dossiers','categories','docs','natures','types','fileModel'),'admin');

}

public function supp_fichiers(int $id)
{
				$dates= date('Y-m-d H:i:s');

	$fileModel = new FichiersModel;
	$suppFile = $fileModel->requete("UPDATE fichiers SET actif=?, update_at=? WHERE id=?",[0,$dates,$id]);
	if($suppFile){
		Form::setFlash('success','Un fichier a été supprimé avec succèss');
								header("Location: ".$_SERVER['HTTP_REFERER']);
								exit;

	}else{
				Form::setFlash('danger','Le fichier n\'a été supprimé ');

	}

	$this->Render("/documents/supp_fichiers",[],'admin');
}

public function recherche()
{
	$typesModel = new TypesModel;
	$types = $typesModel->requete("SELECT * FROM categories,types WHERE categories.id=types.id_cat ORDER BY type asc");

	$servModel = new DossiersModel;
	$dossiers = $servModel->findAll();

	$natModel = new DomainesModel;
	$natures = $natModel->findAll();
$this->Render("/documents/recherche",compact('types','dossiers','natures'),'admin');
}

public function signatures(int $id)
{
	$id_file = $id;

	$this->Render('documents/signature',compact('id_file'),'admin');
}



}



 ?>