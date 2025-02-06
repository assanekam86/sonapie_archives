 <?php 
use App\Core\Form; 
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){

   ?>


<!-- liste des fichiers -->

<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <!--<a href="/documents/ajoutes_pieces/<?php /*=$affiche->id;*/?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">--><!--<i class="fas fa-plus fa-sm text-white-50"></i>Ajouter pièce</a> -->
    <?php if($affiche != null){ ?>
        <a href="/documents/ajoutes_pieces/<?=$affiche->id;?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Ajouter une pièce</a>
    <?php }else{?>
        <a href="<?= $_SERVER['HTTP_REFERER']; ?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Retour</a>

    <?php } ?>
</div>

<div class="card shadow mb-4" id="h1">
    <div class="card-header py-3">
      <h1 class="m-0 font-weight-bold text-primary">
         <!-- <?=$affiche->id ? "TYPOLOGIE : ".$affiche->type." -":"";?>
          LISTE DES PIECES-->
          <h1 class="m-0 font-weight-bold text-primary"><?= ($affiche && is_object($affiche)) ? "TYPOLOGIE : ".$affiche->type." -" : ""; ?> LISTE DES PIECES</h1>

      </h1>
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
				<td><?=$files->usager?$files->usager:"NEANT"; ?></td>
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
				</td>-->
				
			</tr>

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