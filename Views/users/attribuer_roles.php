<?php 

use App\Controllers\UsersController;
use App\Core\Db;
if($_SESSION['user']){
  
   ?>
<div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">ATTRIBUER UN ROLE A UN UTILISATEUR</h1>
                  </div>
                 
               <?=$attribuerForm;?>
                    <hr>

                  
                  <hr>
     
                </div>
  <?php }else{
    header("Location:/");
  } ?>