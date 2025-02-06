<?php 
namespace App\Models;

class EmprunterModel extends Model
{
	protected $id;
	protected $id_entrees;
	protected $id_user;
    protected $id_user_depot;
	protected $status_emp;
	protected $date_emprunt;
	//protected $date_depot;

	public function __construct()
	{
		$this->table ="emprunter";
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
    public function getIdEntrees()
    {
        return $this->id_entrees;
    }

    /**
     * @param mixed $id_entrees
     *
     * @return self
     */
    public function setIdEntrees($id_entrees)
    {
        $this->id_entrees = $id_entrees;

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
    public function getDateEmprunt()
    {
        return $this->date_emprunt;
    }

    /**
     * @param mixed $date_emprunt
     *
     * @return self
     */
    public function setDateEmprunt($date_emprunt)
    {
        $this->date_emprunt = $date_emprunt;

        return $this;
    }

   
    /**
     * @return mixed
     */
    public function getStatusEmp()
    {
        return $this->status_emp;
    }

    /**
     * @param mixed $status_emp
     *
     * @return self
     */
    public function setStatusEmp($status_emp)
    {
        $this->status_emp = $status_emp;

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
}



 ?>