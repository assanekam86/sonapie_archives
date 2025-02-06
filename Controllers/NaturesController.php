<?php 
namespace App\Controllers;

use App\Core\Form;
use App\Models\NaturesModel;
use App\Models\Model;
use App\Core\Db;

class NaturesController extends Controller
{

	 /**
         * Cette methode affichera une page listant toutes les services de la base
         * @return void 
         */
    public function liste_natures()
    {
        $natureModel = new NaturesModel;
        // On va chercher toutes les annonces
        $natures = $natureModel->findAll();
        //var_dump($annonces);
        //on hgenere la vue 
        $this->Render('/natures/liste_natures', compact('natures'),'admin');
        
     //   echo"Ici sera la liste des annonces";
   // include_once ROOT.'/Views/annonces/index.php';
    }

    public function ajouter(){

//INSERTION DUN SERVICE
        
if (Form::Validate($_POST,['nature'])) {
            //le formulaire est valide
            $nature =strtoupper(strip_tags($_POST['nature']));
              $db = Db::getInstance();
                        // code...
                $req= "select * FROM natures WHERE nature=?";

                $exe = $db->prepare($req);
                $exe->execute([$nature]);
                $verif = $exe->fetch();
              
                    //on insert le service   
                    if(!$verif){
                          //on hydrate le service
                            $natures = new NaturesModel;
                            $natures->setNature($nature);
                            $natures->Create();

                            Form::setFlash('success',"Une nature vient d'etre créer" );
                          header("Location: /natures/liste_natures");
                           exit;
                        } 
                        else{
                         Form::setFlash('danger',"Cette nature exite déjà" );   
                        }
                        }           

        else{
            Form::setFlash('info','Veuillez à bien remplir le formulaire');
        }


        $cat = new Form;
        $cat->debutForm()
            ->ajoutLabel('nature','Nom de la nature')
            ->ajoutInput('text','nature',['class'=>'form-control','placeholder'=>'Entrer la nature a ajouter ici'])
            ->ajoutBouton('Creer la nature',['class'=>'btn btn-primary','name'=>'serv'])
            ->finForm();

            $this->Render('/natures/ajouter',['natureForm'=>$cat->Create()],'admin');

    }

    public function modifier(int $id)
    {
         if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])){
       // l'utilisateur est connecté
       // //on va verifier si l'annonce exite dans la base
       $naturesModel = new NaturesModel;

       //on cherche l'annonce avec $id
       $nature = $naturesModel->find($id);//si l'annonce n'existe pas, on retourne ala liste des annonces
       if(!$nature){
        http_response_code(404);
        Form::setFlash('danger',"La nature rechercher n'existe pas");
        header("Location: /natures/liste_natures");
        exit;
       }
       //on Verifie si l'utilisateur est propriétaire de l'annonce et admin
       
       # if($service->user_id !== $_SESSION['user']['id']){
            if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_USER'){
                 //On le renvoi a la page d'accueil
            Form::setFlash('danger',"Vous n'avez pas accès à cette page");
            header("Location: /natures/liste_natures");
            exit;
            }
          
      #  }
        // on traite le formulaire
         if (Form::Validate($_POST,['nature'])) {
             // on se protege contre les faille xss
             $cat =strtoupper(strip_tags($_POST['nature']));
             $dates = date('Y-m-d H:i:s');

             
             //on stocke l'annonce
             $natureModif = new NaturesModel;
             //on hydrate le model
              $natureModif->setId($nature->id)
              ->setNature($cat)
              ->setUpdateAt($dates);

              //on met a jour l'annonce
              $categorieModif->Update();
              //On redirige vers les annonces
              Form::setFlash('success',"La Nature à été modifié avec succès");
            header("Location: /natures/liste_natures");
            exit;
         }



       $form = new Form;

            $form->debutForm();
            $form->ajoutLabel('nature','Nature ')
            ->ajoutInput('text','nature',[
                'id'=>'nature',
                'value' => $nature->nature,
                'class'=> 'form-control'
            ])
            ->ajoutbouton('Modifier',['class'=> 'btn btn-primary'])
            ->finForm();

            //on envoie a la vue
            
            $this->Render('/natures/modifier', ['modifForm' => $form->Create()]);
       }
       else{
            //l'utilisateur n'est pas connecté
            Form::setFlash('danger','Vous devez etre connecté pour accéder à cette page!');
            header("Location: /users/login");
            exit;
        }
    }

    public function supprimeNature($id)
    {
        if($this->isAdmin()) {
            // on est Admin
            $nature = new NaturesModel;
            #$categorie = $categoriesModel->find($id);
            $nature->Delete($id);
                        Form::setFlash('success','Une Nature vient d\'etre supprimé!');
            header("Location: ".$_SERVER['HTTP_REFERER']);
                }
        
    }


}

 ?>