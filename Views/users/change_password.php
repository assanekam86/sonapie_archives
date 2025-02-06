<?php 
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){

   ?>
<div class="p-5">
                  <div class="text-center">
                    <h1 align="center"><img src="/img/logo.jpg" title="logo SOGEPIE"/></h1>
                    <h1 class="h4 text-gray-900 mb-4">MODIFIER SON MOT DE PASSE</h1>
                  </div>
                 
               <?=$ChangeForm;?>
                    <hr>

                  
                  <hr>
     
                </div>
                 <?php }else{
    header("Location:/");
  } ?>