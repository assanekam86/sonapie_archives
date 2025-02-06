<?php 
namespace App\Controllers;

use App\Core\Form;
use App\Models\RayonsModel;
use App\Models\SallesModel;
use App\Models\Model;
use App\Core\Db;

class RayonsController extends Controller
{

	 /**
         * Cette methode affichera une page listant toutes les services de la base
         * @return void 
         */
    public function liste_rayons(int $id=null)
    {
        $rayonsModel = new RayonsModel;
        $rayons = $rayonsModel->requete("SELECT * FROM villes,salles,rayons WHERE villes.id=salles.id_ville AND rayons.id_salle = salles.id")->fetchAll();
        //$salles = $sales->fetchAll();
        //var_dump($salles);

        // On va chercher toutes les annonces
       // $salles = $sallesModel->findAll();
        //var_dump($annonces);
        //on hgenere la vue 
        $this->Render('rayons/liste_rayons', compact('rayons'),'admin');
        
     //   echo"Ici sera la liste des annonces";
   // include_once ROOT.'/Views/annonces/index.php';
    }

    

     public function liste_rayon(int $id)
    {
        $rayonsModel = new RayonsModel;
        $rayons = $rayonsModel->requete("SELECT * FROM villes,salles,rayons WHERE villes.id=salles.id_ville AND rayons.id_salle = salles.id AND rayons.id_salle=?",[$id])->fetchAll();
        $salle = $rayonsModel->requete("SELECT * FROM villes,salles WHERE villes.id=salles.id_ville AND salles.id=?",[$id])->fetch();
        //$salles = $sales->fetchAll();
        //var_dump($salles);

        // On va chercher toutes les annonces
       // $salles = $sallesModel->findAll();
        //var_dump($annonces);
        //on hgenere la vue 
        $this->Render('rayons/liste_rayon', compact('rayons','salle'),'admin');
        
     //   echo"Ici sera la liste des annonces";
   // include_once ROOT.'/Views/annonces/index.php';
    }

   

    public function ajouter(int $id=null){

//INSERTION DUN SERVICE
$rayonsModel = new RayonsModel;
$sal = $rayonsModel->requete("SELECT * FROM villes,rayons,salles WHERE villes.id=salles.id_ville AND rayons.id_salle = salles.id AND salles.id=?",[$id])->fetch();
        
if (Form::Validate($_POST,['rayon','salle'])) {
            //le formulaire est valide
            $rayon = strtoupper(strip_tags($_POST['rayon']));
            $salle = $_POST['salle'];

              $db = db::getInstance();
                        // code...
                $req= "select * FROM rayons WHERE rayon=? AND id_salle=?";

                $exe = $db->prepare($req);
                $exe->execute([$rayon,$salle]);
                $verif = $exe->fetch();
              
                    //on insert le service   
                    if(!$verif){
                          //on hydrate le service
                            $rayons = new RayonsModel;
                            $rayons->setRayon($rayon);
                            $rayons->setIdSalle($salle);
                            $rayons->Create();

                            Form::setFlash('success',"Un rayon vient d'etre créer" );
                            header("Location: /rayons/liste_rayons");
                            exit;
                        } 
                        else{
                         Form::setFlash('danger',"Ce rayon exite déjà" );   
                        }
                        }           

        else{
            Form::setFlash('info','Veuillez à bien remplir le formulaire');
        }
        $sallesModel = new SallesModel;
        $salles = $sallesModel->requete("SELECT * FROM villes,salles WHERE villes.id=salles.id_ville ORDER BY salle asc")->fetchAll();

/*
        $ray = new Form;
        $ray->debutForm()
            ->ajoutLabel('rayon','Nom de la rayon')
            ->ajoutInput('text','rayon',['class'=>'form-control','placeholder'=>'Entrer le rayon a ajouter ici'])
            ->ajoutLabel('salle','Salle')
            ->ajoutSelectSall('salle',['class'=> 'form-control single','id'=>'salle'])
            ->ajoutBouton('Creer le rayon',['class'=>'btn btn-primary','name'=>'sall'])
            ->finForm();
*/
            $this->Render('/rayons/ajouter',compact('salles','sal'),'admin');

    }

