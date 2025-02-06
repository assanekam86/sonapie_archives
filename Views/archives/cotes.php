 <div class="row">
             <div class="col-md-3">
              <div class="card">
                <div class="card-header bg-primary text-white">
                   Ajouter Cote
                </div>
                    <div class="card-body">
                    <blockquote class="blockquote mb-0">
                      <form action="" method="post" enctype="multipart/form-data">

                             <div class="form-group">
                                    <label for="slug" class="control-label mb-1">Libéllé :</label>
                                    <input id="slug" name="cotes" placeholder="Entrer la Nature"  value="" type="text" class="form-control" aria-required="true" aria-invalid="false" required>            
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


             <div class="col-md-9">
              <div class="card">
                <div class="card-header bg-success text-white">
                  Liste des Cotes
                </div>
                    <div class="card-body">
                    <blockquote class="blockquote mb-0">
                   
  <table class="table table-bordered table-striped" id="dataTable" cellspacing="0" data-order="[[ 0, &quot;asc&quot; ]]" >
<thead>
    <tr>
  
    <th data-column="intitule" data-order="desc">Cote</th>  
    <th data-column="creele" data-order="desc">Créé le</th>
    <th data-column="modifiele" data-order="desc">Modifié le</th>
    <th data-column="action" data-order="desc">Action</th>
    </tr>
</thead>
  <tbody>
    <?php foreach ($cotes as $cote ):?>
      <tr>
        <td><?=$cote->libelle;?></td>
        <td><?=$cote->date_creation_cotes;?></td>
        <td><?=date('d-m-Y',strtotime($cote->update_at));?></td>
        <td>
          <a href="/archives/modifier_cote/<?=$cote->id;?>" title="Modifier la cote" class="btn btn-primary">
            <i class="far fa-edit"></i>
          </a>
          <a href="/archives/supprimecote/<?=$cote->id;?>" title="Supprimer la cote" class="btn btn-danger">
            <i class="fas fa-trash"></i>
          </a>
          <!--<button class="btn btn-danger" data-toggle="modal" data-target="#supModal">Supprimer</button>-->
        </td>
      </tr>
    <?php endforeach; ?>

    
  </tbody>

</table>


                   
                    </blockquote>
                    </div>
                </div>
             </div>

            </div>