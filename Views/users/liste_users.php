<?php 
use App\Controllers\UsersController;
use App\Core\Db;
if($_SESSION['user']){
  
   ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <a href="/users/register" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Ajouter Utilisateur</a>
          </div>
<h1 class="text-center">LISTE DES UTILISATEURS</h1>
<div class="card-body">
       <div class="table-responsive">
<table class="table table-bordered table-striped" id="dataTable" data-order="[[ 1, &quot;asc&quot; ]]" width="100%" cellspacing="0">

	<thead>
		<tr>
		<th>Matricule</th>
		<th>Nom Prénoms</th>
		<th>Email</th>
		<th>Contact</th>
		<th>R&ocirc;le</th>
		<th>Créé le</th>
		<th>Modifié le</th>
		<th>Actif</th>
		<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($users as $key=>$user):?>
			<tr>
	
				<td><?=$user->matricule;?></td>
				<td><?=$user->nom." ".$user->prenom;?></td>
				<td><?= $user->email;?></td>
				<td><?= $user->contact;?></td>
				<td><?= $user->roles;?></td>
				<td><?= $user->date_creation_utilisateur;?></td>
				<td><?= $user->update_at;?></td>
				<td>
				<div class="custom-control custom-switch">
					 <?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_ADMIN'){?>
 				 <input type="checkbox" class="custom-control-input" id="customSwitch<?=$user->id;?>" <?= $user->actif ? 'checked':''?> data-id="<?=$user->id;?>">
 				<label class="custom-control-label" for="customSwitch<?=$user->id;?>"></label>
 			<?php }else{?>
 				<input type="checkbox" disabled class="custom-control-input" id="customSwitch<?=$user->id;?>" <?= $user->actif ? 'checked':''?> data-id="<?=$user->id;?>">
 				<label class="custom-control-label" for="customSwitch<?=$user->id;?>"></label>
 			<?php } ?>
				</div>

					</td>
				<td>
						<div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Actions:</div>
                    <div class="dropdown-item">
					<a href="/users/modifier/<?=$user->id;?>" class="btn btn-success" title="modifier"><i class="far fa-edit"></i></a>
									</div>
					<!--<button class="btn btn-danger" data-toggle="modal" data-target="#supModal">Supprimer</button> -->
					<?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_ADMIN'){?>
						 <div class="dropdown-item">
					 <a href="/users/supprimeUser/<?=$user->id;?>" class="btn btn-danger" title="Supprimer"><i class="fas fa-trash"></i></a></div>
					 			<?php } ?>
					 		</div>
					 	</div>
				</td>
			</tr>
		<?php endforeach; ?>
		
	</tbody>

</table>
</div></div>
<!-- Modal -->

<div class="modal fade" id="supModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Supprimer un utilisateur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Etes vous s&ucirc;r de vouloir supprimer cette utilisateur?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <a href="/users/supprimeUser/<?=$user->id;?>" class="btn btn-primary">Confirmer</a>
      </div>
    </div>
  </div>
</div>
 <?php }else{
    header("Location:/");
  } ?>