<?php 
namespace App\Controllers;

use App\Core\Form;
use App\Models\RayonsModel;
use App\Models\EtageresModel;
use App\Models\Model;
use App\Core\Db;

class EtageresController extends Controller
{

	 /**
         * Cette methode affichera une page listant toutes les services de la base
         * @return void 
         */
    public function liste_etageres()
    {
        $etageresModel = new EtageresModel;
        $etageres = $etageresModel->requete("SELECT * FROM villes,salles,rayons,etageres WHERE villes.id=salles.id_ville AND salles.id=rayons.id_salle AND etageres.id_rayon = rayons.id")->fetchAll();
        //$salles = $sales->fetchAll();
        //var_dump($salles);

        // On va chercher toutes les annonces
       // $salles = $sallesModel->findAll();
        //var_dump($annonces);
        //on hgenere la vue 
        $this->Render('etageres/liste_etageres', compact('etageres'),'admin');
        
     //   echo"Ici sera la liste des annonces";
   // include_once ROOT.'/Views/annonces/index.php';
    }
    public function liste_etagere(int $id)
    {
        $etageresModel = new EtageresModel;
        $etageres = $etageresModel->requete("SELECT * FROM villes,salles,rayons,etageres WHERE villes.id=salles.id_ville AND salles.id=rayons.id_salle AND etageres.id_rayon = rayons.id AND rayons.id=?",[$id])->fetchAll();
        $ray = $etageresModel->requete("SELECT * FROM villes,salles,rayons WHERE villes.id=salles.id_ville AND salles.id=rayons.id_salle AND rayons.id=?",[$id])->fetch();
        //$salles = $sales->fetchAll();
        //var_dump($salles);

        // On va chercher toutes les annonces
       // $salles = $sallesModel->findAll();
        //var_dump($annonces);
        //on hgenere la vue 
        $this->Render('etageres/liste_etagere', compact('etageres','ray'),'admin');
        
     //   echo"Ici sera la liste des annonces";
   // include_once ROOT.'/Views/annonces/index.php';
    }

   

    public function ajouter(){

//INSERTION DUN SERVICE
        
if (Form::Validate($_POST,['etagere','rayon'])) {
            //le formulaire est valide
            $etagere = strtoupper(strip_tags($_POST['etagere']));
            $rayon = $_POST['rayon'];

              $db = db::getInstance();
                        // code...
                $req= "select * FROM etageres WHERE etagere=? AND id_rayon=?";

                $exe = $db->prepare($req);
                $exe->execute([$etagere,$rayon]);
                $verif = $exe->fetch();
              
                    //on insert le service   
                    if(!$verif){
                          //on hydrate le service
                            $etageres = new EtageresModel;
                            $etageres->setEtagere($etagere);
                            $etageres->setIdRayon($rayon);
                            $etageres->Create();

                            Form::setFlash('success',"Un etagère vient d'etre créer" );
                            header("Location: /etageres/liste_etageres");
                            exit;
                        } 
                        else{
                         Form::setFlash('danger',"Cet etagère exite déjà" );   
                        }
                        }           

        else{
            Form::setFlash('info','Veuillez à bien remplir le formulaire');
        }
        $rayonsModel =new RayonsModel;
        $rayons = $rayonsModel->requete("SELECT * FROM villes,salles,rayons WHERE villes.id=salles.id_ville AND salles.id = rayons.id_salle ORDER BY rayon asc")->fetchAll(); 

/*
        $etag = new Form;
        $etag->debutForm()
            ->ajoutLabel('etagere',"Nom de l'etagere")
            ->ajoutInput('text','etagere',['class'=>'form-control','placeholder'=>'Entrer le etagere a ajouter ici'])
            ->ajoutLabel('rayon','Rayon')
            ->ajoutSelectRay('rayon',['class'=> 'form-control single','id'=>'rayon'])
            ->ajoutBouton('Creer le etagere',['class'=>'btn btn-primary','name'=>'sall'])
            ->finForm();*/

            $this->Render('/etageres/ajouter',compact('rayons'),'admin');

    }

