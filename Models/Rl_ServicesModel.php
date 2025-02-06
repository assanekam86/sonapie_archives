<?php 
namespace App\Models;


class Rl_ServicesModel extends Model

{
	protected $id;
	protected $id_user;
	protected $id_service;

	public function __construct()
	{
		$this->table = "rl_services";
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
}



 ?>