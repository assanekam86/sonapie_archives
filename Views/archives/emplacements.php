 <div class="row">
             <div class="col-md-3">
              <div class="card">
                <div class="card-header bg-primary text-white">
                   Ajouter Emplacement
                </div>
                    <div class="card-body">
                    <blockquote class="blockquote mb-0">
                      <form action="" method="post" enctype="multipart/form-data">

                             <div class="form-group">
                                    <label for="slug" class="control-label mb-1">Libéllé :</label>
                                    <input id="slug" name="empls" placeholder="Entrer l'emplacement"  value="" type="text" class="form-control" aria-required="true" aria-invalid="false" required>            
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
                  Liste des Emplacements
                </div>
                    <div class="card-body">
                    <blockquote class="blockquote mb-0">
                   <div class="table-responsive">
  <table class="table table-bordered table-striped" id="dataTable3" cellspacing="0" data-order="[[ 0, &quot;asc&quot; ]]" >
<thead>
    <tr>
    
    <th data-column="intitule" data-order="desc">Emplacement</th>  
    <th data-column="creele" data-order="desc">Créé le</th>
    <th data-column="modifiele" data-order="desc">Modifié le</th>
    <th data-column="action" data-order="desc">Action</th>
    </tr>
</thead>
  <tbody>
    <?php foreach ($empls as $emp ):?>
      <tr>
       
        <td><?=$emp->casier;?></td>
        <td><?=$emp->date_creation_emp;?></td>
        <td><?=date('d-m-Y',strtotime($emp->update_at));?></td>
        <td>
          <a href="/archives/modifier_emp/<?=$emp->id;?>" title="Modifier le rayon" class="btn btn-primary">
            <i class="far fa-edit"></i>
          </a>
          <a href="/archives/supprimeremp/<?=$emp->id;?>" title="Supprimer le rayon" class="btn btn-danger">
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