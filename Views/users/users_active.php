<?php 
 use App\Core\Form;
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){
    
   ?>
<h1 class="text-center">LISTE DES UTILISATEURS ACTIFS</h1>
<div class="card-body">
       <div class="table-responsive">
<table class="table table-bordered table-striped" id="dataTable" data-order="[[ 4, &quot;desc&quot; ]]" width="100%" cellspacing="0">

	<thead>
		<tr><th>Matricule</th>
		<th>Nom Prénoms</th>
		<th>Email</th>
		<th>Contact</th>
		<th>Date création</th>
		<th>Actif</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($users as $user):?>
			<tr>
				<td><?=$user->matricule;?></td>
				<td><?=$user->nom." ".$user->prenom;?></td>
				<td><?= $user->email;?></td>
				<td><?= $user->contact;?></td>
				<td><?= $user->date_creation_utilisateur;?></td>
				<td>
				<div class="custom-control custom-switch">
 				 <input type="checkbox" class="custom-control-input" id="customSwitch<?=$user->id;?>" <?= $user->actif ? 'checked':''?> data-id="<?=$user->id;?>" <?= ($_SESSION['user']['roles'] != 'USER_ADMIN')? 'disabled':''?> >
 				<label class="custom-control-label" for="customSwitch<?=$user->id;?>"></label>
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
<?php 
}else{
    http_response_code(404);
    die("Vous ne pouvez pas acceder a cette page");
    exit;
} ?>