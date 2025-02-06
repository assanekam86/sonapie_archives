<?php
namespace App\Controllers;

use App\Core\Form;
use App\Models\AnnoncesModel;

class AnnoncesController extends Controller
{
    /**
         * Cette methode affichera une page listant toutes les annonces de la base
         * @return void 
         */
    public function index()
    {
        $annoncesModel = new AnnoncesModel;
        // On va chercher toutes les annonces
        $annonces = $annoncesModel->findBy(["actif"=> 1]);
        //var_dump($annonces);
        //on hgenere la vue 
        $this->Render('annonces/index', compact('annonces'));
        
     //   echo"Ici sera la liste des annonces";
   // include_once ROOT.'/Views/annonces/index.php';
    }
    /**
     * Affiche une annonce
     * @param  int    $id [id de l'annonce]
     * @return void
     */
    public function lire(int $id){
        //oninstancie le modele 
        $annoncesModel = new AnnoncesModel;
        // on va cherche 1 annonce
        $annonce = $annoncesModel->find($id);
        //on envoie a la vue
        $this->Render('annonces/lire',compact('annonce'));
    }
/**
 * Ajouter une annonce 
 * @return void
 */
    public function ajouter()
    {
        // on verifie sur l'utilisateur est connecter
        if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])){
       // l'utilisateur est connecté
       //On verifie si le formulaire est complet
       
       if (Form::Validate($_POST,['titre','description'])) {
           //on recupere les variables
           $titre = strip_tags($_POST['titre']);
           $desc = strip_tags($_POST['description']);
           //On instancie notre modele
           $annonce = new AnnoncesModel;


           //On hydrate
        $annonce->setTitre($titre)
        ->setDescription($desc)
        ->setUserId($_SESSION['user']['id']); 
        $users = $annonce->Create();
        Form::setFlash('success','Une annonce a été enregistré avec succès');
        header('Location: /');
        exit;
       }else{
        //Formulaire incomplet
       !empty($_POST)? Form::setFlash('info','Veuillez à bien remplir le formulaire') :'';
      
       $titre = isset($_POST['titre'])? strip_tags($_POST['titre']): '';
       $desc = isset($_POST['description'])? strip_tags($_POST['description']): '';
       }
            $form = new Form;

            $form->debutForm();
            $form->ajoutLabel('titre','Tritre de l\'annonce ')
            ->ajoutInput('text','titre',['id'=>'titre',
                'value'=> $titre,
                'class'=> 'form-control'])
            ->ajoutLabel('description','Texte de l\'annonce')
            ->ajoutTextarea('description',$desc,['id'=>'description','class'=> 'form-control','placeholder'=>'Entrer la description ...'])
            ->ajoutbouton('Ajouter',['class'=> 'btn btn-primary'])
            ->finForm();

            $this->Render('/annonces/ajouter',['form'=> $form->Create()]);

        }else{
            //l'utilisateur n'est pas connecté
            Form::setFlash('danger','Vous devez etre connecté pour accéder à cette page!');
            header("Location: /users/login");
            exit;
        }
    }

    public function modifier(int $id)
    {
         if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])){
       // l'utilisateur est connecté
       // //on va verifier si l'annonce exite dans la base
       $annoncesModel = new AnnoncesModel;

       //on cherche l'annonce avec $id
       $annonce = $annoncesModel->find($id);//si l'annonce n'existe pas, on retourne ala liste des annonces
       if(!$annonce){
        http_response_code(404);
        Form::setFlash('danger',"L'annonce rechercher n'existe pas");
        header("Location: /annonces");
        exit;
       }
       //on Verifie si l'utilisateur est propriétaire de l'annonce et admin
       
        if($annonce->user_id !== $_SESSION['user']['id']){
            if(!in_array('ROLE_ADMIN', $_SESSION['user']['roles'])){
                 //On le renvoi a la page d'accueil
            Form::setFlash('danger',"Vous n'avez pas accès à cette page");
            header("Location: /annonces");
            exit;
            }
          
        }
        // on traite le formulaire
         if (Form::Validate($_POST,['titre','description'])) {
             // on se protege contre les faille xss
             $titre = strip_tags($_POST['titre']);
             $descrip = strip_tags($_POST['description']);
             //on stocke l'annonce
             $annonceModif = new AnnoncesModel;
             //on hydrate le model
              $annonceModif->setId($annonce->id)
              ->setTitre($titre)
              ->setDescription($descrip);

              //on met a jour l'annonce
              $annonceModif->Update();
              //On redirige vers les annonces
              Form::setFlash('success',"Votre annonce à été modifiée avec succès");
            header("Location: /annonces");
            exit;
         }



       $form = new Form;

            $form->debutForm();
            $form->ajoutLabel('titre','Tritre de l\'annonce ')
            ->ajoutInput('text','titre',[
                'id'=>'titre',
                'value' => $annonce->titre,
                'class'=> 'form-control'
            ])
            ->ajoutLabel('description','Texte de l\'annonce')
            ->ajoutTextarea('description',strip_tags($annonce->description),[
                'id'=>'description',
                'class'=> 'form-control',
                'placeholder'=>'Entrer la description ...'
            ]) 
            ->ajoutbouton('Modifier',['class'=> 'btn btn-primary'])
            ->finForm();

            //on envoie a la vue
            
            $this->Render('/annonces/modifier', ['form' => $form->Create()]);
       }else{
            //l'utilisateur n'est pas connecté
            Form::setFlash('danger','Vous devez etre connecté pour accéder à cette page!');
            header("Location: /users/login");
            exit;
        }
    }
} 