     public function ajouter_etagere(int $id=null){

//INSERTION DUN SERVICE
        $etageresModel = new EtageresModel;
        $etage = $etageresModel->requete("SELECT * FROM villes,salles,rayons WHERE villes.id=salles.id_ville AND salles.id=rayons.id_salle AND rayons.id=?",[$id])->fetch();
if (Form::Validate($_POST,['etagere','rayon'])) {
            //le formulaire est valide
            $etagere = strtoupper(strip_tags($_POST['etagere']));
            $rayon = $_POST['rayon'];

              $db = db::getInstance();
                        // code...
                $req= "select * FROM etageres WHERE etagere=? AND id_rayon=?";

                $exe = $db->prepare($req);
                $exe->execute([$etagere,$rayon]);
                $verif = $exe->fetch();
              
                    //on insert le service   
                    if(!$verif){
                          //on hydrate le service
                            $etageres = new EtageresModel;
                            $etageres->setEtagere($etagere);
                            $etageres->setIdRayon($rayon);
                            $etageres->Create();

                            Form::setFlash('success',"Un etagère vient d'etre créer" );
                            header("Location: /etageres/liste_etageres");
                            exit;
                        } 
                        else{
                         Form::setFlash('danger',"Cet etagère exite déjà" );   
                        }
                        }           

        else{
            Form::setFlash('info','Veuillez à bien remplir le formulaire');
        }
        $rayonsModel =new RayonsModel;
        $rayons = $rayonsModel->requete("SELECT * FROM villes,salles,etageres,rayons WHERE villes.id=salles.id_ville AND salles.id = rayons.id_salle AND rayons.id=etageres.id_rayon ORDER BY etagere asc")->fetchAll(); 

/*
        $etag = new Form;
        $etag->debutForm()
            ->ajoutLabel('etagere',"Nom de l'etagere")
            ->ajoutInput('text','etagere',['class'=>'form-control','placeholder'=>'Entrer le etagere a ajouter ici'])
            ->ajoutLabel('rayon','Rayon')
            ->ajoutSelectRay('rayon',['class'=> 'form-control single','id'=>'rayon'])
            ->ajoutBouton('Creer le etagere',['class'=>'btn btn-primary','name'=>'sall'])
            ->finForm();*/

            $this->Render('/etageres/ajouter_etagere',compact('rayons','etage'),'admin');

    }


      public function modifier(int $id)
    {
         if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])){
       // l'utilisateur est connecté
       // //on va verifier si l'annonce exite dans la base
       
       
       $etageresModel = new EtageresModel;

       //on cherche l'annonce avec $id
       $etagere = $etageresModel->find($id);//si l'annonce n'existe pas, on retourne ala liste des annonces
       if(!$etagere){
        http_response_code(404);
        Form::setFlash('danger',"L'etagère recherché n'existe pas");
        header("Location: /etageres/liste_etageres");
        exit;
       }
       //on Verifie si l'utilisateur est propriétaire de l'annonce et admin
       
       # if($service->user_id !== $_SESSION['user']['id']){
           if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_USER'){
                 //On le renvoi a la page d'accueil
            Form::setFlash('danger',"Vous n'avez pas accès à cette page");
            header("Location: /etageres/liste_etageres");
            exit;
            }
          
      #  }
        // on traite le formulaire
         if (Form::Validate($_POST,['etagere','rayon'])) {
             // on se protege contre les faille xss
             $etag = strtoupper(strip_tags($_POST['etagere']));
             $rayon = $_POST['rayon'];
             $dates = date('Y-m-d H:i:s');   
             //on stocke l'annonce
             $etagereModif = new EtageresModel;
             $etagere = $etagereModif->find($id);
             //on hydrate le model
             $etagereModif->setId($etagere->id)
                        ->setEtagere($etag)
                        ->setIdRayon($rayon)
                        ->setUpdateAt($dates);

              //on met a jour l'annonce
              $etagereModif->Update();
              //On redirige vers les annonces
              Form::setFlash('success',"Un étagère à été modifié avec succès");
            header("Location: /etageres/liste_etageres");
            exit;
         }

            $rayonsModel = new RayonsModel;
            $rayons = $rayonsModel->findAll();
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
            
            $this->Render('/etageres/modifier',compact('etagere','rayons'),'admin');
       }else{
            //l'utilisateur n'est pas connecté
            Form::setFlash('danger','Vous devez etre connecté pour accéder à cette page!');
            header("Location: /users/login");
            exit;
        }
    }

public function supprimeEtagere(int $id){


        if ($this->isAdmin()) {
            // on est Admin
            $etagere = new EtageresModel;
            $etagere->Delete($id);
          Form::setFlash('danger',"L'etagère a été supprimé!");

            header("Location: ".$_SERVER['HTTP_REFERER']);
        }
    
}

    
}





 ?>