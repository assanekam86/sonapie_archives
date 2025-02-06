<?php 
use App\Core\Db;
use App\Models\Model;
use App\Models\DocumentsModel;
use App\Core\Form;

	
	$affiche= Db::getInstance()->prepare("
			SELECT c.designation,dos.dossier,t.type as typ,f.fichier,f.type,f.date_creation, f.update_at,f.id FROM categories as c, types as t, documents as d,dossiers as dos,fichiers as f  WHERE f.id = ? AND d.id_cat = c.id AND dos.id=d.id_dos AND t.id = d.id_types AND d.id=f.id_doc AND f.actif=? AND d.actif=?
			");
	$affiche->execute([$id_file,1,1]);
	$afficheFile = $affiche->fetchAll();
//var_dump($id_file);

	
		

 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
	</head>
	<body>
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <a href="/documents/liste_documents" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Retour Liste dossiers</a>
          </div>
	<?php foreach($afficheFile as $affiches): ?>
			


 		<!-- Element where PSPDFKit will be mounted. -->
		<div id="pspdfkit" style="width: 100%; height: 100vh;"></div>
		<script src="/assets/pspdfkit.js"></script>
		<script>
			PSPDFKit.load({
				container: "#pspdfkit",
				document: "http://archives.local/archives/<?= $affiches->designation."/".$affiches->typ."/".$affiches->dossier."/".$affiches->fichier;?>",
			})
			.then(function(instance) {
				console.log("PSPDFKit loaded", instance);
			})
			.catch(function(error) {
				console.error(error.message);
			});
		</script>
		<?php endforeach; ?>
	</body>
</html>