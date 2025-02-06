<?php 
namespace App\Models;

class DomainesModel extends Model
{

	protected $id_cat;
	protected $designation;
    protected $desc_cat;
    protected $id_service;
	protected $date_creation_cat;
    protected $update_at;

	public function __construct()
	{
		$this->table = "categories";
	}

    /**
     * @return mixed
     */
    public function getIdCat()
    {
        return $this->id;
    }

    /**
     * @param mixed $id_cat
     *
     * @return self
     */
    public function setIdCat($id_cat)
    {
        $this->id = $id_cat;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * @param mixed $designation
     *
     * @return self
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateCreationCat()
    {
        return $this->date_creation_cat;
    }

    /**
     * @param mixed $date_creation_cat
     *
     * @return self
     */
    public function setDateCreationCat($date_creation_cat)
    {
        $this->date_creation_cat = $date_creation_cat;

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
    public function getIdService()
    {
        return $this->id_service;
    }

    /**
     * @param mixed $id_service
     *
     * @return self
     */
    public function setIdService($id_service)
    {
        $this->id_service = $id_service;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescCat()
    {
        return $this->desc_cat;
    }

    /**
     * @param mixed $desc_cat
     *
     * @return self
     */
    public function setDescCat($desc_cat)
    {
        $this->desc_cat = $desc_cat;

        return $this;
    }
}


 ?>