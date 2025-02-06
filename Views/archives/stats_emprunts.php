<?php 
use App\Core\Form; 
use App\Models\UsersModel;
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){

   ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h1 class="m-0 font-weight-bold text-primary">STATISTIQUE DES EMPRUNTS</h1>
  
       </div>
       <div class="card-body">
       <div class="table-responsive">
<table class="table table-bordered table-striped table-hover" id="dataTable" data-order="[[ 4, &quot;desc&quot; ]]" width="100%" cellspacing="0">
<thead>
		<tr>
		<th>N° Pièce</th>
		<th>Domaine</th>
		<th>Typologie</th>
		<th>Dossier</th>
		<th>Date de creation</th>
		<th>Nbre Emprunt</th>
		</tr>
</thead>
	<tbody>
		
		<?php foreach($emprunts as $emprunt):?>
			<tr>
				<td><?=$emprunt->reference;?></td>
				<td><?=$emprunt->designation;?></td>
				<td><?= $emprunt->type;?></td>
				<td><?= $emprunt->dossier;?></td>
				<td><?= $emprunt->date_creation_doc;?> </td>
				<td style="width: 7%; text-align: center">
					<div style="padding:10px; border-radius:50px;float:left; background-color:#4e73df;color:white; text-align: center; width:50%;">
					<?= $emprunt->total;?>
						
					</div>
					<!--	
					 <a href="/documents/details_pieces/<?= $emprunt->id;?>"><i class="fa fa-eye"></i></a>  
					-->	
					<div style="padding:10px; border-radius:50px; float:left;color:white; text-align: center; width:45%;"> 
						<a href="/archives/details_emprunts/<?= $emprunt->id_entrees;?>" title="Voir détails" style="float:left;"><i class="fa fa-bars fa-2x" ></i></a>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
		
	</tbody>

</table></div></div>
<div class="card-footer small text-muted">
          <a href="/archives/emp_stats" title="Imprimer" target="_blank"> <button class="btn btn-success"><i class="fa fa-print"></i></button> </a>
        </div>

     

</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h1 class="m-0 font-weight-bold text-primary">STATS EMPRUNTS PAR DOMAINE</h1>
  
       </div>
 <div class="card-body">
 	  <?php
      $req="SELECT *, COUNT(*) as total FROM categories,types,dossiers,emprunter,documents WHERE categories.id=documents.id_cat AND types.id=documents.id_types AND dossiers.id=documents.id_dos AND emprunter.id_entrees = documents.id GROUP BY documents.id_cat ";
            
            $rech = Db::getInstance()->query($req);
           // $rech->execute([1,$go,$deb,$fin]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
          
      


 ?>

         <div class="table-responsive">
<table class="table table-bordered table-striped table-hover" id="dataTable5" data-order="[[ 2, &quot;desc&quot; ]]" width="100%" cellspacing="0">
<thead>
		<tr>
		<th width="5%">N°</th>
		<th>Domaine</th>
		<th width="7%">Nbre Emprunt</th>
		</tr>
</thead>
	<tbody>
		
		<?php $n=1; foreach($result as $emprunt):?>
			<tr>
				<td><?=$n;?></td>
				<td><?=$emprunt->designation;?></td>
				<td style="width: 7%; text-align: center">
					<div style="padding:10px; border-radius:50px;float:left; background-color:#4e73df;color:white; text-align: center; width:50%;">
					<?= $emprunt->total;?>
						
					</div>
					<!--	
					 <a href="/documents/details_pieces/<?= $emprunt->id;?>"><i class="fa fa-eye"></i></a>  
					-->
				</td>
			</tr>
		<?php $n++; endforeach; ?>
		
	</tbody>

</table>
</div>
</div>
<div class="card-footer small text-muted">
          <a href="/archives/domaine_stats" title="Imprimer" target="_blank"> <button class="btn btn-success"><i class="fa fa-print"></i></button> </a>
        </div>

</div>







<div class="card-header py-3">
      <h1 class="m-0 font-weight-bold text-primary">STATS EMPRUNTS SELON LE DOMAINE PAR PERIODE </h1>
  
       </div>
       <?php

    $query ="SELECT * FROM categories ORDER BY designation asc";
    $resultat = Db::getInstance()->query($query);
    $rows = $resultat->rowCount();
		// rechrche par type et periode
?>
 				<form action="" method="post">
 					<div class="row mt-2">

               <div class="form-group col-md-4" id="">    
                                    <label for="domaine" class="control-label mb-1">Domaine de gestion</label>
                                    <select id="domaine" name="domaine" class="form-control" aria-required="true" aria-invalid="false">
                                        <option value="">Choisir domaine</option>
                                        
                                          <?php
                                            if($rows>0){

                                              while($row = $resultat->fetch(PDO::FETCH_ASSOC)){?>
                                                 <option value="<?=$row['id'];?>"><?=$row['designation'];?></option>
                                                 <?php
                                                    }
                                            }
                                        else{
                                echo '<option value="">Domaine non valable</option>';
                                             }
                                         ?>
                                       
                                        </select>    
                                    </div>

                                    <div class="form-group col-md-3" id="">
                                    <label for="slug" class="control-label mb-1">Période du :</label>
                                    <input id="slug" name="debut" placeholder="Entrer la date depart"  value="" type="date" class="form-control" aria-required="true" aria-invalid="false" >            
                            </div>

                             <div class="form-group col-md-3" id="">
                                    <label for="slug" class="control-label mb-1"> Au :</label>
                                    <input id="slug" name="fin" placeholder="Entrer la date de fin"  value="" type="date" class="form-control" aria-required="true" aria-invalid="false" >            
                            </div>
                            <div class="col-md-2 form-group">
                            	<label for="slug" class="control-label mb-1"> Valider</label>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block" >
                               <i class="fas fa-fw fa-search"></i> 
                            </button>
                        </div>
                          </div>
</form>
<?php
if(isset($_POST['domaine']) && !empty($_POST['domaine']) && isset($_POST['debut']) && !empty($_POST['debut']) && isset($_POST['fin']) && !empty($_POST['fin']) && ($_SESSION['user']['roles'] =='ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER')){
      $_SESSION['deb']=$_POST['debut'];
      $_SESSION['fin']=$_POST['fin'];
      $_SESSION['domaine']=$_POST['domaine'];
      $qu ="SELECT * FROM categories WHERE id=?";
    $valid = Db::getInstance()->prepare($qu);
    $valid->execute([$_POST['domaine']]);
    $aff=$valid->fetch();?>
    <h3 class="m-2 font-weight-bold text-danger text-center">
    	<?php
echo 'Domaine : "'.$aff->designation.'" Période du ';
echo date('d-m-Y',strtotime($_POST['debut'])).' AU ';
echo date('d-m-Y',strtotime($_POST['fin'])).'<br/>';
  ?> 
</h3>
  <?php
      $req="SELECT *, COUNT(*) as total FROM categories,types,dossiers,emprunter,documents WHERE categories.id=documents.id_cat AND types.id=documents.id_types AND dossiers.id=documents.id_dos AND emprunter.id_entrees = documents.id AND documents.actif=? AND documents.id_cat=? AND DATE_FORMAT(emprunter.date_emprunt,'%Y-%m-%d') BETWEEN ? AND ? GROUP BY documents.reference ";
            $go = strtoupper($_POST['domaine']);
            $deb =$_POST['debut'];
            $fin = $_POST['fin'];
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go,$deb,$fin]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
          
      


 ?>

       <div class="card-body">
       <div class="table-responsive">
<table class="table table-bordered table-striped table-hover" id="dataTable1" data-order="[[ 4, &quot;desc&quot; ]]" width="100%" cellspacing="0">
<thead>
		<tr>
		<th>N° Pièce</th>
		<th>Domaine</th>
		<th>Typologie</th>
		<th>Dossier</th>
		<th>Nbre Emprunt</th>
		</tr>
</thead>
	<tbody>
		<?php foreach($result as $results):?>
			<tr>
				<td><?= $results->reference; ?></td>
				<td><?= $results->designation; ?></td>
				<td><?= $results->type; ?></td>
				<td><?= $results->dossier; ?></td>
				<td style="width: 7%; text-align: center">
					<div style="padding:10px; border-radius:50px;float:left; background-color:#4e73df;color:white; text-align: center; width:50%;">
				<?= $results->total; ?>
						
					</div>
				
					<div style="padding:10px; border-radius:50px; float:left;color:white; text-align: center; width:45%;"> 
						
						<!--<a href="/archives/details_emprunt/<?= $results->id_entrees;?>" title="Voir détails" style="float:left;"><i class="fa fa-bars fa-2x" ></i></a>-->
						<?php $_SESSION['doc']=$results->id_entrees; ?>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
		
	</tbody>

</table></div></div>
<div class="card-footer small text-muted">
          <a href="/archives/liste_stats" title="Imprimer" target="_blank"> <button class="btn btn-success"><i class="fa fa-print"></i></button> </a>
        </div>


<?php } }else{
        header('Location: /');
        exit;
    } ?>
