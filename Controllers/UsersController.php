<?php 
namespace App\Controllers;

use App\Controllers\StrController;
use App\Core\Db;
use App\Core\Form;
use App\Models\DocumentsModel;
use App\Models\FichiersModel;
use App\Models\Rl_ServicesModel;
use App\Models\Rl_TypesModel;
use App\Models\TypesModel;
use App\Models\DirectionsModel;
use App\Models\UsersModel;
use App\Models\DossiersModel;
use App\Models\DomainesModel;
use PDO;

class UsersController extends Controller
{
	//$db = Db::getInstance();
	//liste des users active
	 public function users_active()
    {
        $usersModel = new UsersModel;
        // On va chercher toutes les annonces
        $users = $usersModel->findBy(["actif"=> 1]);
        //var_dump($annonces);
        //on hgenere la vue 
        $this->Render('users/users_active', compact('users'));
        
     //   echo"Ici sera la liste des annonces";
   // include_once ROOT.'/Views/annonces/index.php';
    }
    public function users_attente()
    {
        $usersModel = new UsersModel;
        // On va chercher toutes les annonces
        $users = $usersModel->findBy(["actif"=> 0]);
        //var_dump($annonces);
        //on hgenere la vue 
        $this->Render('users/users_attente', compact('users'));
        
     //   echo"Ici sera la liste des annonces";
   // include_once ROOT.'/Views/annonces/index.php';
    }
    public function liste_users()
  	{
		if ($this->isAdmin()) {
			//echo "vous    etes admin";
			
			$usersModel= new UsersModel;
			$users = $usersModel->findAllUse();
			 $this->Render('users/liste_users',compact('users'),'admin');
		}

	}
	public function supprimeUser(int $id){
		if ($this->isAdmin()) {
			// on est Admin
			$user = new UsersModel;
			$user->Delete($id);
			Form::setFlash('danger',"Un utilisateur a été supprimé");
			header("Location:".$_SERVER['HTTP_REFERER']);
		}
	}
	/**
 * [activer ou desactiver un user]
 * @param  int    $id 
 * @return void
 */
	public function activer($id)
	{
		if($this->isAdmin()){
			$usersModel = new UsersModel;
$dates = date('Y-m-d H:i:s');
			$userArray = $usersModel->find($id);
			if($userArray){
				$user = $usersModel->hydrate($userArray);

				//equivalent 
				if($user->getActif()){
					$user->setActif(0);
					$user->setUpdateAt($dates);
				}else{
					$user->setActif(1);
					$user->setUpdateAt($dates);
				}
				//$annonce->setActif($annonce->getActif() ? 0 : 1);
				$user->update();
			}
		}
	}
	public function remember($user_id){
        $remember_token = StrController::random(60);
        $users = new UsersModel;
        $users->requete("UPDATE users SET remember_token = ? WHERE id = ?",[$remember_token, $user_id]);
        setcookie('remember',$user_id.'=='.$remember_token.sha1($user_id.'killer'),time() +(60 * 60 * 24 * 7));

    }
    public function Connect_from_cookie(){

        if(isset($_COOKIE['remember']) && $_SESSION['user']){

            $remember_token = $_COOKIE['remember'];
            $parts = explode('==',$remember_token);
            $user_id = $parts[0];
            $users = new UsersModel;
            $user = $users->requete("SELECT * FROM users WHERE id = ?",[$user_id])->fetch();
            if($user){
                $expected = $user_id.'=='.$user->remember_token. sha1($user_id.'killer');
                if($expected == $remember_token){
                   $user->setSession();
                    #header("Location:account.php");
                    setcookie('remember',$remember_token,time() +(60 * 60 * 24 * 7));
                }else{
                    setcookie('remember',null,-1);
                }
            }else{
                setcookie('remember',null,-1);
            }
        }

    }
    public function checkResetToken($user_id,$token){
    	$users = new UsersModel;
        return $users->requete('SELECT * FROM users WHERE id = ? AND token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)',[$user_id,$token])->fetch();

    }
    // page de login
	public function login()
	{
	//On verifie si le formulaire est complet
	 if(Form::Validate($_POST,['email','password'])){
	 	//le formulaire est complet
         // On initialise la variable remember
         $remember = false;
	 	//on va chercher dans la base l'utilisateur avec l'email entré
	 	if(isset($_POST['remember'])){
	 		$remember = $_POST['remember'];	
	 	}
	 	
	 	$userModel = new UsersModel;

	 	$userArray = $userModel->findOneByEmail(strip_tags($_POST['email']));
	 	//var_dump($userArray);
	 	//si l'utilisateur n'exite pas
	 	if(!$userArray){
	 		//On envoie un message de session
	 		//$_SESSION['erreur'] = "L'adresse email et/ou le mot de passe est incorrect";
	 		Form::setFlash('danger',"L'adresse email et/ou le mot de passe incorrect");
	 		header('Location:/users/login');
	 		exit;
	 	}
	 	//l'utilisateur existe
	 	 $user = $userModel->hydrate($userArray);

	 	 //var_dump($user);
	 	 //var_dump($user->getPassword());
	 	 //On verifie si le mot de passe est correct
	 	 
	 	 if (password_verify($_POST['password'], $user->getPassword())) {
	 	 	// le mot de passe est bon
	 	 	// On creer la session
	 	 	 if($user->getActif()==1){
	 	 	 	$_SESSION['last_login_timestamp']= time();
	 	 	 	
	 	 	$user->setSession();
	 	 	if($remember){
                $this->remember($user->getId());
               }
	 	 	header("Location:/users/account");
	 	 	Form::setFlash('success',"Vous etes maintenat connecté");
	 	 	exit;
	 		 }else{
	 		 	Form::setFlash('danger',"Votre compte a été désactivé");
	 	 		 	 	header('Location: /users/login');
	 		 }
	 	 		
	 	 
	 	 	
	 	 }else{
	 	 	//Mauvais mot de passe
 		Form::setFlash('danger',"L'adresse email et/ou le mot de passe est incorrect");
 		header('Location:/users/login');
 		exit;

	 	 }
	 }

		$form = new Form; 
		
		$form->debutForm()
			 ->ajoutFormGroup(['class'=>'form-group'])
			 ->ajoutInput('text','email',['class'=> 'form-control','id'=>'email','placeholder'=>'Entrer votre email ou login...'])
			 ->finFormGroup()
			 ->ajoutFormGroup(['class'=>'form-group'])
			 ->ajoutInput('password','password',['id'=>'pass','class'=>'form-control','placeholder'=>'***************'])
			 ->finFormGroup()
			 ->ajoutCheckbox('remember','Se souvenir de moi')
			 ->ajoutBouton('Me Connecter',['class'=>'btn btn-primary'])
			 ->finForm();
//echo $form->Create();
			 //var_dump($form);
			$this->Render('users/login', ['loginForm'=> $form->Create()],'default');


	}

