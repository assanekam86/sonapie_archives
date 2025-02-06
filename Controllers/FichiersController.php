<?php 
namespace App\Controllers;

use App\Core\Db;
use App\Models\FichiersModel;

/*---------------------------------------------------------------*/
/*
    Titre : Upload Multi classe + Formulaire                                                                              
                                                                                                                          
    URL   : https://phpsources.net/code_s.php?id=530
    Auteur           : evanxg852000                                                                                       
    Date édition     : 12 Oct 2009                                                                                        
    Date mise à jour : 22 Sept 2019                                                                                      
    Rapport de la maj:                                                                                                    
    - fonctionnement du code vérifié                                                                                    
*/
/*---------------------------------------------------------------*/

/*=============IMPORTANT==========
Contraintes : ne pas changer  l'attribut name du(des) champ(s) fichier car cet
 dernier est utilise comme cle
  <input type="file" name="fichier[]" ></input>
*/

class FichiersController extends Controller{
/*
protected $maxsize;
protected $repertoire;    
//repertoire des fichiers a dowloader ou rep de destination de l'upload
protected $type=array();  //type autorise par l'instance
protected $files=array();
protected $bilan=array(); 
// permet de dresser un bilan des fichier uploader permet de voire l'echec de
// l'upload plus en détail


public function __tostring() 
    {
    return 
"Cette classe permet de définir et manipuler une upload ou download.<br/>";
    }

 public function __construct($repertoire,$type) 
    {
         $this->repertoire=$repertoire ;
         $this->type=$type ;
         $this->Max_size();
    }

public function Max_size() 
// cette fonction retourne la taille max autorise du fichier 
    {                       
// a uploader par le serveur défini dans php ini (default=2GO)
        $val = trim(ini_get('post_max_size'));
        $vale =strlen($val)-1;
       # $last = strtolower($val{$vale});
            switch($last)
            {
                case 'g':
                        $val *= 1024;
                case 'm':
                        $val *= 1024;
                case 'k':
                        $val *= 1024;
            }
           $this->maxsize=$val ;
        return $this->maxsize;
    }
    
public function Get_max_size() 
    {
        return $this->maxsize;
    }

public function Get_bilan() 
    {
        return $this->bilan;
    }
    
public function Upload($files)
    {
        if(!empty($files))
        {
            // Récupération normale des informations
            //comptage du nbre de fichier a transferer
            $nb_fichiers = count($files['fichier']['tmp_name']);
            $raport=array();
            for($i = 0; $i<$nb_fichiers; $i++)
            {
                if(is_uploaded_file($files['fichier']['tmp_name'][$i]))
                {
                    $name     = $_FILES['fichier']['name'][$i];
                    $tmp_name = $_FILES['fichier']['tmp_name'][$i];
                    $type_file = $_FILES['fichier']['type'][$i];
                    $error    = $_FILES['fichier']['error'][$i];
                    $clean_name = strtolower(basename($name));
                    $clean_name = preg_replace('/[^a-z0-9.-]/', '-', $clean_name

);
                    if($_FILES['fichier']['size'][$i]>=$this->maxsize)
                    {
                            $raport[$i]['size']=false;
                    }
                    // vérifie si le type est autorise a être uploader
                    $test_type=false;
                    for($j=0;$j<count($this->type);$j++)
                    {
                        
// debug mode: echo $type_file; permet de voire le type du fichier
                        //debug mode: echo substr($name,-3); 
                       if(($this->type[$j])==$type_file)
                       { 
                            $test_type=true;
                       }
                    }
                    if ($test_type==true)
                    {
                            // si le est autorise alors on le déplace
                            if(move_uploaded_file($tmp_name, $this->repertoire.
$clean_name)) 
// Déplacement  du répertoire temporaire vers le rep de destination
                            {
                               
// debug mode: $test=true; //si l'un des fichier est transfere on considere
// comme
// succes car le filtre a rejeter les otre c qui est normal 
                            }    
                            else
                            {
                                $raport[$i]['move']=false;
                            }
                    }
                    else
                    {
                        $raport[$i]['type']=false;
                    }
                }
            }
            $this->bilan=$raport;
        }
        else
        {
            return false;
            exit;
        }
        //analyse du raport
        if(count($raport)==0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
}
/*========== Exemple d'utilisation===============
$list=array(0=>"image/gif",1=>"image/png",2=>"image/bmp",3=>"image/jpg",3=>"imag
e/jpeg"); liste des fichiers autorises
$d=new Upload('repertoire/',$list);
$test=$d->Upload($_FILES); //$_FILES est le tableau super global de fichier
 envoye par le formulaire depuis  
?>
*/





}

 ?>