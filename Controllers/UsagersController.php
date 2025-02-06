<?php 
namespace App\Controllers;

use App\Core\Form;
use App\Models\UsagersModel;
use App\Models\Model;
use App\Core\Db;
use App\Models\DomainesModel;

class UsagersController extends Controller
{

	 /**
         * Cette methode affichera une page listant toutes les services de la base
         * @return void 
         */
    public function liste_usagers()
    {
        $usagersModel = new UsagersModel;
        // On va chercher toutes les annonces
        $usagers = $usagersModel->requete('SELECT * FROM categories,status,usagers WHERE categories.id=usagers.id_cat AND usagers.type_usager= status.id')->fetchAll();
        //var_dump($annonces);
        //on hgenere la vue 
        $this->Render('usagers/liste_usagers', compact('usagers'),'admin');
        
     //   echo"Ici sera la liste des annonces";
   // include_once ROOT.'/Views/annonces/index.php';
    }

   

    public function ajouter(){

//INSERTION DUN SERVICE
        
if (Form::Validate($_POST,['usager','type'])) {
            //le formulaire est valide
            $usager = strtoupper(strip_tags($_POST['usager']));
            $type = strtoupper(strip_tags($_POST['type']));
            $contact = strtoupper(strip_tags($_POST['contact']));
            $email = strtoupper(strip_tags($_POST['email']));
            $adresse = strip_tags($_POST['adresse']);
            $matricule = strip_tags($_POST['matricule']);
            $fonction = strip_tags($_POST['fonction']);
            $grade = strip_tags($_POST['grade']);
            $etab = strip_tags($_POST['etable']);
            $iddom= $_POST['domaine'];
            $dateserv = strip_tags($_POST['dateserv']);

              
                    
                    
                        $db = db::getInstance();
                        // code...
                
                    //on insert le service   
                    
                        if($type == 1)
                        {
                            $req= "select * FROM usagers WHERE usager=?";

                        $exe = $db->prepare($req);
                        $exe->execute([$usager]);
                        $verif = $exe->fetch();
                            if(!$verif){
                            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                          //on hydrate l'usager entreprise
                            $usagers = new UsagersModel;
                            $usagers->setUsager($usager)
                                    ->setTypeUsager($type)
                                    ->setContact($contact)
                                    ->setEmail($email)
                                    ->setAdresse($adresse)
                                    ->setIdCat($iddom);
                            $usagers->Create();
                            }else{
                             Form::setFlash('danger',"Entrer un format d'email valide" );   
                            }}else{
                         Form::setFlash('danger',"Cet usager exite déjà" );   
                        }
                        }else{
                            // on hydrate l'usage particulier
                            //on hydrate le service
                        $req= "select * FROM usagers WHERE usager=? AND matricule=?";

                        $exe = $db->prepare($req);
                        $exe->execute([$usager,$matricule]);
                        $verif = $exe->fetch();
                            if(!$verif){
                            $usagers = new UsagersModel;
                            $usagers->setUsager($usager)
                                    ->setTypeUsager($type)
                                    ->setContact($contact)
                                    ->setMatricule($matricule)
                                    ->setFonction($fonction)
                                    ->setEtablissement($etab)
                                    ->setGrade($grade)
                                    ->setIdCat($iddom)
                                    ->setDateService($dateserv);
                            $usagers->Create();
                        }else{
                         Form::setFlash('danger',"Cet usager exite déjà" );   
                        }
                        }

                            Form::setFlash('success',"Un usager vient d'etre créer" );
                            header("Location:/usagers/liste_usagers");
                            exit;
                        } 
                                

