 <?php 
 use App\Core\Form;
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){
    
   ?>
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <a href="/villes/ajouter" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Ajouter Ville</a>
          </div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h1 class="m-0 font-weight-bold text-primary">LISTE DES VILLES</h1>
  
       </div>
       <div class="card-body">
       <div class="table-responsive">
<table class="table table-bordered table-striped table-hover" id="dataTable" data-order="[[ 0, &quot;asc&quot; ]]" width="100%" cellspacing="0">
<thead>
		<tr>
		<th>Nom Ville</th>
		<th>Créé le</th>
		<th>Modifié le</th>
		<th>Actions</th>
		</tr>
</thead>
	<tbody>
		<?php foreach($villes as $ville):?>
			<tr>
				<td><a href="/salles/liste_salle/<?= $ville->id;?>" style="color: gray;"><?=$ville->ville;?></a></td>
				<td><a href="/salles/liste_salle/<?= $ville->id;?>" style="color: gray;"><?= $ville->date_creation_ville ;?></a></td>
				<td><a href="/salles/liste_salle/<?= $ville->id;?>" style="color: gray;"><?= $ville->update_at;?></a></td>
				<td>
					<div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Actions:</div>
                    <div class="dropdown-item">
					<?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_ADMIN'){ ?>
					<a href="/villes/modifier/<?=$ville->id;?>" class="btn btn-primary" title="Modifier"><i class="far fa-edit"></i></a>
				</div>
				 <div class="dropdown-item">
					<a href="/villes/supprimeVille/<?=$ville->id;?>" class="btn btn-danger" title="Supprimer"><i class="fas fa-trash"></i></a>
				</div>
					<!--<button class="btn btn-danger" data-toggle="modal" data-target="#supModal">Supprimer</button>-->
				<?php } ?>
				<?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_SUPERUSER'){ ?>
					 <div class="dropdown-item">
					<a href="/villes/modifier/<?=$ville->id;?>" class="btn btn-success" title="Modifier"><i class="far fa-edit"></i></a>
				</div>
					
					<!--<button class="btn btn-danger" data-toggle="modal" data-target="#supModal">Supprimer</button>-->
				<?php } ?>
				<div class="dropdown-item">
					<a href="/salles/liste_salle/<?= $ville->id;?>" class="btn btn-success" title="liste les Villes"><i class="fa fa-bars"></i></a>
				</div>
				</div>
			</div>
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
