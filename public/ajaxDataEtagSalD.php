<?php 
$pdo = new PDO('mysql:host=localhost;dbname=archives','root','killer@123');


if(!empty($_POST['boite'])){
    //echo"okokok";
    //var_dump($_POST['domaine_']); exit();
    $query = "SELECT * FROM rayons,salles,villes,categories,etageres,boites WHERE villes.id=salles.id_ville AND rayons.id_salle=salles.id AND rayons.id =etageres.id_rayon AND boites.id_etagere = etageres.id AND categories.id=boites.id_cat AND boites.id_cat=".$_POST['boite']." ORDER BY boite ASC";
    $result = $pdo->query($query);
    $rowss = $result->rowCount(); 
    if($rowss > 0){
      echo '<option value="">Choisir dossier</option>';
        while($row = $result->fetch(PDO::FETCH_ASSOC)){?>
            <option value="<?=$row['id'];?>"selected="selected">
                <?=$row['salle'];?>
            </option>


            <?php
        }
    }else{
        echo'<option value="">Salle non valable</option>';
    }

        }
    else{
        echo'<option value="">Salle non valable</option>';
    }




?>