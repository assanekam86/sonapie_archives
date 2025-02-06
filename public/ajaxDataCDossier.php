<?php 
$pdo = new PDO('mysql:host=localhost;dbname=archives','root','killer@123');


if(!empty($_POST['domaine'])){
	//echo"okokok";
	//var_dump($_POST['domaine_']); exit();
	$query = "SELECT * FROM boites,categories
	 WHERE boites.id_cat = categories.id AND categories.id=".$_POST['domaine']." ORDER BY boite ASC";
	$result = $pdo->query($query);
	$rowss = $result->rowCount(); 
	if($rowss > 0){
		echo '<option value="">Choisir Boite</option>';
		while($row = $result->fetch(PDO::FETCH_ASSOC)){?>
			<option value="<?=$row['id'];?>">
				<?=$row['boite'];?>
			</option>


			<?php
		}
	}else{
		echo'<option value="">boite non valable</option>';
	}
}else{
	echo'<option value="">boite non trouvé</option>';}



?>