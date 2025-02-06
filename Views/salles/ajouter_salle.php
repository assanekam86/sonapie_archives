<?php 
use App\Core\Form;
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){
    
   ?>
 <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">AJOUTER SALLE</h1>
                  </div>
                 
                  <div class="row m-t-30">
        <div class="col-md-12">

            <div class="row">
                <div class="col-lg-12">
                    <form id="form1" action="" method="post" enctype="multipart/form-data"target="">

                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="slug" class="control-label mb-1">Libéllé Salle</label>
                                <input id="slug" name="salle" type="text" class="form-control" aria-required="true" aria-invalid="false" required>    
                            </div>  

                      <div class="row">
                            <div class="col-md-12 form-group">
                                    <label for="etagere" class="control-label mb-1">Ville de la Salle</label>
                                        <input type="text" name="ville" value="<?=$villes->ville;?>" class="form-control" disabled/>
                                         <input type="hidden" name="ville" value="<?=$villes->id;?>" class="form-control"/>                                    
                                    
                                      </div>
                           
                                  
                                     
                            </div>

                                        
                                      
                                      <div class="row mt-2">
                            <div class="col-md-8 offset-md-2 form-group">
                            <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block" >
                                Créer la salle
                            </button>
                        </div>
                    </div>
                        </div>
                    </div>
                   </form>
                </div>

              </div>
            </div>

          </div>

                  
                  <hr>
     
                </div>
                 <?php }else{
    header("Location:/users/login");
  } ?>