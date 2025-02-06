 <?php 
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){

   ?> 
<div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">AJOUTER UN ROLE</h1>
                  </div>
                 
               <div class="row m-t-30">
        <div class="col-md-12">

            <div class="row">
                <div class="col-lg-12">
                    <form action="" method="post" enctype="multipart/form-data">

                    <div class="card">
                        <div class="card-body">

                         <div class="form-group">
                                    <label for="slug" class="control-label mb-1">Nom du role</label>
                                    <input id="slug" name="libelle" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                
                                

                                
                                </div>   
                                <div class="form-group">    
                                    <label for="category_id" class="control-label mb-1">Role</label>
                                    <select id="category_id" name="role" class="form-control" aria-required="true" aria-invalid="false">
                                        <option value="">Choisir role</option>
                                        
                                          <?php


                                                foreach($roles as $role){?>
                                                    
                                                <option value="<?= $role->roles; ?>">
                                                    <?=$role->libelle;?>
                                                        
                                                    </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>    
                                    </div>

                                      <div class="row mt-2">
                            <div class="col-md-8 offset-md-2 form-group">
                            <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block" >
                                crée le role
                            </button>
                        </div>
                    </div>
                    <hr>


                  
                  <hr>
                </div>
                </div>
                   </form>
                </div>
                </div>
                </div>
     
                </div>
              </div>

  <?php  }else{
    header("Location:/");
  } ?>