        else{
            Form::setFlash('info','Veuillez à bien remplir le formulaire');
        }

/*
        $usag = new Form;
        $usag->debutForm()
            ->ajoutLabel('usager','Nom de l\'usager :')
            ->ajoutInput('text','usager',['class'=>'form-control','placeholder'=>'Entrer l\'usager a ajouter ici'])
            ->ajoutLabel('type','Type usager :')
            ->ajoutSelect('type',['Entreprise'=>'Entreprise','Particulier'=>'Particulier'],['class'=>'form-control single','placeholder'=>'Entrer type usager ici'])
            ->ajoutLabel('contact','Contact :')
            ->ajoutInput('text','contact',['class'=>'form-control','placeholder'=>'Entrer le contact a ajouter ici','id'=>'contact'])
            ->ajoutLabel('email','Email :')
            ->ajoutInput('email','email',['class'=>'form-control','placeholder'=>'Entrer le mail a ajouter ici','id'=>'email'])
            ->ajoutLabel('adresse','Adresse usager :')
            ->ajoutInput('text','adresse',['class'=>'form-control','placeholder'=>'Entrer le mail a ajouter ici','id'=>'adresse'])
            ->ajoutBouton('Creer usager',['class'=>'btn btn-primary','name'=>'adr'])
            ->finForm();
            */
$dom = new DomainesModel;
$domaines = $dom->findAll();
            $this->Render('/usagers/ajouter',compact('domaines'),'admin');

    }


      public function modifier(int $id)
    {
        
       // l'utilisateur est connecté
       // //on va verifier si l'annonce exite dans la base
       $usagersModel = new UsagersModel;

       //on cherche l'annonce avec $id
       $usager = $usagersModel->requete("SELECT * FROM usagers,categories WHERE usagers.id=?",[$id])->fetch();//si l'annonce n'existe pas, on retourne ala liste des annonces
       if(!$usager){
        http_response_code(404);
        Form::setFlash('danger',"Le usager rechercher n'existe pas");
        header("Location: /usagers/liste_usagers");
        exit;
       }
       //on Verifie si l'utilisateur est propriétaire de l'annonce et admin
       
       # if($service->user_id !== $_SESSION['user']['id']){
           if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_USER'){
                 //On le renvoi a la page d'accueil
            Form::setFlash('danger',"Vous n'avez pas accès à cette page");
            header("Location: /usagers/liste_usagers");
            exit;
            }
          
      #  }
        // on traite le formulaire
         if (Form::Validate($_POST,['usager','type'])) {
             // on se protege contre les faille xss
             
             $usag = strtoupper(strip_tags($_POST['usager']));
             $type = $_POST['type'];
            $iddom = $_POST['domaine'];

             
             //on stocke l'annonce
          /*   $usagerModif = new UsagersModel;
             $usager = $usagerModif->find($id);
             //on hydrate le model
              $usagerModif->setId($usager->id)
                        ->setUsager($usag)
                        ->setTypeUsager($type)
                        ->setContact($contact)
                        ->setEmail($email)
                        ->setAdresse($adresse)
                        ->setUpdateAt($dates);

              //on met a jour l'annonce
              $usagerModif->Update();
*/
              if($type == 1)
                        {
          
             $contact = strtoupper(strip_tags($_POST['contact']));
               $email = strtoupper(strip_tags($_POST['email']));
             $adresse = strtoupper(strip_tags($_POST['adresse']));
             $dates = date('Y-m-d H:i:s');
                            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                          //on hydrate l'usager entreprise
                            $usagers = new UsagersModel;
                            $usagers->setId($id)
                                    ->setUsager($usag)
                                    ->setTypeUsager($type)
                                    ->setContact($contact)
                                    ->setEmail($email)
                                    ->setAdresse($adresse)
                                    ->setIdCat($iddom)
                                    ->setUpdateAt($dates);
                            $usagers->update();
                            }else{
                             Form::setFlash('danger',"Entrer un format d'email valide" );   
                            }
                        }else{
                            
             $contact = strtoupper(strip_tags($_POST['contact']));   
             $matricule = strip_tags($_POST['matricule']);
            $fonction = strip_tags($_POST['fonction']);
            $grade = strip_tags($_POST['grade']);
            $etab = strip_tags($_POST['etable']);
            $dateserv = $_POST['dateserv'];
             $dates = date('Y-m-d H:i:s');
             //var_dump($dates);
                            // on hydrate l'usage particulier
                            //on hydrate le service
                            $usagers = new UsagersModel;
                            $usagers->setId($id)
                                    ->setUsager($usag)
                                    ->setTypeUsager($type)
                                    ->setContact($contact)
                                    ->setMatricule($matricule)
                                    ->setFonction($fonction)
                                    ->setEtablissement($etab)
                                    ->setGrade($grade)
                                    ->setDateService($dateserv)
                                    ->setIdCat($iddom)
                                    ->setUpdateAt($dates);
                            $usagers->update();
                        }
              //On redirige vers les annonces
              Form::setFlash('success',"L'usager a été modifié avec succès");
            header("Location: /usagers/liste_usagers");
            exit;
         }
         $Usage = db::getInstance()->query("SELECT * FROM status");
         $listeUsagers = $Usage->fetchAll();
         //var_dump($usager);

/*

       $form = new Form;

            $form->debutForm();
            $form->ajoutLabel('usager','Nom de l\' usager ')
            ->ajoutInput('text','usager',[
                'id'=>'usager',
                'value' => $usager->usager,
                'class'=> 'form-control'
            ])
            ->ajoutbouton('Modifier',['class'=> 'btn btn-primary'])
            ->finForm();
*/
            //on envoie a la vue
            $dom = new DomainesModel;
            $domaines = $dom->findAll();
                        
            $this->Render('/usagers/modifier',compact('usager','listeUsagers','domaines'),'admin');
       
    }

public function supprimeUsager($id){


        if ($this->isAdmin()) {
            // on est Admin
            $usager = new UsagersModel;
            $usager->Delete($id);
          Form::setFlash('danger','Un usager a été supprimé!');

            header("Location: ".$_SERVER['HTTP_REFERER']);
        }
    
}

    
}





 ?>