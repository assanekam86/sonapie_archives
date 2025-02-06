<?php 
namespace App\Controllers;

use App\Core\Form;
use App\Models\BoitesModel;
use App\Models\DocumentsModel;
use App\Models\DossiersModel;
use App\Models\VillesModel;
use App\Models\DomainesModel;
use App\Models\Model;
use App\Core\Db;

class DossiersController extends Controller
{

	 /**
         * Cette methode affichera une page listant toutes les services de la base
         * @return void 
         */
    public function liste_dossiers()
    {
        $dossiersModel = new DossiersModel;
        // On va chercher toutes les annonces
        $dossiers = $dossiersModel->requete("SELECT * FROM villes,salles,rayons,etageres,users,categories,boites,dossiers WHERE villes.id=salles.id_ville AND salles.id=rayons.id_salle AND rayons.id=etageres.id_rayon AND etageres.id=boites.id_etagere AND dossiers.id_cat = categories.id AND users.id=dossiers.id_user AND dossiers.id_boite = boites.id")->fetchAll();
        //var_dump($annonces);
        //on hgenere la vue 
        $this->Render('dossiers/liste_dossiers', compact('dossiers'),'admin');
        
     //   echo"Ici sera la liste des annonces";
   // include_once ROOT.'/Views/annonces/index.php';
    }

      public function dossiers_domaine(int $id)
    {
        $dossiersModel = new DossiersModel;
        // On va chercher toutes les annonces
        $dossiers = $dossiersModel->requete("SELECT * FROM villes,salles,rayons,etageres,users,categories,boites,dossiers WHERE villes.id=salles.id_ville AND salles.id=rayons.id_salle AND rayons.id=etageres.id_rayon AND etageres.id=boites.id_etagere AND dossiers.id_cat = categories.id AND users.id=dossiers.id_user AND dossiers.id_boite = boites.id AND categories.id=?",[$id])->fetchAll();

          $dos = $dossiersModel->requete("SELECT * FROM villes,salles,rayons,etageres,users,boites,categories WHERE villes.id=salles.id_ville AND salles.id=rayons.id_salle AND rayons.id=etageres.id_rayon AND etageres.id=boites.id_etagere AND categories.id=?",[$id])->fetch();
        //var_dump($annonces);
        //on hgenere la vue 
        $this->Render('dossiers/liste_dossier', compact('dossiers','dos'),'admin');
        
     //   echo"Ici sera la liste des annonces";
   // include_once ROOT.'/Views/annonces/index.php';
    }
    //lister les dossiers
    
