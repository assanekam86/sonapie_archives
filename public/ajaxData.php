<?php 
$pdo = new PDO('mysql:host=localhost;dbname=archives','root','killer@123');

//var_dump($_POST);
if(!empty($_POST['domaine'])){
	//echo"okokok";
	//var_dump($_POST['domaine_']); exit();
	$query = "SELECT * FROM types WHERE id_cat=".$_POST['domaine']." ORDER BY type ASC";
	$result = $pdo->query($query);
	$rowss = $result->rowCount(); 
	if($rowss > 0){
		echo '<option value="">Choisir la typologie</option>';
		while($row = $result->fetch(PDO::FETCH_ASSOC)){?>
			<option value="<?=$row['id'];?>"><?=$row['type'];?></option>
			<?php
		}
	}else{
		echo'<option value="">typologie non valable</option>';
	}
}else{
	echo'<option value="">typologie non trouve</option>';}




?>