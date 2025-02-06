<style type="text/Css">
<!--
table
{
  width: 100%;
  height: auto;
    border: solid 1px #FF0000;
    background: ;
    border-collapse: collapse;
}
-->
</style>
<page>
	<div style="width:100%; height:80px; border:1px solid blue;"><span style="float:left; color:blue; font-size:45px; margin-left:38%; margin-top:20px; text-align:center; width:400px;border:1px solid red;">SOGEPIE</span> </div>

  <?php
  use App\Core\Form; 
use App\Models\UsersModel;
use App\Controllers\UsersController;
use App\Core\Db;
use Dompdf\Dompdf;
use Dompdf\Options;
  $qu ="SELECT * FROM categories";
    $valid = Db::getInstance()->query($qu);
    //$valid->execute();
    $aff=$valid->fetch();

?>
             <h1 style="color:red; text-align:center;"> LISTE DES STATS EMPRUNTS PAR DOMAINE</h1>
           <h2 style="color:red; text-align:center;"> </h2>

       
        <?php 
                      $req="SELECT *, COUNT(*) as total FROM categories,types,dossiers,emprunter,documents WHERE categories.id=documents.id_cat AND types.id=documents.id_types AND dossiers.id=documents.id_dos AND emprunter.id_entrees = documents.id GROUP BY documents.id_cat ORDER BY total desc ";
            $rech = Db::getInstance()->query($req);
            //$rech->execute([1,$go,$deb,$fin]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ); 
                        ?>

                      
    <table border="1" style="border: solid 1px #FF0000; background: #FFFFFF; width: 100%; text-align: center">   
                <tr>
                  <th  style="border: solid 1px blue;width: 5%"><font color="blue">N°</font></th>
                  <th  style="border: solid 1px blue;width: 85%"><font color="blue">Domaine</font></th>
                  <th  style="border: solid 1px blue;width: 10%"><font color="blue">Nbre Emprunt</font></th>          
                </tr>  
              <?php $n=1; foreach($result as $results): ?>    
                <tr>
                  <td  style="border: solid 1px blue;width: 5%"><?= $n;; ?></td>
                  <td  style="border: solid 1px blue;width: 85%"><?= $results->designation; ?></td>
                  <td  style="border: solid 1px blue;width: 10%">        
                    <?= $results->total; ?>          
                  </td>     
                </tr>
                  <?php
                  $n++;
                  endforeach;
                 ?>
            </table>
          
<page_footer>

               <?php   
                       

                        $imp = date('d-m-Y');
                         echo "<span style='margin-bottom:0; postion:absolute; bottom:0;'><hr/><b>IMPRIME LE ".$imp.'</b></span>';



                ?>
</page_footer>
</page>