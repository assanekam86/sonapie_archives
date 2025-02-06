<?php 
use App\Core\Form; 
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){
/*if($_SESSION['user']['nom']){
  
   if((time() - $_SESSION['last_login_timestamp']) > 900){
      $user = new UsersController;
      $user->logout();
   }*/
   ?>





<div class="">
                 <div class="card-header py-3">
      <h1 class="m-0 font-weight-bold text-primary"> GESTION EMPRUNTS</h1>
  
       </div>
                  <?php 

    $query ="SELECT * FROM categories ORDER BY designation asc";
    $result = Db::getInstance()->query($query);
    $rows = $result->rowCount();

 ?>

 
         <div class="row mt-2">        
    
             <div class="col-md-12">
              <div class="card">
                <div class="card-header bg-primary text-white">
                   RECHERCHES SPECIFIQUES
                </div>
                    <div class="card-body">
                    <blockquote class="blockquote mb-0">
                      <form action="" method="post" enctype="multipart/form-data">

                            <div class="form-group" id="">
                                    <label for="slug" class="control-label mb-1">Critères de recherche</label>
                                    
                                  <select id="CRITERE" name="critere" class="form-control critere" aria-required="true" aria-invalid="false" required>
                                        <option value="">Choix du critère</option>
                                        <option value="1">Selon la référence du document</option>
                                        <option value="2">Selon le typologie du document</option>
                                        <option value="3">Selon le typologie sur une periode</option>
                                        <option value="4">Selon la date d'enregistrement</option>
                                         <option value="5">Selon le dossier</option>
                                         <option value="6">Selon le domaine et dossier</option>
                                        <option value="7">Selon une période </option>
                                        <option value="8">Selon un usager </option>
                                      

                                  </select> 
                                

                                
                                </div>

                             <div class="form-group" id="REFERENCE">
                                    <label for="slug" class="control-label mb-1">Référence Document :</label>
                                    <input id="slug" name="reference" placeholder="Entrer la référence"  value="" type="text" class="form-control" aria-required="true" aria-invalid="false">            
                            </div>

                             <div class="form-group" id="USAGERS">
                                    <label for="slug" class="control-label mb-1">NOM USAGER :</label>
                                    <input id="slug" name="usagers" placeholder="Entrer le Nom Usager"  value="" type="text" class="form-control" aria-required="true" aria-invalid="false">            
                            </div>
                            <div class="row mt-2">
                            <div class="col-md-12 form-group" id="TYPES">    
                                    <label for="category_id" class="control-label mb-1">Typologie</label>
                                    <select id="category_id" name="type" class="form-control single" aria-required="true" aria-invalid="false" >
                                        <option value="">Choisir la Typologie</option>
                                        
                                          <?php


                                                foreach($types as $type){?>
                                                 <option value="<?=$type->id;?>"><?=$type->type;?> (<?=$type->designation;?>)</option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>    
                             </div>
                             </div>
                             <div class="row">
                             <div class="col-md-4 form-group" id="CONT">
                                    <label for="name" class="control-label mb-1">Statut Contrat </label>
                                      <select name="contrat" class="form-control" id="serv">
                                            <option value="">option du contrat</option>
                                      
                                                <option value="en cours">En cours</option>
                                                <option value="résilié">Résilié</option>
                                                <option value="1">tout</option>
                                              
                                        </select> 
                            </div>
                            </div>
                              <div class="form-group" id="NATURES">    
                                    <label for="domaine" class="control-label mb-1">Domaine de gestion</label>
                                    <select id="domaine" name="domaine" class="form-control" aria-required="true" aria-invalid="false">
                                        <option value="">Choisir domaine</option>
                                        
                                          <?php
                                            if($rows>0){

                                              while($row = $result->fetch(PDO::FETCH_ASSOC)){?>
                                                 <option value="<?=$row['id'];?>"><?=$row['designation'];?></option>
                                                 <?php
                                                    }
                                            }
                                        else{
                                echo '<option value="">Domaine non valable</option>';
                                             }
                                         ?>
                                       
                                        </select>    
                                    </div>


                
                                <div class="row">
                                  <div class="col-md-6 form-group" id="SERVICES1">
                                    <label for="doss" class="control-label mb-1">Dossier</label>
                                        <select name="dossier1" class="single form-control" id="doss" style="width:200px;">
                                            <option value="">Choisir le dossier</option>
                                         
                                        </select>                                    
                                    </div>

                            


                              <div class="col-md-6 form-group" id="SERVICES">    
                                    <label for="category_id" class="control-label mb-1">Dossier</label>
                                    <select id="category_id" name="dossier" class="single form-control" aria-required="true" aria-invalid="false" style="width:200px;" >
                                        <option value="">Choisir le Dossier</option>
                                        
                                          <?php


                                                foreach($dossiers as $type){?>
                                                 <option value="<?=$type->id;?>"><?=$type->dossier;?></option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>    
                             </div>
                         </div>
                             <div class="row mt-2">
                             <div class="form-group col-md-6" id="DEBUT">
                                    <label for="slug" class="control-label mb-1">Période du :</label>
                                    <input id="slug" name="debut" placeholder="Entrer la date depart"  value="" type="date" class="form-control" aria-required="true" aria-invalid="false" >            
                            </div>

                             <div class="form-group col-md-6" id="FIN">
                                    <label for="slug" class="control-label mb-1"> Au :</label>
                                    <input id="slug" name="fin" placeholder="Entrer la date de fin"  value="" type="date" class="form-control" aria-required="true" aria-invalid="false" >            
                            </div>
                            </div>
                             <div class="form-group" id="REGISTER">
                                    <label for="slug" class="control-label mb-1">Date Enregistrement :</label>
                                    <input id="slug" name="register" placeholder="Entrer la date de création"  value="" type="date" class="form-control" aria-required="true" aria-invalid="false" >            
                            </div>

                            <div class="row mt-2">
                            <div class="col-md-8 offset-md-2 form-group">
                            <button id="payment-button" type="submit" class="btn btn-lg btn-primary btn-block" >
                               <i class="fas fa-fw fa-search"></i> 
                            </button>
                        </div>
                    </div>

                   </form>
                    </blockquote>
                    </div>
                </div>
             </div>
         </div>

 <?php            
 

          //--------------------------------------------------------------------USER ADMIN------------------------------------------------//
          
          //recherche par reference
    if(isset($_POST['critere']) && !empty($_POST['critere']) && isset($_POST['reference']) && !empty($_POST['reference'])  && ($_SESSION['user']['roles'] =='ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER')){
    
$req="SELECT vil.ville,ray.rayon,et.etagere,bo.boite,sal.salle,d.reference,d.libelle as document, d.id as id_doc,d.status_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM villes as vil,rayons as ray, etageres as et,boites as bo,salles as sal,USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE vil.id = sal.id_ville AND sal.id=ray.id_salle AND ray.id=et.id_rayon AND et.id=bo.id_etagere AND bo.id=dos.id_boite AND u.id = d.id_user AND d.actif=? AND d.reference LIKE ? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND usag.id=d.id_usager GROUP BY d.reference ";
            $go = strtoupper("%".$_POST['reference']."%");
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
          }

          //recherche par usager
    if(isset($_POST['critere']) && !empty($_POST['critere']) && isset($_POST['usagers']) && !empty($_POST['usagers'])  && ($_SESSION['user']['roles'] =='ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER')){
    
$req="SELECT vil.ville,ray.rayon,et.etagere,bo.boite,sal.salle,d.reference,d.libelle as document, d.id as id_doc,d.status_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM villes as vil,rayons as ray, etageres as et,boites as bo,salles as sal, USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE vil.id = sal.id_ville AND sal.id=ray.id_salle AND ray.id=et.id_rayon AND et.id=bo.id_etagere AND bo.id=dos.id_boite AND u.id = d.id_user AND d.actif=? AND usag.usager LIKE ? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND usag.id=d.id_usager GROUP BY d.reference ";
            $go = strtoupper("%".$_POST['usagers']."%");
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
          }

            //recherche par dossier
    if(isset($_POST['critere']) && !empty($_POST['critere']) && isset($_POST['dossier']) && !empty($_POST['dossier'])  && ($_SESSION['user']['roles'] =='ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER')){
    
$req="SELECT vil.ville,ray.rayon,et.etagere,bo.boite,sal.salle,d.reference,d.libelle as document, d.id as id_doc,d.status_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM villes as vil,rayons as ray, etageres as et,boites as bo,salles as sal, USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE vil.id = sal.id_ville AND sal.id=ray.id_salle AND ray.id=et.id_rayon AND et.id=bo.id_etagere AND bo.id=dos.id_boite AND u.id = d.id_user AND d.actif=? AND d.id_dos=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND usag.id=d.id_usager GROUP BY d.reference ";
            $go = $_POST['dossier'];
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
          }

            //recherche par dossier et Domaine
    if(isset($_POST['critere']) && !empty($_POST['critere']) && isset($_POST['dossier1']) && !empty($_POST['dossier1']) && isset($_POST['domaine']) && !empty($_POST['domaine'])  && ($_SESSION['user']['roles'] =='ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER')){
    
$req="SELECT vil.ville,ray.rayon,et.etagere,bo.boite,sal.salle,d.reference,d.libelle as document, d.id as id_doc,d.status_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM villes as vil,rayons as ray, etageres as et,boites as bo,salles as sal, USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE vil.id = sal.id_ville AND sal.id=ray.id_salle AND ray.id=et.id_rayon AND et.id=bo.id_etagere AND bo.id=dos.id_boite AND u.id = d.id_user AND d.actif=? AND d.id_dos=? AND c.id=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND usag.id=d.id_usager  GROUP BY d.reference ";
            $go = $_POST['dossier1'];
            $go1 = $_POST['domaine'];
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go,$go1]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
          }

           
// recherche par types
          if(isset($_POST['critere']) && !empty($_POST['critere']) && isset($_POST['type']) && !empty($_POST['type']) && ($_SESSION['user']['roles'] =='ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER')){

              if($_POST['contrat']==1){
      $req="SELECT vil.ville,ray.rayon,et.etagere,bo.boite,sal.salle,d.reference,d.libelle as document, d.id as id_doc,d.status_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM villes as vil,rayons as ray, etageres as et,boites as bo,salles as sal, USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE vil.id = sal.id_ville AND sal.id=ray.id_salle AND ray.id=et.id_rayon AND et.id=bo.id_etagere AND bo.id=dos.id_boite AND u.id = d.id_user AND d.actif=? AND d.id_types=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND usag.id=d.id_usager GROUP BY d.reference";
            $go = strtoupper($_POST['type']);
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
        }  elseif($_POST['contrat']=='en cours' || $_POST['contrat']=='résilié'){
            $req="SELECT vil.ville,ray.rayon,et.etagere,bo.boite,sal.salle,d.reference,d.libelle as document, d.id as id_doc,d.status_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM villes as vil,rayons as ray, etageres as et,boites as bo,salles as sal, USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE vil.id = sal.id_ville AND sal.id=ray.id_salle AND ray.id=et.id_rayon AND et.id=bo.id_etagere AND bo.id=dos.id_boite AND u.id = d.id_user AND d.actif=? AND d.id_types=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND usag.id=d.id_usager AND d.contrat=? GROUP BY d.reference";
            $go = strtoupper($_POST['type']);
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go,$_POST['contrat']]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
        }else{
             $req="SELECT vil.ville,ray.rayon,et.etagere,bo.boite,sal.salle,d.reference,d.libelle as document, d.id as id_doc,d.status_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM villes as vil,rayons as ray, etageres as et,boites as bo,salles as sal, USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE vil.id = sal.id_ville AND sal.id=ray.id_salle AND ray.id=et.id_rayon AND et.id=bo.id_etagere AND bo.id=dos.id_boite AND u.id = d.id_user AND d.actif=? AND d.id_types=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND usag.id=d.id_usager GROUP BY d.reference";
            $go = strtoupper($_POST['type']);
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);  
          }
        }
