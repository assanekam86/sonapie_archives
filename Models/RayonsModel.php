<?php 
namespace App\Models;

class RayonsModel extends Model
{
	protected $id;
	protected $rayon;
    protected $id_salle;
	protected $date_creation_rayon;
	protected $update_at;


	public function __construct()
	{
		$this->table = "rayons";
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
    public function getRayon()
    {
        return $this->rayon;
    }

    /**
     * @param mixed $rayon
     *
     * @return self
     */
    public function setRayon($rayon)
    {
        $this->rayon = $rayon;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdSalle()
    {
        return $this->id_salle;
    }

    /**
     * @param mixed $id_salle
     *
     * @return self
     */
    public function setIdSalle($id_salle)
    {
        $this->id_salle = $id_salle;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateCreationRayon()
    {
        return $this->date_creation_rayon;
    }

    /**
     * @param mixed $date_creation_rayon
     *
     * @return self
     */
    public function setDateCreationRayon($date_creation_rayon)
    {
        $this->date_creation_rayon = $date_creation_rayon;

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