<?php 
use App\Core\Form;
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){
    
   ?>
 <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">AJOUTER ETAGERE</h1>
                  </div>
                 
                  <div class="row m-t-30">
        <div class="col-md-12">

            <div class="row">
                <div class="col-lg-12">
                    <form id="form1" action="" method="post" enctype="multipart/form-data"target="">

                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="slug" class="control-label mb-1">Libéllé Etagère</label>
                                <input id="slug" name="etagere" type="text" class="form-control" aria-required="true" aria-invalid="false">    
                            </div>  

                      <div class="row">
                            <div class="col-md-6 form-group">
                                    <label for="etagere" class="control-label mb-1">Rayon de l'étagère</label>
                                        <select name="rayon" class="form-control single" id="rayon">
                                            <option value="">Choisir le Rayon</option>
                                          <?php
                                                foreach($rayons as $rayon){?>
                                                     
                                                <option value="<?= $rayon->id; ?>">
                                                <?=$rayon->rayon;?> ( Salle: <?=$rayon->salle?> | Ville: <?=$rayon->ville?> )
                                                 </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>                                    
                                      </div>
                           
                                    <div class=" col-md-3 form-group">
                                    <label for="doss" class="control-label mb-1">Ville</label>
                                       <!--<input type="text" name="ville" value="" id="ville" class="form-control" /> -->
                                        <select name="ville" class="form-control single" id="ville" disabled>
                                            
                                         
                                        </select>                                     
                                    </div>
                                     <div class=" col-md-3 form-group">
                                    <label for="doss" class="control-label mb-1">Salle</label>
                                       <!--<input type="text" name="ville" value="" id="ville" class="form-control" /> -->
                                        <select name="salle" class="form-control single" id="salle" disabled>   
                                        </select>                                     
                                    </div>
                                     
                            </div>

                                        
                                      
                                      <div class="row mt-2">
                            <div class="col-md-8 offset-md-2 form-group">
                            <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block" >
                                Créer l'Etagere
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