	public function register(){
		//var_dump($_POST);
		
		
		if (Form::Validate($_POST,['matricule','nom','prenom','fonction','domaine','contact','email','login','password','conf_password'])) {
			//le formulaire est valide
			$mat = strtoupper(($_POST['matricule']));
			$nom = strtoupper(strip_tags($_POST['nom']));
			$prenom = strtoupper(strip_tags($_POST['prenom']));
			$fonction = strtoupper(strip_tags($_POST['fonction']));
			$direction = strtoupper($_POST['direction']);
			$types = $_POST['domaine'];
			$contact = strip_tags($_POST['contact']);
			$login = strip_tags($_POST['login']);
			$data = "ROLE_USER";
			$token = StrController::random(60);
			//on nettoie l'adresse mail
			$email = strip_tags($_POST['email']);
			//on chiffre le mot de passe
			$pass = password_hash($_POST['password'], PASSWORD_ARGON2I);
			//var_dump($service);exit;
			if (Form::Validate_Number($contact)) {
				 $req= "select * FROM users WHERE contact=?";

                $exe = Db::getInstance()->prepare($req);
                $exe->execute([$contact]);
                $verif = $exe->fetch();
                 //verirfie si le contact existe
                    if(!$verif){
						// code...
				if (Form::Validate_Email($email)) {
					$req= "select * FROM users WHERE email=?";

                $exe = Db::getInstance()->prepare($req);
                $exe->execute([$email]);
                $verif = $exe->fetch();
                 //verirfie si le contact existe
                    if(!$verif){
				$req= "select * FROM users WHERE login=?";
                $log = Db::getInstance()->prepare($req);
                $log->execute([$login]);
                $veriflog = $log->fetch();
                 if(!$veriflog){
					if (Form::Validate_Password($_POST['password'],$_POST['conf_password'])) {
						// code...
					
                    //on insert le service
							$user = new UsersModel;
							$user->setMatricule($mat)
								 ->setNom($nom)
								 ->setPrenom($prenom)
								 ->setFonction($fonction)
								 ->setContact($contact)
								 ->setEmail($email)
								 ->setDirection($direction)
								 ->setLogin($login)
								 ->setPassword($pass)
								 ->setRoles($data)
								 ->setRememberToken($token);
							$user->Create();
							//on recupere la dernier insertion de l'user
							$db = Db::getInstance();
							$last_id = $db->lastInsertId();



							//on insert les differents services
							foreach($types as $type):
								$rltypeModel = new Rl_TypesModel;

								$rltypeModel->setIdUser($last_id)
											->setIdType($type);

								$rltypeModel->Create();

							endforeach;

							Form::setFlash('success','Un utilisateur à été crée avec succès');
						}else{
							Form::setFlash('danger','Mots de passes non identiques');

						}
					}else{
					Form::setFlash('danger','Login déjà utilisé');

					}
					}else{
						Form::setFlash('danger','Email déjà utilisé');

					}

						}else{
							Form::setFlash('danger','Email non valide');

						}
					}else{
							Form::setFlash('danger','Contact déja utilsé');
						}
							}
						else{
							Form::setFlash('danger','Contact non valide');
						}
								

				/*if (Form::Validate_Number($_POST['contact'])) {
					if(Form::Validate_Email($_POST['email'])){
						if (Form::Validate_Password($_POST['password'])) {
							$user = new UsersModel;

							$user->setNom($nom)
								 ->setPrenom($prenom)
								 ->setContact($pass)
								 ->setEmail($email)
								 ->setPassword($password);
							$user->Create();


						}else{
							return false;
						}
				}else{
					return false;
				}
				}else{
					return false;
				}*/
				


		}else{
			Form::setFlash('info','Veuillez à bien remplir le formulaire');
		}
		

        

      // var_dump($services);
		$form = new Form; 
		
		$form->debutForm()
		 	->ajoutInput('text','matricule',['class'=> 'form-control','id'=>'matricule','placeholder'=>'Entrer votre Matricule ...'])
			 ->ajoutInput('text','nom',['class'=> 'form-control','id'=>'nom','placeholder'=>'Entrer votre Nom ...'])
			 ->ajoutInput('text','prenom',['class'=> 'form-control','id'=>'prenom','placeholder'=>'Entrer votre prenom ...'])
			  ->ajoutInput('text','fonction',['class'=> 'form-control','id'=>'fonction','placeholder'=>'Entrer votre fonction ...'])
			  ->ajoutSelectServ('direction',['class'=> 'form-control'])
			  ->ajoutLabel('damaine','Domaine de Gestion')
			 ->ajoutSelectDom('domaine[]',['class'=> 'form-control single','required'=>'required'],'multiple')
			 ->ajoutInput('number','contact',['class'=> 'form-control','id'=>'contact','placeholder'=>'Entrer votre contact ...'])
			 ->ajoutInput('email','email',['class'=> 'form-control','id'=>'email','placeholder'=>'Entrer votre email ...'])
			 ->ajoutInput('text','login',['class'=> 'form-control','id'=>'login','placeholder'=>'Entrer votre login ...'])
			 ->ajoutInput('password','password',['id'=>'pass','class'=>'form-control','placeholder'=>'***************'])
			 ->ajoutInput('password','conf_password',['id'=>'pass1','class'=>'form-control','placeholder'=>'***************'])
			 ->ajoutBouton('M\'inscrire',['class'=>'btn btn-primary'])
			 ->finForm();
//echo $form->Create();
			 //var_dump($form);
			$this->Render('users/register', ['registerForm'=> $form->Create()],'admin');
	}

