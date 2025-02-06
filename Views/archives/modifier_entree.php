 <?php 
use App\Core\Form; 
use App\Models\UsersModel;
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){
if($_SESSION['user']['nom']){
  
   if((time() - $_SESSION['last_login_timestamp']) > 900){
      $user = new UsersController;
      $user->logout();
   }
   ?>
   <div class="row">
             <div class="col-md-12">
              <div class="card">
                <div class="card-header bg-primary text-white">
                   Modifier une Entrée
                </div>
                    <div class="card-body">
                    <blockquote class="blockquote mb-0">
                      <form action="" method="post" enctype="multipart/form-data">
                          <div class="row">
                            <div class="col-md-12">
                             <div class="form-group">
                                    <label for="slug" class="control-label mb-1">Libéllé :</label>
                                    <input id="slug" name="name" placeholder="Entrer le Libéllé"  value="<?= $entres->name; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" required>            
                            </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">    
                                    <label for="category_id" class="control-label mb-1">Cote</label>
                                    <select id="category_id" name="cote" class="form-control" aria-required="true" aria-invalid="false" required>
                                        <option value="">Choisir cote</option>
                                        
                                       <?php


                                                foreach($cotes as $cote){?>
                                                    <?php if($cote->libelle==$entres->id_cote):?>
                                                <option selected="selected" value="<?= $cote->libelle; ?>">

                                                    <?php else: ?>
                                                <option value="<?= $cote->libelle; ?>">
                                                <?php endif; ?>
                                                    <?=$cote->libelle;?>
                                                        
                                                    </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>    
                            </div>
                          </div>
                        
                            <div class="col-md-6">
                              <div class="form-group">    
                                    <label for="category_id" class="control-label mb-1">Nature</label>
                                    <select id="category_id" name="nature" class="form-control" aria-required="true" aria-invalid="false" required>
                                        <option value="">Choisir nature</option>
                                        
                                          <?php


                                                foreach($natures as $nature){?>
                                                    <?php if($nature->designation==$entres->id_cat):?>
                                                <option selected="selected" value="<?= $nature->designation; ?>">

                                                    <?php else: ?>
                                                <option value="<?= $nature->designation; ?>">
                                                <?php endif; ?>
                                                    <?=$nature->designation;?>
                                                        
                                                    </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>    
                                    </div>
                                </div>
                              </div>
                          <div class="row">
                            <div class="col-md-4">
                                    <div class="form-group">    
                                    <label for="category_id" class="control-label mb-1">Type</label>
                                    <select id="category_id" name="type" class="form-control" aria-required="true" aria-invalid="false" required>
                                        <option value="">Choisir Type</option>
                                        
                                          <?php


                                                foreach($types as $type){?>
                                                    <?php if($type->type==$entres->id_type):?>
                                                <option selected="selected" value="<?= $type->type; ?>">

                                                    <?php else: ?>
                                                <option value="<?= $type->type; ?>">
                                                <?php endif; ?>
                                                    <?=$type->type;?>
                                                        
                                                    </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>    
                                    </div>
                              </div>

                            <div class="col-md-4">
                                    <div class="form-group">    
                                    <label for="category_id" class="control-label mb-1">Rayon</label>
                                    <select id="category_id" name="rayon" class="form-control" aria-required="true" aria-invalid="false" required>
                                        <option value="">Choisir Rayon</option>
                                        
                                        <?php


                                                foreach($rayons as $rayon){?>
                                                    <?php if($rayon->designation==$entres->id_rayon):?>
                                                <option selected="selected" value="<?= $rayon->designation; ?>">

                                                    <?php else: ?>
                                                <option value="<?= $rayon->designation; ?>">
                                                <?php endif; ?>
                                                    <?=$rayon->designation;?>
                                                        
                                                    </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>    
                                    </div>
                              </div>
                            
                              <div class="col-md-4">
                                    <div class="form-group">    
                                    <label for="category_id" class="control-label mb-1">Emplacement</label>
                                    <select id="category_id" name="empl" class="form-control" aria-required="true" aria-invalid="false" required>
                                        <option value="">Choisir Emplacement</option>
                                        
                                          <?php


                                                foreach($empls as $empl){?>
                                                    <?php if($empl->casier==$entres->id_empl):?>
                                                <option selected="selected" value="<?= $empl->casier; ?>">

                                                    <?php else: ?>
                                                <option value="<?= $empl->casier; ?>">
                                                <?php endif; ?>
                                                    <?=$empl->casier;?>
                                                        
                                                    </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>    
                                    </div>
                                  </div>
                              </div>
                             <div class="form-group">
                                    <label for="slug" class="control-label mb-1">Description :</label>
                                    <textarea id="slug" name="description" placeholder="Entrer la Description"  class="form-control" aria-required="true" aria-invalid="false" required><?= $entres->description; ?></textarea>         
                            </div>
                            <div class="row mt-2">
                            <div class="col-md-8 offset-md-2 form-group">
                            <button id="payment-button" name="ajoutcote" type="submit" class="btn btn-lg btn-primary btn-block" >
                                Modifier
                            </button>
                        </div>
                    </div>

                   </form>
                    </blockquote>
                    </div>
                </div>
             </div>
            </div>

                 <?php } }else{
        header('Location: /');
        exit;
    } ?>