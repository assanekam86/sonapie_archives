<?php 
namespace App\Controllers;

use App\Core\Form;
use App\Models\BoitesModel;
use App\Models\EtageresModel;
use App\Models\DomainesModel;
use App\Models\DossiersModel;
use App\Models\VillesModel;
use App\Models\RayonsModel;
use App\Models\SallesModel;
use App\Models\Model;
use App\Core\Db;

class BoitesController extends Controller
{

	 /**
         * Cette methode affichera une page listant toutes les services de la base
         * @return void 
         */
    public function liste_boites()
    {
        $boitesModel = new BoitesModel;
        // On va chercher toutes les annonces
        $boites = $boitesModel->requete("SELECT * FROM rayons,salles,villes,categories,etageres,boites WHERE villes.id=salles.id_ville AND rayons.id_salle=salles.id AND rayons.id =etageres.id_rayon AND boites.id_etagere = etageres.id AND categories.id=boites.id_cat")->fetchAll();
        //var_dump($annonces);
        //on hgenere la vue 
        $this->Render('boites/liste_boites', compact('boites'),'admin');
        
     //   echo"Ici sera la liste des annonces";
   // include_once ROOT.'/Views/annonces/index.php';
    }
     public function liste_boite(int $id)
    {
        $boitesModel = new BoitesModel;
        // On va chercher toutes les annonces
        $boites = $boitesModel->requete("SELECT * FROM rayons,salles,villes,categories,etageres,boites WHERE villes.id=salles.id_ville AND rayons.id_salle=salles.id AND rayons.id =etageres.id_rayon AND boites.id_etagere = etageres.id AND categories.id=boites.id_cat AND boites.id_etagere=?",[$id])->fetchAll();
        $etagere = $boitesModel->requete("SELECT * FROM rayons,salles,villes,categories,etageres WHERE villes.id=salles.id_ville AND rayons.id_salle=salles.id AND rayons.id =etageres.id_rayon /*AND categories.id=boites.id_cat */AND etageres.id=?",[$id])->fetch();
        //var_dump($annonces);
        //on hgenere la vue 
        $this->Render('boites/boites', compact('boites','etagere'),'admin');
        
     //   echo"Ici sera la liste des annonces";
   // include_once ROOT.'/Views/annonces/index.php';
    }

     public function boites_domaine(int $id)
    {
        $boitesModel = new BoitesModel;
        // On va chercher toutes les annonces
        $boites = $boitesModel->requete("SELECT * FROM rayons,salles,villes,categories,etageres,boites WHERE villes.id=salles.id_ville AND rayons.id_salle=salles.id AND rayons.id =etageres.id_rayon AND boites.id_etagere = etageres.id AND categories.id=boites.id_cat AND boites.id_cat=?",[$id])->fetchAll();
        $domaine = $boitesModel->requete("SELECT categories.id,categories.designation FROM rayons,salles,villes,etageres,categories WHERE villes.id=salles.id_ville AND rayons.id_salle=salles.id AND rayons.id =etageres.id_rayon AND categories.id=boites.id_cat AND categories.id=?",[$id])->fetch();
        //var_dump($annonces);
        //on hgenere la vue 
        $this->Render('boites/liste_boite', compact('boites','domaine'),'admin');
        
     //   echo"Ici sera la liste des annonces";
   // include_once ROOT.'/Views/annonces/index.php';
    }

    

   

