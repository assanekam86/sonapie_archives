 <?php 
 use App\Core\Form;
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){
    
   ?>
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
          <!--   <?php /*if($dos != null){ */?>
            <a href="/dossiers/ajouter_dossier/<?php /*=$dos->id;*/?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Ajouter un dossier</a>
          --><?php /*}else{*/?>
<a href="<?= $_SERVER['HTTP_REFERER']; ?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Retour</a>

    <!--  --><?php /*} */?>
          </div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h1 class="m-0 font-weight-bold text-primary"><?=$dos->id!=""? "DOMAINE : ".$dos->designation." -":"";?> LISTE DES DOSSIERS</h1>
  
       </div>
       <div class="card-body">
       <div class="table-responsive">
<table class="table table-bordered table-striped table-hover" id="dataTable" data-order="[[ 0, &quot;asc&quot; ]]" width="100%" cellspacing="0">
<thead>
		<tr>
		<th>Dossier</th>
		<th>Description</th>
		<th>Créé Par</th>
		<th>Domaine de Gestion</th>
		<th>Boite Archive</th>
		<th>Etagère</th>
		<th>Rayon</th>
		<th>Salle</th>
		<th>Ville</th>
		<th>Créé le</th>
		<th>Modifié le</th>
		<th>Actions</th>
		</tr>
</thead>
	<tbody>
		<?php foreach($dossiers as $dossier):?>
			<tr>
				<td><a href="/documents/liste_pieces/<?= $dossier->id;?>" style="color: gray;"><?=$dossier->dossier;?></td>
			<td><a href="/documents/liste_pieces/<?= $dossier->id;?>" style="color: gray;" title="Liste des pièces du dossier"><?=$dossier->desc_dossier;?></td>
						<td><a href="/documents/liste_pieces/<?= $dossier->id;?>" style="color: gray;"><?=strtoupper($dossier->nom." ".$dossier->prenom);?></td>
				<td><a href="/types/types_domaine/<?= $dossier->id;?>" style="color: gray;" title="Liste des typologies du domaine"><?=$dossier->designation;?></td>
				<td><a href="/documents/liste_pieces/<?= $dossier->id;?>" style="color: gray;" title="Liste des pièces du dossier"><?=$dossier->boite;?></td>
				<td><a href="/documents/liste_pieces/<?= $dossier->id;?>" style="color: gray;" title="Liste des pièces du dossier"><?=$dossier->etagere;?></td>
				<td><a href="/documents/liste_pieces/<?= $dossier->id;?>" style="color: gray;" title="Liste des pièces du dossier"><?=$dossier->rayon?></td>
				<td><a href="/documents/liste_pieces/<?= $dossier->id;?>" style="color: gray;" title="Liste des pièces du dossier"><?=$dossier->salle;?></td>
				<td><a href="/documents/liste_pieces/<?= $dossier->id;?>" style="color: gray;" title="Liste des pièces du dossier"><?=$dossier->ville;?></td>
				<td><a href="/documents/liste_pieces/<?= $dossier->id;?>" style="color: gray;" ><?= date('d-m-Y',strtotime($dossier->date_creation_dossier)) ;?></td>
				<td><a href="/documents/liste_pieces/<?= $dossier->id;?>" style="color: gray;"><?= date('d-m-Y',strtotime($dossier->update_at));?></td>
				<td>
					<div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Actions:</div>
                      <div class="dropdown-item">
				<a href="/documents/liste_pieces/<?= $dossier->id;?>" class="btn btn-success" title="Voir les Pièces"><i class="fa fa-bars"></i></a>

				</div>
                    <div class="dropdown-item">
					<?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_ADMIN'){ ?>

					<a href="/dossiers/modifier/<?=$dossier->id;?>" class="btn btn-primary" title="Modifier"><i class="far fa-edit"></i></a>
				</div>
				<div class="dropdown-item">
					<a href="/dossiers/supprimeDossier/<?=$dossier->id;?>" class="btn btn-danger" title="Supprimer"><i class="fas fa-trash"></i></a>
				</div>
					<!--<button class="btn btn-danger" data-toggle="modal" data-target="#supModal">Supprimer</button>-->
				<?php } ?>
				<?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_SUPERUSER'){ ?>
					<div class="dropdown-item">
					<a href="/dossiers/modifier/<?=$dossier->id;?>" class="btn btn-success" title="Modifier"><i class="far fa-edit"></i></a>
					</div>
					<!--<button class="btn btn-danger" data-toggle="modal" data-target="#supModal">Supprimer</button>-->
				<?php } ?>
				
				</div>
				</div>
				</td>
			</tr>
		<?php endforeach; ?>
		
	</tbody>

</table></div></div></div>

<!-- Modal -->
  <!--
<div class="modal fade" id="supModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Supprimer un type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Etes vous s&ucirc;r de vouloir supprimer le Type?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <a href="/services/supprimeType/<?php #$type->id;?>" class="btn btn-primary">Confirmer</a>
      </div>
    </div>
  </div>
</div> -->
<?php }else{
    header("Location:/");
  } ?>
