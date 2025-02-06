<?php 
$pdo = new PDO('mysql:host=localhost;dbname=archives','root','killer@123');


if(!empty($_POST['rayon'])){
    //echo"okokok";
    //var_dump($_POST['domaine_']); exit();
    $query = "SELECT * FROM rayons,etageres WHERE rayons.id=etageres.id_rayon AND rayons.id=".$_POST['rayon']." ORDER BY etagere ASC";
    $result = $pdo->query($query);
    $rowss = $result->rowCount(); 
    if($rowss > 0){
      echo '<option value="">Choisir le Rayon</option>';
        while($row = $result->fetch(PDO::FETCH_ASSOC)){?>
            <option value="<?=$row['id'];?>">
                <?=$row['etagere'];?>
            </option>


            <?php
        }
    }else{
        echo'<option value="">etagere non valabl</option>';
    }

        }
    else{
        echo'<option value="">etagere non valab</option>';
    }




?>