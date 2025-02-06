 <?php 
use App\Core\Form; 
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){

   ?>
<!--	<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <a href="/domaines/ajouter" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Ajouter Domaine</a>
          </div>-->
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h1 class="m-0 font-weight-bold text-primary">LISTE DES DOMAINES</h1>
            </div>
            <div class="card-body">
              <div class="table-responsive">
<table class="table table-bordered table-striped table-hover" id="dataTable" data-order="[[ 0, &quot;asc&quot; ]]" width="100%" cellspacing="0">
	<thead>
		<tr>
		
		<th>Nom Domaine</th>
		<th>Description</th>
		<th>Direction</th>
		<th>crée le</th>
		<th>Modifié le</th>
		<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($categories as $categorie):?>
			<tr>
			
				<td><a href="/types/types_domaine/<?= $categorie->id;?>" style="color: gray;"><?=$categorie->designation;?></a></td>
				<td><a href="/types/types_domaine/<?= $categorie->id;?>" style="color: gray;"><?=$categorie->desc_cat;?></a></td>
				<td><a href="/types/types_domaine/<?= $categorie->id;?>" style="color: gray;"><?=$categorie->designat;?></a></td>
				<td><?= $categorie->date_creation_cat ;?></td>
				<td><?= $categorie->update_at ;?></td>
				<td>
					<div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Actions:</div>
                    

					<?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_SUPERUSER'){ ?>
						<div class="dropdown-item">
					<a href="/domaines/modifier/<?=$categorie->id;?>" class="btn btn-success" title="Modifier"><i class="far fa-edit"></i></a>
				</div>
				<!--	<button class="btn btn-danger" data-toggle="modal" data-target="#supModal">Supprimer</button> -->
					<?php } ?>
					<div class="dropdown-item">
					<a href="/types/types_domaine/<?= $categorie->id;?>" class="btn btn-info" title="liste des Typologies"><i class="fas fa-fw fa-wrench"></i></a>
				</div>
				<div class="dropdown-item">
					<a href="/boites/boites_domaine/<?= $categorie->id;?>" class="btn btn-warning" title="liste des boites"><i class="fas fa-fw fa-box-open"></i></a>
				</div>
				<div class="dropdown-item">
					<a href="/dossiers/dossiers_domaine/<?= $categorie->id;?>" class="btn btn-secondary" title="liste des dossiers"><i class="fas fa-fw fa-folder"></i></a>
				</div>
				<div class="dropdown-item">
					<a href="/documents/pieces_domaine/<?= $categorie->id;?>" class="btn btn-success" title="liste des pièces"><i class="fa fa-bars"></i></a>
				</div>
				<div class="dropdown-item">
					<?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_ADMIN'){ ?>
					<a href="/domaines/modifier/<?=$categorie->id;?>" class="btn btn-primary" title="Modifier"><i class="far fa-edit"></i></a>
				</div>
				<div class="dropdown-item">
					<a href="/domaines/supprimeDomaine/<?=$categorie->id;?>" class="btn btn-danger" title="Spprimer"><i class="fas fa-trash"></i></a></div>
				<!--	<button class="btn btn-danger" data-toggle="modal" data-target="#supModal">Supprimer</button> -->
					<?php } ?>
				</div>
			</div>
				</td>
			</tr>
		<?php endforeach; ?>
		
	</tbody>

</table> </div></div></div>
<!-- Modal -->
<div class="modal fade" id="supModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Supprimer une catégorie</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Etes vous s&ucirc;r de vouloir supprimer cette catégorie?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <a href="/categories/supprimeCategorie/<?=$categorie->id;?>" class="btn btn-primary">Confirmer</a>
      </div>
    </div>
  </div>
</div>

      <?php
                 }else{
                    header("Location: /");
                    exit;
        
    } ?>
