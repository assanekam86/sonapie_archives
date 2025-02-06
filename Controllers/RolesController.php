<?php 
namespace App\Controllers;

use App\Core\Db;
use App\Core\Form;
use App\Models\Model;
use App\Models\RolesModel;
use App\Models\UsersModel;

class RolesController extends Controller
{

	 /**
         * Cette methode affichera une page listant toutes les services de la base
         * @return void 
         */
    public function liste_roles()
    {
        $rolesModel = new RolesModel;
        // On va chercher toutes les annonces
        $roles = $rolesModel->findAll();
        //var_dump($annonces);
        //on hgenere la vue 
        $this->Render('roles/liste_roles', compact('roles'),'admin');
        
     //   echo"Ici sera la liste des annonces";
   // include_once ROOT.'/Views/annonces/index.php';
    }

    public function ajouter(){

//INSERTION DUN SERVICE
        $rolesModele = new RolesModel;
        // On va chercher toutes les annonces
        $roles = $rolesModele->findAll();
if (Form::Validate($_POST,['role','libelle'])) {
            //le formulaire est valide
            $role = strip_tags($_POST['role']);
            $libelle = strip_tags($_POST['libelle']);
              $db = db::getInstance();
                        // code...
                $req= "select * FROM roles WHERE libelle=?";

                $exe = $db->prepare($req);
                $exe->execute([$libelle]);
                $verif = $exe->fetch();
              
                    //on insert le service   
                    if(!$verif){
                          //on hydrate le service
                            $rolesModel = new RolesModel;
                            $rolesModel->setRoles($role);
                             $rolesModel->setLibelle($libelle);
                            $rolesModel->Create();

                            Form::setFlash('success',"Un role vient d'etre créer" );

                        } 
                        else{
                         Form::setFlash('danger',"Ce role exite déjà" );
                         //header("Location: /roles/liste_roles");   
                        }
                        }           

        else{
            Form::setFlash('info','Veuillez à bien remplir le formulaire');
        }


        //$roller = new Form;
        //$json_code = ['ROLE_USER'=>'Utilisateur','ROLE_ADMIN'=>'Administrateur'];
        //$json = json_encode($json_code);
       // $roller->debutForm()
         //   ->ajoutLabel('libelle','Nom du Role')
           // ->ajoutInput('text','libelle',['class'=>'form-control','placeholder'=>'Entrer le role a ajouter ici'])
            //->ajoutLabel('droit','Droit')
            //->ajoutSelect('role',,['class'=>'form-control','id'=>'droit'])
            //->ajoutBouton('Creer le role',['class'=>'btn btn-primary','name'=>'serv'])
            //->finForm();

            $this->Render('/roles/ajouter',compact('roles'),'admin');

    }


      public function modifier(int $id)
    {
         if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])){
       // l'utilisateur est connecté
       // //on va verifier si l'annonce exite dans la base
       $rolesModel = new RolesModel;

       //on cherche l'annonce avec $id
       $role = $rolesModel->find($id);//si l'annonce n'existe pas, on retourne ala liste des annonces
       if(!$role){
        http_response_code(404);
        Form::setFlash('danger',"Le role rechercher n'existe pas");
        header("Location: /roles/liste_roles");
        exit;
       }
       //on Verifie si l'utilisateur est propriétaire de l'annonce et admin
       
       # if($service->user_id !== $_SESSION['user']['id']){
           if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_USER'){
                 //On le renvoi a la page d'accueil
            Form::setFlash('danger',"Vous n'avez pas accès à cette page");
            header("Location: /roles/liste_roles");
            exit;
            }
          
      #  }
        // on traite le formulaire
         if (Form::Validate($_POST,['role','libelle']) && ($_POST['role'] != $role->roles || $_POST['libelle'] != $role->libelle) ){
             // on se protege contre les faille xss
             $rol = strip_tags($_POST['role']);
             $libelle = strip_tags($_POST['libelle']);

             $dates = date('Y-m-d H:i:s');

             
             //on stocke l'annonce
             $roleModif = new RolesModel;
             //on hydrate le model
              $roleModif->setId($role->id)
              ->setLibelle($libelle)
              ->setRoles($rol)
              ->setUpdateAt($dates);

              //on met a jour l'annonce
              $roleModif->Update();
              //On redirige vers les annonces
              Form::setFlash('success',"Le Role à été modifié avec succès");
            header("Location: /roles/liste_roles");
            exit;
         }



       $form = new Form;

            $form->debutForm();
            $form->ajoutLabel('role','Nom du Role ')
            ->ajoutInput('text','libelle',[
                'id'=>'role',
                'value' => $role->libelle,
                'class'=> 'form-control'
            ])
             ->ajoutLabel('droit','Droit')
            ->ajoutSelect('role',
                ['ROLE_USER'=>'Utilisateur','ROLE_ADMIN'=>'Administrateur'],
                [
                    'class'=>'form-control',
                    'id'=>'droit'

            ])
          
            ->ajoutbouton('Modifier',['class'=> 'btn btn-primary'])
            ->finForm();

            //on envoie a la vue
            
            $this->Render('roles/modifier', ['modifForm' => $form->Create()],'admin');
       }else{
            //l'utilisateur n'est pas connecté
            Form::setFlash('danger','Vous devez etre connecté pour accéder à cette page!');
            header("Location: /users/login");
            exit;
        }
    }







public function supprimeRole($id){


        if ($this->isAdmin()) {
            // on est Admin
            $role = new RolesModel;
            $role->Delete($id);
            Form::setFlash('success',"Le Role à été supprimé avec succès");
            header("Location: ".$_SERVER['HTTP_REFERER']);
        }
    
}
 public function utlis($option){

        foreach($users as $user => $value){
            $option = array($user =>$value);
        }
        return $option;
    }

    
}





 ?>