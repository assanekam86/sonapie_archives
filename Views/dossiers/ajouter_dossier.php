<?php 
use App\Core\Form;
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){
    $query ="SELECT * FROM categories ORDER BY designation asc";
    $result = Db::getInstance()->query($query);
    $rows = $result->rowCount();
   ?>
 <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">AJOUTER UN DOSSIER</h1>
                  </div>
                 
                  <div class="row m-t-30">
        <div class="col-md-12">

            <div class="row">
                <div class="col-lg-12">
                    <form id="form1" action="" method="post" enctype="multipart/form-data"target="">

                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="slug" class="control-label mb-1">Libéllé Dossier</label>
                                <input id="slug" name="dossier" type="text" class="form-control" aria-required="true" aria-invalid="false" required>    
                            </div>  

                             <div class="form-group">
                                <label for="slug" class="control-label mb-1">Description Dossier</label>
                                <textarea id="slug" name="description" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Description de la boite ..."></textarea>   
                            </div> 
                        
                        <div class="row">
                                    <div class=" col-md-3 form-group">
                                    <label for="doss" class="control-label mb-1">Ville</label>
                                       <!--<input type="text" name="ville" value="" id="ville" class="form-control" /> -->
                                        <select name="ville" class="form-control single" id="ville" >
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
                                     <div class=" col-md-3 form-group">
                                    <label for="doss" class="control-label mb-1">Salle</label>
                                       <!--<input type="text" name="ville" value="" id="ville" class="form-control" /> -->
                                        <select name="salle" class="form-control single" id="salle" >   
                                        </select>                                     
                                    </div>
                                     <div class=" col-md-3 form-group">
                                    <label for="doss" class="control-label mb-1">Rayon</label>
                                       <!--<input type="text" name="ville" value="" id="ville" class="form-control" /> -->
                                        <select name="rayon" class="form-control single" id="rayon" >
                                        </select>                                     
                                    </div>
                                     <div class=" col-md-3 form-group">
                                    <label for="doss" class="control-label mb-1">Etagère</label>
                                       <!--<input type="text" name="ville" value="" id="ville" class="form-control" /> -->
                                        <select name="etager" class="form-control single" id="etager">
                                        </select>                                     
                                    </div>
                            </div>

                            <div class="form-group">
                                    <label for="etagere" class="control-label mb-1">Boite d'Archive</label>
                                        <select name="boite" class="form-control single" id="boite" required>
                                           
                                        </select>                                    
                                      </div>
                   
                                   <div class="form-group">
                                    <label for="serv" class="control-label mb-1">Domaine de gestion</label>
                                        <select name="domaine" class="form-control single" id="domaine" disabled>
                                            <option value="">Choisir Domaine</option>
                                           <?php
                                            if($rows>0){

                                              while($row = $result->fetch(PDO::FETCH_ASSOC)){?>
                                                 <option value="<?=$row['id'];?>" <?= $categories->id==$row['id']?'selected=selected':''; ?>><?=$row['designation'];?></option>
                                                 <?php
                                                    }
                                            }
                                        else{
                                echo '<option value="">Domaine non valable</option>';
                                             }
                                         ?>
                                       
                                        </select> <input type="hidden" name="domaine" value="<?=$categories->id;?>">                                   
                              </div>         
                                      

                                      <div class="row mt-2">
                            <div class="col-md-8 offset-md-2 form-group">
                            <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block" >
                                Créer le Dossier
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