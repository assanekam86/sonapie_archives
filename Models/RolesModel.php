<?php 
namespace App\Models;

class RolesModel extends Model
{

	protected $id;
	protected $libelle;
	protected $roles;
	protected $date_creation;
	protected $update_at;


	public function __construct(){
		$this->table = "roles";
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
     * @return array
     */
    public function getRoles()
    {
        return $roles = $this->roles;
        //$roles[]="ROLE_USER";

        //return array_unique($roles);

    }

    /**
     * @param mixed $role
     *
     * @return self
     */
    public function setRoles($roles)
    {
        //$this->roles = json_decode($roles);
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->date_creation;
    }

    /**
     * @param mixed $date_creation
     *
     * @return self
     */
    public function setDateCreation($date_creation)
    {
        $this->date_creation = $date_creation;

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