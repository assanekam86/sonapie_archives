<?php 
$pdo = new PDO('mysql:host=localhost;dbname=archives','root','killer@123');


if(!empty($_POST['domaine'])){
	//echo"okokok";
	//var_dump($_POST['domaine_']); exit();
	$query = "SELECT * FROM rayons,etageres,boites,dossiers
	 WHERE rayons.id=etageres.id_rayon AND boites.id_etagere=etageres.id AND dossiers.id_boite=boites.id AND dossiers.id_cat=".$_POST['domaine']." ORDER BY dossier ASC";
	$result = $pdo->query($query);
	$rowss = $result->rowCount(); 
	if($rowss > 0){
		echo '<option value="">Choisir dossier</option>';
		while($row = $result->fetch(PDO::FETCH_ASSOC)){?>
			<option value="<?=$row['id'];?>">
				<?=$row['dossier'].' | Boite:'.$row['boite'].' | Etag:'.$row['etagere'].' | Ray:'.$row['rayon'];?>
			</option>


			<?php
		}
	}else{
		echo'<option value="">dossier non valable</option>';
	}
}else{
	echo'<option value="">dossier non trouvé</option>';}



?>