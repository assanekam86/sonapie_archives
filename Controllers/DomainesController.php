<?php 
namespace App\Controllers;

use App\Core\Form;
use App\Models\DomainesModel;
use App\Models\DirectionsModel;
use App\Models\Model;
use App\Core\Db;

class DomainesController extends Controller
{

	 /**
         * Cette methode affichera une page listant toutes les services de la base
         * @return void 
         */
    public function liste_domaines()
    {
        $categorieModel = new DomainesModel;
        // On va chercher toutes les annonces
        $categories = $categorieModel->requete('SELECT services.designation as designat, categories.designation,categories.id, categories.date_creation_cat,categories.update_at,categories.desc_cat FROM services,categories WHERE categories.id_service = services.id')->fetchAll();
        //var_dump($annonces);
        //on hgenere la vue 
        $this->Render('domaines/liste_domaines', compact('categories'),'admin');
        
     //   echo"Ici sera la liste des annonces";
   // include_once ROOT.'/Views/annonces/index.php';
    }
    //liste des types a un domaines
    public function types_domaine(int $id)
    {
        $categorieModel = new DomainesModel;
        // On va chercher toutes les annonces
        $categories = $categorieModel->requete('SELECT * FROM categories,types WHERE categories.id = types.id_cat AND categories.id= ?',[$id])->fetchAll();
        //var_dump($annonces);
        //on hgenere la vue 
        $this->Render('domaines/types_domaine', compact('categories'),'admin');
        
     //   echo"Ici sera la liste des annonces";
   // include_once ROOT.'/Views/annonces/index.php';
    }

    public function ajouter(){

//INSERTION DUN SERVICE
        
if (Form::Validate($_POST,['categorie','description','direction'])) {
            //le formulaire est valide
            $categorie = strtoupper(strip_tags($_POST['categorie']));
            $description =  strtoupper(strip_tags($_POST['description']));
            $direction = $_POST['direction'];
              $db = Db::getInstance();
                        // code...
                $req= "select * FROM categories WHERE designation=? AND id_service=?";

                $exe = $db->prepare($req);
                $exe->execute([$categorie,$direction]);
                $verif = $exe->fetch();
              
                    //on insert le service   
                    if(!$verif){
                          //on hydrate le service
                            $categories = new DomainesModel;
                            $categories->setDesignation($categorie)
                                       ->setDescCat($description)
                                       ->setIdService($direction);
                            $categories->Create();
                            header("Location: /domaines/liste_domaines");
                            Form::setFlash('success',"Une domaine vient d'etre créer" );
                        } 
                        else{
                         Form::setFlash('danger',"Cette domaine exite déjà" );   
                        }
                        }           

        else{
            Form::setFlash('info','Veuillez à bien remplir le formulaire');
        }


        $cat = new Form;
        $cat->debutForm()
            ->ajoutLabel('categorie','Nom du domaine')
            ->ajoutInput('text','categorie',['class'=>'form-control','placeholder'=>'Entrer le domaine a ajouter ici'])
             ->ajoutLabel('description','Description du domaine')
            ->ajoutInput('text','description',['class'=>'form-control','placeholder'=>'Entrer la description du domaine ici...'])
            ->ajoutLabel('direction','Direction')
            ->ajoutSelectDirect('direction',['class'=> 'form-control single','id'=>'direction'])
            ->ajoutBouton('Creer le domaine',['class'=>'btn btn-primary','name'=>'serv'])
            ->finForm();

            $this->Render('/domaines/ajouter',['categorieForm'=>$cat->Create()],'admin');

    }

    public function modifier(int $id)
    {
         if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])){
       // l'utilisateur est connecté
       // //on va verifier si l'annonce exite dans la base
       $categoriesModel = new DomainesModel;

       //on cherche l'annonce avec $id
       $categorie = $categoriesModel->find($id);//si l'annonce n'existe pas, on retourne ala liste des annonces
       if(!$categorie){
        http_response_code(404);
        Form::setFlash('danger',"La catégorie rechercher n'existe pas");
        header("Location: /domaines/liste_domaines");
        exit;
       }
       //on Verifie si l'utilisateur est propriétaire de l'annonce et admin
       
       # if($service->user_id !== $_SESSION['user']['id']){
            if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_USER'){
                 //On le renvoi a la page d'accueil
            Form::setFlash('danger',"Vous n'avez pas accès à cette page");
            header("Location: /domaines/liste_domaines");
            exit;
            }
          
      #  }
        // on traite le formulaire
         if (Form::Validate($_POST,['categorie','description','direction'])) {
             // on se protege contre les faille xss
             $cat =strtoupper(strip_tags($_POST['categorie']));
             $desc =strtoupper(strip_tags($_POST['description']));
             $direction =$_POST['direction'];
             $dates = date('Y-m-d H:i:s');

             
             //on stocke l'annonce
             $categorieModif = new DomainesModel;
             //on hydrate le model
              $categorieModif->setIdCat($categorie->id)
              ->setDesignation($cat)
              ->setDescCAT($desc)
              ->setIdService($direction)
              ->setUpdateAt($dates);

              //on met a jour l'annonce
              $categorieModif->Update();
              //On redirige vers les annonces
              Form::setFlash('success',"Le Domaine à été modifié avec succès");
            header("Location: /domaines/liste_domaines");
            exit;
         }
// afficher la liste des directions
         $direct = new DirectionsModel;

         $directions = $direct->findAll();
/*
       $form = new Form;

            $form->debutForm();
            $form->ajoutLabel('categorie','Catégorie ')
            ->ajoutInput('text','categorie',[
                'id'=>'categorie',
                'value' => $categorie->designation,
                'class'=> 'form-control'
            ])
            ->ajoutbouton('Modifier',['class'=> 'btn btn-primary'])
            ->finForm();
*/
            //on envoie a la vue
            
            $this->Render('/domaines/modifier',compact('categorie','directions'),'admin');
       }
       else{
            //l'utilisateur n'est pas connecté
            Form::setFlash('danger','Vous devez etre connecté pour accéder à cette page!');
            header("Location: /users/login");
            exit;
        }
    }

    public function supprimeDomaine($id)
    {
        if($this->isAdmin()) {
            // on est Admin
            $categorie = new DomainesModel;
            #$categorie = $categoriesModel->find($id);
            $categorie->Delete($id);
                        Form::setFlash('success','Un domaine vient d\'etre supprimé!');
            header("Location: ".$_SERVER['HTTP_REFERER']);
                }
        
    }


}

 ?>