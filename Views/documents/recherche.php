<?php 
use App\Core\Form; 
use App\Controllers\UsersController;
use App\Models\UsersModel;
use App\Core\Db;
if(isset($_SESSION['user']['id'])){

   ?>
<div class="">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">RECHERCHER UNE PIECE</h1>
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
  $user = new UsersModel;
        $userss = $user->requete('SELECT rl_types.id_type FROM users,categories,rl_types WHERE users.id = rl_types.id_user AND categories.id = rl_types.id_type AND users.id=? GROUP BY rl_types.id_type',[$_SESSION['user']['id']])->fetchAll();
      // var_dump($userss); exit;
        foreach ($userss as $users) :    
  
//recherche par reference
    if(isset($_POST['critere']) && !empty($_POST['critere']) && isset($_POST['reference']) && !empty($_POST['reference']) && $_SESSION['user']['roles'] =='ROLE_USER'){
    
$req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag, DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = r.id_user AND c.id = r.id_type AND u.id = d.id_user AND d.id_cat = r.id_type AND d.actif=? AND d.reference LIKE ? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND c.id= t.id_cat AND usag.id=d.id_usager AND d.id_cat=? GROUP BY d.reference ";
            $go = strtoupper("%".$_POST['reference']."%");
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go,$users->id_type]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
          }
//recherche par usager
    if(isset($_POST['critere']) && !empty($_POST['critere']) && isset($_POST['usagers']) && !empty($_POST['usagers']) && $_SESSION['user']['roles'] =='ROLE_USER'){
    
$req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag, DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = r.id_user AND c.id = r.id_type AND u.id = d.id_user AND d.id_cat = r.id_type AND d.actif=? AND usag.usager LIKE ? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND c.id= t.id_cat AND usag.id=d.id_usager AND d.id_cat=? GROUP BY d.reference ";
            $go = strtoupper("%".$_POST['usagers']."%");
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go,$users->id_type]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
          }
//recherche par dossiers
    if(isset($_POST['critere']) && !empty($_POST['critere']) && isset($_POST['dossier']) && !empty($_POST['dossier']) && $_SESSION['user']['roles'] =='ROLE_USER'){
    
$req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at,c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag, DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = r.id_user AND c.id = r.id_type AND u.id = d.id_user AND d.id_cat = r.id_type AND d.actif=? AND d.id_dos=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND c.id= t.id_cat AND usag.id=d.id_usager  AND d.id_cat=? GROUP BY d.reference";
            $go = $_POST['dossier'];
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go,$users->id_type]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
          }

//recherche par domaine et dossiers
    if(isset($_POST['critere']) && !empty($_POST['critere']) && isset($_POST['dossier1']) && !empty($_POST['dossier1']) && isset($_POST['domaine']) && !empty($_POST['domaine']) && $_SESSION['user']['roles'] =='ROLE_USER'){
    
$req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at,c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag, DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = r.id_user AND c.id = r.id_type AND u.id = d.id_user AND d.id_cat = r.id_type AND d.actif=? AND d.id_dos=? AND c.id=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND c.id= t.id_cat AND usag.id=d.id_usager  AND d.id_cat=? GROUP BY d.reference";
            $go = $_POST['dossier1'];
            $go1 = $_POST['domaine'];
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go,$go1,$users->id_type]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
          }


          
// recherche par types
          if(isset($_POST['critere']) && !empty($_POST['critere']) && isset($_POST['type']) && !empty($_POST['type']) && $_SESSION['user']['roles'] =='ROLE_USER'){
               if($_POST['contrat']==1){
      $req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = r.id_user AND c.id = r.id_type AND u.id = d.id_user AND d.id_cat = r.id_type AND d.actif=? AND d.id_types=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND c.id= t.id_cat AND usag.id=d.id_usager  AND d.id_cat=? GROUP BY d.reference";
      $go = strtoupper($_POST['type']);
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go,$users->id_type]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
            }elseif($_POST['contrat']=='en cours' || $_POST['contrat']=='résilié'){
            $req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = r.id_user AND c.id = r.id_type AND u.id = d.id_user AND d.id_cat = r.id_type AND d.actif=? AND d.id_types=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND c.id= t.id_cat AND usag.id=d.id_usager  AND d.id_cat=? AND d.contrat=? GROUP BY d.reference";
           $go = strtoupper($_POST['type']);
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go,$users->id_type,$_POST['contrat']]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
            }else{
               $req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = r.id_user AND c.id = r.id_type AND u.id = d.id_user AND d.id_cat = r.id_type AND d.actif=? AND d.id_types=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND c.id= t.id_cat AND usag.id=d.id_usager  AND d.id_cat=? GROUP BY d.reference";
            $go = strtoupper($_POST['type']);
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go,$users->id_type]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
            }
            
          }
