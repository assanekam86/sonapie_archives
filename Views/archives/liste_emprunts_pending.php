<?php 
use App\Core\Form; 
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){

   ?>
<?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_ADMIN'){ ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h1 class="m-0 font-weight-bold text-primary">PIECES EMPRUNT&Eacute;S</h1>
  
       </div>

 <div class="card-body">
              <div class="table-responsive">

       <table class="table table-bordered table-striped" id="dataTable" data-order="[[ 5, &quot;desc&quot; ]]" width="100%" cellspacing="0">
  <thead>
    <tr>
    <th>N° Pièce</th>
    <th>Domaine</th>
    <th>Typologie</th>
    <th>Dossier</th>
    <th>Demandeur</th>
    <th>Date Emprunt</th>
    <th>Actions</th>
    </tr>
  </thead>
  <tbody>

    <?php foreach($listeEmp as $liste):?>
      <tr>
        <td><?=$liste->reference;?></td>
        <td><?=$liste->designation;?></td>
        <td><?=$liste->type;?></td>
        <td><?=$liste->dossier;?></td>
        <td><?=$liste->matricule." - ".$liste->nom." ".$liste->prenom;?></td>
        <td><?= $liste->date_emprunt ;?></td>
        <td>
          
          <?php if($liste->status_emp == 1): ?>
          <button class="btn btn-danger"><i class="fa fa-close" title="en cours"></i></button>
          <?php else: ?>
          <button class="btn btn-success">valider</button>

          <?php endif; ?>
          <a href="/archives/details_piece/<?=$liste->id_entrees;?>" title="Détails" class="btn btn-success"><i class="fas fa-bars"></i></a>
          <a href="/archives/depot_Emprunt/<?= $liste->id;?>" class="btn btn-success" title="Deposer la pièce"><i class="fa fa-hands-helping"></i></a>

          
        <!--  <button class="btn btn-danger" data-toggle="modal" data-target="#supModal">Supprimer</button> -->
  
        </td>
      </tr>
    <?php endforeach; ?>
    
  </tbody>

</table></div></div>







</div>
  <?php } else{

header("Location: /");
} }
  ?>