    public function ajouter(){

//INSERTION DUN SERVICE
        
if (Form::Validate($_POST,['boite','description','etagere','categorie'])) {
            //le formulaire est valide
            $boite = strtoupper(strip_tags($_POST['boite']));
            $description = strtoupper(strip_tags($_POST['description']));
            $etagere = $_POST['etagere'];
            $categorie = $_POST['categorie'];
              $db = db::getInstance();
                        // code...
                $req= "select * FROM boites WHERE boite=? AND id_etagere=?";

                $exe = $db->prepare($req);
                $exe->execute([$boite,$etagere]);
                $verif = $exe->fetch();
              
                    //on insert le service   
                    if(!$verif){
                          //on hydrate le service
                            $boites = new BoitesModel;
                            $boites->setBoite($boite)
                                  ->setDescBoite($description)
                                  ->setIdEtagere($etagere)
                                  ->setIdCat($categorie);
                            $boites->Create();

                            Form::setFlash('success',"Un boite vient d'etre créer" );
                            header("Location: /boites/liste_boites");
                            exit;
                        } 
                        else{
                         Form::setFlash('danger',"Ce boite exite déjà dans cet etagère" );   
                        }
                        }           

        else{
            Form::setFlash('info','Veuillez à bien remplir le formulaire');
        }
        $catModel = new DomainesModel;
         $domaines = $catModel->findAll();
         $etagereModel = new EtageresModel;

         $etageres = $etagereModel->requete("SELECT * FROM villes,salles,rayons,etageres WHERE villes.id=salles.id_ville AND salles.id = rayons.id_salle AND rayons.id=etageres.id_rayon ORDER BY etagere asc")->fetchAll();
         $villes = $etagereModel->requete("SELECT * FROM villes ORDER BY ville asc")->fetchAll();
/*
        $boit = new Form;
        $boit->debutForm()
            ->ajoutLabel('boite','Libellé Boite Archive')
            ->ajoutInput('text','boite',['class'=>'form-control','placeholder'=>'Entrer la Boite Archive a ajouter ici'])
            ->ajoutLabel('desc','Description Boite')
            ->ajoutTextarea('description','',['class'=>'form-control','placeholder'=>'Entrer la description ici'])
             ->ajoutLabel('categorie','Domaine de Gestion')
            ->ajoutSelectDomaine('categorie',['class'=> 'form-control single','id'=>'categorie'])
             ->ajoutLabel('etagere','Etagère')
            ->ajoutSelectEtag('etagere',['class'=> 'form-control single','id'=>'etagere'])
            ->ajoutBouton('Creer la boite',['class'=>'btn btn-primary','name'=>'boit'])
            ->finForm();
            */

            $this->Render('/boites/ajouter',compact('domaines','etageres','villes'),'admin');

    }


    public function ajouter_boite(int $id){

//INSERTION DUN SERVICE
$boitesModel = new BoitesModel;
        // On va chercher toutes les annonces
        $boites = $boitesModel->requete("SELECT * FROM categories WHERE categories.id=?",[$id])->fetch();
        
if (Form::Validate($_POST,['boite','description','etagere','categorie'])) {
            //le formulaire est valide
            $boite = strtoupper(strip_tags($_POST['boite']));
            $description = strtoupper(strip_tags($_POST['description']));
            $etagere = $_POST['etagere'];
            $categorie = $_POST['categorie'];
              $db = db::getInstance();
                        // code...
                $req= "select * FROM boites WHERE boite=? AND id_etagere=?";

                $exe = $db->prepare($req);
                $exe->execute([$boite,$etagere]);
                $verif = $exe->fetch();
              
                    //on insert le service   
                    if(!$verif){
                          //on hydrate le service
                            $boites = new BoitesModel;
                            $boites->setBoite($boite)
                                  ->setDescBoite($description)
                                  ->setIdEtagere($etagere)
                                  ->setIdCat($categorie);
                            $boites->Create();

                            Form::setFlash('success',"Un boite vient d'etre créer" );
                            header("Location: /boites/liste_boites");
                            exit;
                        } 
                        else{
                         Form::setFlash('danger',"Ce boite exite déjà dans cet etagère" );   
                        }
                        }           

        else{
            Form::setFlash('info','Veuillez à bien remplir le formulaire');
        }
        $catModel = new DomainesModel;
         $domaines = $catModel->findAll();
         $etagereModel = new EtageresModel;

         $etageres = $etagereModel->requete("SELECT * FROM villes,salles,rayons,etageres WHERE villes.id=salles.id_ville AND salles.id = rayons.id_salle AND rayons.id=etageres.id_rayon ORDER BY etagere asc")->fetchAll();;
/*
        $boit = new Form;
        $boit->debutForm()
            ->ajoutLabel('boite','Libellé Boite Archive')
            ->ajoutInput('text','boite',['class'=>'form-control','placeholder'=>'Entrer la Boite Archive a ajouter ici'])
            ->ajoutLabel('desc','Description Boite')
            ->ajoutTextarea('description','',['class'=>'form-control','placeholder'=>'Entrer la description ici'])
             ->ajoutLabel('categorie','Domaine de Gestion')
            ->ajoutSelectDomaine('categorie',['class'=> 'form-control single','id'=>'categorie'])
             ->ajoutLabel('etagere','Etagère')
            ->ajoutSelectEtag('etagere',['class'=> 'form-control single','id'=>'etagere'])
            ->ajoutBouton('Creer la boite',['class'=>'btn btn-primary','name'=>'boit'])
            ->finForm();
            */
                    $villes = $etagereModel->requete("SELECT * FROM villes ORDER BY ville asc")->fetchAll();


            $this->Render('/boites/ajouter_boite',compact('domaines','etageres','boites','villes'),'admin');

    }

