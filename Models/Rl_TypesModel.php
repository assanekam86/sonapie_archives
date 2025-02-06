<?php 
namespace App\Models;


class Rl_TypesModel extends Model

{
	protected $id;
	protected $id_user;
	protected $id_type;
    protected $date_creation_rltype;


	public function __construct()
	{
		$this->table = "rl_types";
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
    public function getDateCreationRltype()
    {
        return $this->date_creation_rltype;
    }

    /**
     * @param mixed $date_creation_rltype
     *
     * @return self
     */
    public function setDateCreationRltype($date_creation_rltype)
    {
        $this->date_creation_rltype = $date_creation_rltype;

        return $this;
    }
}



 ?>