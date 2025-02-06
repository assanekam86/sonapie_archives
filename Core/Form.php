<?php 

namespace App\Core;

use App\Models\RolesModel;
use App\Models\ServicesModel;
use App\Models\VillesModel;
use App\Models\SallesModel;
use App\Models\DirectionsModel;
use App\Models\DomainesModel;
use App\Models\EtageresModel;
use App\Models\BoitesModel;
use App\Models\RayonsModel;
use App\Models\UsersModel;
use App\Models\TypesModel;

class Form
{
	private $formCode='';

    /**
     * Genere le formulaire HTML
     * @return string
     */
    public function Create()
    {
        return $this->formCode;
    }
    /**
     * validation si tous les champs sont remplis
     * @param array $form   tableau issu du formulaire
     * @param array $champs tableau listant des champs obligatoires
     * @return bool
     *  
     */
    public static function Validate(array $form, array $champs)
    {
    	//on parcours les champs
    	foreach ($champs as $champ) {
    		// si le champs est absent ou vide dans le formulaire
    	
    		if(!isset($form[$champ]) || empty($form[$champ])){
    			//on sort en reournant false
    			return false;
    		}
    	}
   	    		return true;

    }

    public static function Validate_Email(string $email)
    {
        
        
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                //on sort en reournant false
                return false;
            }
            return true;    
            
    }

    public static function Validate_Number(string $cont)
    {
        
        
            if(!ctype_digit($cont)){
                //on sort en reournant false
                return false;
            }
            return true;    
            
    }
