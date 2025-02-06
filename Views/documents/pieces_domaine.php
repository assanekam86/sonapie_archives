 <?php 
use App\Core\Form; 
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){

   ?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <a href="/documents/ajouter_piece/<?=$pieces->id;?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Ajouter une pièce</a>
          </div>
						

<div class="card shadow mb-4" id="h1">
    <div class="card-header py-3">
      <h1 class="m-0 font-weight-bold text-primary"><?=$pieces->id!=""? "DOMAINE : ".$pieces->designation." -":"";?> LISTE DES PIECES</h1>
  <form id="form1" runat="server">
       </div>
       <div class="card-body">
       <div class="table-responsive">
<table class="table table-bordered table-striped table-hover" id="dataTable1" width="" cellspacing="0"  data-order="[[ 1, &quot;desc&quot; ]]">
<thead>
		<tr>
		<th>Référence Pièce</th>
		<th>Dossier</th>
		<th>Boite Archive</th>
		<th>Etagere</th>
		<th>Rayon</th>
		<th>Salle</th>
		<th>Ville</th>
		<th>Domaine</th>
		<th>Typologie</th>	
		<th>Usager</th>	
		<th>Créé le</th>	
		<th>Modifié le</th>	
		<th width="13%">Action</th>
	
		</tr>
</thead>
	<tbody>
		<?php ?>
		<?php foreach ($afficheFile as $files ): ?>


			<tr>
				<td><?=$files->reference;?></td>
				<td><?=$files->dossier;?></td>
				<td><?=$files->boite;?></td>
				<td><?=$files->etagere;?></td>
				<td><?=$files->rayon;?></td>
				<td><?=$files->salle;?></td>
				<td><?=$files->ville==''?'ABIDJAN':$files->ville;?></td>
				<td><?=$files->designation;?></td>
				<td><?=$files->type;?></td>
				<td><?=$files->usager;?></td>
				<td><?= date('d-m-Y',strtotime($files->date_creation_doc));?></td>
				<td><?= date('d-m-Y',strtotime($files->update_at));?></td>
				<td width="5%">
					<div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Actions:</div>
                    <div class="dropdown-item">
					<a href="/documents/details/<?=$files->id;?>" title="Détails" class="btn btn-success"><i class="fas fa-bars"></i></a></div>
					<?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_SUPERUSER'){ ?>
					<div class="dropdown-item">
						<a href="/documents/modifier/<?=$files->id;?>" title="Modifier le dossier" class="btn btn-primary">
						<i class="far fa-edit"></i>
						</a>
					</div>
					<?php } ?>
					<?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_ADMIN'){ ?>
						<div class="dropdown-item">
						<a href="/documents/modifier/<?=$files->id;?>" title="Modifier le dossier" class="btn btn-primary">
						<i class="far fa-edit"></i>
						</a>
						</div>
						
					<div class="dropdown-item">
						<a href="/documents/supprimeDocument/<?=$files->id;?>" title="Supprimer le dossier" class="btn btn-danger"><i class="fas fa-trash"></i></a>
					</div>

                      <a class="dropdown-item" href="#"></a>
                    </div>
                  </div>
					<!--<button class="btn btn-danger" data-toggle="modal" data-target="#supModal">Supprimer</button>-->
				<?php } ?>
				</td>
<!--
				<div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Actions:</div>
                    <div class="dropdown-item">  
					<a class="btn btn-primary" title="Voir le fichier" href="/archives/<?= $files->designation."/".$files->designat."/".$files->nature."/".$files->typ."/".$files->libelle."/".$files->fichier;?>">
				<?php
				if($files->type == 'jpg' || $files->type == 'jpeg' || $files->type == 'png' || $files->type == 'gif' || $files->type == 'swf'){
					echo'<i class="fa fa-file-picture-o fa-2x"></i>';
				}elseif ($files->type == 'docx' || $files->type == 'doc') {
					// code...
					echo'<i class="fa fa-file-word-o fa-2x"></i>';
				}elseif($files->type == 'pdf'){
					echo'<i class="fa fa-file-pdf-o fa-2x"></i>';
				}elseif ($files->type == 'xlsx' || $files->type == 'xls' || $files->type == 'xlsm') {
					// code...
					echo'<i class="fa fa-file-excel-o fa-2x"></i>';
				}elseif ($files->type == 'pptx' || $files->type == 'ppt') {
					// code...
					echo'<i class="fa fa-file-powerpoint-o fa-2x"></i>';
				}elseif ($files->type == 'mp3' || $files->type == 'amr') {
					// code...
					echo'<i class="fa fa-file-sound-o fa-2x"></i>';
				}elseif ($files->type == 'mpeg' || $files->type == 'mp4' || $files->type == 'avi' || $files->type == 'flv') {
					// code...
					echo'<i class="fas fa-file-video-o fa-2x"></i>';
				}elseif ($files->type == 'zip' || $files->type == 'rar') {
					// code...
					echo'<i class="fas fa-file-archive-o fa-2x"></i>';
				}else{
					echo'<i class="fa fa-file fa-2x"></i>';
				}

					
				 ?></a>
				</div>
				