    public function ajouter_rayon(int $id){

//INSERTION DUN SERVICE
$rayonsModel = new RayonsModel;
$sal = $rayonsModel->requete("SELECT * FROM villes,salles WHERE villes.id=salles.id_ville AND salles.id=?",[$id])->fetch();
        
if (Form::Validate($_POST,['rayon','salle'])) {
            //le formulaire est valide
            $rayon = strtoupper(strip_tags($_POST['rayon']));
            $salle = $_POST['salle'];

              $db = db::getInstance();
                        // code...
                $req= "select * FROM rayons WHERE rayon=? AND id_salle=?";

                $exe = $db->prepare($req);
                $exe->execute([$rayon,$salle]);
                $verif = $exe->fetch();
              
                    //on insert le service   
                    if(!$verif){
                          //on hydrate le service
                            $rayons = new RayonsModel;
                            $rayons->setRayon($rayon);
                            $rayons->setIdSalle($salle);
                            $rayons->Create();

                            Form::setFlash('success',"Un rayon vient d'etre créer" );
                            header("Location: /rayons/liste_rayons");
                            exit;
                        } 
                        else{
                         Form::setFlash('danger',"Ce rayon exite déjà" );   
                        }
                        }           

        else{
            Form::setFlash('info','Veuillez à bien remplir le formulaire');
        }
        $sallesModel = new SallesModel;
        $salles = $sallesModel->requete("SELECT * FROM villes,salles WHERE villes.id=salles.id_ville ORDER BY salle asc")->fetchAll();

/*
        $ray = new Form;
        $ray->debutForm()
            ->ajoutLabel('rayon','Nom de la rayon')
            ->ajoutInput('text','rayon',['class'=>'form-control','placeholder'=>'Entrer le rayon a ajouter ici'])
            ->ajoutLabel('salle','Salle')
            ->ajoutSelectSall('salle',['class'=> 'form-control single','id'=>'salle'])
            ->ajoutBouton('Creer le rayon',['class'=>'btn btn-primary','name'=>'sall'])
            ->finForm();
*/
            $this->Render('/rayons/ajouter_rayon',compact('salles','sal'),'admin');

    }


      public function modifier(int $id)
    {
         if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])){
       // l'utilisateur est connecté
       // //on va verifier si l'annonce exite dans la base
       
       
       $rayonsModel = new RayonsModel;

       //on cherche l'annonce avec $id
       $rayon = $rayonsModel->find($id);//si l'annonce n'existe pas, on retourne ala liste des annonces
       if(!$rayon){
        http_response_code(404);
        Form::setFlash('danger',"Le rayon rechercher n'existe pas");
        header("Location: /rayons/liste_rayons");
        exit;
       }
       //on Verifie si l'utilisateur est propriétaire de l'annonce et admin
       
       # if($service->user_id !== $_SESSION['user']['id']){
           if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_USER'){
                 //On le renvoi a la page d'accueil
            Form::setFlash('danger',"Vous n'avez pas accès à cette page");
            header("Location: /rayons/liste_rayons");
            exit;
            }
          
      #  }
        // on traite le formulaire
         if (Form::Validate($_POST,['rayon','salle'])) {
             // on se protege contre les faille xss
             $ray = strtoupper(strip_tags($_POST['rayon']));
             $salle = $_POST['salle'];
             $dates = date('Y-m-d H:i:s');   
             //on stocke l'annonce
             $rayonModif = new RayonsModel;
             $rayon = $rayonModif->find($id);
             //on hydrate le model
             $rayonModif->setId($rayon->id)
                        ->setRayon($ray)
                        ->setIdSalle($salle)
                        ->setUpdateAt($dates);

              //on met a jour l'annonce
              $rayonModif->Update();
              //On redirige vers les annonces
              Form::setFlash('success',"Le rayon à été modifié avec succès");
            header("Location: /rayons/liste_rayons");
            exit;
         }

            $sallesModel = new SallesModel;
            $salles = $sallesModel->findAll();
/*
       $form = new Form;

            $form->debutForm();
            $form->ajoutLabel('salle','Nom du salle ')
            ->ajoutInput('text','salle',[
                'id'=>'salle',
                'value' => $salle->salle,
                'class'=> 'form-control'
            ])
            ->ajoutbouton('Modifier',['class'=> 'btn btn-primary'])
            ->finForm();*/

            //on envoie a la vue
            
            $this->Render('/rayons/modifier',compact('rayon','salles'),'admin');
       }else{
            //l'utilisateur n'est pas connecté
            Form::setFlash('danger','Vous devez etre connecté pour accéder à cette page!');
            header("Location: /users/login");
            exit;
        }
    }

public function supprimeRayon(int $id){


        if ($this->isAdmin()) {
            // on est Admin
            $rayon = new RayonsModel;
            $rayon->Delete($id);
          Form::setFlash('danger','La rayon a été supprimé!');

            header("Location: ".$_SERVER['HTTP_REFERER']);
        }
    
}

    
}





 ?>