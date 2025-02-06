<?php 
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){

   ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <a href="/roles/ajouter" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Ajouter R&ocirc;le</a>
          </div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h1 class="m-0 font-weight-bold text-primary">LISTE DES ROLES</h1>
  
       </div>
       <div class="card-body">
       <div class="table-responsive">
<table class="table table-bordered table-striped" id="dataTable" data-order="[[ 3, &quot;desc&quot; ]]" width="100%" cellspacing="0">
<thead>
		<tr>
		<th>ID</th>
		<th>Nom Role</th>
		<th>Privilège</th>
		<th>Date de création</th>
		<th>Actions</th>
		</tr>
</thead>
	<tbody>
		<?php foreach($roles as $role):?>
			<tr>
				<td><?=$role->id;?></td>
				<td><?=$role->libelle;?></td>
				<td><?=$role->roles;?></td>
				<td><?= $role->date_creation ;?></td>
				<td><?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_ADMIN'){ ?>
					<a href="/roles/modifier/<?=$role->id;?>" class="btn btn-success">	<i class="far fa-edit"></i></a>
					<a href="/roles/supprimeRole/<?=$role->id;?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
					<!--<button class="btn btn-danger" data-toggle="modal" data-target="#supModal">Supprimer</button>-->
				<?php } ?>
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
        <h5 class="modal-title" id="exampleModalLabel">Supprimer un r&ocirc;le</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Etes vous s&ucirc;r de vouloir supprimer le R&ocirc;le?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <a href="/services/supprimeService/<?=$role->id;?>" class="btn btn-primary">Confirmer</a>
      </div>
    </div>
  </div>
</div>

  <?php  }else{
    header("Location:/");
  } ?>