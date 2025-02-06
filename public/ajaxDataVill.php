<?php 
$pdo = new PDO('mysql:host=localhost;dbname=archives','root','killer@123');


if(!empty($_POST['rayon'])){
    //echo"okokok";
    //var_dump($_POST['domaine_']); exit();
    $query = "SELECT * FROM salles,villes,rayons WHERE villes.id=salles.id_ville AND rayons.id_salle=salles.id AND rayons.id=".$_POST['rayon']." LIMIT 1";
    $result = $pdo->query($query);
    $rowss = $result->rowCount(); 
    if($rowss > 0){
      echo '<option value="">Choisir dossier</option>';
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
        echo'<option value="">ville non valable</option>';
    }




?>