<?php $tab=array('doc','docx','html','php','rar','zip','csv','xls','xlsx','mp4','mp3','flv','3gp','mpeg','amr','avi','accdb');				 if(!in_array($files->type,$tab)){
				  ?>
				<div class="dropdown-item">
					<?php if($files->type == "pdf"){ ?>
						<?php //$_SESSION['fichier_id']=$files->id; ?>
<a href="/documents/imprimer/<?=$files->id?>" class="btn btn-info" onclick="javascript:imprime_bloc('titre','imprime_moi');" target="_blank">
	<i class="fa fa-print"></i>
</a><?php }elseif($files->type == "png" || $files->type == "jpeg" || $files->type == "jpg" || $files->type == "gif") {  //$_SESSION['fichier_id']=$files->id;?>
	<a href="/documents/imprime/<?=$files->id?>" class="btn btn-info" onclick="javascript:imprime_bloc('titre','imprime_moi');" target="_blank">
	<i class="fa fa-print"></i></a>
<?php } ?>
				 </div> 
				<div class="dropdown-item"> 
				<a href="/documents/signatures/<?=$files->id?>"  title="signer le fichier" class="btn btn-success">
						<i class="fas fa-sign-out-alt fa-1x"></i>
					</a></div>
				<?php } ?>
				
                      <div class="dropdown-item"><a href="/documents/supp_fichiers/<?=$files->id?>"  title="Supprimer le fichier" class="btn btn-danger">
						<i class="fas fa-trash fa-1x"></i>
					</a></div>
                      <a class="dropdown-item" href="#"></a>
                    </div>
                  </div>




				
				 
				 <!--<input type="button" id="btnPrint" value="Print" />

				 <a href="" onclick="window.print()" class="btn btn-info"><i class="fa fa-print"></i></a>
				 
				  <button type="button" class="btn btn-info" onclick="Myprint()" value=""><i class="fa fa-print"></i> </button>
				 -->
				
				<!--	
				</td>-->
				
			</tr>
			<?php 
			
			
			if(isset($_GET['name'])){
				$file = $_GET['name'];

				$db = Db::getInstance()->prepare('UPDATE fichiers SET actif=? WHERE id_doc=? AND fichier=?');
				$db->execute([0,$affiches->id_doc,$file]);
				
				Form::setFlash('success','Un Fichier a été supprimé');
				header("Location: /documents/mes_documents");
				exit;
				
								
									}
 ?>
		<?php endforeach; ?>
		
		
	</tbody>

</table></div></div></div>
<!-- liste des documents -->



<script>


</script>


    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
    <script type="text/javascript">
        $(function () {
            $("#btnPrint").click(function () {
                var contents = $("#dvContents").html();
                var frame1 = $('<iframe />');
                frame1[0].name = "frame1";
                frame1.css({ "position": "absolute", "top": "-1000000px" });
                $("body").append(frame1);
                var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
                frameDoc.document.open();
                //Create a new HTML document.
                frameDoc.document.write('<html><head><title>Archive Sogepie</title>');
                frameDoc.document.write('</head><body>');
                //Append the external CSS file.
                frameDoc.document.write('<link href="/css/sb-admin-2.css" rel="stylesheet" type="text/css" />');
                //Append the DIV contents.
                frameDoc.document.write(contents);
                frameDoc.document.write('</body></html>');
                frameDoc.document.close();
                setTimeout(function () {
                    window.frames["frame1"].focus();
                    window.frames["frame1"].print();
                    frame1.remove();
                }, 500);
            });
        });
    </script>
    </form>

    <?php
                 }else{
                    header("Location: /");
                    exit;
        
    } ?>

 <script>
    var i = 0;
    function frames['frame'].print() {
        document.getElementById('frame').value = i++;
    }
</script>

<script>
/*	PSPDFKit.load({
		container: "#pspdfkit",
  		document: "document.pdf"
	})
	.then(function(instance) {
		console.log("PSPDFKit loaded", instance);
	})
	.catch(function(error) {
		console.error(error.message);
	});*/
</script>