// rechrche par type et periode
if(isset($_POST['critere']) && !empty($_POST['critere']) && isset($_POST['type']) && !empty($_POST['type']) && isset($_POST['debut']) && !empty($_POST['debut']) && isset($_POST['fin']) && !empty($_POST['fin']) && ($_SESSION['user']['roles'] =='ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER')){
        if($_POST['contrat']==1){
      $req="SELECT vil.ville,ray.rayon,et.etagere,bo.boite,sal.salle,d.reference,d.libelle as document, d.id as id_doc,d.status_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM villes as vil,rayons as ray, etageres as et,boites as bo,salles as sal, USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE vil.id = sal.id_ville AND sal.id=ray.id_salle AND ray.id=et.id_rayon AND et.id=bo.id_etagere AND bo.id=dos.id_boite AND u.id = d.id_user AND d.actif=? AND d.id_types=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND DATE_FORMAT(d.date_creation_doc,'%Y-%m-%d') BETWEEN ? AND ? AND usag.id=d.id_usager GROUP BY d.reference ";
            $go = strtoupper($_POST['type']);
            $deb =$_POST['debut'];
            $fin = $_POST['fin'];
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go,$deb,$fin]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
          }elseif($_POST['contrat']=='en cours' || $_POST['contrat']=='résilié'){
             $req="SELECT vil.ville,ray.rayon,et.etagere,bo.boite,sal.salle,d.reference,d.libelle as document, d.id as id_doc,d.status_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM villes as vil,rayons as ray, etageres as et,boites as bo,salles as sal, USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE vil.id = sal.id_ville AND sal.id=ray.id_salle AND ray.id=et.id_rayon AND et.id=bo.id_etagere AND bo.id=dos.id_boite AND u.id = d.id_user AND d.actif=? AND d.id_types=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND DATE_FORMAT(d.date_creation_doc,'%Y-%m-%d') BETWEEN ? AND ? AND usag.id=d.id_usager AND d.contrat=? GROUP BY d.reference ";
            $go = strtoupper($_POST['type']);
            $deb =$_POST['debut'];
            $fin = $_POST['fin'];
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go,$deb,$fin,$_POST['contrat']]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
          }
          else{
 $req="SELECT vil.ville,ray.rayon,et.etagere,bo.boite,sal.salle,d.reference,d.libelle as document, d.id as id_doc,d.status_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM villes as vil,rayons as ray, etageres as et,boites as bo,salles as sal, USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE vil.id = sal.id_ville AND sal.id=ray.id_salle AND ray.id=et.id_rayon AND et.id=bo.id_etagere AND bo.id=dos.id_boite AND u.id = d.id_user AND d.actif=? AND d.id_types=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND DATE_FORMAT(d.date_creation_doc,'%Y-%m-%d') BETWEEN ? AND ? AND usag.id=d.id_usager GROUP BY d.reference ";
            $go = strtoupper($_POST['type']);
            $deb =$_POST['debut'];
            $fin = $_POST['fin'];
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go,$deb,$fin]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
          }
      }
          //recherche par date enregistrement
          if(isset($_POST['critere']) && !empty($_POST['critere']) && isset($_POST['register']) && !empty($_POST['register']) && ($_SESSION['user']['roles'] =='ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER')){

      $req="SELECT vil.ville,ray.rayon,et.etagere,bo.boite,sal.salle,d.reference,d.libelle as document, d.id as id_doc,d.status_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM vil.id = sal.id_ville AND sal.id=ray.id_salle AND ray.id=et.id_rayon AND et.id=bo.id_etagere AND bo.id=dos.id_boite AND villes as vil,rayons as ray, etageres as et,boites as bo,salles as sal, USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = d.id_user AND d.actif=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND DATE_FORMAT(d.date_creation_doc,'%Y-%m-%d') = ? AND usag.id=d.id_usager GROUP BY d.reference ";
            $go = $_POST['register'];
           $rech = Db::getInstance()->prepare($req);
           $rech->execute([1,$go]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
            //var_dump($_POST['register']);
          }


          //recherche par periode
       if(isset($_POST['critere']) && !empty($_POST['critere']) && isset($_POST['debut']) && !empty($_POST['debut']) && isset($_POST['fin']) && !empty($_POST['fin']) && ($_SESSION['user']['roles'] =='ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER')){

      $req="SELECT vil.ville,ray.rayon,et.etagere,bo.boite,sal.salle,d.reference,d.libelle as document, d.id as id_doc,d.status_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM villes as vil,rayons as ray, etageres as et,boites as bo,salles as sal, USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE vil.id = sal.id_ville AND sal.id=ray.id_salle AND ray.id=et.id_rayon AND et.id=bo.id_etagere AND bo.id=dos.id_boite AND u.id = d.id_user AND d.actif=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND DATE_FORMAT(d.date_creation_doc,'%Y-%m-%d') BETWEEN ? AND ? AND usag.id=d.id_usager GROUP BY d.reference ";
            $go = $_POST['debut']; $go1 = $_POST['fin'];
           $rech = Db::getInstance()->prepare($req);
           $rech->execute([1,$go,$go1]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
            //var_dump($_POST['register']);
          }
       //endforeach;    

?>

<div class="row mt-2">

             <div class="col-md-12">
              <div class="card">
                <div class="card-header bg-success text-white">
                  <?= isset($_POST['critere'])? $nbre:'' ; ?> PI&Egrave;CE(S) TROUV&Eacute;E(S)
                </div>
                    <div class="card-body">
                    <blockquote class="blockquote mb-0">
  
<?php if(isset($_POST['critere']) && !empty($_POST['critere'])): ?>
<h2>RESULTAT DE LA RECHERCHE</h2>
<div class="table-responsive">
<table class="table table-bordered table-striped table-hover" id="dataTable" data-order="[[ 1, &quot;desc&quot; ]]" width="100%" cellspacing="0">
                        <caption></caption>
<thead>
    <tr>
        <th>N°</th>  
        <th>Ville</th>  
        <th>Salle</th>  
        <th>Rayon</th>  
        <th>Etagère</th>    
        <th>Boite</th>  
        <th>Réf Pièce</th>
        <th>Dossier</th>
        <th>Domaine</th>
        <th>Typologie</th>  
        <th>Usager</th> 
       <!-- <th>Créé le</th>    
        <th>Modifié le</th> -->
        <th width="3%">Action</th>
    
         
   
        </tr>
</thead>
    <tbody>
<?php
              $n=1;  foreach($result as $result1){?>


            <tr>
                <td><?=$n;?></td>
                <td><?=$result1->ville;?></td>
                <td><?=$result1->salle;?></td>
                <td><?=$result1->rayon;?></td>
                <td><?=$result1->etagere;?></td>
                <td><?=$result1->boite;?></td>
                <td><?=$result1->reference;?></td>
                <td><?=$result1->dossier;?></td>
                <td><?=$result1->designat;?></td>
                <td><?=$result1->typ;?></td>
                <td><?=$result1->usager;?></td>
               <!-- <td><?= $result1->date_creation_doc;?></td>
                <td><?= $result1->update_at;?></td>-->
                <td width="3%">
                  
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Actions:</div>
                    <div class="dropdown-item">
           <!-- 
          <a href="/archives/emprunter/<?=$result1->id_doc;?>" title="details" class="btn btn-primary">
            <i class="fa fa-bars"></i>
          </a>-->
          <?php 

            if($result1->status_doc==0){ ?>
          <a href="/archives/ajout_emprunt/<?=$result1->id_doc;?>" title="Emprunter" class="btn btn-info">
            <i class="fa fa-hands-helping"></i>
          </a></div><?php }else{ ?>
             <div class="dropdown-item"><button title="En cours d'emprunt" disabled class="btn btn-info">
            <i class="fa fa-hands"></i>
          </button></div><?php 
            }
           ?>
         <div class="dropdown-item">
          <a href="/archives/details_piece/<?=$result1->id_doc;?>" title="Détails" class="btn btn-success"><i class="fas fa-bars"></i></a></div>
        </div>
      </div>
         <!-- <a href="/archives/supprimeentree/<?=$result1->id_doc;?>" title="Supprimer" class="btn btn-danger">
            <i class="fas fa-trash"></i>
          </a>-->
          <!--<button class="btn btn-danger" data-toggle="modal" data-target="#supModal">Supprimer</button>-->
        </td>
                    
                </td>
                
            </tr>
      

        
    

               <?php $n++;}
       ?>

</tbody>

</table>
</div>

<?php endif; ?>
    </blockquote>
                    </div>
                </div>
             </div></div>
    

</div>










<!--


<?php if(isset($_SESSION['user']['id']) && $_SESSION['user']['roles'] =='ROLE_ADMIN'){ ?>
    
<div class="card shadow mb-4" style="padding-bottom:15px;">
    <div class="card-header py-3">
      <h1 class="m-0 font-weight-bold text-primary"> GESTION EMPRUNTS</h1>
  
       </div>
            <div class="row mt-4">
             <div class="col-md-12">
              <div class="card">
                <div class="card-header bg-success text-white">
                  Liste des pièces
                </div>
                    <div class="card-body">
                    <blockquote class="blockquote mb-0">
                   <div class="table-responsive">
  <table class="table table-bordered table-striped" id="dataTable6" cellspacing="0" data-order="[[ 0, &quot;desc&quot; ]]" >
<thead>
    <tr>

    <th data-column="" data-order="desc">N°</th>  
    <th data-column="" data-order="desc">Salle</th>  
    <th data-column="" data-order="desc">Rayon</th>  
    <th data-column="" data-order="desc">Etagère</th>    
    <th data-column="" data-order="desc">Boite Archive</th>  
    <th data-column="creele" data-order="desc">Dossier</th>
    <th data-column="intitule" data-order="desc">N° Pièce</th>
    <th data-column="modifiele" data-order="desc">Domaine</th>
    <th data-column="modifiele" data-order="desc">Typologie</th>
    <th data-column="action" data-order="desc" style="width: 3%;">Action</th>
    </tr>
</thead>
  <tbody>
    <?php $n=1;foreach ($entrees as $entree ):?>
      <tr>
        <td><?=$n;?></td>
        <td><?=$entree->salle;?></td>
        <td><?=$entree->rayon;?></td>
        <td><?=$entree->etagere;?></td>
        <td><?=$entree->boite;?></td>
        <td><?=$entree->dossier;?></td>
        <td><?=$entree->reference;?></td>
        <td><?=$entree->designation;?></td>
        <td><?=$entree->type;?></td>
        
        <td style="width: 3%;">
          <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Actions:</div>
                    <div class="dropdown-item">
        
        
          <?php 

            if($entree->status_doc==0){ ?>
          <a href="/archives/ajout_emprunt/<?=$entree->id;?>" title="Emprunter" class="btn btn-info">
            <i class="fa fa-hands-helping"></i>
          </a></div><?php }else{ ?>
             <div class="dropdown-item"><button title="En cours d'emprunt" disabled class="btn btn-info">
            <i class="fa fa-hands"></i>
          </button></div><?php 
            }
           ?>
         <div class="dropdown-item">
          <a href="/archives/details_piece/<?=$entree->id;?>" title="Détails" class="btn btn-success"><i class="fas fa-bars"></i></a></div>
        </div>
      </div>
      
        </td>
      </tr>
    <?php $n++; endforeach; ?>

    
  </tbody>

</table>

</div>
                   
                    </blockquote>
                    </div>
                </div>
             </div>

            </div></div>
          -->

<?php 
}else{
  header("Location: /");
  }
}
 ?>
