 <?php 
 use App\Core\Form;
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){
    
   ?>

	<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <a href="/usagers/ajouter" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Ajouter Usager</a>
          </div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h1 class="m-0 font-weight-bold text-primary">LISTE DES USAGERS ENTREPRISE</h1>
  
       </div>
       <div class="card-body">
       <div class="table-responsive">
<table class="table table-bordered table-striped" id="dataTable" data-order="[[ 0, &quot;asc&quot; ]]" width="100%" cellspacing="0">
<thead>
		<tr>
		<th>Usager</th>
		<th>Domaine</th>
		<th>Contact</th>
		<th>Email</th>
		<th>Adresse</th>
		<th>Créé le</th>
		<th>Modifié le</th>
		<th>Actions</th>
		</tr>
</thead>
	<tbody>
		<?php foreach($usagers as $usager):?>
		 <?php if($usager->type_usager == 1){?>
			<tr>
				<td><?=$usager->usager;?></td>
				<td><?=$usager->designation;?></td>
				<td><?=$usager->contact==""?"NEANT":$usager->contact;?></td>
				<td><?=$usager->email==""?"NEANT":$usager->email;?></td>
				<td><?=$usager->adresse==""?"NEANT":$usager->adresse;?></td>
				<td><?= $usager->date_creation_usager ;?></td>
				<td><?= $usager->update_at;?></td>
				<td>
					<div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Actions:</div>
                    <div class="dropdown-item">

					<?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_ADMIN'){ ?>
					<a href="/usagers/modifier/<?=$usager->id;?>" class="btn btn-primary" title="Modifier"><i class="far fa-edit"></i></a></div>
					<div class="dropdown-item">
					<a href="/usagers/supprimeUsager/<?=$usager->id;?>" class="btn btn-danger" title="Supprimer"><i class="fas fa-trash"></i></a>
				</div>
					<!--<button class="btn btn-danger" data-toggle="modal" data-target="#supModal">Supprimer</button>-->
				<?php } ?>
				<div class="dropdown-item">
				<?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_SUPERUSER'){ ?>
					<a href="/usagers/modifier/<?=$usager->id;?>" class="btn btn-success" title="Modifier"><i class="far fa-edit"></i></a>
					</div>
					<!--<button class="btn btn-danger" data-toggle="modal" data-target="#supModal">Supprimer</button>-->
				<?php } ?>
				  <div class="dropdown-item">
				  	<a class="dropdown-item" href="#"></a>
                    </div>
                  </div>
				</td>
			</tr>
		<?php } endforeach; ?>
		
	</tbody>

</table></div></div>


<div class="card-header py-3">
      <h1 class="m-0 font-weight-bold text-primary">LISTE DES USAGERS PARTICULIER</h1>
  
       </div>
       <div class="card-body">
       <div class="table-responsive">
<table class="table table-bordered table-striped" id="dataTable2" data-order="[[ 0, &quot;asc&quot; ]]" width="100%" cellspacing="0">
<thead>
		<tr>
		<th>Usager</th>
		<th>Domaine</th>
		<th>Matricule</th>
		<th>Emploi</th>
		<th width="3%">Catégorie</th>
		<th>Date Service</th>
		<th>Contact</th>
		<th>Créé le</th>
		<th>Modifié le</th>
		<th>Actions</th>
		</tr>
</thead>
	<tbody>
		<?php foreach($usagers as $usager):?>
		 <?php if($usager->type_usager == 2){?>
			<tr>
				<td><?=$usager->usager;?></td>
				<td><?=$usager->designation;?></td>
				<td><?=$usager->matricule==""?"NEANT":$usager->matricule;?></td>
				<td><?=$usager->fonction==""?"NEANT":$usager->fonction;?></td>
				<td><?=$usager->grade==""?"NEANT":$usager->grade;?></td>
				<td><?=$usager->date_service==""?"NEANT":$usager->date_service;?></td>
				<td><?=$usager->contact==""?"NEANT":$usager->contact;?></td>
				<td><?= $usager->date_creation_usager ;?></td>
				<td><?= $usager->update_at;?></td>
				<td>
					<div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Actions:</div>
                    <div class="dropdown-item">

					<?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_ADMIN'){ ?>
					<a href="/usagers/modifier/<?=$usager->id;?>" class="btn btn-primary" title="Modifier"><i class="far fa-edit"></i></a></div>
					<div class="dropdown-item">
					<a href="/usagers/supprimeUsager/<?=$usager->id;?>" class="btn btn-danger" title="Supprimer"><i class="fas fa-trash"></i></a>
				</div>
					<!--<button class="btn btn-danger" data-toggle="modal" data-target="#supModal">Supprimer</button>-->
				<?php } ?>
				<div class="dropdown-item">
				<?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_SUPERUSER'){ ?>
					<a href="/usagers/modifier/<?=$usager->id;?>" class="btn btn-success" title="Modifier"><i class="far fa-edit"></i></a>
					</div>
					<!--<button class="btn btn-danger" data-toggle="modal" data-target="#supModal">Supprimer</button>-->
				<?php } ?>
				  <div class="dropdown-item">
				  	<a class="dropdown-item" href="#"></a>
                    </div>
                  </div>
				</td>
			</tr>
		<?php } endforeach; ?>
		
	</tbody>

</table></div></div>


</div>

<!-- Modal -->
<div class="modal fade" id="supModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Supprimer un Ville</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Etes vous s&ucirc;r de vouloir supprimer le Ville?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <a href="/services/supprimeVille/<?=$ville->id;?>" class="btn btn-primary">Confirmer</a>
      </div>
    </div>
  </div>
</div>
<?php }else{
    header("Location:/");
  } ?>
