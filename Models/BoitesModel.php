<?php 
namespace App\Models;

class BoitesModel extends Model
{
	protected $id;
	protected $boite;
    protected $desc_boite;
    protected $id_etagere;
    protected $id_cat;
	protected $date_creation_boite;
	protected $update_at;


	public function __construct()
	{
		$this->table = "boites";
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
    public function getBoite()
    {
        return $this->boite;
    }

    /**
     * @param mixed $boite
     *
     * @return self
     */
    public function setBoite($boite)
    {
        $this->boite = $boite;

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
    public function getIdEtagere()
    {
        return $this->id_etagere;
    }

    /**
     * @param mixed $id_etagere
     *
     * @return self
     */
    public function setIdEtagere($id_etagere)
    {
        $this->id_etagere = $id_etagere;

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
}



 ?>