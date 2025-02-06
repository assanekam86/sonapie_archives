 <?php 
use App\Core\Form; 
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user']['id']) && ($_SESSION['user']['roles']=='ROLE_ADMIN' || $_SESSION['user']['roles']=='ROLE_SUPERUSER') ){

   ?>
<!-- liste des documents -->


<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <a href="/documents/ajout_documents" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Ajouter une pièce</a>
          </div>
<div class="card shadow mb-4" id="dvContents">
    <div class="card-header py-3" >
      <h1 class="m-0 font-weight-bold text-primary">LISTE DES DOSSIERS </h1>
  
       </div>
       <div class="card-body">
       <div class="table-responsive">
<table class="table table-bordered table-striped table-hover" id="dataTable2" width="" cellspacing="0" data-order="[[ 5, &quot;desc&quot; ]]" >
<thead>
		<tr>
	<th data-column="service" data-order="desc">N°</th>
		<th data-column="service" data-order="desc">Dossier</th>
		<th data-column="service" data-order="desc">Boite Archive</th>
		<th data-column="service" data-order="desc">Domaine</th>
		<th data-column="utilisateur" data-order="desc">Etagere</th>
		<th data-column="utilisateur" data-order="desc">Rayon</th>
		<th data-column="utilisateur" data-order="desc">Salle</th>
		<th data-column="utilisateur" data-order="desc">Ville</th>
		<th data-column="utilisateur" data-order="desc">Créé par</th>
		<th data-column="creele" data-order="desc">Créé le</th>
		<!--<th data-column="modifiele" data-order="desc">Modifié le</th>-->
		<th data-column="action" data-order="desc">Action</th>
		</tr>
</thead>
	<tbody>
		<?php $n=1; foreach ($afficheDoc as $affiche ):?>
			<tr>
				
				<td><a href="/documents/liste_pieces/<?=$affiche->id;?>" style="color:gray;" title="Voir les étagères"><?=$n;?></td>
				<td><a href="/documents/liste_pieces/<?=$affiche->id;?>" style="color:gray;" title="Voir les pièces"><?=$affiche->dossier;?></td>
				<td><a href="/dossiers/liste_dossier/<?=$affiche->idboit;?>" style="color:gray;" title="Voir les dossiers"><?=$affiche->boite;?></td>
				<td><a href="/types/types_domaine/<?=$affiche->idcat;?>" style="color:gray;" title="Voir les typographies"><?=$affiche->designation;?></td>
				<td><a href="/boites/liste_boite/<?=$affiche->idet;?>" style="color:gray;" title="Voir les boites"><?=$affiche->etagere;?></td>
				<td><a href="/etageres/liste_etagere/<?=$affiche->idray;?>" style="color:gray;" title="Voir les etageres"><?=$affiche->rayon;?></td>
				<td><a href="/rayons/liste_rayon/<?=$affiche->idsal;?>" style="color:gray;" title="Voir les rayons"><?=$affiche->salle;?></td>
				<td><a href="/salles/liste_salle/<?=$affiche->idvil;?>" style="color:gray;" title="Voir les salles"><?=$affiche->ville;?></td>
				<td><a href="/etageres/liste_pieces/<?=$affiche->id;?>" style="color:gray;" title="Voir les pieces"><?=strtoupper($affiche->nom." ".$affiche->prenom);?></td>
				<td><a href="/etageres/liste_pieces/<?=$affiche->id;?>" style="color:gray;" title="Voir les étagères"><?= date('d-m-Y',strtotime($affiche->date_creation_dossier));?></td>
				<!--<td><a href="/etageres/liste_pieces/<?=$affiche->id;?>" style="color:gray;" title="Voir les étagères"><?= date('d-m-Y',strtotime($affiche->update_at));?></td>-->
				<td width="5%">
					<a href="/documents/liste_pieces/<?=$affiche->id;?>" title="Voir le contenu" class="btn btn-success"><i class="fas fa-folder-open"></i></a></div>
					<!--<div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Actions:</div>
                    <div class="dropdown-item">
					<a href="/documents/liste_documents/<?=$affiche->id;?>" title="Voir le contenu" class="btn btn-success"><i class="fas fa-folder-open"></i></a></div>
					<!--<?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_ADMIN'){ ?>
						<div class="dropdown-item"><a href="/documents/modifier/<?=$affiche->id;?>" title="Modifier le dossier" class="btn btn-primary">
						<i class="far fa-edit"></i>
					</a></div>
						<?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_SUPERUSER'){ ?>
					<div class="dropdown-item"><a href="/documents/modifier/<?=$affiche->id;?>" title="Modifier le dossier" class="btn btn-primary">
						<i class="far fa-edit"></i>
					</a></div>
					<?php } ?>
					<div class="dropdown-item"><a href="/documents/supprimeDocument/<?=$affiche->id;?>" title="Supprimer le dossier" class="btn btn-danger">
						<i class="fas fa-trash"></i>
					</a></div>

                      <a class="dropdown-item" href="#"></a>
                    </div>
                  </div>
					<button class="btn btn-danger" data-toggle="modal" data-target="#supModal">Supprimer</button>-->
				<!--<?php } ?>-->
				</td>
			</tr>
		<?php $n++; endforeach; ?>

		
	</tbody>

</table></div></div></div>


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