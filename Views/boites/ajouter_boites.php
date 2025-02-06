<?php 
use App\Core\Form;
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){
    
   ?>
 <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">AJOUTER UNE BOITE ARCHIVE</h1>
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
                                <input id="slug" name="boite" type="text" class="form-control" aria-required="true" aria-invalid="false">    
                            </div>  

                             <div class="form-group">
                                <label for="slug" class="control-label mb-1">Description Boite</label>
                                <textarea id="slug" name="description" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Description de la boite ..."></textarea>   
                            </div> 
                            <div class="form-group">
                                    <label for="etagere" class="control-label mb-1">Etagère de la boite</label>
                                        <select name="etagere" class="form-control" id="etagere" disabled>
                                            <option value="">Choisir Etagère</option>
                                          <?php
                                                foreach($etageres as $etagere){?>
                                                     
                                                <option value="<?= $etagere->id; ?>" <?= $etages->id==$etagere->id?'selected=selected':''; ?>>
                                                <?=$etagere->etagere;?> ( Rayon: <?=$etagere->rayon;?> | Salle:  <?=$etagere->salle;?> | Ville:  <?=$etagere->ville;?> )
                                                 </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>    
                                        <input type="hidden" name="etagere" class="form-control" value="<?=$etages->id;?>">                                
                                      </div>
                            <div class="row">
                                    <div class=" col-md-4 form-group">
                                    <label for="doss" class="control-label mb-1">Ville</label>
                                       <!--<input type="text" name="ville" value="" id="ville" class="form-control" /> -->
                                        <input type="text" name="ville" class="form-control" value="<?=$etages->ville;?>" id="ville" disabled>
                                            
                                         
                                                                        
                                    </div>
                                     <div class=" col-md-4 form-group">
                                    <label for="doss" class="control-label mb-1">Salle</label>
                                       <!--<input type="text" name="ville" value="" id="ville" class="form-control" /> -->
                                        <input type="text" value="<?=$etages->salle;?>" name="salle" class="form-control" id="salle" disabled>   
                                                                            
                                    </div>
                                     <div class=" col-md-4 form-group">
                                    <label for="doss" class="control-label mb-1">Rayon</label>
                                       <!--<input type="text" name="ville" value="" id="ville" class="form-control" /> -->
                                        <input type="text" value="<?=$etages->rayon;?>" name="rayon" class="form-control" id="rayon" disabled>
                                                                            
                                    </div>
                            </div>

                                        
                                      <div class="form-group">
                                    <label for="serv" class="control-label mb-1">Domaine de la boite</label>
                                        <select name="categorie" class="form-control single" id="serv">
                                            <option value="">Choisir Domaine</option>
                                          <?php
                                                foreach($domaines as $domaine){?>
                                          <option value="<?= $domaine->id; ?>">
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
                                Créer la Boite
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