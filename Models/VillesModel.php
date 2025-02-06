<?php 
namespace App\Models;

class VillesModel extends Model
{
	protected $id;
	protected $ville;
	protected $date_creation_ville;
	protected $update_at;


	public function __construct()
	{
		$this->table = "villes";
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
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     *
     * @return self
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateCreationVille()
    {
        return $this->date_creation_ville;
    }

    /**
     * @param mixed $date_creation_ville
     *
     * @return self
     */
    public function setDateCreationVille($date_creation_ville)
    {
        $this->date_creation_ville = $date_creation_ville;

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