	//Modifier un utilisateur
	
	 public function modifier(int $id)
    {
         if($this->isAdmin()){
       // l'utilisateur est connecté
       // //on va verifier si l'annonce exite dans la base
       $usersModel = new UsersModel;

       //on cherche l'annonce avec $id
       $user = $usersModel->find($id);//si l'annonce n'existe pas, on retourne ala liste des annonces
       if(!$user){
        http_response_code(404);
        Form::setFlash('danger',"L'utilisateur rechercher n'existe pas");
        header("Location:/users/account");
        exit;
       }
       //on Verifie si l'utilisateur est propriétaire de l'annonce et admin
       
      /*  if($user->id !== $_SESSION['user']['id']){
            if($_SESSION['user']['roles'] !== 'USER_ADMIN'){
                 //On le renvoi a la page d'accueil
            Form::setFlash('danger',"Vous n'avez pas accès à cette page");
            header("Location: /users/account");
            exit;
            }
          
        }*/
        // on traite le formulaire
         if (Form::Validate($_POST,['matricule','nom','prenom','fonction','direction','contact','email','login','domaine'])) {
             // on se protege contre les faille xss
             $nom = strtoupper(strip_tags($_POST['nom']));
             $prenom = strtoupper(strip_tags($_POST['prenom']));
             $fonction = strtoupper(strip_tags($_POST['fonction']));
             $direction = strtoupper($_POST['direction']);
             $types = $_POST['domaine'];
             $contact = strip_tags($_POST['contact']);
             $email = strip_tags($_POST['email']);
             $login = strip_tags($_POST['login']);
             $matricule = strtoupper(strip_tags($_POST['matricule']));
             $dates= date('Y-m-d H:i:s');
             //on stocke l'annonce
             $userModif = new UsersModel;
             //on hydrate le model
                       $userModif->setId($user->id)
              					 ->setMatricule($matricule)
								 ->setNom($nom)
								 ->setPrenom($prenom)
								 ->setFonction($fonction)
								 ->setContact($contact)
								 ->setEmail($email)
								 ->setDirection($direction)
								 ->setLogin($login)
								 ->setUpdateAt($dates);
							
              //on met a jour l'annonce
              $userModif->update();
              //on insert les differents services
              $rltypeModel = new Rl_TypesModel;
              // on supprime le(s) ancien(s) service(s)
              // 
              $deleteserv = $rltypeModel->requete("DELETE FROM rl_types WHERE id_user=?",[$user->id]); 
							foreach($types as $type):
								
								$rltypeModel->setIdUser($user->id)
											->setIdType($type);

								$rltypeModel->Create();

							endforeach;
              //On redirige vers les annonces
              Form::setFlash('success'," Un utilisateur a été modifiée avec succès");
            header("Location:/users/liste_users");
            exit;
         }//else{
            //l'utilisateur n'a pas rempli tous les champs
            Form::setFlash('danger','Vous devez remplir tous les champs du formulaire!');
            //header("Location:/users/login");
            //exit;
        //}
         $directionModel = new DirectionsModel;
         $directions = $directionModel->requete('SELECT * FROM services ORDER BY designation asc')->fetchAll();

         $typModel = new DomainesModel;
         $typesusers = $typModel->requete('SELECT * FROM categories order by designation asc')->fetchAll();
         $typoModel = new Rl_TypesModel;
         $typologies = $typoModel->requete('SELECT id_type FROM rl_types WHERE id_user=? ',[$id])->fetchAll(PDO::FETCH_ASSOC);

         $valeur="";

/*
       $form = new Form;

            $form->debutForm();
            $form->ajoutLabel('matricule','Matricule ')
            ->ajoutInput('text','matricule',[
                'id'=>'matricule',
                'value' => $user->matricule,
                'class'=> 'form-control'
            ])
            ->ajoutLabel('nom','Nom')
            ->ajoutInput('text','nom',[
                'id'=>'matricule',
                'value' => $user->nom,
                'class'=> 'form-control'
            ])
            ->ajoutLabel('prenom','Prenom')
            ->ajoutInput('text','prenom',[
                'id'=>'prenom',
                'value' => $user->prenom,
                'class'=> 'form-control'
            ])
            ->ajoutLabel('fonction','Fonction')
            ->ajoutInput('text','fonction',[
                'id'=>'matricule',
                'value' => $user->fonction,
                'class'=> 'form-control'
            ])
            ->ajoutLabel('service','Service')
            ->ajoutSelectServ('service[]',['class'=> 'form-control'])
             ->ajoutLabel('contact','Contact')
			 ->ajoutInput('number','contact',['class'=> 'form-control','id'=>'contact','value' => $user->contact,'placeholder'=>'Entrer votre contact ...'])
			  ->ajoutLabel('email','Email')
			 ->ajoutInput('email','email',['class'=> 'form-control','value' => $user->email,'id'=>'email','placeholder'=>'Entrer votre email ...'])
			->ajoutLabel('login','Login')
			 ->ajoutInput('text','login',['class'=> 'form-control','value' => $user->login,'id'=>'login','placeholder'=>'Entrer votre login ...'])
            ->ajoutbouton('Modifier',['class'=> 'btn btn-primary'])
            ->finForm();
            */
            //var_dump($user->id);

            //on envoie a la vue
           // var_dump(gettype($typologies));
            $this->Render('/users/modifier', compact('user','directions','typesusers','typologies'),'admin');
       }else{
            //l'utilisateur n'est pas connecté
            Form::setFlash('danger','Vous devez etre connecté pour accéder à cette page!');
            header("Location:/users/login");
            exit;
        }
    }
	/**
	 * Deconnexion de user
	 * @return [type] [description]
	 */
	public function logout(){
		unset($_SESSION['user']);		
		//setcookie('remember', NULL, -1);
        setcookie('remember', '', time() - 3600);
		header("Location:/users/login");
		//header("Location: ".$_SERVER['HTTP_REFERER']);
		Form::setFlash('success','Vous etes maintenant déconnecté');
		exit;
	}
	public function account(){


  		if($this->isUser()){
  			$userAccount = new UsersModel;
  			$userAccounts= $userAccount->find($_SESSION['user']['id']);
  			$countUser = $userAccount->requete("SELECT * FROM users WHERE actif=1");
  			$countUsers = $countUser->rowCount();
  			$servicereq = new DossiersModel;
  			$countSer = $servicereq->requete("SELECT * FROM dossiers");
  			$countServ = $countSer->rowCount();
  			$doc = new DocumentsModel;
  			$countDo = $doc->requete("SELECT * FROM documents WHERE actif=1");
  			$countDoc = $countDo->rowCount();
  			$file = new FichiersModel;
  			$countFil = $file->requete("SELECT * FROM fichiers WHERE actif=1");
  			$countFile = $countFil->rowCount();

  			

  			
  			  $this->Render('users/account', compact('userAccounts','countUsers','countFile','countServ','countDoc'),'admin');
  			}else{
  				Form::setFlash('danger',"Vous n'avez pas accès à cette page");
			header("Location: /users/login");
			exit;
  			}
	}

