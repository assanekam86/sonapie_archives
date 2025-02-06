<?php 
use App\Core\Form; 
use App\Models\UsersModel;
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){

   ?>
<?php

 if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_ADMIN'){ ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h1 class="m-0 font-weight-bold text-primary">LISTE DES DOCUMENTS DEPOS&Eacute;S</h1>
  
       </div>

 <div class="card-body">
              <div class="table-responsive">

       <table class="table table-bordered table-striped" id="dataTable" data-order="[[ 7, &quot;asc&quot; ]]" width="100%" cellspacing="0">
  <thead>
    <tr>
    <th>N° Pièce</th>
    <th>Domaine</th>
    <th>Typologie</th>
    <th>Dossier</th>
    <th>Demandeur</th>
    <th>Date Emprunt</th>
    <th>Deposé Par</th>
    <th>Date Depot</th>
    <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($listeEmp as $liste): ?>
      <tr>
        <td><?=$liste->reference;?></td>
        <td><?=$liste->designation;?></td>
        <td><?=$liste->type;?></td>
        <td><?=$liste->dossier;?></td>
        <td><?=$liste->matricule."-".$liste->nom." ".$liste->prenom;?></td>
        <td><?= $liste->date_emprunt ;?></td>
        <td><?= $liste->id_user_depot?></td>
        <td><?= $liste->date_depot;?></td>
        <td style="width:10%;">
          
          <?php if($liste->status_emp == 1): ?>
          <button class="btn btn-danger">en cours</button>
          <?php else: ?>
          <a title="Document deposer" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i>
          </a>

          <?php endif; ?>
         <a href="/archives/details_piece/<?=$liste->id;?>" title="Détails" class="btn btn-success"><i class="fas fa-bars"></i></a>

          
        <!--  <button class="btn btn-danger" data-toggle="modal" data-target="#supModal">Supprimer</button> -->
  
        </td>
      </tr>
    
  <?php endforeach; ?>
    
  </tbody>

</table></div></div>







</div>
  <?php } else{

header("Location: /");
}
}
  ?>