    public function ajouter_boites(int $id){

//INSERTION DUN SERVICE
$boitesModel = new BoitesModel;
        // On va chercher toutes les annonces
        //$boites = $boitesModel->requete("SELECT * FROM boites,categories WHERE categories.id=boites.id_cat AND categories.id=?",[$id])->fetch();
        
if (Form::Validate($_POST,['boite','description','etagere','categorie'])) {
            //le formulaire est valide
            $boite = strtoupper(strip_tags($_POST['boite']));
            $description = strtoupper(strip_tags($_POST['description']));
            $etagere = $_POST['etagere'];
            $categorie = $_POST['categorie'];
              $db = db::getInstance();
                        // code...
                $req= "select * FROM boites WHERE boite=? AND id_etagere=?";

                $exe = $db->prepare($req);
                $exe->execute([$boite,$etagere]);
                $verif = $exe->fetch();
              
                    //on insert le service   
                    if(!$verif){
                          //on hydrate le service
                            $boites = new BoitesModel;
                            $boites->setBoite($boite)
                                  ->setDescBoite($description)
                                  ->setIdEtagere($etagere)
                                  ->setIdCat($categorie);
                            $boites->Create();

                            Form::setFlash('success',"Un boite vient d'etre créer" );
                            header("Location: /boites/liste_boites");
                            exit;
                        } 
                        else{
                         Form::setFlash('danger',"Ce boite exite déjà dans cet etagère" );   
                        }
                        }           

        else{
            Form::setFlash('info','Veuillez à bien remplir le formulaire');
        }
        $catModel = new DomainesModel;
         $domaines = $catModel->findAll();
         $etagereModel = new EtageresModel;

         $etageres = $etagereModel->requete("SELECT * FROM villes,salles,rayons,etageres WHERE villes.id=salles.id_ville AND salles.id = rayons.id_salle AND rayons.id=etageres.id_rayon ORDER BY etagere asc")->fetchAll();
            $etages = $etagereModel->requete("SELECT * FROM villes,salles,rayons,etageres WHERE villes.id=salles.id_ville AND salles.id = rayons.id_salle AND rayons.id=etageres.id_rayon AND etageres.id=? ORDER BY etagere asc",[$id])->fetch();
/*
        $boit = new Form;
        $boit->debutForm()
            ->ajoutLabel('boite','Libellé Boite Archive')
            ->ajoutInput('text','boite',['class'=>'form-control','placeholder'=>'Entrer la Boite Archive a ajouter ici'])
            ->ajoutLabel('desc','Description Boite')
            ->ajoutTextarea('description','',['class'=>'form-control','placeholder'=>'Entrer la description ici'])
             ->ajoutLabel('categorie','Domaine de Gestion')
            ->ajoutSelectDomaine('categorie',['class'=> 'form-control single','id'=>'categorie'])
             ->ajoutLabel('etagere','Etagère')
            ->ajoutSelectEtag('etagere',['class'=> 'form-control single','id'=>'etagere'])
            ->ajoutBouton('Creer la boite',['class'=>'btn btn-primary','name'=>'boit'])
            ->finForm();
            */

            $this->Render('/boites/ajouter_boites',compact('domaines','etageres','etages'),'admin');

    }

