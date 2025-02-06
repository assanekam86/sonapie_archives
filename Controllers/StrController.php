<?php 
namespace App\Controllers;

class StrController extends Controller
{
    public static function random($length){
        $alphabet = "0123456789azertyuiopmlkjhgfdsqwxcvbnAZERTYUIOPMLKJHGFDSQWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet,$length)),0,$length);
    }
}



?>