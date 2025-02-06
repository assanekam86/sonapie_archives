<?php 

namespace App\Models;

class DirectionsModel extends Model
{

	protected $id_service;
	protected $designation;
	protected $date_ajout;
    protected $update_at;

	public function __construct()
	{
		$this->table = 'Services';
	}

    /**
     * @return mixed
     */
    public function getIdService()
    {
        return $this->id;
    }

    /**
     * @param mixed $id_service
     *
     * @return self
     */
    public function setIdService($id_service)
    {
        $this->id = $id_service;

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
    public function getDateAjout()
    {
        return $this->date_ajout;
    }

    /**
     * @param mixed $date_ajout
     *
     * @return self
     */
    public function setDateAjout($date_ajout)
    {
        $this->date_ajout = $date_ajout;

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