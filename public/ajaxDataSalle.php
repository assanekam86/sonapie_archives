<?php 
$pdo = new PDO('mysql:host=localhost;dbname=archives','root','killer@123');


if(!empty($_POST['salle'])){
    //echo"okokok";
    //var_dump($_POST['domaine_']); exit();
    $query = "SELECT * FROM salles,villes WHERE villes.id=salles.id_ville AND salles.id=".$_POST['salle']." LIMIT 1";
    $result = $pdo->query($query);

    $rowss = $result->rowCount(); 
    var_dump($_POST['salle']);
    if($rowss > 0){
      echo '<option value="">Choisir Ville</option>';
        while($row = $result->fetch(PDO::FETCH_ASSOC)){?>
            <option value="<?=$row['id'];?>"selected="selected">
                <?=$row['ville'];?>
            </option>


            <?php
        }
    }else{
        echo'<option value="">ville non valable</option>';
    }

        }
    else{
        echo'<option value="">Ville non valable</option>';
    }




?>