// rechrche par type et periode
if(isset($_POST['critere']) && !empty($_POST['critere']) && isset($_POST['type']) && !empty($_POST['type']) && isset($_POST['debut']) && !empty($_POST['debut']) && isset($_POST['fin']) && !empty($_POST['fin']) && $_SESSION['user']['roles'] =='ROLE_USER'){
  if($_POST['contrat']==1){
      $req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = r.id_user AND c.id = r.id_type AND u.id = d.id_user AND d.id_cat = r.id_type AND d.actif=? AND d.id_types=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND DATE_FORMAT(d.date_creation_doc,'%Y-%m-%d') BETWEEN ? AND ? AND c.id= t.id_cat AND usag.id=d.id_usager  AND d.id_cat=? GROUP BY d.reference";
            $go = strtoupper($_POST['type']);
            $deb =$_POST['debut'];
            $fin = $_POST['fin'];
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go,$deb,$fin,$users->id_type]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
          }elseif($_POST['contrat']=='en cours' || $_POST['contrat']=='résilié'){
 $req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = r.id_user AND c.id = r.id_type AND u.id = d.id_user AND d.id_cat = r.id_type AND d.actif=? AND d.id_types=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND DATE_FORMAT(d.date_creation_doc,'%Y-%m-%d') BETWEEN ? AND ? AND c.id= t.id_cat AND usag.id=d.id_usager  AND d.id_cat=? AND d.contrat=? GROUP BY d.reference";
            $go = strtoupper($_POST['type']);
            $deb =$_POST['debut'];
            $fin = $_POST['fin'];
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go,$deb,$fin,$users->id_type,$_POST['contrat']]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
          }else{
             $req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = r.id_user AND c.id = r.id_type AND u.id = d.id_user AND d.id_cat = r.id_type AND d.actif=? AND d.id_types=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND DATE_FORMAT(d.date_creation_doc,'%Y-%m-%d') BETWEEN ? AND ? AND c.id= t.id_cat AND usag.id=d.id_usager  AND d.id_cat=? GROUP BY d.reference";
            $go = strtoupper($_POST['type']);
            $deb =$_POST['debut'];
            $fin = $_POST['fin'];
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go,$deb,$fin,$users->id_type]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
          }
          }

          //recherche par date enregistrement
          if(isset($_POST['critere']) && !empty($_POST['critere']) && isset($_POST['register']) && !empty($_POST['register']) && $_SESSION['user']['roles'] =='ROLE_USER'){

      $req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = r.id_user AND c.id = r.id_type AND u.id = d.id_user AND d.id_cat = r.id_type AND d.actif=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND DATE_FORMAT(d.date_creation_doc,'%Y-%m-%d') = ?  AND c.id= t.id_cat AND usag.id=d.id_usager  AND d.id_cat=? GROUP BY d.reference";
            $go = $_POST['register'];
           $rech = Db::getInstance()->prepare($req);
           $rech->execute([1,$go,$users->id_type]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
            //var_dump($_POST['register']);
          }


          //recherche par periode
       if(isset($_POST['critere']) && !empty($_POST['critere']) && isset($_POST['debut']) && !empty($_POST['debut']) && isset($_POST['fin']) && !empty($_POST['fin']) && $_SESSION['user']['roles'] =='ROLE_USER'){

      $req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = r.id_user AND c.id = r.id_type AND u.id = d.id_user AND d.id_cat = r.id_type AND d.actif=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND DATE_FORMAT(d.date_creation_doc,'%Y-%m-%d') BETWEEN ? AND ? AND c.id= t.id_cat AND usag.id=d.id_usager  AND d.id_cat=? GROUP BY d.reference";
            $go = $_POST['debut']; $go1 = $_POST['fin'];
           $rech = Db::getInstance()->prepare($req);
           $rech->execute([1,$go,$go1,$users->id_type]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
            //var_dump($_POST['register']);
          }


          //--------------------------------------------------------------------USER ADMIN------------------------------------------------//
          
          //recherche par reference
    if(isset($_POST['critere']) && !empty($_POST['critere']) && isset($_POST['reference']) && !empty($_POST['reference'])  && ($_SESSION['user']['roles'] =='ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER')){
    
$req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = d.id_user AND d.actif=? AND d.reference LIKE ? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND usag.id=d.id_usager GROUP BY d.reference ";
            $go = strtoupper("%".$_POST['reference']."%");
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
          }

          //recherche par usager
    if(isset($_POST['critere']) && !empty($_POST['critere']) && isset($_POST['usagers']) && !empty($_POST['usagers'])  && ($_SESSION['user']['roles'] =='ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER')){
    
$req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = d.id_user AND d.actif=? AND usag.usager LIKE ? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND usag.id=d.id_usager GROUP BY d.reference ";
            $go = strtoupper("%".$_POST['usagers']."%");
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
          }

            //recherche par dossier
    if(isset($_POST['critere']) && !empty($_POST['critere']) && isset($_POST['dossier']) && !empty($_POST['dossier'])  && ($_SESSION['user']['roles'] =='ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER')){
    
$req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = d.id_user AND d.actif=? AND d.id_dos=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND usag.id=d.id_usager GROUP BY d.reference ";
            $go = $_POST['dossier'];
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
          }

            //recherche par dossier et Domaine
    if(isset($_POST['critere']) && !empty($_POST['critere']) && isset($_POST['dossier1']) && !empty($_POST['dossier1']) && isset($_POST['domaine']) && !empty($_POST['domaine'])  && ($_SESSION['user']['roles'] =='ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER')){
    
$req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = d.id_user AND d.actif=? AND d.id_dos=? AND c.id=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND usag.id=d.id_usager  GROUP BY d.reference ";
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
      $req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = d.id_user AND d.actif=? AND d.id_types=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND usag.id=d.id_usager GROUP BY d.reference";
            $go = strtoupper($_POST['type']);
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
        }  elseif($_POST['contrat']=='en cours' || $_POST['contrat']=='résilié'){
            $req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = d.id_user AND d.actif=? AND d.id_types=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND usag.id=d.id_usager AND d.contrat=? GROUP BY d.reference";
            $go = strtoupper($_POST['type']);
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go,$_POST['contrat']]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
        }else{
             $req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = d.id_user AND d.actif=? AND d.id_types=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND usag.id=d.id_usager GROUP BY d.reference";
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
      $req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = d.id_user AND d.actif=? AND d.id_types=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND DATE_FORMAT(d.date_creation_doc,'%Y-%m-%d') BETWEEN ? AND ? AND usag.id=d.id_usager GROUP BY d.reference ";
            $go = strtoupper($_POST['type']);
            $deb =$_POST['debut'];
            $fin = $_POST['fin'];
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go,$deb,$fin]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
          }elseif($_POST['contrat']=='en cours' || $_POST['contrat']=='résilié'){
             $req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = d.id_user AND d.actif=? AND d.id_types=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND DATE_FORMAT(d.date_creation_doc,'%Y-%m-%d') BETWEEN ? AND ? AND usag.id=d.id_usager AND d.contrat=? GROUP BY d.reference ";
            $go = strtoupper($_POST['type']);
            $deb =$_POST['debut'];
            $fin = $_POST['fin'];
            $rech = Db::getInstance()->prepare($req);
            $rech->execute([1,$go,$deb,$fin,$_POST['contrat']]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
          }
          else{
 $req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = d.id_user AND d.actif=? AND d.id_types=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND DATE_FORMAT(d.date_creation_doc,'%Y-%m-%d') BETWEEN ? AND ? AND usag.id=d.id_usager GROUP BY d.reference ";
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

      $req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = d.id_user AND d.actif=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND DATE_FORMAT(d.date_creation_doc,'%Y-%m-%d') = ? AND usag.id=d.id_usager GROUP BY d.reference ";
            $go = $_POST['register'];
           $rech = Db::getInstance()->prepare($req);
           $rech->execute([1,$go]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
            //var_dump($_POST['register']);
          }


          //recherche par periode
       if(isset($_POST['critere']) && !empty($_POST['critere']) && isset($_POST['debut']) && !empty($_POST['debut']) && isset($_POST['fin']) && !empty($_POST['fin']) && ($_SESSION['user']['roles'] =='ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER')){

      $req="SELECT d.reference,d.libelle as document, d.id as id_doc,d.date_creation_doc,u.nom,u.prenom,d.update_at, c.designation as designat, t.type as typ,dos.dossier, usag.usager FROM USAGERS as usag,DOSSIERS as dos, USERS as u,RL_TYPES as r, types as t,CATEGORIES as c,DOCUMENTS as d WHERE u.id = d.id_user AND d.actif=? AND d.id_cat = c.id AND d.id_types = t.id AND dos.id=d.id_dos AND DATE_FORMAT(d.date_creation_doc,'%Y-%m-%d') BETWEEN ? AND ? AND usag.id=d.id_usager GROUP BY d.reference ";
            $go = $_POST['debut']; $go1 = $_POST['fin'];
           $rech = Db::getInstance()->prepare($req);
           $rech->execute([1,$go,$go1]);
            $nbre = $rech->rowCount();
            $result = $rech->fetchAll(PDO::FETCH_OBJ);
            //var_dump($_POST['register']);
          }
       endforeach;    

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
        <th>Référence Pièce</th>
        <th>Dossier</th>
        <th>Domaine</th>
        <th>Typologie</th>  
        <th>Usager</th> 
        <th>Créé le</th>    
        <th>Modifié le</th> 
        <th width="13%">Action</th>
    
         
   
        </tr>
</thead>
    <tbody>
<?php
                foreach($result as $result1){?>


            <tr>
                <td><?=$result1->reference;?></td>
                <td><?=$result1->dossier;?></td>
                <td><?=$result1->designat;?></td>
                <td><?=$result1->typ;?></td>
                <td><?=$result1->usager;?></td>
                <td><?= $result1->date_creation_doc;?></td>
                <td><?= $result1->update_at;?></td>
                <td width="5%">
                  
                    <a href="/documents/details/<?=$result1->id_doc;?>" title="Détails" class="btn btn-success"><i class="fas fa-bars"></i></a>
                </td>
                
            </tr>
      

        
    

               <?php }
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
                   
              
                <?php
            
                 }else{
                    header("Location:/users/login");
                    exit;
        
    } ?>


   





