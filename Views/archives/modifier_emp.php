<?php 
use App\Core\Form; 
use App\Models\UsersModel;
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){
if($_SESSION['user']['nom']){
  
   if((time() - $_SESSION['last_login_timestamp']) > 900){
      $user = new UsersController;
      $user->logout();
   }
   ?>
 <div class="row">
             <div class="col-md-12">
              <div class="card">
                <div class="card-header bg-primary text-white">
                   Modifier Emplacement
                </div>
                    <div class="card-body">
                    <blockquote class="blockquote mb-0">
                      <form action="" method="post" enctype="multipart/form-data">

                             <div class="form-group">
                                    <label for="slug" class="control-label mb-1">Libéllé :</label>
                                    <input id="slug" name="empls" placeholder="Entrer l'emplacement"  value="<?= $empls->casier; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" required>            
                            </div>
                            <div class="row mt-2">
                            <div class="col-md-8 offset-md-2 form-group">
                            <button id="payment-button" name="" type="submit" class="btn btn-lg btn-primary btn-block" >
                                Modifier
                            </button>
                        </div>
                    </div>

                   </form>
                    </blockquote>
                    </div>
                </div>
             </div>


             </div>

             <?php } }else{
        header('Location: /');
        exit;
    } ?>

            