 <div class="row">
             <div class="col-md-3">
              <div class="card">
                <div class="card-header bg-primary text-white">
                   Ajouter Type
                </div>
                    <div class="card-body">
                    <blockquote class="blockquote mb-0">
                      <form action="" method="post" enctype="multipart/form-data">

                             <div class="form-group">
                                    <label for="slug" class="control-label mb-1">Libéllé :</label>
                                    <input id="slug" name="types" placeholder="Entrer le type"  value="" type="text" class="form-control" aria-required="true" aria-invalid="false" required>            
                            </div>
                            <div class="row mt-2">
                            <div class="col-md-8 offset-md-2 form-group">
                            <button id="payment-button" name="" type="submit" class="btn btn-lg btn-primary btn-block" >
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
                  Liste des Types
                </div>
                    <div class="card-body">
                    <blockquote class="blockquote mb-0">
                   <div class="table-responsive">
  <table class="table table-bordered table-striped" id="dataTable2" cellspacing="0" data-order="[[ 0, &quot;asc&quot; ]]" >
<thead>
    <tr>
    <th data-column="intitule" data-order="desc">Types</th>  
    <th data-column="creele" data-order="desc">Créé le</th>
    <th data-column="modifiele" data-order="desc">Modifié le</th>
    <th data-column="action" data-order="desc">Action</th>
    </tr>
</thead>
  <tbody>
    <?php foreach ($types as $type ):?>
      <tr>
        <td><?=$type->type;?></td>
        <td><?=$type->date_creation_type;?></td>
        <td><?=date('d-m-Y',strtotime($type->update_at));?></td>
        <td>
          <a href="/archives/modifier_type/<?=$type->id;?>" title="Modifier le type" class="btn btn-primary">
            <i class="far fa-edit"></i>
          </a>
          <a href="/archives/supprimetype/<?=$type->id;?>" title="Supprimer le type" class="btn btn-danger">
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