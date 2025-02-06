<?php 
namespace App\Models;

class EtageresModel extends Model
{
	protected $id;
	protected $etagere;
    protected $id_rayon;
	protected $date_creation_etag;
	protected $update_at;


	public function __construct()
	{
		$this->table = "etageres";
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
    public function getEtagere()
    {
        return $this->etagere;
    }

    /**
     * @param mixed $etagere
     *
     * @return self
     */
    public function setEtagere($etagere)
    {
        $this->etagere = $etagere;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdRayon()
    {
        return $this->id_rayon;
    }

    /**
     * @param mixed $id_rayon
     *
     * @return self
     */
    public function setIdRayon($id_rayon)
    {
        $this->id_rayon = $id_rayon;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateCreationEtag()
    {
        return $this->date_creation_etag;
    }

    /**
     * @param mixed $date_creation_etag
     *
     * @return self
     */
    public function setDateCreationEtag($date_creation_etag)
    {
        $this->date_creation_etag = $date_creation_etag;

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