    public function modifier2(int $id)
    {
        if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])){
            // Vérification si la boîte existe
            $boitesModel = new BoitesModel;
            $boite = $boitesModel->find($id);
            if(!$boite){
                http_response_code(404);
                Form::setFlash('danger', "La boîte recherchée n'existe pas");
                header("Location: /boites/liste_boites");
                exit;
            }

            // Vérification si la boîte contient des dossiers
            $dossiersModel = new DossiersModel;
            $dossiers = $dossiersModel->findBy(['id_boite' => $id]);
            $hasDossier = !empty($dossiers);

            // Gestion du formulaire
            if (Form::Validate($_POST, ['boite', 'description', 'etagere', 'categorie'])) {
                $boit = strtoupper(strip_tags($_POST['boite']));
                $description = strtoupper(strip_tags($_POST['description']));
                $etagere = $_POST['etagere'];
                $categorie = $_POST['categorie'];
                $dates = date('Y-m-d H:i:s');

                $boiteModif = new BoitesModel;
                $boiteModif->setId($boite->id)
                    ->setBoite($boit)
                    ->setDescBoite($description)
                    ->setIdEtagere($etagere)
                    ->setIdCat($categorie)
                    ->setUpdateAt($dates);
                $boiteModif->Update();

                Form::setFlash('success', "La boîte d'archive a été modifiée avec succès");
                header("Location: /boites/liste_boites");
                exit;
            }

            $etagereModel = new EtageresModel;
            $etageres = $etagereModel->findAll();

            $catModel = new DomainesModel;
            $domaines = $catModel->findAll();

            // On envoie à la vue
            $this->Render('/boites/modifier', compact('etageres', 'boite', 'domaines', 'hasDossier'), 'admin');
        } else {
            Form::setFlash('danger', 'Vous devez être connecté pour accéder à cette page!');
            header("Location: /users/login");
            exit;
        }
    }

    public function modifier(int $id)
    {

        if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])){
            // Vérification si la boîte existe
            $boitesModel = new BoitesModel;
            //$boite = $boitesModel->find($id);
            $boite = $boitesModel->requete("SELECT * FROM villes,salles,rayons,etageres,boites WHERE villes.id=salles.id_ville AND salles.id = rayons.id_salle AND rayons.id=etageres.id_rayon AND boites.id_etagere= etageres.id AND boites.id=?",[$id])->fetch();
            /*
            var_dump($boite);
            exit();*/
            if(!$boite){
                http_response_code(404);
                Form::setFlash('danger', "La boîte recherchée n'existe pas");
                header("Location: /boites/liste_boites");
                exit;
            }

            // Vérification si la boîte contient des dossiers
            $dossiersModel = new DossiersModel;
            $dossiers = $dossiersModel->findBy(['id_boite' => $id]);
            $hasDossier = !empty($dossiers);

            // Gestion du formulaire
            if (Form::Validate($_POST, ['boite', 'description', 'etagere', 'categorie'])) {
                $boit = strtoupper(strip_tags($_POST['boite']));
                $description = strtoupper(strip_tags($_POST['description']));
                $etagere = $_POST['etagere'];
                $categorie = $_POST['categorie'];
               /* $ville = $_POST['ville'];  // Nouveau champ ville
                $salle = $_POST['salle'];  // Nouveau champ salle
                $rayon = $_POST['rayon']; */ // Nouveau champ rayon
                $dates = date('Y-m-d H:i:s');

                $boiteModif = new BoitesModel;
                $boiteModif->setId($boite->id)
                    ->setBoite($boit)
                    ->setDescBoite($description)
                    ->setIdEtagere($etagere)
                    ->setIdCat($categorie)
                  //  ->setIdVille($ville) // Mise à jour de la ville
                    //->setIdSalle($salle) // Mise à jour de la salle
                    //->setIdRayon($rayon) // Mise à jour du rayon
                    ->setUpdateAt($dates);

                // Effectuer la mise à jour
                $boiteModif->Update();

                Form::setFlash('success', "La boîte d'archive a été modifiée avec succès");
                header("Location: /boites/liste_boites");
                exit;
            }

            // Charger les villes, salles, rayons et étagères
            $villesModel = new VillesModel;
            $villes = $villesModel->findAll();

            $sallesModel = new SallesModel;
            $salles = $sallesModel->findBy(['id_ville' => $boite->id_ville]);

            $rayonsModel = new RayonsModel;
            $rayons = $rayonsModel->findBy(['id_salle' => $boite->id_salle]);

            $etageresModel = new EtageresModel;
            $etageres = $etageresModel->findBy(['id_rayon' => $boite->id_rayon]);

            $catModel = new DomainesModel;
            $domaines = $catModel->findAll();

            // On envoie à la vue
            $this->Render('/boites/modifier', compact('etageres', 'boite', 'domaines', 'hasDossier', 'villes', 'salles', 'rayons'), 'admin');
        } else {
            Form::setFlash('danger', 'Vous devez être connecté pour accéder à cette page!');
            header("Location: /users/login");
            exit;
        }
    }



    public function modifier1(int $id)
    {

         if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])){
       // l'utilisateur est connecté
       // //on va verifier si l'annonce exite dans la base
       $boitesModel = new BoitesModel;

       //on cherche l'annonce avec $id
       $boite = $boitesModel->find($id);//si l'annonce n'existe pas, on retourne ala liste des annonces
       if(!$boite){
        http_response_code(404);
        Form::setFlash('danger',"La boite recherchée n'existe pas");
        header("Location: /boites/liste_boites");
        exit;
       }
       //on Verifie si l'utilisateur est propriétaire de l'annonce et admin
       
       # if($service->user_id !== $_SESSION['user']['id']){
           if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_USER'){
                 //On le renvoi a la page d'accueil
            Form::setFlash('danger',"Vous n'avez pas accès à cette page");
            header("Location: /boites/liste_boites");
            exit;
            }
          
      #  }
        // on traite le formulaire
         if (Form::Validate($_POST,['boite','description','etagere','categorie'])) {
             // on se protege contre les faille xss
             $boit = strtoupper(strip_tags($_POST['boite']));
             $description = strtoupper(strip_tags($_POST['description']));
             $etagere = $_POST['etagere'];
             $categorie = $_POST['categorie'];
             $dates = date('Y-m-d H:i:s');

             
             //on stocke l'annonce
             $boiteModif = new BoitesModel;
             $boite = $boiteModif->find($id);
             //on hydrate le model
              $boiteModif->setId($boite->id)
                        ->setBoite($boit)
                        ->setDescBoite($description)
                        ->setIdEtagere($etagere)
                        ->setIdCat($categorie)
                        ->setUpdateAt($dates);


              //on met a jour l'annonce
              $boiteModif->Update();
              //On redirige vers les annonces
              Form::setFlash('success',"La boite d'archive a été modifié avec succès");
            header("Location: /boites/liste_boites");
            exit;
         }

         $etagereModel = new EtageresModel;

         $etageres = $etagereModel->findAll();
         $catModel = new DomainesModel;

         $domaines = $catModel->findAll();

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
            
            $this->Render('/boites/modifier',compact('etageres','boite','domaines'),'admin');
       }else{
            //l'utilisateur n'est pas connecté
            Form::setFlash('danger','Vous devez etre connecté pour accéder à cette page!');
            header("Location: /users/login");
            exit;
        }
    }

public function supprimeBoite($id){


        if ($this->isAdmin()) {
            // on est Admin
            $type = new BoitesModel;
            $type->Delete($id);
          Form::setFlash('danger','Une boite d\'archive a été supprimé!');

            header("Location: ".$_SERVER['HTTP_REFERER']);
        }
    
}

    public function getSallesByVille($id_ville)
    {
        $sallesModel = new SallesModel;
        $salles = $sallesModel->findBy(['id_ville' => $id_ville]);
        echo json_encode($salles);
    }

    public function getRayonsBySalle($id_salle)
    {
        $rayonsModel = new RayonsModel;
        $rayons = $rayonsModel->findBy(['id_salle' => $id_salle]);
        echo json_encode($rayons);
    }

    public function getEtageresByRayon($id_rayon)
    {
        $etageresModel = new EtageresModel;
        $etageres = $etageresModel->findBy(['id_rayon' => $id_rayon]);
        echo json_encode($etageres);
    }

    
}





 ?>