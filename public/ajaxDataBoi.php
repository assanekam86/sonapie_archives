<?php 
$pdo = new PDO('mysql:host=localhost;dbname=archives','root','killer@123');


if(!empty($_POST['etager'])){
    //echo"okokok";
    //var_dump($_POST['domaine_']); exit();
    $query = "SELECT * FROM etageres,boites WHERE etageres.id=boites.id_etagere AND etageres.id=".$_POST['etager']." ORDER BY boite ASC";
    $result = $pdo->query($query);
    $rowss = $result->rowCount(); 
    if($rowss > 0){
      echo '<option value="">Choisir la boite</option>';
        while($row = $result->fetch(PDO::FETCH_ASSOC)){?>
            <option value="<?=$row['id'];?>">
                <?=$row['boite'];?>
            </option>


            <?php
        }
    }else{
        echo'<option value="">boite non valabl</option>';
    }

        }
    else{
        echo'<option value="">boite non valab</option>';
    }




?>