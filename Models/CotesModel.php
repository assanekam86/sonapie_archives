<?php
namespace App\Models;

class CotesModel extends Model
{

protected $id;
protected $libelle;
protected $date_creation_cotes;
protected $update_at;


 public function __construct()
 {
 	$this->table = "cotes";
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
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     *
     * @return self
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateCreationCotes()
    {
        return $this->date_creation_cotes;
    }

    /**
     * @param mixed $date_creation_cotes
     *
     * @return self
     */
    public function setDateCreationCotes($date_creation_cotes)
    {
        $this->date_creation_cotes = $date_creation_cotes;

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