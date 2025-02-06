<?php 
namespace App\Controllers;

use App\Core\Form;
use App\Models\TypesModel;
use App\Models\DomainesModel;
use App\Models\Model;
use App\Core\Db;

class TypesController extends Controller
{

	 /**
         * Cette methode affichera une page listant toutes les services de la base
         * @return void 
         */
    public function liste_types()
    {
        $typesModel = new TypesModel;
        // On va chercher toutes les annonces
        $types = $typesModel->requete("SELECT * FROM categories,types WHERE types.id_cat = categories.id")->fetchAll();
        //var_dump($annonces);
        //on hgenere la vue 
        $this->Render('types/liste_types', compact('types'),'admin');
        
     //   echo"Ici sera la liste des annonces";
   // include_once ROOT.'/Views/annonces/index.php';
    }


     public function types_domaine(int $id)
    {
        $typesModel = new TypesModel;
        // On va chercher toutes les annonces
        $types = $typesModel->requete("SELECT * FROM categories,types WHERE types.id_cat = categories.id AND categories.id=?",[$id])->fetchAll();
        $typos = $typesModel->requete("SELECT types.id,categories.designation FROM categories,types WHERE types.id_cat = categories.id AND categories.id=?",[$id])->fetch();
        //var_dump($annonces);
        //on hgenere la vue 
        $this->Render('types/types_domaine', compact('types','typos'),'admin');
        
     //   echo"Ici sera la liste des annonces";
   // include_once ROOT.'/Views/annonces/index.php';
    }

   

    public function ajouter(){

//INSERTION DUN SERVICE
        
if (Form::Validate($_POST,['type','description','domaine','code'])) {
            //le formulaire est valide
            $type = strtoupper(strip_tags($_POST['type']));
              $code = strtoupper(strip_tags($_POST['code']));
            $description = strtoupper(strip_tags($_POST['description']));
            $domaine = $_POST['domaine'];
              $db = db::getInstance();
                        // code...
                $req= "select * FROM types WHERE type=? AND id_cat=?";

                $exe = $db->prepare($req);
                $exe->execute([$type,$domaine]);
                $verif = $exe->fetch();
              
                    //on insert le service   
                    if(!$verif){
                          //on hydrate le service
                            $types = new TypesModel;
                            $types->setType($type)
                                  ->setCode($code)
                                  ->setDescType($description)
                                  ->setIdCat($domaine);
                            $types->Create();

                            Form::setFlash('success',"Un type vient d'etre créer" );
                            header("Location: /types/liste_types");
                            exit;
                        } 
                        else{
                         Form::setFlash('danger',"Ce type exite déjà pour ce domaine de gestion");   
                        }
                        }           

        else{
            Form::setFlash('info','Veuillez à bien remplir le formulaire');
        }


        $typ = new Form;
        $typ->debutForm()
            ->ajoutLabel('code','Code Typologie')
            ->ajoutInput('text','code',['class'=>'form-control','placeholder'=>'Entrer le code a ajouter ici(6 caracteres) EX: BULSOL','maxlength'=>'6','required'=>'required'])
            ->ajoutLabel('type','Libellé Typologie')
            ->ajoutInput('text','type',['class'=>'form-control','placeholder'=>'Entrer la typologie a ajouter ici'])
            ->ajoutLabel('desc','Description typologie')
            ->ajoutTextarea('description','',['class'=>'form-control','placeholder'=>'Entrer la description ici'])
             ->ajoutLabel('domaine','Domaine de Gestion')
            ->ajoutSelectDomaine('domaine',['class'=> 'form-control single','id'=>'domaine'])
            ->ajoutBouton('Creer le type',['class'=>'btn btn-primary','name'=>'typ'])
            ->finForm();

            $this->Render('/types/ajouter',['typeForm'=>$typ->Create()],'admin');

    }

