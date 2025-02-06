 <?php 
use App\Core\Form; 
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){

   ?>
<!-- liste des documents -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h1 class="m-0 font-weight-bold text-primary"> DOCUMENTS SUPPRIM&Eacute;S</h1>
  
       </div>
       <div class="card-body">
       <div class="table-responsive">
<table class="table table-bordered table-striped" id="dataTable" data-order="[[ 3, &quot;desc&quot; ]]" width="" cellspacing="0">
<thead>
		<tr>
		<th>Référence</th>
		<th>Service</th>
		<th>utilisateur</th>
		<th>Date Création</th>
		<th>Action</th>
		</tr>
</thead>
	<tbody>
		<?php foreach ($afficheDoc as $affiche ):?>
			<tr>
				<td><?=$affiche->reference;?></td>
				<td><?=$affiche->designation;?></td>
				<td><?= $affiche->nom." ".$affiche->prenom ;?></td>
				<td><?= $affiche->date_creation_doc;?></td>
				<td><?php if($_SESSION['user']['roles'] == 'ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER'){?>
					<a href="/documents/restaureDocuments/<?=$affiche->id;?>" title="Restaurer" id="b2" class="btn btn-success"><i class="fas fa-trash-restore"></i></a>&nbsp;			
					<!--<button class="btn btn-danger" data-toggle="modal" data-target="#supModal">Supprimer</button>-->
				<?php } ?>
				</td>
			</tr>
		<?php endforeach; ?>

		
	</tbody>

</table></div></div></div>
<?php
                 }else{
                    header("Location: /");
                    exit;
        
    } ?>