     public function liste_dossier(int $id)
    {
        $dossiersModel = new DossiersModel;
        // On va chercher toutes les annonces
        $dossiers = $dossiersModel->requete(
            "SELECT villes.ville,villes.id as idvil,salles.salle,salles.id as idsal,rayons.rayon,rayons.id as idray,etageres.id as idet,etageres.etagere,categories.id as idcat,categories.designation,boites.id as idboit,boites.boite,dossiers.dossier,dossiers.id,dossiers.desc_dossier,dossiers.id_boite,boites.id as idboite,categories.id as idcat,etageres.id as idetag,rayons.id as idray,salles.id as idsal,villes.id as idvil,dossiers.date_creation_dossier,dossiers.update_at,dossiers.id,users.nom,users.prenom 
            FROM villes,salles,rayons,etageres,categories,boites,users,dossiers 
            WHERE villes.id=salles.id_ville AND salles.id=rayons.id_salle AND rayons.id=etageres.id_rayon AND etageres.id=boites.id_etagere AND dossiers.id_cat = categories.id AND dossiers.id_boite = boites.id AND users.id=dossiers.id_user AND dossiers.id_boite=?
            ",[$id]
        )->fetchAll();
              $boite = $dossiersModel->requete("SELECT * FROM villes,salles,rayons,etageres,users,categories,boites
                                WHERE 
                                    villes.id=salles.id_ville AND 
                                    salles.id=rayons.id_salle AND 
                                    rayons.id=etageres.id_rayon AND
                                    etageres.id=boites.id_etagere AND
                                    categories.id=boites.id_cat AND
                                    boites.id=?",[$id])->fetch();
        //var_dump($annonces);
        //on hgenere la vue 
        $this->Render('dossiers/listes_dossier', compact('dossiers','boite'),'admin');
        
     //   echo"Ici sera la liste des annonces";
   // include_once ROOT.'/Views/annonces/index.php';
    }

   

    public function ajouter(){

//INSERTION DUN SERVICE
        
if (Form::Validate($_POST,['dossier','description','domaine','boite'])) {
            //le formulaire est valide
            $dossier = strtoupper(strip_tags($_POST['dossier']));
            $description = strtoupper(strip_tags($_POST['description']));
            $domaine = $_POST['domaine'];
            $boite = $_POST['boite'];
            $user=$_SESSION['user']['id'];
              $db = db::getInstance();
                        // code...
                $req= "select * FROM dossiers WHERE dossier=? AND id_boite=?";

                $exe = $db->prepare($req);
                $exe->execute([$dossier,$boite]);
                $verif = $exe->fetch();
              
                    //on insert le service   
                    if(!$verif){
                          //on hydrate le service
                            $dossiers = new DossiersModel;
                            $dossiers->setDossier($dossier)
                                    ->setIdUser($user)
                                  ->setDescDossier($description)
                                  ->setIdCat($domaine)
                                  ->setIdBoite($boite);
                            $dossiers->Create();

                            Form::setFlash('success',"Un dossier vient d'etre créer" );
                            header("Location: /dossiers/liste_dossiers");
                            exit;
                        } 
                        else{
                         Form::setFlash('danger',"Ce dossier exite déjà dans cette boite d'archive" );   
                        }
                        }           

        else{
            Form::setFlash('info','Veuillez à bien remplir le formulaire');
        }
                    $villesModel = new VillesModel;
                     $villes = $villesModel->requete("SELECT * FROM villes ORDER BY ville asc")->fetchAll();



       /* $boit = new Form;
        $boit->debutForm()
            ->ajoutLabel('dossier','Libellé Dossier')
            ->ajoutInput('text','dossier',['class'=>'form-control','placeholder'=>'Entrer Nom du dossier ici'])
            ->ajoutLabel('desc','Description Dossier')
            ->ajoutTextarea('description','',['class'=>'form-control','placeholder'=>'Entrer la description ici'])
             ->ajoutLabel('domaine','Domaine de Gestion')
            ->ajoutSelectDomaine('domaine',['class'=> 'form-control single','id'=>'domaine'])
            ->ajoutLabel('boite','Boite d\'Archive')
            ->ajoutSelectBoite('boite',['class'=> 'form-control single','id'=>'boite'])
            ->ajoutBouton('Creer le dossier',['class'=>'btn btn-primary','name'=>'boit'])
            ->finForm();*/

            $this->Render('/dossiers/ajouter',compact('villes'),'admin');

    }

  public function ajouter_dossier(int $id){

//INSERTION DUN SERVICE
$boitesModel = new BoitesModel;
        // On va chercher toutes les annonces
        $categories = $boitesModel->requete("SELECT * FROM boites,categories WHERE categories.id=boites.id_cat AND categories.id=?",[$id])->fetch();
 $dossiersModel = new DossiersModel;
        // On va chercher toutes les annonces
        $boites = $dossiersModel->requete("SELECT villes.ville,rayons.rayon,salles.salle,etageres.etagere,categories.designation,categories.id,boites.boite FROM villes,salles,rayons,etageres,users,categories,boites WHERE villes.id=salles.id_ville AND salles.id=rayons.id_salle AND rayons.id=etageres.id_rayon AND etageres.id=boites.id_etagere AND categories.id=?",[$id])->fetchAll();       
        
if (Form::Validate($_POST,['dossier','description','domaine','boite'])) {
            //le formulaire est valide
            $dossier = strtoupper(strip_tags($_POST['dossier']));
            $description = strtoupper(strip_tags($_POST['description']));
            $domaine = $_POST['domaine'];
            $boite = $_POST['boite'];
            $user=$_SESSION['user']['id'];
              $db = db::getInstance();
                        // code...
                $req= "select * FROM dossiers WHERE dossier=? AND id_boite=?";

                $exe = $db->prepare($req);
                $exe->execute([$dossier,$boite]);
                $verif = $exe->fetch();
              
                    //on insert le service   
                    if(!$verif){
                          //on hydrate le service
                            $dossiers = new DossiersModel;
                            $dossiers->setDossier($dossier)
                                    ->setIdUser($user)
                                  ->setDescDossier($description)
                                  ->setIdCat($domaine)
                                  ->setIdBoite($boite);
                            $dossiers->Create();

                            Form::setFlash('success',"Un dossier vient d'etre créer" );
                            header("Location: /dossiers/liste_dossiers");
                            exit;
                        } 
                        else{
                         Form::setFlash('danger',"Ce dossier exite déjà dans cette boite d'archive" );   
                        }
                        }           

        else{
            Form::setFlash('info','Veuillez à bien remplir le formulaire');
        }


       /* $boit = new Form;
        $boit->debutForm()
            ->ajoutLabel('dossier','Libellé Dossier')
            ->ajoutInput('text','dossier',['class'=>'form-control','placeholder'=>'Entrer Nom du dossier ici'])
            ->ajoutLabel('desc','Description Dossier')
            ->ajoutTextarea('description','',['class'=>'form-control','placeholder'=>'Entrer la description ici'])
             ->ajoutLabel('domaine','Domaine de Gestion')
            ->ajoutSelectDomaine('domaine',['class'=> 'form-control single','id'=>'domaine'])
            ->ajoutLabel('boite','Boite d\'Archive')
            ->ajoutSelectBoite('boite',['class'=> 'form-control single','id'=>'boite'])
            ->ajoutBouton('Creer le dossier',['class'=>'btn btn-primary','name'=>'boit'])
            ->finForm();*/

                    $villesModel = new VillesModel;
                     $villes = $villesModel->requete("SELECT * FROM villes ORDER BY ville asc")->fetchAll();
            $this->Render('/dossiers/ajouter_dossier',compact('categories','boites','villes'),'admin');

    }

    public function ajouter_dos(int $id){

//INSERTION DUN SERVICE
$boitesModel = new BoitesModel;
        // On va chercher toutes les annonces
      //  $boites = $boitesModel->requete("SELECT * FROM boites,categories WHERE categories.id=boites.id_cat AND boites.id=?",[$id])->fetch();
 $dossiersModel = new DossiersModel;
        // On va chercher toutes les annonces
/*        $boites = $dossiersModel->requete("SELECT villes.ville,rayons.rayon,salles.salle,etageres.etagere,categories.designation,categories.id as idcat,boites.boite, boites.id FROM villes,salles,rayons,etageres,users,categories,boites WHERE villes.id=salles.id_ville AND salles.id=rayons.id_salle AND rayons.id=etageres.id_rayon AND etageres.id=boites.id_etagere AND boites.id=?",[$id])->fetch();       */
        $boites = $dossiersModel->requete("SELECT villes.ville,rayons.rayon,salles.salle,etageres.etagere,categories.designation,categories.id as idcat,boites.boite, boites.id FROM villes,salles,rayons,etageres,users,categories,boites WHERE villes.id=salles.id_ville AND salles.id=rayons.id_salle AND rayons.id=etageres.id_rayon AND boites.id_cat=categories.id AND etageres.id=boites.id_etagere AND boites.id=? GROUP BY boites.id",[$id])->fetch();

if (Form::Validate($_POST,['dossier','description','domaine','boite'])) {
            //le formulaire est valide
           // $dossier = strtoupper(strip_tags($_POST['dossier']));
            $dossier = strtoupper(strip_tags($_POST['dossier']));
            /*if (!preg_match('/^[a-zA-Z0-9\s-_]+$/', $dossier)) {
                Form::setFlash('danger', "Le libellé du dossier contient des caractères non autorisés. Utilisez uniquement lettres, chiffres, espaces, tirets ou underscores.");
                header("Location: /dossiers/liste_dossier/$id");
                exit;
            }*/
            $description = strtoupper(strip_tags($_POST['description']));
            $domaine = $_POST['domaine'];
            $boite = $_POST['boite'];
            $user=$_SESSION['user']['id'];
              $db = db::getInstance();
                        // code...
                $req= "select * FROM dossiers WHERE dossier=? AND id_boite=?";

                $exe = $db->prepare($req);
                $exe->execute([$dossier,$boite]);
                $verif = $exe->fetch();
              
                    //on insert le service   
                    if(!$verif){
                          //on hydrate le service
                            $dossiers = new DossiersModel;
                            $dossiers->setDossier($dossier)
                                    ->setIdUser($user)
                                  ->setDescDossier($description)
                                  ->setIdCat($domaine)
                                  ->setIdBoite($boite);
                            $dossiers->Create();

                            Form::setFlash('success',"Un dossier vient d'etre créer" );
                          //  header("Location: /dossiers/liste_dossiers");
                          header("Location: /dossiers/liste_dossier/$id");
                            exit;
                        } 
                        else{
                         Form::setFlash('danger',"Ce dossier exite déjà dans cette boite d'archive" );   
                        }
                        }           

        else{
            Form::setFlash('info','Veuillez à bien remplir le formulaire');
        }


       /* $boit = new Form;
        $boit->debutForm()
            ->ajoutLabel('dossier','Libellé Dossier')
            ->ajoutInput('text','dossier',['class'=>'form-control','placeholder'=>'Entrer Nom du dossier ici'])
            ->ajoutLabel('desc','Description Dossier')
            ->ajoutTextarea('description','',['class'=>'form-control','placeholder'=>'Entrer la description ici'])
             ->ajoutLabel('domaine','Domaine de Gestion')
            ->ajoutSelectDomaine('domaine',['class'=> 'form-control single','id'=>'domaine'])
            ->ajoutLabel('boite','Boite d\'Archive')
            ->ajoutSelectBoite('boite',['class'=> 'form-control single','id'=>'boite'])
            ->ajoutBouton('Creer le dossier',['class'=>'btn btn-primary','name'=>'boit'])
            ->finForm();*/

            $this->Render('/dossiers/ajouter_dossiers',compact('boites'),'admin');

    }

      public function modifier(int $id)
    {
         if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])){
       // l'utilisateur est connecté
       // //on va verifier si l'annonce exite dans la base
       $dossiersModel = new DossiersModel;

       //on cherche l'annonce avec $id
       $dossier = $dossiersModel->find($id);//si l'annonce n'existe pas, on retourne ala liste des annonces
       if(!$dossier){
        http_response_code(404);
        Form::setFlash('danger',"Le dossier recherchée n'existe pas");
        header("Location: /dossiers/liste_dossier");
        exit;
       }
             // Vérification si la boîte contient des dossiers
             $documentModel = new DocumentsModel();
             $documents = $documentModel->findBy(['id_dos' => $id]);
             $hasDocument = !empty($documents);
       //on Verifie si l'utilisateur est propriétaire de l'annonce et admin
       
       # if($service->user_id !== $_SESSION['user']['id']){
           if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_USER'){
                 //On le renvoi a la page d'accueil
            Form::setFlash('danger',"Vous n'avez pas accès à cette page");
            header("Location: /dossiers/liste_dossiers");
            exit;
            }
          
      #  }
        // on traite le formulaire
         if (Form::Validate($_POST,['dossier','description','domaine','boite'])) {
             // on se protege contre les faille xss
             //$dos = strtoupper(strip_tags($_POST['dossier']));
             $dos = strtoupper(strip_tags($_POST['dossier']));
         /*    if (!preg_match('/^[a-zA-Z0-9\s-_]+$/', $dos)) {
                 Form::setFlash('danger', "Le libellé du dossier contient des caractères non autorisés. Utilisez uniquement lettres, chiffres, espaces, tirets ou underscores.");
                 header("Location: /dossiers/liste_dossiers");
                 exit;
             }*/
             $description = strtoupper(strip_tags($_POST['description']));
             $domaine = $_POST['domaine'];
             $boite = $_POST['boite'];
             $dates = date('Y-m-d H:i:s');

             
             //on stocke l'annonce
             $dossierModif = new DossiersModel;
             $dossier = $dossierModif->find($id);
             //on hydrate le model
              $dossierModif->setId($dossier->id)
                        ->setDossier($dos)
                        ->setDescDossier($description)
                        ->setIdCat($domaine)
                        ->setIdBoite($boite)
                        ->setUpdateAt($dates);


              //on met a jour l'annonce
              $dossierModif->Update();
              //On redirige vers les annonces
              Form::setFlash('success',"La dossier d'archive a été modifié avec succès");
           header("Location: /dossiers/liste_dossiers");
           // header("Location: /dossiers/liste_dossier/$id");
            exit;
         }

         $domaineModel = new DomainesModel;
         $boiteModel = new BoitesModel;

         $domaines = $domaineModel->findAll();
         $boites = $boiteModel->findAll();

/*

       $form = new Form;

            $form->debutForm();
            $form->ajoutLabel('type','Nom du Type ')
            ->ajoutInput('text','type',[
                'id'=>'type',
                'value' => $type->type,
                'class'=> 'form-control'
            ])
            ->ajoutbouton('Modifier',['class'=> 'btn btn-primary'])
            ->finForm();
*/
            //on envoie a la vue
            
            $this->Render('/dossiers/modifier',compact('domaines','dossier','boites','hasDocument'),'admin');
       }else{
            //l'utilisateur n'est pas connecté
            Form::setFlash('danger','Vous devez etre connecté pour accéder à cette page!');
            header("Location: /users/login");
            exit;
        }
    }

public function supprimeDossier($id){


        if ($this->isAdmin()) {
            // on est Admin
            $dossier = new DossiersModel;
            $dossier->Delete($id);
          Form::setFlash('danger','Un dossier a été supprimé!');

            header("Location: ".$_SERVER['HTTP_REFERER']);
        }
    
}

    
}





 ?>