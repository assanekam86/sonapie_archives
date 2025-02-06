<?php 
$pdo = new PDO('mysql:host=localhost;dbname=archives','root','killer@123');



if(!empty($_POST['domaine'])){
	//echo"okokok";
	//var_dump($_POST['domaine_']); exit();
	$query = "SELECT * FROM usagers WHERE id_cat=".$_POST['domaine']." ORDER BY usager ASC";
	$result = $pdo->query($query);
	$rowss = $result->rowCount(); 
	if($rowss > 0){
		echo '<option value="">Choisir usager</option>';
		while($row = $result->fetch(PDO::FETCH_ASSOC)){?>
			<option value="<?=$row['id'];?>">
				<?php if($row['usager']!== null) echo $row['matricule']." "; ?><?= $row['usager']; ?>
			</option>


			<?php
		}
	}else{
		echo'<option value="">usager non valable</option>';
	}
}else{
	echo'<option value="">usager non trouvé</option>';}



?>