	public function isUser(){

		//On verifie si on est connecté et si "ROLE_ADMIN" est dans mon role
		if(isset($_SESSION['user'])){
			//on est admin
			return true;
		}else{
			//On est pas admin
			Form::setFlash('danger',"Vous n'avez pas accès à cette page");
			header("Location: /users/login");
			exit;
		}
	}
 // Changer le mot de passe
	public function change_password(int $id){
		if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])){
       // l'utilisateur est connecté
       // //on va verifier si l'annonce exite dans la base
       $usersModel = new UsersModel;

       //on cherche l'annonce avec $id
       $user = $usersModel->find($id);//si l'annonce n'existe pas, on retourne ala liste des annonces
       if(!$user){
        http_response_code(404);
        Form::setFlash('danger',"L'utilisateur rechercher n'existe pas");
        header("Location: /users/account");
        exit;
       }
       //on Verifie si l'utilisateur est propriétaire de l'annonce et admin
       
        if($user->id !== $_SESSION['user']['id']){
            if($_SESSION['user']['roles'] != 'USER_ADMIN'){
                 //On le renvoi a la page d'accueil
            Form::setFlash('danger',"Vous n'avez pas accès à cette page");
            header("Location: /users/account");
            exit;
            }
          
        }
        // on traite le formulaire
         if (Form::Validate($_POST,['password','confirmepass'])) {
             // on se protege contre les faille xss
             $password = strip_tags($_POST['password']);
             $conf_pass = strip_tags($_POST['confirmepass']);
             $dates= date('Y-m-d H:i:s');
             if(Form::Validate_Password($_POST['password'],$_POST['confirmepass'])) {
             	$pass = password_hash($_POST['password'], PASSWORD_ARGON2I);
             //on stocke l'annonce
             $userModif = new UsersModel;
             //on hydrate le model
                       $userModif->setId($user->id)
              					 ->setPassword($pass)
								 ->setUpdateAt($dates);

              //on met a jour l'annonce
              $userModif->Update();
              //On redirige vers les annonces
              Form::setFlash('success'," le mot de passe utilisateur a été modifiée avec succès");
            header("Location: /users/liste_users");
            exit;
        }else{
         Form::setFlash('danger'," Mots de passes non identiques");
        }
         }

         $valeur="";


       $form = new Form;

            $form->debutForm();
            $form->ajoutLabel('pass','Mot de passe ')
            ->ajoutInput('password','password',[
                'id'=>'pass',
                'class'=> 'form-control',
                'placeholder'=>'*************************'
            ])
            ->ajoutLabel('confpass','Confirme mot de passe')
            ->ajoutInput('password','confirmepass',[
                'id'=>'confpass',
                'class'=> 'form-control',
                'placeholder'=>'*************************'
            ])
            ->ajoutbouton('Modifier',['class'=> 'btn btn-primary'])
            ->finForm();
            //var_dump($user->id);

            //on envoie a la vue
            
            $this->Render("/users/change_password", ['ChangeForm' => $form->Create()]);
       }else{
            //l'utilisateur n'est pas connecté
            Form::setFlash('danger','Vous devez etre connecté pour accéder à cette page!');
            header("Location: /users/login");
            exit;
        }
	}



    public function attribuer_roles(){

//INSERTION DUN SERVICE
        
if (Form::Validate($_POST,['role','id'])) {

     //var_dump($_POST['']);
            //le formulaire est valide
            $role = strip_tags($_POST['role']);
            $util = strip_tags($_POST['id']);
           // var_dump($role);
              $db = db::getInstance();
                        // code...
                $req= "select * FROM users WHERE roles=?";

                $exe = $db->prepare($req);
                $exe->execute([$role]);
                $verif = $exe->fetch();
               // var_dump($role,$verif->roles);die();
               // var_dump($util);die();
               $dates = date('Y-m-d H:i:s');
 		 	  
   			 
                    //on insert le service   
                    if($verif->roles){
                          //on hydrate le service
                          $userModel = new UsersModel;  
                            $userModel->setRoles($role);
                            $userModel->setid($util);
                            $userModel->setUpdateAt($dates);
                            $userModel->update();

                            Form::setFlash('success',"Un role vient d'etre attribuer à un utilisateur" );
                            header('Location: /users/liste_users');
                            exit;

                        } 
                        else{
                         Form::setFlash('danger',"Cet utilisateur avait ce role" );
                         //header("Location: /roles/liste_roles");   
                        }
                        }           

        else{
            Form::setFlash('info','Veuillez à bien remplir le formulaire');
        }

     // $usersModel = new UsersModel;
 		//$users = $usersModel->findAll();

        $roller = new Form;
       // $json_code = ['ROLE_USER'=>'Utilisateur','ROLE_ADMIN'=>'Administrateur'];
        //$json = json_encode($json_code);
        $roller->debutForm()
            ->ajoutLabel('use','Nom Utilisateur')
            ->ajoutSelectUser('id',['class'=>'form-control single','id'=>'use'])
            ->ajoutLabel('droit','Droit')
            //->ajoutSelect('role',['ROLE_USER'=>'Utilisateur','ROLE_ADMIN'=>'Administrateur'],['class'=>'form-control','id'=>'droit'])
            ->ajoutSelectRole('role',['class'=>'form-control single','id'=>'droit'])

            ->ajoutBouton('Attribuer le role',['class'=>'btn btn-primary','name'=>'serv'])
            ->finForm();

            $this->Render('/users/attribuer_roles',['attribuerForm'=> $roller->Create()],'admin');

    }

    public function forgot_password()
    {
    	if(Form::Validate($_POST,['email'])){
    		$email =$_POST['email'];
    		if (Form::Validate_Email($email)) {
					$req= "select * FROM users WHERE email=?";
				$users = new UsersModel;
        		$exe = $users->requete($req,[$email]);
                $verif = $exe->fetch();
                 //verirfie si le contact existe
                    if($verif == 1){
                    	header('location: /users/reini_password/'.$verif->id);
                    	exit;
                    }else{
                   Form::setFlash('danger',"Vous n'avez pas de compte sur notre plateforme");  	
                    }
                }
    	}else{
    		//$roller = new Form;
       // $json_code = ['ROLE_USER'=>'Utilisateur','ROLE_ADMIN'=>'Administrateur'];
        //$json = json_encode($json_code);
        //$roller->debutForm()
          //  ->ajoutLabel('email','Email')
           // ->ajoutInput('email','email',['class'=>'form-control','id'=>'email','placeholder'=>'Entrer votre adresse email ...'])
           // ->ajoutBouton('Vérification',['class'=>'btn btn-success'])
          //  ->finForm();

            
    	}
    	$this->Render('/users/forgot_password',[],'default');
     
    }
    public function reini_password($user_id){

    	   // on traite le formulaire
         if (Form::Validate($_POST,['password','conf_password'])) {

         		
        
             //on stocke l'annonce4
             if (Form::Validate_Password($_POST['password'],$_POST['conf_password'])) {
             	     // on se protege contre les faille xss
            $pass = password_hash($_POST['password'], PASSWORD_ARGON2I);
             $dates= date('Y-m-d H:i:s');
             $userModif = new UsersModel;
             //on hydrate le model
                       $userModif->setId($user_id)
								 ->setPassword($pass)
								 ->setUpdateAt($dates);
              //on met a jour l'annonce
              $userModif->Update();
              //On redirige vers les annonces
              Form::setFlash('success'," Votre mot de passe a été modifiée avec succès");
            header("Location: /users/login");
            exit;
        }else{
        	 Form::setFlash('danger',"Mot de passes non conforment");

        }

    	
    }
    $this->Render("/users/reini_password",[],'default');
}

public function signature(){

	if(Form::Validate($_POST,['signed'])){
		$folderPath = "uploads/signature/";
		$image_parts = explode(";base64,",$_POST['signed']);
		$image_type_aux = explode("image/", $image_parts[0]);
		$image_type = $image_type_aux[1];
		$image_base64 = base64_decode($image_parts[1]);
		$fichier=uniqid().'.'.$image_type;
		$file = $folderPath.uniqid().'.'.$image_type;

		$user = new UsersModel;
		$use = $user->requete("UPDATE users SET signature=? WHERE id=?",[$fichier,$_SESSION['user']['id']]);
		file_put_contents($file, $image_base64);

		Form::setFlash('success','Signature ajouté avec succès');
		header("Location:".$_SERVER['HTTP_REFERER']);
	}
	$this->Render('/users/signature',[],'admin');
}


}

 ?>