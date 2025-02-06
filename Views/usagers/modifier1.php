<?php 
 use App\Core\Form;
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){   
?>
<div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">MODIFIER UN USAGER</h1>
                  </div>
                 
<?php 
$req="select * from usagers ORDER BY usager asc";
$valides = Db::getInstance()->query($req);
$valide = $valides->fetchAll();
 ?>          

    <div class="row m-t-30">
        <div class="col-md-12">

            <div class="row">
                <div class="col-lg-12">
                    <form id="form1" action="" method="post" enctype="multipart/form-data"target="_blank">

                    <div class="card">
                        <div class="card-body">
                            

                            <div class="form-group">
                                    <label for="serv" class="control-label mb-1">Type Usager :  PARTICULIER</label>
                                        <!--<select name="type" class="form-control single" id="serv">
                                            <option value="">Choisir type Usager</option>
                                          <?php
                                                /*foreach($listeUsagers as $liste){?>
                                                    <?php if($liste->id==$usager->type_usager): ?>
                                                 <option selected="selected" value="<?= $liste->id; ?>" >
                                                     <?php else: ?>
                                                <option value="<?= $liste->id; ?>">
                                                <?php endif; ?>
                                                <?=$liste->types;?> 
                                                 </option>
                                                 <?php
                                                    }*/
                                         ?>
                                        </select>-->                                    
                            </div> 
                                      
                                       
                                       
                                 <div id="parti"> 
                            <div class="form-group">
                                <label for="slug" class="control-label mb-1">Usager</label>
                                    <input id="slug" name="usager"  type="text" value="<?= $usager->usager;?>" class="form-control" aria-required="true" aria-invalid="false">                            </div> 
                                    <div class="form-group">
                                <label for="slug1" class="control-label mb-1">Matricule</label>
                                <input id="slug1" name="matricule"  type="text" value="<?= $usager->matricule;?>" class="form-control" aria-required="true" aria-invalid="false">
                                 </div> 

                                 <div class="form-group">
                                  <label for="slug2" class="control-label mb-1">Fonction</label>
                                  <input id="slug2" name="fonction" value="<?= $usager->fonction;?>" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                 </div> 

                                 <div class="form-group">
                                  <label for="slug3" class="control-label mb-1">Grade</label>
                                  <input id="slug3" name="grade" value="<?= $usager->grade;?>" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                 </div> 

                                 <div class="form-group">
                                  <label for="slug4" class="control-label mb-1">Etablissement</label>
                                  <input id="slug4" name="etable" type="text" value="<?= $usager->etablissement;?>" class="form-control" aria-required="true" aria-invalid="false">
                                 </div>

                                 <div class="form-group">
                                  <label for="slug5" class="control-label mb-1">Date de service</label>
                                  <input id="slug5" name="dateserv" type="date" value="<?= $usager->date_service;?>" class="form-control" aria-required="true" aria-invalid="false">
                                 </div> 
                                 <div class="form-group">
                                <label for="slug" class="control-label mb-1">Contact</label>
                                <input id="slug" name="contact" type="text" value="<?= $usager->contact;?>" class="form-control" aria-required="true" aria-invalid="false">
                            </div> 

                              
                          <!--   
                           <div id="entreprise">
                               <div class="form-group">
                                <label for="slug" class="control-label mb-1">Usager</label>
                                <input id="slug" name="usager"  type="text" value="<?= $usager->usager;?>" class="form-control" aria-required="true" aria-invalid="false"> 
                             </div>
                            <div class="form-group">
                                <label for="slug" class="control-label mb-1">Contact</label>
                                <input id="slug" name="contact" type="text" value="<?= $usager->contact;?>" class="form-control" aria-required="true" aria-invalid="false">
                            </div>
                          
                              <div class="form-group">
                                <label for="slug" class="control-label mb-1">Email</label>
                               <input id="slug" name="email" type="text" value="<?= $usager->email;?>" class="form-control" aria-required="true" aria-invalid="false"> 
                            </div> 
                              <div class="form-group">
                                <label for="slug" class="control-label mb-1">Adresse</label>
                               <input id="slug" name="adresse" type="text" value="<?= $usager->adresse;?>" class="form-control" aria-required="true" aria-invalid="false">  
                            </div>
                           </div> -->
                       

                                      

                                      <div class="row mt-2">
                            <div class="col-md-8 offset-md-2 form-group">
                            <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block" >
                                Modifier usager
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