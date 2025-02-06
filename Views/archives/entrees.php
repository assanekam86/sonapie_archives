 <div class="row">
             <div class="col-md-12">
              <div class="card">
                <div class="card-header bg-primary text-white">
                   Ajouter une Entrée
                </div>
                    <div class="card-body">
                    <blockquote class="blockquote mb-0">
                      <form action="" method="post" enctype="multipart/form-data">
                          <div class="row">
                            <div class="col-md-12">
                             <div class="form-group">
                                    <label for="slug" class="control-label mb-1">Libéllé :</label>
                                    <input id="slug" name="name" placeholder="Entrer le Libéllé"  value="" type="text" class="form-control" aria-required="true" aria-invalid="false" required>            
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
                                                 <option value="<?=$cote->libelle;?>"><?=$cote->libelle;?></option>
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
                                                 <option value="<?=$nature->designation;?>"><?=$nature->designation;?></option>
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
                                                 <option value="<?=$type->type;?>"><?=$type->type;?></option>
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
                                                 <option value="<?=$rayon->designation;?>"><?=$rayon->designation;?></option>
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
                                                 <option value="<?=$empl->casier;?>"><?=$empl->casier;?></option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>    
                                    </div>
                                  </div>
                              </div>
                             <div class="form-group">
                                    <label for="slug" class="control-label mb-1">Description :</label>
                                    <textarea id="slug" name="description" placeholder="Entrer la Description"  class="form-control" aria-required="true" aria-invalid="false" required></textarea>         
                            </div>
                            <div class="row mt-2">
                            <div class="col-md-8 offset-md-2 form-group">
                            <button id="payment-button" name="ajoutcote" type="submit" class="btn btn-lg btn-primary btn-block" >
                                Créer
                            </button>
                        </div>
                    </div>

                   </form>
                    </blockquote>
                    </div>
                </div>
             </div>
            </div>
<hr>
            <div class="row mt-4">
             <div class="col-md-12">
              <div class="card">
                <div class="card-header bg-success text-white">
                  Liste des Entrées
                </div>
                    <div class="card-body">
                    <blockquote class="blockquote mb-0">
                   <div class="table-responsive">
  <table class="table table-bordered table-striped" id="dataTable6" cellspacing="0" data-order="[[ 6, &quot;desc&quot; ]]" >
<thead>
    <tr>
    <th data-column="intitule" data-order="desc">Libéllé</th>
    <th data-column="" data-order="desc">Description</th>  
    <th data-column="" data-order="desc">Nature</th>  
    <th data-column="" data-order="desc">Type</th>  
    <th data-column="" data-order="desc">Rayon</th>  
    <th data-column="" data-order="desc">Emplacement</th>  
    <th data-column="creele" data-order="desc">Créé le</th>
    <th data-column="modifiele" data-order="desc">Modifié le</th>
    <th data-column="action" data-order="desc">Action</th>
    </tr>
</thead>
  <tbody>
    <?php foreach ($entrees as $entree ):?>
      <tr>
        <td><?=$entree->name;?></td>
        <td><?=$entree->description;?></td>
        <td><?=$entree->id_cat;?></td>
        <td><?=$entree->id_type;?></td>
        <td><?=$entree->id_rayon;?></td>
        <td><?=$entree->id_empl;?></td>
        <td><?=$entree->date_creation_ent;?></td>
        <td><?=date('d-m-Y',strtotime($entree->update_at));?></td>
        <td>
            <?php 

            if($entree->status_entrees==0){ ?>
          <a href="/archives/ajout_emprunt/<?=$entree->id;?>" title="Emprunter" class="btn btn-info">
            <i class="fa fa-hands-helping"></i>
          </a><?php }else{ ?>
             <button title="En cours d'emprunt" disabled class="btn btn-info">
            <i class="fa fa-hands"></i>
          </button><?php 
            }
           ?>
          <a href="/archives/modifier_entree/<?=$entree->id;?>" title="Modifier " class="btn btn-primary">
            <i class="far fa-edit"></i>
          </a>
          <a href="/archives/supprimeentree/<?=$entree->id;?>" title="Supprimer" class="btn btn-danger">
            <i class="fas fa-trash"></i>
          </a>
          <!--<button class="btn btn-danger" data-toggle="modal" data-target="#supModal">Supprimer</button>-->
        </td>
      </tr>
    <?php endforeach; ?>

    
  </tbody>

</table>

</div>
                   
                    </blockquote>
                    </div>
                </div>
             </div>

            </div>