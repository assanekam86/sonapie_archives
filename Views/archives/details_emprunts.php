<?php 
use App\Core\Form; 
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){

   ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h1 class="m-0 font-weight-bold text-primary">DETAILS EMPRUNTS</h1>
  
       </div>
       <div class="card-body">
       <div class="table-responsive">
<table class="table table-bordered table-striped" id="dataTable" data-order="[[ 4, &quot;desc&quot; ]]" width="100%" cellspacing="0">
<thead>
		<tr>
		<th>N° Pièce</th>
		<th>Domaine</th>
		<th>Typologie</th>
		<th>Dossier</th>
		<th>Demandeur</th>
		<th>Date de creation</th>
		<th>Date d'emprunt</th>
		<th>Déposer par</th>
		<th>Date depot</th>
		<th style="width:10%;">status</th>
		</tr>
</thead>
	<tbody>
		<?php foreach($demprunts as $emprunt):?>
			<tr>
				
				<td><?=$emprunt->reference;?></td>
				<td><?=$emprunt->designation;?></td>
				<td><?= $emprunt->type;?></td>
				<td><?= $emprunt->dossier;?></td>
				<td><?= strtoupper($emprunt->nom)." ".strtoupper($emprunt->prenom);?></td>
				<td><?= date('d-m-y',strtotime($emprunt->date_creation_doc));?></td>
				<td><?= date('d-m-y',strtotime($emprunt->date_emprunt));?></td>
				<td><?= strtoupper($emprunt->id_user_depot);?></td>
				<td><?= date('d-m-y',strtotime($emprunt->date_depot)) ;?></td>
				<td style="width:10%;">
					<?= $emprunt->status_emp==0? '<div class="btn btn-success"><i class="fa fa-check" title="OK" aria-hidden="true"></i></div>':'<div class="btn btn-danger"><i class="fa fa-ban" aria-hidden="true" title="EN COURS"></i></div>';?>
					<a href="/archives/details_piece/<?=$emprunt->id_entrees;?>" title="Détails" class="btn btn-success"><i class="fas fa-bars"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
		
	</tbody>

</table></div></div></div>

<!-- Modal -->
<div class="modal fade" id="supModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Supprimer un service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Etes vous s&ucirc;r de vouloir supprimer le Service?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <a href="/services/supprimeService/<?=$service->id;?>" class="btn btn-primary">Confirmer</a>
      </div>
    </div>
  </div>
</div>
<?php }else{
        header('Location: /');
        exit;
    } ?>
