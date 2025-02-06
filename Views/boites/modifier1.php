 <?php 
 use App\Core\Form;
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){
    
   ?>
  
  <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">MODIFIER LA BOITE ARCHIVE</h1>
                  </div>
                 
                 

    <div class="row m-t-30">
        <div class="col-md-12">

            <div class="row">
                <div class="col-lg-12">
                    <form id="form1" action="" method="post" enctype="multipart/form-data"target="">

                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="slug" class="control-label mb-1">Boite Archive</label>
                                <input id="slug" name="boite"  value="<?= $boite->boite;?>" type="text" class="form-control" aria-required="true" aria-invalid="false">    
                            </div>  

                             <div class="form-group">
                                <label for="slug" class="control-label mb-1">Description Boite</label>
                                <textarea id="slug" name="description"  value="<?= $boite->desc_boite;?>" type="text" class="form-control" aria-required="true" aria-invalid="false"><?= $boite->desc_boite;?> </textarea>   
                            </div> 


                                        <div class="form-group">
                                    <label for="serv" class="control-label mb-1">Etagère de la boite</label>
                                        <select name="etagere" class="form-control single" id="serv">
                                            <option value="">Choisir Etagère</option>
                                          <?php
                                                foreach($etageres as $etagere){?>
                                                    <?php if($etagere->id==$boite->id_etagere): ?>
                                                 <option selected="selected" value="<?= $etagere->id; ?>" >
                                                     <?php else: ?>
                                                <option value="<?= $etagere->id; ?>">
                                                <?php endif; ?>
                                                <?=$etagere->etagere;?> 
                                                 </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>                                    
                                      </div>
                                      <div class="form-group">
                                    <label for="serv" class="control-label mb-1">Domaine de la boite</label>
                                        <select name="categorie" class="form-control single" id="serv">
                                            <option value="">Choisir Domaine</option>
                                          <?php
                                                foreach($domaines as $domaine){?>
                                                    <?php if($domaine->id==$boite->id_etagere): ?>
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
                                Modifier la Boite
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