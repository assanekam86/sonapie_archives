<?php 
namespace App\Controllers;

use App\Core\Form;
use App\Models\VillesModel;
use App\Models\Model;
use App\Core\Db;

class VillesController extends Controller
{

	 /**
         * Cette methode affichera une page listant toutes les services de la base
         * @return void 
         */
    public function liste_villes()
    {
        $villesModel = new VillesModel;
        // On va chercher toutes les annonces
        $villes = $villesModel->findAll();
        //var_dump($annonces);
        //on hgenere la vue 
        $this->Render('villes/liste_villes', compact('villes'),'admin');
        
     //   echo"Ici sera la liste des annonces";
   // include_once ROOT.'/Views/annonces/index.php';
    }

   

    public function ajouter(){

//INSERTION DUN SERVICE
        
if (Form::Validate($_POST,['ville'])) {
            //le formulaire est valide
            $ville = strtoupper(strip_tags($_POST['ville']));
              $db = db::getInstance();
                        // code...
                $req= "select * FROM villes WHERE ville=?";

                $exe = $db->prepare($req);
                $exe->execute([$ville]);
                $verif = $exe->fetch();
              
                    //on insert le service   
                    if(!$verif){
                          //on hydrate le service
                            $villes = new VillesModel;
                            $villes->setVille($ville);
                            $villes->Create();

                            Form::setFlash('success',"Un ville vient d'etre créer" );
                            header("Location: /villes/liste_villes");
                            exit;
                        } 
                        else{
                         Form::setFlash('danger',"Ce ville exite déjà" );   
                        }
                        }           

        else{
            Form::setFlash('info','Veuillez à bien remplir le formulaire');
        }


        $vil = new Form;
        $vil->debutForm()
            ->ajoutLabel('ville','Nom de la ville')
            ->ajoutInput('text','ville',['class'=>'form-control','placeholder'=>'Entrer le ville a ajouter ici'])
            ->ajoutBouton('Creer le ville',['class'=>'btn btn-primary','name'=>'vill'])
            ->finForm();

            $this->Render('/villes/ajouter',['villeForm'=>$vil->Create()],'admin');

    }


      public function modifier(int $id)
    {
         if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])){
       // l'utilisateur est connecté
       // //on va verifier si l'annonce exite dans la base
       $villesModel = new VillesModel;

       //on cherche l'annonce avec $id
       $ville = $villesModel->find($id);//si l'annonce n'existe pas, on retourne ala liste des annonces
       if(!$ville){
        http_response_code(404);
        Form::setFlash('danger',"Le ville rechercher n'existe pas");
        header("Location: /villes/liste_villes");
        exit;
       }
       //on Verifie si l'utilisateur est propriétaire de l'annonce et admin
       
       # if($service->user_id !== $_SESSION['user']['id']){
           if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_USER'){
                 //On le renvoi a la page d'accueil
            Form::setFlash('danger',"Vous n'avez pas accès à cette page");
            header("Location: /villes/liste_villes");
            exit;
            }
          
      #  }
        // on traite le formulaire
         if (Form::Validate($_POST,['ville'])) {
             // on se protege contre les faille xss
             $vil = strtoupper(strip_tags($_POST['ville']));
             $dates = date('Y-m-d H:i:s');

             
             //on stocke l'annonce
             $villeModif = new VillesModel;
             $ville = $villeModif->find($id);
             //on hydrate le model
              $villeModif->setId($ville->id)
                        ->setVille($vil)
                        ->setUpdateAt($dates);

              //on met a jour l'annonce
              $villeModif->Update();
              //On redirige vers les annonces
              Form::setFlash('success',"Le ville à été modifié avec succès");
            header("Location: /villes/liste_villes");
            exit;
         }



       $form = new Form;

            $form->debutForm();
            $form->ajoutLabel('ville','Nom du ville ')
            ->ajoutInput('text','ville',[
                'id'=>'ville',
                'value' => $ville->ville,
                'class'=> 'form-control'
            ])
            ->ajoutbouton('Modifier',['class'=> 'btn btn-primary'])
            ->finForm();

            //on envoie a la vue
            
            $this->Render('/villes/modifier', ['modifForm' => $form->Create()],'admin');
       }else{
            //l'utilisateur n'est pas connecté
            Form::setFlash('danger','Vous devez etre connecté pour accéder à cette page!');
            header("Location: /users/login");
            exit;
        }
    }

public function supprimeVille($id){


        if ($this->isAdmin()) {
            // on est Admin
            $ville = new VillesModel;
            $ville->Delete($id);
          Form::setFlash('danger','Un ville de document a été supprimé!');

            header("Location: ".$_SERVER['HTTP_REFERER']);
        }
    
}

    
}





 ?>