<?php 
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){

   ?>
 <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">MODIFIER UN ROLE</h1>
                  </div>
                 
                 <?= $modifForm; ?>
                    <hr>

                  
                  <hr>
     
                </div>
                
  <?php  }else{
    header("Location:/");
  } ?>