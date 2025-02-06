 <?php 
 use App\Core\Form;
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){
    
   ?>
  
  <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">MODIFIER LA TYPOLOGIE</h1>
                  </div>
                 
                 

    <div class="row m-t-30">
        <div class="col-md-12">

            <div class="row">
                <div class="col-lg-12">
                    <form id="form1" action="" method="post" enctype="multipart/form-data"target="_blank">

                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="slug" class="control-label mb-1">Référence Typologie :</label>

                                <input id="slug" name="ref"  value="<?= $type->code;?>" type="text" disabled class="form-control" aria-required="true" aria-invalid="false">    
                            </div>
                            <div class="form-group">
                                <label for="slug" class="control-label mb-1">Typologie</label>
                                <input id="slug" name="type"  value="<?= $type->type;?>" type="text" class="form-control" aria-required="true" aria-invalid="false">    
                            </div>  

                             <div class="form-group">
                                <label for="slug" class="control-label mb-1">Description Typologie</label>
                                <textarea id="slug" name="description"  value="<?= $type->desc_type;?>" type="text" class="form-control" aria-required="true" aria-invalid="false"><?= $type->desc_type;?> </textarea>   
                            </div> 


                                        <div class="form-group">
                                    <label for="serv" class="control-label mb-1">Domaine de gestion</label>
                                        <select name="domaine" class="form-control single" id="serv">
                                            <option value="">Choisir le domaine</option>
                                          <?php
                                                foreach($domaines as $domaine){?>
                                                    <?php if($domaine->id==$type->id_cat): ?>
                                                 <option selected="selected" value="<?= $domaine->id; ?>" >
                                                     <?php else: ?>
                                                <option value="<?= $domaine->id; ?>">
                                                <?php endif; ?>
                                                <?=$domaine->designation;?> 
                                                 </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>                                    
                                      </div>

                                      <div class="row mt-2">
                            <div class="col-md-8 offset-md-2 form-group">
                            <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block" >
                                Modifier la Typologie
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