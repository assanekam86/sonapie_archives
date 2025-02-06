<?php 
namespace App\Models;

class EmplacementsModel extends Model
{

	protected $id;
	protected $casier;
	protected $date_creation_emp;
	protected $update_at;


	public function __construct()
	{
		$this->table = "emplacements";
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
    public function getCasier()
    {
        return $this->casier;
    }

    /**
     * @param mixed $casier
     *
     * @return self
     */
    public function setCasier($casier)
    {
        $this->casier = $casier;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateCreationEmp()
    {
        return $this->date_creation_emp;
    }

    /**
     * @param mixed $date_creation_emp
     *
     * @return self
     */
    public function setDateCreationEmp($date_creation_emp)
    {
        $this->date_creation_emp = $date_creation_emp;

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