<?php 
$pdo = new PDO('mysql:host=localhost;dbname=archives','root','killer@123');


if(!empty($_POST['salle'])){
    //echo"okokok";
    //var_dump($_POST['domaine_']); exit();
    $query = "SELECT * FROM salles,rayons WHERE salles.id=rayons.id_salle AND salles.id=".$_POST['salle']." ORDER BY rayon ASC";
    $result = $pdo->query($query);
    $rowss = $result->rowCount(); 
    if($rowss > 0){
      echo '<option value="">Choisir le Rayon</option>';
        while($row = $result->fetch(PDO::FETCH_ASSOC)){?>
            <option value="<?=$row['id'];?>">
                <?=$row['rayon'];?>
            </option>


            <?php
        }
    }else{
        echo'<option value="">rayon non valabl</option>';
    }

        }
    else{
        echo'<option value="">rayon non valab</option>';
    }




?>