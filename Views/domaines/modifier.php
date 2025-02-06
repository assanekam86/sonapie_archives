<?php 
use App\Core\Form; 
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){

   ?>

<div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">MODIFIER LE DOMAINE</h1>
                  </div>
                 
                 

    <div class="row m-t-30">
        <div class="col-md-12">

            <div class="row">
                <div class="col-lg-12">
                    <form id="form1" action="" method="post" enctype="multipart/form-data"target="_blank">

                    <div class="card">
                        <div class="card-body">
                           <div class="form-group">
                                    <label for="slug" class="control-label mb-1">Domaine</label>
                                    <input id="slug" name="categorie"  value="<?= $categorie->designation; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                
                                </div>  
                              <div class="form-group">
                                    <label for="slug" class="control-label mb-1">Domaine</label>
                                    <input id="slug" name="description" value="<?= $categorie->desc_cat; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                
                                </div>

                                        <div class="form-group">
                                    <label for="serv" class="control-label mb-1">Direction</label>
                                        <select name="direction" class="form-control single" id="serv">
                                            <option value="">Choisir la Direction</option>
                                          <?php
                                                foreach($directions as $direct){?>
                                                    <?php if($direct->id==$categorie->id_service): ?>
                                                 <option selected="selected" value="<?= $direct->id; ?>" >
                                                     <?php else: ?>
                                                <option value="<?= $direct->id; ?>">
                                                <?php endif; ?>
                                                <?=$direct->designation;?> 
                                                 </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>                                    
                                      </div>

                                      <div class="row mt-2">
                            <div class="col-md-8 offset-md-2 form-group">
                            <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block" >
                                Modifier le Domaine
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
     
                </div>
                 <?php
     }else{
    http_response_code(404);
    die("Vous ne pouvez pas acceder a cette page");
    exit;
} ?>