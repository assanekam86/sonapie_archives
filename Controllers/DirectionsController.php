<?php 
namespace App\Controllers;

use App\Core\Form;
use App\Models\DirectionsModel;
use App\Models\Model;
use App\Core\Db;

class DirectionsController extends Controller
{

	 /**
         * Cette methode affichera une page listant toutes les services de la base
         * @return void 
         */
    public function liste_directions()
    {
        $servicesModel = new DirectionsModel;
        // On va chercher toutes les annonces
        $services = $servicesModel->findAll();
        //var_dump($annonces);
        //on hgenere la vue 
        $this->Render('directions/liste_directions', compact('services'),'admin');
        
     //   echo"Ici sera la liste des annonces";
   // include_once ROOT.'/Views/annonces/index.php';
    }

   

    public function ajouter(){

//INSERTION DUN SERVICE
        
if (Form::Validate($_POST,['service'])) {
            //le formulaire est valide
            $service = strtoupper(strip_tags($_POST['service']));
              $db = db::getInstance();
                        // code...
                $req= "select * FROM services WHERE designation=?";

                $exe = $db->prepare($req);
                $exe->execute([$service]);
                $verif = $exe->fetch();
              
                    //on insert le service   
                    if(!$verif){
                          //on hydrate le service
                            $services = new DirectionsModel;
                            $services->setDesignation($service);
                            $services->Create();

                            Form::setFlash('success',"Une Direction vient d'etre créée" );
                        } 
                        else{
                         Form::setFlash('danger',"Ce service exite déjà" );   
                        }
                        }           

        else{
            Form::setFlash('info','Veuillez à bien remplir le formulaire');
        }


        $serv = new Form;
        $serv->debutForm()
            ->ajoutLabel('service','Nom de la Direction')
            ->ajoutInput('text','service',['class'=>'form-control','placeholder'=>'Entrer le service a ajouter ici'])
            ->ajoutBouton('Creer la Direction',['class'=>'btn btn-primary','name'=>'serv'])
            ->finForm();

            $this->Render('/directions/ajouter',['serviceForm'=>$serv->Create()],'admin');

    }


      public function modifier(int $id)
    {
         if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])){
       // l'utilisateur est connecté
       // //on va verifier si l'annonce exite dans la base
       $servicesModel = new DirectionsModel;

       //on cherche l'annonce avec $id
       $service = $servicesModel->find($id);//si l'annonce n'existe pas, on retourne ala liste des annonces
       if(!$service){
        http_response_code(404);
        Form::setFlash('danger',"La Direction recherché n'existe pas");
        header("Location: /directions/liste_directions");
        exit;
       }
       //on Verifie si l'utilisateur est propriétaire de l'annonce et admin
       
       # if($service->user_id !== $_SESSION['user']['id']){
           if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_USER'){
                 //On le renvoi a la page d'accueil
            Form::setFlash('danger',"Vous n'avez pas accès à cette page");
            header("Location: /directions/liste_directions");
            exit;
            }
          
      #  }
        // on traite le formulaire
         if (Form::Validate($_POST,['service'])) {
             // on se protege contre les faille xss
             $serv = strtoupper(strip_tags($_POST['service']));
             $dates = date('Y-m-d H:i:s');

             
             //on stocke l'annonce
             $serviceModif = new DirectionsModel;
             //on hydrate le model
              $serviceModif->setIdService($service->id)
              ->setDesignation($serv)
              ->setUpdateAt($dates);

              //on met a jour l'annonce
              $serviceModif->Update();
              //On redirige vers les annonces
              Form::setFlash('success',"La Direction à été modifié avec succès");
            header("Location: /directions/liste_directions");
            exit;
         }



       $form = new Form;

            $form->debutForm();
            $form->ajoutLabel('service','Nom du Service ')
            ->ajoutInput('text','service',[
                'id'=>'service',
                'value' => $service->designation,
                'class'=> 'form-control'
            ])
            ->ajoutbouton('Modifier',['class'=> 'btn btn-primary'])
            ->finForm();

            //on envoie a la vue
            
            $this->Render('/directions/modifier', ['modifForm' => $form->Create()],'admin');
       }else{
            //l'utilisateur n'est pas connecté
            Form::setFlash('danger','Vous devez etre connecté pour accéder à cette page!');
            header("Location: /users/login");
            exit;
        }
    }

public function supprimeService($id){


        if ($this->isAdmin()) {
            // on est Admin
            $service = new DirectionsModel;
            $service->Delete($id);
            Form::setFlash('danger','Une Direction a été supprimé!');
            header("Location: ".$_SERVER['HTTP_REFERER']);
        }
    
}

    
}





 ?>