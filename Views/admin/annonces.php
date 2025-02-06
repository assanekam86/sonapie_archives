<h1 class="text-center">LISTE DES ANNONCES</h1>
<table class="table table-striped">
	<thead>
		<tr><th>ID</th>
		<th>Titre</th>
		<th>Contenu</th>
		<th>Actif</th>
		<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($annonces as $annonce):?>
			<tr>
				<td><?=$annonce->id;?></td>
				<td><?=$annonce->titre;?></td>
				<td><?= substr($annonce->description, 0,50) ;?>...</td>
				<td>
				<div class="custom-control custom-switch">
 				 <input type="checkbox" class="custom-control-input" id="customSwitch<?=$annonce->id;?>" <?= $annonce->actif ? 'checked':''?> data-id="<?=$annonce->id;?>">
 				<label class="custom-control-label" for="customSwitch<?=$annonce->id;?>"></label>
				</div>

					</td>
				<td>
					<a href="/annonces/modifier/<?=$annonce->id;?>" class="btn btn-warning">Modifier</a>
					<button class="btn btn-danger" data-toggle="modal" data-target="#supModal">Supprimer</button>
				</td>
			</tr>
		<?php endforeach; ?>
		
	</tbody>

</table>
<!-- Modal -->
<div class="modal fade" id="supModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Supprimer une annonce</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Etes vous s&ucirc;r de vouloir supprimer cette annonce?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <a href="/admin/supprimeAnnonce/<?=$annonce->id;?>" class="btn btn-primary">Confirmer</button>
      </div>
    </div>
  </div>
</div>