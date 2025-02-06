<?php 
namespace App\Models;

class SallesModel extends Model
{
	protected $id;
	protected $salle;
    protected $id_ville;
	protected $date_creation_salle;
	protected $update_at;


	public function __construct()
	{
		$this->table = "salles";
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
    public function getSalle()
    {
        return $this->salle;
    }

    /**
     * @param mixed $salle
     *
     * @return self
     */
    public function setSalle($salle)
    {
        $this->salle = $salle;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdVille()
    {
        return $this->id_ville;
    }

    /**
     * @param mixed $id_ville
     *
     * @return self
     */
    public function setIdVille($id_ville)
    {
        $this->id_ville = $id_ville;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateCreationSalle()
    {
        return $this->date_creation_salle;
    }

    /**
     * @param mixed $date_creation_salle
     *
     * @return self
     */
    public function setDateCreationSalle($date_creation_salle)
    {
        $this->date_creation_salle = $date_creation_salle;

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