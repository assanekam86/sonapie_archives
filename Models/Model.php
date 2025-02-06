<?php

namespace App\Models;

use App\Core\Db;

class Model extends Db
{

    /**
     * [$table Nom de la table de la base de donnees]
     * @var string
     */
    protected $table;

    /**
     * Instance de Db
     * @var Instance
     */
    private $db;
    // afficher tous les element de ma table
    public function findAll()
    {
        $query = $this->requete('SELECT * FROM '.$this->table);
        return $query->fetchAll();
    }
    public function findAllUse()
    {
        $query = $this->requete('SELECT * FROM '.$this->table.' where id!=?',[$_SESSION['user']['id']]);
        return $query->fetchAll();
    }
    public function findAnyActif(int $id)
    {
        $query = $this->requete("SELECT * FROM {$this->table} WHERE status= ? AND id=?",[1,$id]);
        return $query->fetchAll();
    }
    public function find(int $id)
    {
        $query = $this->requete("SELECT * FROM {$this->table} WHERE id =?", [$id]);
        return $query->fetch();
    }
    
     public function CreateFile()
    {
        $champ = [];
        $inter=[];
        $valeur = [];

        //on boucle pour eclater le tableau

        foreach ($this as $champ => $valeur) {
            //INSERT INTO annonces SET titre= ? AND description=?           //bindValue(1,valeur)
            if ($valeur != null && $champ != 'db' && $champ != "table") {
                $champs[] = $champ;
                $inter[]="?";
                $valeurs[] = $valeur;
            }
        }
        //on ajoute les AND dans notre parametres de requetes
        //actif =1 AND signaler = 2
        $liste_champs = implode(' , ', $champs);
        $liste_inter = implode(' , ', $inter);
        //  echo $liste_champs; die($liste_inter);
        // On execute la requete
        return $this->requete("INSERT INTO fichiers ('. $liste_champs.') VALUES ('.$liste_inter.')", $valeurs);
        //var_dump($champs);
        //var_dump($valeurs);
    }

    public function Create()
    {
        $champ = [];
        $inter=[];
        $valeur = [];

        //on boucle pour eclater le tableau

        foreach ($this as $champ => $valeur) {
            //INSERT INTO annonces SET titre= ? AND description=? 			//bindValue(1,valeur)
            if ($valeur != null && $champ != 'db' && $champ != "table") {
                $champs[] = $champ;
                $inter[]="?";
                $valeurs[] = $valeur;
            }
        }
        //on ajoute les AND dans notre parametres de requetes
        //actif =1 AND signaler = 2
        $liste_champs = implode(' , ', $champs);
        $liste_inter = implode(' , ', $inter);
        //	echo $liste_champs; die($liste_inter);
        // On execute la requete
        return $this->requete('INSERT INTO '.$this->table.'('. $liste_champs.') VALUES ('.$liste_inter.')', $valeurs);
        //var_dump($champs);
        //var_dump($valeurs);
    }
    public function update()
    {
        $champ = [];
        //$inter=[];
        $valeur = [];

        //on boucle pour eclater le tableau

        foreach ($this as $champ => $valeur) {
            //UPDATE annonces SET titre= ?,description=? WHERE id=?  			//bindValue(1,valeur)
            if ($valeur !== null && $champ != 'db' && $champ != "table") {
                $champs[] = "$champ = ?";
                //	$inter[]="?";
                $valeurs[] = $valeur;
            }
        }
        $valeurs[] = $this->id;
        //on ajoute les AND dans notre parametres de requetes
        //actif =1 AND signaler = 2
        $liste_champs = implode(' , ', $champs);
        //$liste_inter = implode(' , ', $inter);
        //	echo $liste_champs; die($liste_inter);
        // On execute la requete
        return $this->requete("UPDATE ".$this->table." SET ". $liste_champs." WHERE id = ?", $valeurs);
        //var_dump($champs);
        //var_dump($valeurs);
    }
    public function UpdateEntrees(string $user = "name")
    {
        $champ = [];
        //$inter=[];
        $valeur = [];

        //on boucle pour eclater le tableau

        foreach ($this as $champ => $valeur) {
            //UPDATE annonces SET titre= ?,description=? WHERE id=?             //bindValue(1,valeur)
            if ($valeur !== null && $champ != 'db' && $champ != "table") {
                $champs[] = "$champ = ?";
                //  $inter[]="?";
                $valeurs[] = $valeur;
            }
        }
    }
     public function updateUser(string $user = "users")
    {
        $champ = [];
        //$inter=[];
        $valeur = [];

        //on boucle pour eclater le tableau

        foreach ($this as $champ => $valeur) {
            //UPDATE annonces SET titre= ?,description=? WHERE id=?             //bindValue(1,valeur)
            if ($valeur !== null && $champ != 'db' && $champ != "table") {
                $champs[] = "$champ = ?";
                //  $inter[]="?";
                $valeurs[] = $valeur;
            }
        }
        $valeurs[] = $this->id;
        //on ajoute les AND dans notre parametres de requetes
        //actif =1 AND signaler = 2
        $liste_champs = implode(' , ', $champs);
        //$liste_inter = implode(' , ', $inter);
        //  echo $liste_champs; die($liste_inter);
        // On execute la requete
        return $this->requete('UPDATE '.$user.' SET '. $liste_champs.'WHERE id = ?', $valeurs);
        //var_dump($champs);
        //var_dump($valeurs);
    }

    public function Delete(int $id)
    {
        return $this->requete("DELETE FROM ".$this->table." WHERE id= ?", [$id]);
    }
    public function findBy(array $criteres)
    {
        $champ = [];
        $valeur = [];

        //on boucle pour eclater le tableau

        foreach ($criteres as $champ => $valeur) {
            //SELECT * FROM annones WHERE actif=?
            //bindValue(1,valeur)
            $champs[] = "$champ= ?";
            $valeurs[] = $valeur;
        }
        //on ajoute les AND dans notre parametres de requetes
        //actif =1 AND signaler = 2
        $liste_champs = implode(' AND ', $champs);
        // On execute la requete
        return $this->requete('SELECT * FROM '.$this->table.' WHERE '. $liste_champs, $valeurs)->fetchAll();
        //var_dump($champs);
        //var_dump($valeurs);
    }
     
    public function requete(string $sql, array $attributs = null)
    {
        //On recupere l'instance de Db
        $this->db = Db::getInstance();

        //On verifie si on a un attribut
        if ($attributs !== null) {

        //requete preparee
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        } else {
            //requete simple
            return $this->db->query($sql);
        }
    }
    public function hydrate($donnees)
    {
        foreach ($donnees as $key => $value) {
            //On recupere le nom du setter correspondant a la clé
            //titre -> setTitre
            $setter = 'set'.ucfirst($key);

            //on verifie si le setter existe
            if (method_exists($this, $setter)) {
                //on appelle le setter
                $this->$setter($value);
            }
        }
        return $this;
    }


     public function IsUnique($field){
        $data = $this->requete("SELECT * FROM {$this->table} WHERE $field =?", [$field]);
         $data->fetch();

        if($data==1){
            Form::setFlash('danger','Ce service existe déjà!');
        }
        return $this;
    }


}
