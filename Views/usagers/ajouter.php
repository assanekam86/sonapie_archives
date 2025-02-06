<?php 
 use App\Core\Form;
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){
    
   ?>
<div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">AJOUTER UN USAGER</h1>
                  </div>
                 
                 

    <div class="row m-t-30">
        <div class="col-md-12">

            <div class="row">
                <div class="col-lg-12">
                    <form id="form1" action="" method="post" enctype="multipart/form-data"target="">

                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="slug" class="control-label mb-1">Usager</label>
                                <input id="slug" name="usager" placeholder="Nom de l'usager ..."  value="" type="text" class="form-control" aria-required="true" aria-invalid="false" required>    
                            </div> 
         <?php 
            $req="select * from status";
            $valides = Db::getInstance()->query($req);
            $valide = $valides->fetchAll();
         ?>
                              <div class="form-group">
                                    <label for="serv" class="control-label mb-1">Type Usager</label>
                                        <select name="type" id="usagers" class="form-control single usager" required>
                                            <option value="">Choisir type Usager</option>
                                          <?php
                                                foreach($valide as $liste){?>
                                          
                                                 <option value="<?= $liste->id; ?>" >
                                                <?=$liste->types;?> 
                                                 </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>                                    
                                 </div>
                                 <div id="particulier"> 
                                    <div class="form-group">
                                <label for="slug1" class="control-label mb-1">Matricule</label>
                                <input id="slug1" name="matricule" placeholder="Matricule ..." type="text" class="form-control" aria-required="true" aria-invalid="false">
                                 </div> 

                                 <div class="form-group">
                                  <label for="slug2" class="control-label mb-1">Emploi</label>
                                  <input id="slug2" name="fonction" placeholder="Fonction ..." type="text" class="form-control" aria-required="true" aria-invalid="false">
                                 </div> 

                                 <div class="form-group">
                                  <label for="slug3" class="control-label mb-1">Catégorie</label>
                                  <input id="slug3" name="grade" type="text" placeholder="Grade ..." class="form-control" aria-required="true" aria-invalid="false">
                                 </div> 

                                 <div class="form-group">
                                  <label for="slug4" class="control-label mb-1">Etablissement</label>
                                  <input id="slug4" name="etable" type="text" placeholder="Etablissement ..." class="form-control" aria-required="true" aria-invalid="false">
                                 </div>

                                 <div class="form-group">
                                  <label for="slug5" class="control-label mb-1">Date de service</label>
                                  <input id="slug5" name="dateserv" type="date" class="form-control" aria-required="true" aria-invalid="false">
                                 </div>  

                                 </div>
                            <div class="form-group">
                                <label for="slug" class="control-label mb-1">Contact</label>
                                <input id="slug" name="contact" type="text" placeholder="Contact ..." class="form-control" aria-required="true" aria-invalid="false">
                            </div> 
                           <div id="entreprise">
                          
                              <div class="form-group">
                                <label for="slug" class="control-label mb-1">Email</label>
                               <input id="slug" name="email" type="text" placeholder="Email ..." class="form-control" aria-required="true" aria-invalid="false"> 
                            </div> 
                              <div class="form-group">
                                <label for="slug" class="control-label mb-1">Adresse</label>
                               <input id="slug" name="adresse" type="text" placeholder="Adresse ..." class="form-control" aria-required="true" aria-invalid="false">  
                            </div>
                           </div> 
                           <div class="form-group">
                                <label for="slug" class="control-label mb-1">Domaine d'intervention</label>
                                <select name="domaine" class="form-control single" id="slug" required>
                                            <option value="">Choisir domaine</option>
                                          <?php
                                                foreach($domaines as $domaine){?>
                                                    
                                                 <option  value="<?= $domaine->id; ?>" >
                                                 <?= $domaine->designation ?>
                                                 </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>
                            </div>


                                      

                                      <div class="row mt-2">
                            <div class="col-md-8 offset-md-2 form-group">
                            <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block" >
                                Ajouter usager
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
      ?>
                 <?php }else{
    header("Location:/users/login");
  } ?>