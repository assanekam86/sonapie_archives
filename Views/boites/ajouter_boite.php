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
                                  <div class="row">
                                    <div class=" col-md-4 form-group">
                                    <label for="doss" class="control-label mb-1">Ville</label>
                                       <!--<input type="text" name="ville" value="" id="ville" class="form-control" /> -->
                                        <select name="ville" class="form-control single" id="ville">
                                            
                                         <option value="">Choisir La ville</option>
                                          <?php
                                                foreach($villes as $ville){?>
                                                     
                                                <option value="<?= $ville->id;?>">
                                                <?=$ville->ville;?>
                                                 </option>
                                                 <?php
                                                    }
                                         ?>  
                                        </select>                                     
                                    </div>
                                     <div class=" col-md-4 form-group">
                                    <label for="doss" class="control-label mb-1">Salle</label>
                                       <!--<input type="text" name="ville" value="" id="ville" class="form-control" /> -->
                                        <select name="salle" class="form-control single" id="salle">   
                                        </select>                                     
                                    </div>
                                     <div class=" col-md-4 form-group">
                                    <label for="doss" class="control-label mb-1">Rayon</label>
                                       <!--<input type="text" name="ville" value="" id="ville" class="form-control" /> -->
                                        <select name="rayon" class="form-control single" id="rayon">
                                        </select>                                     
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label for="etagere" class="control-label mb-1">Etagère de la boite</label>
                                        <select name="etagere" class="form-control single" id="etager">
                                            
                                        </select>                                    
                                      </div>
                      

                                        
                                      <div class="form-group">
                                    <label for="serv" class="control-label mb-1">Domaine de la boite</label>
                                        <select name="categorie" class="form-control single" id="serv" disabled>
                                            <option value="">Choisir Domaine</option>
                                          <?php
                                                foreach($domaines as $domaine){?>
                                          <option value="<?= $domaine->id; ?>" <?=$boites->id==$domaine->id?'selected=selected':'';?>>
                                             <?=$domaine->designation;?> 
                                          </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select> 
                                        <input type="hidden" name="categorie" value="<?=$boites->id;?>">                                   
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