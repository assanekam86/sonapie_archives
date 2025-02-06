<?php 
$pdo = new PDO('mysql:host=localhost;dbname=archives','root','killer@123');


if(!empty($_POST['ville'])){
    //echo"okokok";
    //var_dump($_POST['domaine_']); exit();
    $query = "SELECT * FROM villes,salles WHERE villes.id=salles.id_ville AND villes.id=".$_POST['ville']." ORDER BY salle ASC";
    $result = $pdo->query($query);
    $rowss = $result->rowCount(); 
    if($rowss > 0){
      echo '<option value="">Choisir la salle</option>';
        while($row = $result->fetch(PDO::FETCH_ASSOC)){?>
            <option value="<?=$row['id'];?>">
                <?=$row['salle'];?>
            </option>


            <?php
        }
    }else{
        echo'<option value="">salle non valable</option>';
    }

        }
    else{
        echo'<option value="">salle non valable</option>';
    }




?>