<?php
namespace App\Models;

class UsersModel extends Model
{
    protected $id;
    protected $matricule;
    protected $nom;
    protected $prenom;
    protected $contact;
    protected $email;
    protected $direction;
    protected $login;
    protected $password;
    protected $fonction;
    protected $roles;
    protected $actif;
    protected $create_at;
    protected $date_creation_utilisateur;
    protected $update_at;
    protected $remember_token;
    protected $validate_token;

    public function __construct(){
       // $this->table = 'users';
       $class = str_replace(__NAMESPACE__."\\","",__CLASS__);
       $this->table = strtolower(str_replace("Model","",$class));
    }
/**
 * Recuperer un user a partir de son email
 * @param  string $email [description]
 * @return [type]        [description]
 */
    public function findOneByEmail(string $email)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE email = ? OR login = ?", [$email,$email])->fetch();
    }
    /**
     * creer la seesion de l'utilisateur
     * @return void
     */
    public function setSession()
    {
        $_SESSION['user'] = [
            'id'=> $this->id,
            'matricule'=> $this->matricule,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'fonction'=> $this->fonction,
            'contact' => $this->contact,
            'email' => $this->email,
            'direction' => $this->direction,
            'roles' => $this->roles,
            'remember'=> $this->remember_token,
            'date_creation_utilisateur'=> $this->date_creation_utilisateur

        ];
        return $_SESSION['user'];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

 public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreateAt()
    {
        return $this->create_at;
    }

    /**
     * @param mixed $create_at
     *
     * @return self
     */
    public function setCreateAt($create_at)
    {
        $this->create_at = $create_at;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     *
     * @return self
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     *
     * @return self
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param mixed $contact
     *
     * @return self
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
       // $roles[]="ROLE_USER";

        return array_unique($roles);

    }

    /**
     * @param mixed $role
     *
     * @return self
     */
    public function setRoles($roles)
    {
       // $this->roles = json_decode($roles);
     $this->roles = $roles;
        return $this;
    }
     

    /**
     * @return mixed
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * @param mixed $matricule
     *
     * @return self
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * @param mixed $fonction
     *
     * @return self
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;

        return $this;
    }

    
    /**
     * @return mixed
     */
    public function getDateCreationUtilisateur()
    {
        return $this->date_creation_utilisateur;
    }

    /**
     * @param mixed $date_creation_utilisateur
     *
     * @return self
     */
    public function setDateCreationUtilisateur($date_creation_utilisateur)
    {
        $this->date_creation_utilisateur = $date_creation_utilisateur;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdateAt()
    {
        return $this->update_at;
    }

    /**
     * @param mixed $update_at
     *
     * @return self
     */
    public function setUpdateAt($update_at)
    {
        $this->update_at = $update_at;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * @param mixed $actif
     *
     * @return self
     */
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * @param mixed $remember_token
     *
     * @return self
     */
    public function setRememberToken($remember_token)
    {
        $this->remember_token = $remember_token;

        return $this;
    }

    /**
     * @param mixed $validate_token
     *
     * @return self
     */
    public function setValidateToken($validate_token)
    {
        $this->validate_token = $validate_token;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValidateToken()
    {
        return $this->validate_token;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     *
     * @return self
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @param mixed $direction
     *
     * @return self
     */
    public function setDirection($direction)
    {
        $this->direction = $direction;

        return $this;
    }
}