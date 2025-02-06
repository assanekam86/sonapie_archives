<?php 
namespace App\Controllers;

use App\Core\Form;
use App\Models\SallesModel;
use App\Models\VillesModel;
use App\Models\Model;
use App\Core\Db;

class SallesController extends Controller
{

	 /**
         * Cette methode affichera une page listant toutes les services de la base
         * @return void 
         */
    public function liste_salles()
    {
        $sallesModel = new VillesModel;
        $salles = $sallesModel->requete("SELECT * FROM villes,salles WHERE salles.id_ville = villes.id")->fetchAll();
        //$salles = $sales->fetchAll();
        //var_dump($salles);

        // On va chercher toutes les annonces
       // $salles = $sallesModel->findAll();
        //var_dump($annonces);
        //on hgenere la vue 
        $this->Render('salles/liste_salles', compact('salles'),'admin');
        

     //   echo"Ici sera la liste des annonces";
   // include_once ROOT.'/Views/annonces/index.php';
    }

     public function liste_salle(int $id)
    {
        $sallesModel = new VillesModel;
        $salles = $sallesModel->requete("SELECT * FROM villes,salles WHERE salles.id_ville = villes.id AND salles.id_ville=?",[$id])->fetchAll();
        $sall = $sallesModel->requete("SELECT * FROM villes WHERE villes.id=?",[$id])->fetch();
        //$salles = $sales->fetchAll();
        //var_dump($salles);

        // On va chercher toutes les annonces
       // $salles = $sallesModel->findAll();
        //var_dump($annonces);
        //on hgenere la vue 
        $this->Render('salles/liste_salle', compact('salles','sall'),'admin');
        
     //   echo"Ici sera la liste des annonces";
   // include_once ROOT.'/Views/annonces/index.php';
    }

   

    public function ajouter(){

//INSERTION DUN SERVICE
        
if (Form::Validate($_POST,['salle'])) {
            //le formulaire est valide
            $salle = strtoupper(strip_tags($_POST['salle']));
            $ville = $_POST['ville'];

              $db = db::getInstance();
                        // code...
                $req= "select * FROM salles WHERE salle=? AND id_ville=?";

                $exe = $db->prepare($req);
                $exe->execute([$salle,$ville]);
                $verif = $exe->fetch();
              
                    //on insert le service   
                    if(!$verif){
                          //on hydrate le service
                            $salles = new SallesModel;
                            $salles->setSalle($salle);
                            $salles->setIdVille($ville);
                            $salles->Create();

                            Form::setFlash('success',"Un salle vient d'etre créer" );
                            header("Location: /salles/liste_salles");
                            exit;
                        } 
                        else{
                         Form::setFlash('danger',"Ce salle exite déjà" );   
                        }
                        }           

        else{
            Form::setFlash('info','Veuillez à bien remplir le formulaire');
        }


        $sal = new Form;
        $sal->debutForm()
            ->ajoutLabel('salle','Nom de la salle')
            ->ajoutInput('text','salle',['class'=>'form-control','placeholder'=>'Entrer le salle a ajouter ici'])
            ->ajoutLabel('ville','Ville')
            ->ajoutSelectVill('ville',['class'=> 'form-control single','id'=>'ville'])
            ->ajoutBouton('Creer le salle',['class'=>'btn btn-primary','name'=>'sall'])
            ->finForm();

            $this->Render('/salles/ajouter',['salleForm'=>$sal->Create()],'admin');

    }


    public function ajouter_salle(int $id){

//INSERTION DUN SERVICE
$sallesModel = new SallesModel;
$villes = $sallesModel->requete("SELECT * FROM villes WHERE villes.id=?",[$id])->fetch();
        
if (Form::Validate($_POST,['salle'])) {
            //le formulaire est valide
            $salle = strtoupper(strip_tags($_POST['salle']));
            $ville = $_POST['ville'];

              $db = db::getInstance();
                        // code...
                $req= "select * FROM salles WHERE salle=? AND id_ville=?";

                $exe = $db->prepare($req);
                $exe->execute([$salle,$ville]);
                $verif = $exe->fetch();
              
                    //on insert le service   
                    if(!$verif){
                          //on hydrate le service
                            $salles = new SallesModel;
                            $salles->setSalle($salle);
                            $salles->setIdVille($ville);
                            $salles->Create();

                            Form::setFlash('success',"Un salle vient d'etre créer" );
                            header("Location: /salles/liste_salles");
                            exit;
                        } 
                        else{
                         Form::setFlash('danger',"Ce salle exite déjà" );   
                        }
                        }           

        else{
            Form::setFlash('info','Veuillez à bien remplir le formulaire');
        }
/*

        $sal = new Form;
        $sal->debutForm()
            ->ajoutLabel('salle','Nom de la salle')
            ->ajoutInput('text','salle',['class'=>'form-control','placeholder'=>'Entrer le salle a ajouter ici'])
            ->ajoutLabel('ville','Ville')
            ->ajoutSelectVill('ville',['class'=> 'form-control single','id'=>'ville'])
            ->ajoutBouton('Creer le salle',['class'=>'btn btn-primary','name'=>'sall'])
            ->finForm();
*/
            $this->Render('/salles/ajouter_salle',compact('villes'),'admin');

    }


      public function modifier(int $id)
    {
         if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])){
       // l'utilisateur est connecté
       // //on va verifier si l'annonce exite dans la base
       
       
       $sallesModel = new SallesModel;

       //on cherche l'annonce avec $id
       $salle = $sallesModel->find($id);//si l'annonce n'existe pas, on retourne ala liste des annonces
       if(!$salle){
        http_response_code(404);
        Form::setFlash('danger',"Le salle rechercher n'existe pas");
        header("Location: /salles/liste_salles");
        exit;
       }
       //on Verifie si l'utilisateur est propriétaire de l'annonce et admin
       
       # if($service->user_id !== $_SESSION['user']['id']){
           if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_USER'){
                 //On le renvoi a la page d'accueil
            Form::setFlash('danger',"Vous n'avez pas accès à cette page");
            header("Location: /salles/liste_salles");
            exit;
            }
          
      #  }
        // on traite le formulaire
         if (Form::Validate($_POST,['salle','ville'])) {
             // on se protege contre les faille xss
             $sal = strtoupper(strip_tags($_POST['salle']));
             $ville = $_POST['ville'];
             $dates = date('Y-m-d H:i:s');

             
             //on stocke l'annonce
             $salleModif = new SallesModel;
             $salle = $salleModif->find($id);
             //on hydrate le model
              $salleModif->setId($salle->id)
                        ->setSalle($sal)
                        ->setIdVille($ville)
                        ->setUpdateAt($dates);

              //on met a jour l'annonce
              $salleModif->Update();
              //On redirige vers les annonces
              Form::setFlash('success',"Le salle à été modifié avec succès");
            header("Location: /salles/liste_salles");
            exit;
         }

            $villesModel = new VillesModel;
            $villes = $villesModel->findAll();
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
            
            $this->Render('/salles/modifier',compact('salle','villes'),'admin');
       }else{
            //l'utilisateur n'est pas connecté
            Form::setFlash('danger','Vous devez etre connecté pour accéder à cette page!');
            header("Location: /users/login");
            exit;
        }
    }

public function supprimeSalle(int $id){


        if ($this->isAdmin()) {
            // on est Admin
            $salle = new SallesModel;
            $salle->Delete($id);
          Form::setFlash('danger','La salle a été supprimé!');

            header("Location: ".$_SERVER['HTTP_REFERER']);
        }
    
}

    
}





 ?>