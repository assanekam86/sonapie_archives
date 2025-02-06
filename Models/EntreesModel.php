<?php 
namespace App\Models;


class EntreesModel extends Model
{
	protected $id;
	protected $name;
	protected $description;
    protected $id_cote;
	protected $id_cat;
	protected $id_rayon;
	protected $id_empl;
	protected $id_type;
	protected $date_creation_ent;
	protected $update_at;
    protected $status_entrees;

	public function __construct()
	{
		$this->table ="entrees";
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

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
    public function getIdRayon()
    {
        return $this->id_rayon;
    }

    /**
     * @param mixed $id_rayon
     *
     * @return self
     */
    public function setIdRayon($id_rayon)
    {
        $this->id_rayon = $id_rayon;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdEmpl()
    {
        return $this->id_empl;
    }

    /**
     * @param mixed $id_empl
     *
     * @return self
     */
    public function setIdEmpl($id_empl)
    {
        $this->id_empl = $id_empl;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdType()
    {
        return $this->id_type;
    }

    /**
     * @param mixed $id_type
     *
     * @return self
     */
    public function setIdType($id_type)
    {
        $this->id_type = $id_type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateCreationEnt()
    {
        return $this->date_creation_ent;
    }

    /**
     * @param mixed $date_creation_ent
     *
     * @return self
     */
    public function setDateCreationEnt($date_creation_ent)
    {
        $this->date_creation_ent = $date_creation_ent;

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
    public function getIdCote()
    {
        return $this->id_cote;
    }

    /**
     * @param mixed $id_cote
     *
     * @return self
     */
    public function setIdCote($id_cote)
    {
        $this->id_cote = $id_cote;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusEntrees()
    {
        return $this->status_entrees;
    }

    /**
     * @param mixed $status_entrees
     *
     * @return self
     */
    public function setStatusEntrees($status_entrees)
    {
        $this->status_entrees = $status_entrees;

        return $this;
    }
}



 ?>