     public function ajouter_type(){

//INSERTION DUN SERVICE
        
if (Form::Validate($_POST,['type','description','domaine','code'])) {
            //le formulaire est valide
            $type = strtoupper(strip_tags($_POST['type']));
              $code = strtoupper(strip_tags($_POST['code']));
            $description = strtoupper(strip_tags($_POST['description']));
            $domaine = $_POST['domaine'];
              $db = db::getInstance();
                        // code...
                $req= "select * FROM types WHERE type=? AND id_cat=?";

                $exe = $db->prepare($req);
                $exe->execute([$type,$domaine]);
                $verif = $exe->fetch();
              
                    //on insert le service   
                    if(!$verif){
                          //on hydrate le service
                            $types = new TypesModel;
                            $types->setType($type)
                                  ->setCode($code)
                                  ->setDescType($description)
                                  ->setIdCat($domaine);
                            $types->Create();

                            Form::setFlash('success',"Un type vient d'etre créer" );
                            header("Location: /types/liste_types");
                            exit;
                        } 
                        else{
                         Form::setFlash('danger',"Ce type exite déjà pour ce domaine de gestion");   
                        }
                        }           

        else{
            Form::setFlash('info','Veuillez à bien remplir le formulaire');
        }


        $typ = new Form;
        $typ->debutForm()
            ->ajoutLabel('code','Code Typologie')
            ->ajoutInput('text','code',['class'=>'form-control','placeholder'=>'Entrer le code a ajouter ici(6 caracteres) EX: BULSOL','maxlength'=>'6','required'=>'required'])
            ->ajoutLabel('type','Libellé Typologie')
            ->ajoutInput('text','type',['class'=>'form-control','placeholder'=>'Entrer la typologie a ajouter ici'])
            ->ajoutLabel('desc','Description typologie')
            ->ajoutTextarea('description','',['class'=>'form-control','placeholder'=>'Entrer la description ici'])
             ->ajoutLabel('domaine','Domaine de Gestion')
            ->ajoutSelectDomaine('domaine',['class'=> 'form-control single','id'=>'domaine'])
            ->ajoutBouton('Creer le type',['class'=>'btn btn-primary','name'=>'typ'])
            ->finForm();

         $domaineModel = new DomainesModel;

         $domaines = $domaineModel->findAll();
            $this->Render('/types/ajouter_type',compact('domaines'),'admin');

    }



      public function modifier(int $id)
    {
         if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])){
       // l'utilisateur est connecté
       // //on va verifier si l'annonce exite dans la base
       $typesModel = new TypesModel;

       //on cherche l'annonce avec $id
       $type = $typesModel->find($id);//si l'annonce n'existe pas, on retourne ala liste des annonces
       if(!$type){
        http_response_code(404);
        Form::setFlash('danger',"Le type rechercher n'existe pas");
        header("Location: /types/liste_types");
        exit;
       }
       //on Verifie si l'utilisateur est propriétaire de l'annonce et admin
       
       # if($service->user_id !== $_SESSION['user']['id']){
           if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_USER'){
                 //On le renvoi a la page d'accueil
            Form::setFlash('danger',"Vous n'avez pas accès à cette page");
            header("Location: /types/liste_types");
            exit;
            }
          
      #  }
        // on traite le formulaire
         if (Form::Validate($_POST,['type','description','domaine'])) {
             // on se protege contre les faille xss
             $typ = strtoupper(strip_tags($_POST['type']));
             $description = strtoupper(strip_tags($_POST['description']));
             $domaine = $_POST['domaine'];
             $dates = date('Y-m-d H:i:s');

             
             //on stocke l'annonce
             $typeModif = new TypesModel;
             $type = $typeModif->find($id);
             //on hydrate le model
              $typeModif->setId($type->id)
                        ->setType($typ)
                        ->setDescType($description)
                        ->setIdCat($domaine)
                        ->setUpdateAt($dates);


              //on met a jour l'annonce
              $typeModif->Update();
              //On redirige vers les annonces
              Form::setFlash('success',"Le Type à été modifié avec succès");
            header("Location: /types/liste_types");
            exit;
         }

         $domaineModel = new DomainesModel;

         $domaines = $domaineModel->findAll();

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
            
            $this->Render('/types/modifier',compact('domaines','type'),'admin');
       }else{
            //l'utilisateur n'est pas connecté
            Form::setFlash('danger','Vous devez etre connecté pour accéder à cette page!');
            header("Location: /users/login");
            exit;
        }
    }

public function supprimeType($id){


        if ($this->isAdmin()) {
            // on est Admin
            $type = new TypesModel;
            $type->Delete($id);
          Form::setFlash('danger','Un type de document a été supprimé!');

            header("Location: ".$_SERVER['HTTP_REFERER']);
        }
    
}

    
}





 ?>