<?php 
namespace App\Models;

class TypesModel extends Model
{
	protected $id;
    protected $code;
	protected $type;
    protected $desc_type;
    protected $id_cat;
	protected $date_creation_type;
	protected $update_at;


	public function __construct()
	{
		$this->table = "types";
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateCreationType()
    {
        return $this->date_creation_type;
    }

    /**
     * @param mixed $date_creation_type
     *
     * @return self
     */
    public function setDateCreationType($date_creation_type)
    {
        $this->date_creation_type = $date_creation_type;

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
    public function getDescType()
    {
        return $this->desc_type;
    }

    /**
     * @param mixed $desc_type
     *
     * @return self
     */
    public function setDescType($desc_type)
    {
        $this->desc_type = $desc_type;

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
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     *
     * @return self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }
}



 ?>