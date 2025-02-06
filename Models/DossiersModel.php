<?php 
namespace App\Models;

class DossiersModel extends Model
{
	protected $id;
    protected $id_user;
	protected $dossier;
    protected $desc_dossier;
    protected $id_cat;
    protected $id_boite;
	protected $date_creation_boite;
	protected $update_at;


	public function __construct()
	{
		$this->table = "dossiers";
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
    public function getDossier()
    {
        return $this->dossier;
    }

    /**
     * @param mixed $dossier
     *
     * @return self
     */
    public function setDossier($dossier)
    {
        $this->dossier = $dossier;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescBoite()
    {
        return $this->desc_boite;
    }

    /**
     * @param mixed $desc_boite
     *
     * @return self
     */
    public function setDescBoite($desc_boite)
    {
        $this->desc_boite = $desc_boite;

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
    public function getIdBoite()
    {
        return $this->id_boite;
    }

    /**
     * @param mixed $id_boite
     *
     * @return self
     */
    public function setIdBoite($id_boite)
    {
        $this->id_boite = $id_boite;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateCreationBoite()
    {
        return $this->date_creation_boite;
    }

    /**
     * @param mixed $date_creation_boite
     *
     * @return self
     */
    public function setDateCreationBoite($date_creation_boite)
    {
        $this->date_creation_boite = $date_creation_boite;

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
    public function getDescDossier()
    {
        return $this->desc_dossier;
    }

    /**
     * @param mixed $desc_dossier
     *
     * @return self
     */
    public function setDescDossier($desc_dossier)
    {
        $this->desc_dossier = $desc_dossier;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     *
     * @return self
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }
}



 ?>