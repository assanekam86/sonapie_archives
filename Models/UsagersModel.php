<?php 
namespace App\Models;

class UsagersModel extends Model
{
	protected $id;
	protected $usager;
    protected $type_usager;
    protected $contact;
    protected $email;
    protected $adresse;
    protected $matricule;
    protected $fonction;
    protected $grade;
    protected $date_service;
    protected $etablissement;
    protected $id_cat;
	protected $date_creation_usager;
	protected $update_at;


	public function __construct()
	{
		$this->table = "usagers";
	}

	

 

    

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsager()
    {
        return $this->usager;
    }

    /**
     * @param mixed $usager
     *
     * @return self
     */
    public function setUsager($usager)
    {
        $this->usager = $usager;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTypeUsager()
    {
        return $this->type_usager;
    }

    /**
     * @param mixed $type_usager
     *
     * @return self
     */
    public function setTypeUsager($type_usager)
    {
        $this->type_usager = $type_usager;

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
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     *
     * @return self
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

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
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * @param mixed $grade
     *
     * @return self
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateService()
    {
        return $this->date_service;
    }

    /**
     * @param mixed $date_service
     *
     * @return self
     */
    public function setDateService($date_service)
    {
        $this->date_service = $date_service;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEtablissement()
    {
        return $this->etablissement;
    }

    /**
     * @param mixed $etablissement
     *
     * @return self
     */
    public function setEtablissement($etablissement)
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateCreationUsager()
    {
        return $this->date_creation_usager;
    }

    /**
     * @param mixed $date_creation_usager
     *
     * @return self
     */
    public function setDateCreationUsager($date_creation_usager)
    {
        $this->date_creation_usager = $date_creation_usager;

        return $this;
    }

    
    /**
     * @return mixed
     */
    public function getIdCat()
    {
        return $this->id_cat;
    }

    /**
     * @param mixed $id_cat
     *
     * @return self
     */
    public function setIdCat($id_cat)
    {
        $this->id_cat = $id_cat;

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
}



 ?>