/**
 * Verification de l'unicite des mots de passe
 * @param array $pass variable password
 */
    public static function Validate_Password(string $pass,string $pass2)
    {
        
        
            if($pass !== $pass2 ){
                //on sort en reournant false
                return false;
            }
            return true;    
            
    }
    /**
     * Ajoute les attributs envoyes a la balise
     * @param  array  $attributs tableau associatif['class' =>'form-control','required'=>'true']
     * @return string chaine de caractere generée
     */
    private function ajoutAttributs(array $attributs): string
    {
    	//on initialise une chaine de caractere
    	 $str = '';

    	 //on liste les attributs "courts"
    	 $courts=['checked','disabled','readonly','multiple','autofocus','novalidate','formnovalidate','required'];
    	 //on boucle sur le tableau d'attributs
    	
    	foreach ($attributs as $attribut => $valeur) {
    		// si l'attribut est dans la liste des attributs courts
    		if (in_array($attribut, $courts) && $valeur == true) {
    			// code...
    			$str.="attribut";
    		}else{
    			//on ajoute attribut="valeur"
    			
    			$str.="$attribut=\"$valeur\"";
    		}
    	}

    	 return $str;

    }
    /**
     * Balise d'ouverture du formulaire
     * @param  string $methode   methode du formulaire
     * @param  string $action    action de formulaire
     * @param  array  $attributs les attributs dans les balises
     * @return Form  
     */
    public function debutForm(string $methode='post',string $action='#', array $attributs=[]): self
    {

    	//on cree la balise form
    	$this->formCode.= "<form action='$action' method='$methode'";
    	//on ajoute les attributs eventuels
    	
    		$this->formCode .= $attributs ? $this->ajoutAttributs($attributs).'>' : '>';
    	
    	return $this;


    }
    /**
     * Balise de fermeture du formulaire
     * @return [type] [description]
     */
    public function finForm(): self
    {
    	$this->formCode.= '</form>';

    	return $this;
    }

    /**
     * Ajout de label
     * @param  string $for for du label       [description]
     * @param  string $texte    la valeur entre la balise label
     * @param  array  $attributs les attributs de label
     * @return self            [description]
     */
    public function ajoutLabel(string $for, string $texte,array $attributs =[]): self
    	{
    		//on ouvre la balise
    		$this->formCode.= "<p class='form-group'><label for='$for'";
    		//on ajoute les attributs
    		$this->formCode.= $attributs ? $this->ajoutAttributs($attributs) : '';

    		//on ajoute le texte
    		$this->formCode.= ">$texte</label>";


    		return $this;
    	}
        public function ajoutFormGroup(array $attributs =[]): self
        {
            //on ouvre la balise
            $this->formCode.= "<div ";
            //on ajoute les attributs
            $this->formCode.= $attributs ? $this->ajoutAttributs($attributs) : '';

            //on ajoute le texte
            $this->formCode.= ">";


            return $this;
        }

        public function finFormGroup(): self
        {
            $this->formCode.= "</div>";

            return $this;
        }

        public function ajoutCheckbox(string $name,string $texte): self
        {
            $this->formCode.="<div class='form-group'>
                      <div class='custom-control custom-checkbox small'>
                        <input type='checkbox' value='1' class='custom-control-input' id='customCheck' name='$name'>
                        <label class='custom-control-label' for='customCheck'>$texte</label>
                      </div>
                    </div>";
            return $this;
        }
    public function ajoutInput(string $type, string $nom, array $attributs = []): self
    {
        //On ouvre la balise
        $this->formCode .= "<input type='$type' name='$nom'";
        // on ajoute les attributs
        $this->formCode.= $attributs ? $this->ajoutAttributs($attributs).'></p>' : '></p>';

        return $this;
    }

    public function ajoutTextarea(string $nom,string $valeur='', array $attributs = []){
        //on ouvre la balise
        $this->formCode.= "<textarea name='$nom'";
            //on ajoute les attributs
            $this->formCode.= $attributs ? $this->ajoutAttributs($attributs) : '';

            //on ajoute le texte
            $this->formCode.= ">$valeur</textarea></p>";


            return $this;
    }

    public function ajoutSelect(string $nom, array $option,array $attributs = []): self
    {
        //on cree le select
        $this->formCode.= "<select name='$nom'";
        //on ajoute les attributs
        $this->formCode.= $attributs ? $this->ajoutAttributs($attributs).'>': '>';
        // on ajoute les options
        foreach ($option as $valeur => $texte) {
            $this->formCode.="<option value=\"$valeur\">$texte</option>";            // code...
        }
        //on ferme le select
        $this->formCode.= "</select></p>";
                return $this; 
    }

    public function ajoutSelectServ(string $nom,array $attributs = []): self
    {
        //$use = new UsersModel;
       //$uses = $use->find($id);
        //On instancie service
        $servicesModel = new DirectionsModel;
        // On va chercher toutes les service
        $services = $servicesModel->requete("SELECT * FROM services ORDER BY designation asc")->fetchAll();
        //on cree le select
        $this->formCode.= "<select name='$nom'";
        //on ajoute les attributs
        $this->formCode.= $attributs ? $this->ajoutAttributs($attributs).'>': '>';
        // on ajoute les options
        $this->formCode.="<option value=''>Choisir la Direction</option>";
        foreach ($services as $valeur) {
            $this->formCode.="<option value=\"$valeur->id\" "; 
          //  $this->formCode.= $valeur->id == $uses->id_service ?'selected':'' ;   
            $this->formCode.=" >$valeur->designation</option>";        // code...
        }
        //on ferme le select
        $this->formCode.= "</select></p>";
                return $this; 
    }

     public function ajoutSelectTypes(string $nom,array $attributs = [],string $multiple=""): self
    {
        //$use = new UsersModel;
       //$uses = $use->find($id);
        //On instancie service
        $typesModel = new TypesModel;
        // On va chercher toutes les service
        $types = $typesModel->requete("SELECT * FROM categories,types WHERE categories.id=types.id_cat ORDER BY type asc")->fetchAll();
        //on cree le select
        $this->formCode.= "<select multiple='$multiple' name='$nom'";
        //on ajoute les attributs
        $this->formCode.= $attributs ? $this->ajoutAttributs($attributs).'>': '>';
        // on ajoute les options
        $this->formCode.="<option value=''>Choisir Typologie</option>";
        foreach ($types as $valeur) {
            $this->formCode.="<option value=\"$valeur->id\" "; 
          //  $this->formCode.= $valeur->id == $uses->id_service ?'selected':'' ;   
            $this->formCode.=" >$valeur->type ($valeur->designation)</option>";        // code...
        }
        //on ferme le select
        $this->formCode.= "</select></p>";
                return $this; 
    }

    public function ajoutSelectDom(string $nom,array $attributs = [],string $multiple=""): self
    {
        //$use = new UsersModel;
       //$uses = $use->find($id);
        //On instancie service
        $domainesModel = new DomainesModel;
        // On va chercher toutes les service
        $domaines = $domainesModel->requete("SELECT * FROM categories ORDER BY designation asc")->fetchAll();
        //on cree le select
        $this->formCode.= "<select multiple='$multiple' name='$nom'";
        //on ajoute les attributs
        $this->formCode.= $attributs ? $this->ajoutAttributs($attributs).'>': '>';
        // on ajoute les options
        $this->formCode.="<option value=''>Choisir le domaine</option>";
        foreach ($domaines as $valeur) {
            $this->formCode.="<option value=\"$valeur->id\" "; 
          //  $this->formCode.= $valeur->id == $uses->id_service ?'selected':'' ;   
            $this->formCode.=" >$valeur->designation</option>";        // code...
        }
        //on ferme le select
        $this->formCode.= "</select></p>";
                return $this; 
    }

     public function ajoutSelectVill(string $nom,array $attributs = []): self
    {
        //$use = new UsersModel;
       //$uses = $use->find($id);
        //On instancie service
        $villesModel = new VillesModel;
        // On va chercher toutes les service
        $villes = $villesModel->requete("SELECT * FROM villes ORDER BY ville asc")->fetchAll();
        //on cree le select
        $this->formCode.= "<select name='$nom'";
        //on ajoute les attributs
        $this->formCode.= $attributs ? $this->ajoutAttributs($attributs).'>': '>';
        // on ajoute les options
        $this->formCode.="<option value=''>Choisir le ville</option>";
        foreach ($villes as $valeur) {
            $this->formCode.="<option value=\"$valeur->id\" "; 
          //  $this->formCode.= $valeur->id == $uses->id_service ?'selected':'' ;   
            $this->formCode.=" >$valeur->ville</option>";        // code...
        }
        //on ferme le select
        $this->formCode.= "</select></p>";
                return $this; 
    }
    public function ajoutSelectSall(string $nom,array $attributs = []): self
    {
        //$use = new UsersModel;
       //$uses = $use->find($id);
        //On instancie service
        $sallesModel = new SallesModel;
        // On va chercher toutes les service
        $salles = $sallesModel->requete("SELECT * FROM villes,salles WHERE villes.id=salles.id_ville ORDER BY salle asc")->fetchAll();
        //on cree le select
        $this->formCode.= "<select name='$nom'";
        //on ajoute les attributs
        $this->formCode.= $attributs ? $this->ajoutAttributs($attributs).'>': '>';
        // on ajoute les options
        $this->formCode.="<option value=''>Choisir la salle</option>";
        foreach ($salles as $valeur) {
            $this->formCode.="<option value=\"$valeur->id\" "; 
          //  $this->formCode.= $valeur->id == $uses->id_service ?'selected':'' ;   
            $this->formCode.=" >$valeur->salle | Ville: $valeur->ville</option>";        // code...
        }
        //on ferme le select
        $this->formCode.= "</select></p>";
                return $this; 
    }

     public function ajoutSelectRay(string $nom,array $attributs = []): self
    {
        //$use = new UsersModel;
       //$uses = $use->find($id);
        //On instancie service
        $rayonsModel = new RayonsModel;
        // On va chercher toutes les service
        $rayons = $rayonsModel->requete("SELECT * FROM villes,salles,rayons WHERE salles.id=rayons.id_salle AND villes.id=salles.id_ville ORDER BY rayon asc")->fetchAll();
        //on cree le select
        $this->formCode.= "<select name='$nom'";
        //on ajoute les attributs
        $this->formCode.= $attributs ? $this->ajoutAttributs($attributs).'>': '>';
        // on ajoute les options
        $this->formCode.="<option value=''>Choisir la rayon</option>";
        foreach ($rayons as $valeur) {
            $this->formCode.="<option value=\"$valeur->id\" "; 
          //  $this->formCode.= $valeur->id == $uses->id_service ?'selected':'' ;   
            $this->formCode.=" >$valeur->rayon | Ville: $valeur->ville | Salle: $valeur->salle </option>";        // code...
        }
        //on ferme le select
        $this->formCode.= "</select></p>";
                return $this; 
    }

     public function ajoutSelectDirect(string $nom,array $attributs = []): self
    {
        //$use = new UsersModel;
       //$uses = $use->find($id);
        //On instancie service
        $directionsModel = new DirectionsModel;
        // On va chercher toutes les service
        $directions = $directionsModel->requete("SELECT * FROM services ORDER BY designation asc")->fetchAll();
        //on cree le select
        $this->formCode.= "<select name='$nom'";
        //on ajoute les attributs
        $this->formCode.= $attributs ? $this->ajoutAttributs($attributs).'>': '>';
        // on ajoute les options
        $this->formCode.="<option value=''>Choisir la Direction</option>";
        foreach ($directions as $valeur) {
            $this->formCode.="<option value=\"$valeur->id\" "; 
          //  $this->formCode.= $valeur->id == $uses->id_service ?'selected':'' ;   
            $this->formCode.=" >$valeur->designation</option>";        // code...
        }
        //on ferme le select
        $this->formCode.= "</select></p>";
                return $this; 
    }

     public function ajoutSelectDomaine(string $nom,array $attributs = []): self
    {
        //$use = new UsersModel;
       //$uses = $use->find($id);
        //On instancie service
        $domainesModel = new DomainesModel;
        // On va chercher toutes les service
        $domaines = $domainesModel->requete("SELECT * FROM categories ORDER BY designation asc")->fetchAll();
        //on cree le select
        $this->formCode.= "<select name='$nom'";
        //on ajoute les attributs
        $this->formCode.= $attributs ? $this->ajoutAttributs($attributs).'>': '>';
        // on ajoute les options
        $this->formCode.="<option value=''>Choisir le domaine</option>";
        foreach ($domaines as $valeur) {
            $this->formCode.="<option value=\"$valeur->id\" "; 
          //  $this->formCode.= $valeur->id == $uses->id_service ?'selected':'' ;   
            $this->formCode.=" >$valeur->designation</option>";        // code...
        }
        //on ferme le select
        $this->formCode.= "</select></p>";
                return $this; 
    }

    public function ajoutSelectEtag(string $nom,array $attributs = []): self
    {
        //$use = new UsersModel;
       //$uses = $use->find($id);
        //On instancie service
        $etageresModel = new EtageresModel;
        // On va chercher toutes les service
        $etageres = $etageresModel->requete("SELECT * FROM villes,salles,rayons,etageres WHERE villes.id=salles.id_ville AND salles.id = rayons.id_salle AND rayons.id=etageres.id_rayon ORDER BY etagere asc")->fetchAll();
        //on cree le select
        $this->formCode.= "<select name='$nom'";
        //on ajoute les attributs
        $this->formCode.= $attributs ? $this->ajoutAttributs($attributs).'>': '>';
        // on ajoute les options
        $this->formCode.="<option value=''>Choisir etagère</option>";
        foreach ($etageres as $valeur) {
            $this->formCode.="<option value=\"$valeur->id\" "; 
          //  $this->formCode.= $valeur->id == $uses->id_service ?'selected':'' ;   
            $this->formCode.=" >$valeur->etagere c</option>";        // code...
        }
        //on ferme le select
        $this->formCode.= "</select></p>";
                return $this; 
    }

    public function ajoutSelectBoite(string $nom,array $attributs = []): self
    {
        //$use = new UsersModel;
       //$uses = $use->find($id);
        //On instancie service
        $boitesModel = new BoitesModel;
        // On va chercher toutes les service
        $boites = $boitesModel->requete("SELECT * FROM rayons,villes,salles,etageres,boites WHERE villes.id=salles.id_ville AND salles.id = rayons.id_salle AND rayons.id=etageres.id_rayon AND etageres.id=boites.id_etagere ORDER BY boite asc")->fetchAll();
        //on cree le select
        $this->formCode.= "<select name='$nom'";
        //on ajoute les attributs
        $this->formCode.= $attributs ? $this->ajoutAttributs($attributs).'>': '>';
        // on ajoute les options
        $this->formCode.="<option value=''>Choisir la boite Archive</option>";
        foreach ($boites as $valeur) {
            $this->formCode.="<option value=\"$valeur->id\" "; 
          //  $this->formCode.= $valeur->id == $uses->id_service ?'selected':'' ;   
            $this->formCode.=" >$valeur->boite (Etag : $valeur->etagere | Rayon : $valeur->rayon | Salle : $valeur->salle | Ville : $valeur->ville )</option>";        // code...
        }
        //on ferme le select
        $this->formCode.= "</select></p>";
                return $this; 
    }

    public function ajoutSelectUser(string $nom,array $attributs = []): self
    {

        //On instancie service
        $usersModel = new UsersModel;
        // On va chercher toutes les service
        $users = $usersModel->requete("SELECT * FROM users");
        //on cree le select
        $this->formCode.= "<select name='$nom'";
        //on ajoute les attributs
        $this->formCode.= $attributs ? $this->ajoutAttributs($attributs).'>': '>';
        // on ajoute les options
        
        foreach ($users as $valeur) {
            $this->formCode.="<option value=\"$valeur->id\"> $valeur->matricule  $valeur->nom $valeur->prenom</option>";           
             // code...
        }
        //on ferme le select
        $this->formCode.= "</select></p>";
                return $this; 
    }
      public function ajoutSelectRole(string $role,array $attributs = []): self
    {
        //On instancie service
        $rolesModel = new RolesModel;
        // On va chercher toutes les service
        $roles = $rolesModel->findAll();
        //on cree le select
        $this->formCode.= "<select name='$role'";
        //on ajoute les attributs
        $this->formCode.= $attributs ? $this->ajoutAttributs($attributs).'>': '>';
        // on ajoute les options
        foreach ($roles as $valeur) {
            $this->formCode.="<option value=\"$valeur->roles\">$valeur->libelle</option>";            // code...
        }
        //on ferme le select
        $this->formCode.= "</select></p>";
                return $this; 
    }

    public function ajoutbouton(string $texte, array $attributs = []): self
    {
        //on ouvre la balise
        $this->formCode.= "<p class='form-group'><button ";
        // on ajoute les attributs
                $this->formCode.= $attributs ? $this->ajoutAttributs($attributs).'>': '>';
        //on ajoute le texte et  on ferme la balise
        $this->formCode.="$texte</button></p>";

        return $this;

    }
    public static function getFlash(){
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    public static function hasFlash(){
        return isset($_SESSION['flash']);
    }
    public static function setFlash($key,$message){
        $_SESSION['flash'][$key]=$message;
    }
}

 ?>