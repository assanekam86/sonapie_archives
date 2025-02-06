<?php 
namespace App\Models;

class DepotModel extends Model
{

	protected $id;
	protected $id_user_depot;
	protected $date_depot;
	protected $id_emprunt;

	public function __construct()
	{
		$this->table = "depot";
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
    public function getIdUserDepot()
    {
        return $this->id_user_depot;
    }

    /**
     * @param mixed $id_user_depot
     *
     * @return self
     */
    public function setIdUserDepot($id_user_depot)
    {
        $this->id_user_depot = $id_user_depot;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateDepot()
    {
        return $this->date_depot;
    }

    /**
     * @param mixed $date_depot
     *
     * @return self
     */
    public function setDateDepot($date_depot)
    {
        $this->date_depot = $date_depot;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdEmprunt()
    {
        return $this->id_emprunt;
    }

    /**
     * @param mixed $id_emprunt
     *
     * @return self
     */
    public function setIdEmprunt($id_emprunt)
    {
        $this->id_emprunt = $id_emprunt;

        return $this;
    }
}


 ?>