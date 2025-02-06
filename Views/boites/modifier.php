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
                          <!--
                            <div class="form-group">
                                <label for="slug" class="control-label mb-1">Boite Archive</label>
                                <input id="slug" name="boite"  value="<?= $boite->boite;?>" type="text" class="form-control" aria-required="true" aria-invalid="false">    
                            </div>
                            -->
                            <div class="form-group">
                                <label for="slug" class="control-label mb-1">Boîte Archive</label>
                                <input id="slug" name="boite" value="<?= $boite->boite; ?>" type="text" class="form-control"
                                       aria-required="true" aria-invalid="false"
                                    <?= $hasDossier ? 'readonly' : ''; ?>>
                            </div>

                             <div class="form-group">
                                <label for="slug" class="control-label mb-1">Description Boite</label>
                                <textarea id="slug" name="description"  value="<?= $boite->desc_boite;?>" type="text" class="form-control" aria-required="true" aria-invalid="false"><?= $boite->desc_boite;?> </textarea>   
                            </div>
                        <div class="row">
                            <!-- Ville -->
                            <!--<div class="col-md-4 form-group">
                                <label for="ville" class="control-label mb-1">Ville</label>
                                <select name="ville" id="ville" class="form-control">
                                    <option value="">Choisir Ville</option>
                                    <?php /*foreach($villes as $ville): */?>
                                        <option value="<?php /*= $ville->id */?>" <?php /*= $boite->id_ville == $ville->id ? 'selected' : '' */?>>
                                            <?php /*= $ville->ville */?>
                                        </option>
                                    <?php /*endforeach; */?>
                                </select>
                            </div>-->

                            <!-- Salle -->
                            <!--<div class="col-md-4 form-group">
                                <label for="salle" class="control-label mb-1">Salle</label>
                                <select name="salle" id="salle" class="form-control">
                                    <option value="">Choisir Salle</option>
                                    <?php /*foreach($salles as $salle): */?>
                                        <option value="<?php /*= $salle->id */?>" <?php /*= $boite->id_salle == $salle->id ? 'selected' : '' */?>>
                                            <?php /*= $salle->salle */?>
                                        </option>
                                    <?php /*endforeach; */?>
                                </select>
                            </div>-->

                            <!-- Rayon -->
                           <!-- <div class=" col-md-4 form-group">
                                <label for="rayon" class="control-label mb-1">Rayon</label>
                                <select name="rayon" id="rayon" class="form-control">
                                    <option value="">Choisir Rayon</option>
                                    <?php /*foreach($rayons as $rayon): */?>
                                        <option value="<?php /*= $rayon->id */?>" <?php /*= $boite->id_rayon == $rayon->id ? 'selected' : '' */?>>
                                            <?php /*= $rayon->rayon */?>
                                        </option>
                                    <?php /*endforeach; */?>
                                </select>
                            </div>-->
                        </div>
                                        <div class="form-group">
                                          <!--  <label for="etagere" class="control-label mb-1">Étagère de la boîte</label>
                                            <select name="etagere" class="form-control single" id="etagere">
                                                <option value="">Choisir Étagère</option>
                                                <?php foreach($etageres as $etagere): ?>
                                                    <option value="<?= $etagere->id ?>" <?= $boite->id_etagere == $etagere->id ? 'selected' : '' ?>>
                                                        <?= $etagere->etagere ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select> -->
                                    <label for="serv" class="control-label mb-1">Etagère de la boite</label>
                                       <!-- <select name="etagere" class="form-control single" id="serv">
                                            <option value="">Choisir Etagère</option>
                                          <?php
/*                                                foreach($etageres as $etagere){*/?>
                                                    <?php /*if($etagere->id==$boite->id_etagere): */?>
                                                 <option selected="selected" value="<?php /*= $etagere->id; */?>" >
                                                     <?php /*else: */?>
                                                <option value="<?php /*= $etagere->id; */?>">
                                                <?php /*endif; */?>
                                                <?php /*=$etagere->etagere;*/?>
                                                 </option>
                                                 <?php
/*                                                    }
                                         */?>
                                        </select>       -->
                                           <select name="etagere" class="form-control single" id="etagere">
                                                <option value="">Choisir Étagère</option>
                                                <?php foreach($etageres as $etagere): ?>
                                                    <option value="<?= $etagere->id ?>" <?= $boite->id_etagere == $etagere->id ? 'selected' : '' ?>>
                                                        <?= $etagere->etagere ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                      </div>
                                      <div class="form-group">
                                    <label for="serv" class="control-label mb-1">Domaine de la boite</label>
                                        <select name="categorie" class="form-control single" id="serv">
                                            <option value="">Choisir Domaine</option>
                                          <?php
                                                foreach($domaines as $domaine){?>
                                                    <?php if($domaine->id==$boite->id_cat): ?>
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