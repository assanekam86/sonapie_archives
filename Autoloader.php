<?php
namespace App;

class Autoloader{
    
    static function register(){
        spl_autoload_register([__CLASS__,'autoload']);
    } 

    static function autoload($class){
        //
        //On recupere dans $class la totalité du namespace de la classe concernéé (App\Client\Compte) 
        //on retire App\ (Client\Compte)
        $class = str_replace(__NAMESPACE__.'\\','',$class);
        //on remplace le \ par /
        $class = str_replace('\\','/',$class);
        //echo $class;
        //on verifie si le fichier existe
        //$fichier = __DIR__.'/'.$class.'.php';
        $fichier = __DIR__.DIRECTORY_SEPARATOR.$class.'.php';
     //  echo $fichier;
        if(file_exists($fichier)){
            require_once $fichier;
        }
        
    }
}

?>