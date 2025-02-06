<?php 
namespace App\Models;

class NaturesModel extends Model
{

	protected $id;
	protected $nature;
	protected $date_creation_nature;
    protected $update_at;

	public function __construct()
	{
		$this->table = "natures";
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
    public function getNature()
    {
        return $this->nature;
    }

    /**
     * @param mixed $nature
     *
     * @return self
     */
    public function setNature($nature)
    {
        $this->nature = $nature;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateCreationNature()
    {
        return $this->date_creation_nature;
    }

    /**
     * @param mixed $date_creation_nature
     *
     * @return self
     */
    public function setDateCreationNature($date_creation_nature)
    {
        $this->date_creation_nature = $date_creation_nature;

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