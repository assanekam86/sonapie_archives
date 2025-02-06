 <?php 
use App\Core\Form; 
use App\Models\DossiersModel;
use App\Models\DomainesModel;
use App\Models\TypesModel;
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user']['id'])){
$res="SELECT UPPER(vill) AS vill FROM liste_ville ORDER BY vill ASC";
$exe = Db::getInstance()->query($res);
$datas=$exe->fetchAll();

$query ="SELECT * FROM contrats ORDER BY contrat asc";
    $result = Db::getInstance()->query($query);
    $contrats = $result->fetchAll(PDO::FETCH_OBJ);
   ?>

<div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">AJOUTER UNE PIECE</h1>
                  </div>
                 
                 

    <div class="row m-t-30">
        <div class="col-md-12">

            <div class="row">
                <div class="col-lg-12">
                    <form id="form1" action="" method="post" enctype="multipart/form-data" target="">

                    <div class="card">
                        <div class="card-body">

                                <!--
                                <div class="form-group">
                                    <label for="name" class="control-label mb-1">Référence Document</label>
                                    <input id="name" name="reference" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                </div> -->
                             <!--   <div class="form-group">
                                    <label for="slug" class="control-label mb-1">Intitulé</label>
                                    <input id="slug" name="libelle"  value="" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                
                                

                                
                                </div> -->



                                  
<?php 

    $query ="SELECT * FROM categories ORDER BY designation asc";
    $result = Db::getInstance()->query($query);
    $rows = $result->rowCount();

    $req= "SELECT * FROM usagers ORDER BY usager asc ";
    $usage = Db::getInstance()->query($req);
    $usagers = $usage->fetchAll();

/*
$req ="SELECT * FROM categories ORDER BY designation asc";
    $result = Db::getInstance()->query($req);
    $datas = $result->fetchAll();
    */
 ?>                                    <div class="row">
                                                <div class="col-md-2 offset-md-3"><label>Pièce avec Usager:</label></div>
                                            <div class="col-md-6">
                                            NON &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 <input type="radio" name="cases" value="2" id="chkb_10" onclick="met(this,'texte_10','texte_20');" > 
                                 <input type="hidden" style="display:none" id="texte_10" value="">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            OUI &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                    <input type="radio" id="chkb_20" value="1" style="" checked="checked" name="cases" onclick="met(this,'texte_20','texte_10');" >
                                        </div>
                                        </div> 
<hr>
                                        <div class="row mt-2">
                                      <div class="col-md-6 form-group">    
                                    <label for="domaine" class="control-label mb-1">Domaine de gestion</label>
                                    <select id="domaine" name="domaine" class="form-control" aria-required="true" aria-invalid="false" disabled>
                                        <option value="">Choisir domaine</option>
                                        
                                          <?php
                                            if($rows>0){

                                              while($row = $result->fetch(PDO::FETCH_ASSOC)){?>
                                                 <option value="<?=$row['id'];?>" <?= $domain->id==$row['id']? 'selected=selected':''; ?>><?=$row['designation'];?></option>
                                                 <?php
                                                    }
                                            }
                                        else{
                                echo '<option value="">Domaine non valable</option>';
                                             }
                                         ?>
                                       
                                        </select>   
                                        <input type="hidden" name="domaine" value="<?=$domain->id;?>"> 
                                   </div>
                                   <div id="texte_20" style="display:;" class="col-md-6">
                                      <div class=" form-group" >                 
                                        <label for="usag" class="control-label mb-1">Usager</label>
                                        <select id="usag" name="usager" class="form-control single">
                                            <option value="">Choisir usager</option>
                                            <?php foreach($usages as $usage): ?>
                                                <option value="<?=$usage->id ?>"><?= $usage->matricule." ".$usage->usager ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div style="float:right;" class="mt-2">
                                            <a data-toggle="modal" href='#modal-id' class="btn btn-primary">Créer usager</a>
                                        </div>

                                     

                                      </div>
                                    </div>
                                    
                                
                                </div>
                                <div class="row">

                                    <div class="col-md-12 form-group">    
                                    <label for="category_id" class="control-label mb-1">Typologie</label>
                                    <select id="type" name="types" class="form-control single types" aria-required="true" aria-invalid="false" required>
                                        <option value="">Choisir Type</option>
                                        <?php foreach($typos as $typo): ?>
                                                <option value="<?=$typo->id ?>"><?= $typo->type;?></option>
                                            <?php endforeach; ?>
                                    </select>    
                                    </div>
                                </div>

                                <div class="row">
                                      <div class=" col-md-12 form-group">
                                    <label for="doss" class="control-label mb-1">Dossier</label>
                                        <select name="dossier" class="form-control single" id="doss" required>
                                            <option value="">Choisir le dossier</option>
                                          <?php foreach($doss as $dos): ?>
                                                <option value="<?=$dos->id ?>"><?= $dos->dossier;?> (Boite: <?= $dos->boite;?>| Etagère: <?= $dos->dossier;?>| Rayon: <?= $dos->rayon;?>| Salle: <?= $dos->salle;?>| Ville: <?= $dos->ville;?>)</option>
                                            <?php endforeach; ?>
                                        </select>                                    
                                    </div>
                                </div>
                                <div id="ANL1">
                                        <!-- ATTESTATION DE NON LOGEMENT  -->
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Numéro </label>
                                    <input id="name" name="numero4" value="" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="idem" class="control-label mb-1">Taux d'indemnité </label>
                                    <input id="idem" name="indemnite" value="" placeholder="Entrer taux d'indemnité" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                   </div>
                                   <div class="col-md-4 form-group">
                                    <label for="etb" class="control-label mb-1">Etabli le </label>
                                    <input id="name" name="etabli4" value="" placeholder="Date d'edition" type="date" class="form-control" aria-required="true" aria-invalid="false">
                                   </div>
                               </div>

                                </div>

                                <div id="ANL2">
                                        <!-- CERTIFICAT DE NON HEBERGEMENT  -->
                                         <!-- CERTIFICAT DE PREMIERE PRISE DE SERVICE  -->

                                    <div class="form-group">
                                    <label for="name" class="control-label mb-1">Numéro </label>
                                    <input id="name" name="numero1" value="" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                   <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Etabli le </label>
                                    <input id="name" name="etabli1" value="" placeholder="Date d'edition" type="date" class="form-control" aria-required="true" aria-invalid="false">
                                   </div>

                                </div>
                              
                                <div id="ANL3">
                                     <!-- ARRETE DE NOMMINATION  -->

                                    <div class="form-group">
                                    <label for="name" class="control-label mb-1">Libellé</label>
                                    <input id="name" name="libelle2" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                    <div class="form-group">
                                    <label for="name" class="control-label mb-1">Numéro </label>
                                    <input id="name" name="numero2" value="" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                   <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Etabli le </label>
                                    <input id="name" name="etabli2" value="" placeholder="Date d'edition" type="date" class="form-control" aria-required="true" aria-invalid="false">
                                   </div>

                                </div>
                                  <div id="ANL4">
                                     <!-- BULLETIN DE SOLDE -->
                                <div class="row"> 

                                <div class="col-md-6 form-group">
                                    <label for="name" class="control-label mb-1">Numéro</label>
                                       <input id="name" name="numero5" value="" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="name" class="control-label mb-1">Intitulé</label>
                                    <input id="name" name="libelle5" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col-md-4 form-group">
                                    <label for="gains" class="control-label mb-1">Gains</label>
                                    <input id="gains" name="gains" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                    </div>
                                    <div class="col-md-4 form-group">
                                    <label for="retenue" class="control-label mb-1">Retenues</label>
                                    <input id="retenue" name="retenues" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                   <div class="col-md-4 form-group">
                                    <label for="montant" class="control-label mb-1">Montant net</label>
                                    <input id="montant" name="montant5" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col-md-4 form-group">
                                    <label for="regle" class="control-label mb-1">Mode de reglement</label>
                                    <select id="montant" name="reglement5" value="" class="form-control single" aria-required="true" aria-invalid="false" >
                                        <option value="Virement" selected="selected">Virement</option>
                                        <option value="Cheque">Cheque</option>
                                    </select>
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="compte" class="control-label mb-1">Numero Compte</label>
                                    <input id="compte" name="compte5" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                    <div class="col-md-4 form-group">
                                        <label for="etb" class="control-label mb-1">Banque </label>
                                   <select id="montant" name="domicile5" value="" class="form-control single" aria-required="true" aria-invalid="false" >
                                    <option>Choisir la Banque</option>
                                        <option value="AFRILAND FIRST BANK">AFRILAND FIRST BANK</option>
                                        <option value="BACI">BACI</option>
                                        <option value="BBG-CI">BBG-CI</option>
                                        <option value="BDA">BDA</option>
                                        <option value="BDU-CI">BDU-CI</option>
                                        <option value="BGFIBANK">BGFIBANK</option>
                                        <option value="BHCI">BHCI</option>
                                        <option value="BIAO-CI">BIAO-CI</option>
                                        <option value="BICICI">BICICI</option>
                                        <option value="BMS">BMS</option>
                                        <option value="BNI">BNI</option>
                                        <option value="BOA">BOA</option>
                                        <option value="BRM-CI">BRM-CI</option>
                                        <option value="BSIC-CI">BSIC-CI</option>
                                        <option value="CBI-CI">CBI-CI</option>
                                        <option value="CITIBANK">CITIBANK</option>
                                        <option value="CNCE-CI">CNCE-CI</option>
                                        <option value="DBCI">DBCI</option>
                                        <option value="ECOBANK-CI">ECOBANK-CI</option>
                                        <option value="FIDELIS">FIDELIS</option>
                                        <option value="GTBANK-CI">GTBANK-CI</option>
                                        <option value="MANSA BANK">MANSA BANK</option>
                                        <option value="NSIA BANQUE">NSIA BANQUE</option>
                                        <option value="OAC">OAC</option>
                                        <option value="ORABANK">ORABANK</option>
                                        <option value="SAFCA">SAFCA</option>
                                        <option value="SCBCI">SCBCI</option>
                                        <option value="SGBCI">SGBCI</option>
                                        <option value="SIB">SIB</option>
                                        <option value="STABIC BANK">STABIC BANK</option>
                                        <option value="UBA">UBA</option>
                                        <option value="VERSUS BANQUE">VERSUS BANQUE</option>
                                    </select>
                                   </div>
                                                     
                                </div>
                                  <div class="col-md-4 form-group">
                                        <label for="etb" class="control-label mb-1">Etabli le </label>
                                        <input id="name" name="etabli5" value="" placeholder="Date d'edition" type="date" class="form-control" aria-required="true" aria-invalid="false">
                                    </div>
                                </div>

                                  <div id="CESSION2">
                                        <div class="row">                   <!-- ATTESTATION DE FIN DE PAIEMENT -->
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Numéro</label>
                                    <input id="name" name="numero8" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                   <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Montant</label>
                                    <input id="name" name="montant8" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                   <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date Paiement</label>
                                    <input id="name" name="etabli8" value="" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                               </div>
                                 </div>

                                  <div id="CESSION3">
                                       <div class="row">                      <!-- SITUATION DES REGLEMENTS ACQUEREUR -->
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Numéro Dossier</label>
                                    <input id="name" name="numero9" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">N° Décision</label>
                                    <input id="name" name="decision9" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date Décision</label>
                                    <input id="name" name="datedecision" value="" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                      </div>
                                      <div class="row">
                                    <div class="col-md-6 form-group">
                                    <label for="name" class="control-label mb-1">MT Expertise</label>
                                    <input id="name" name="expertise" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                    <div class="col-md-6 form-group">
                                    <label for="name" class="control-label mb-1">Nombre P</label>
                                    <input id="name" name="nbrep" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Montant à payer</label>
                                    <input id="name" name="montant9" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                     <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Solde</label>
                                    <input id="name" name="solde" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                      <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Arriérés</label>
                                    <input id="name" name="arriere" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                   
                               </div>
                                 </div>

                                 <div id="CESSION4">
                                     <div class="row">                        <!-- DECISION AFFECTATION DE LOGEMENT -->
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Numéro</label>
                                    <input id="name" name="numero7" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Logement</label>
                                    <input id="name" name="logement7" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                       <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Baille</label>
                                    <input id="name" name="baille" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                               </div>
                               <div class="row">
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Loyer mensuel</label>
                                    <input id="name" name="montant7" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                       <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Logement du groupe </label>
                                    <input id="name" name="logroupe" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                     <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Pièces</label>
                                    <input id="name" name="pieces" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                               </div>

                           </div>

                                <div id="BAUX1">
                                     <!-- CONTRAT DE BAIL -->
                                     <div class="col-md-8 form-group">
                                    <label for="name" class="control-label mb-1">Libellé</label>
                                    <input id="name" name="libelle20" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli20" value="" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="etb" class="control-label mb-1">Ville </label>
                                    <select id="name" name="ville" value="" class="form-control single" aria-required="true" aria-invalid="false">
                                        <option>Choisir la ville</option>
                                        <?php foreach($datas as $data): ?>

                                            <option value="<?= $data->vill;?>">
                                                <?= $data->vill;?>  
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Numéro Bail </label>
                                    <input id="name" name="numero20" value="" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                               </div>

                                   <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Objet du contrat </label>
                                    <textarea id="name" name="objet20" value="" placeholder="Objet du contrat" class="form-control"></textarea>
                                   </div>
                                <div class="row">
                                   <div class="col-md-4 form-group">
                                    <label for="etb" class="control-label mb-1">Loyer mensuel</label>
                                    <input id="name" name="montant20" value="" placeholder="Loyer mensuel" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="etb" class="control-label mb-1">Durée</label>
                                    <input id="name" name="duree20" value="" placeholder="Duree" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                   </div>
                                    <div class="col-md-4 form-group">
                                        <label for="etb" class="control-label mb-1">Date Effet</label>
                                        <input id="name" name="effet20" value="" placeholder="Date d'effet" type="date" class="form-control" aria-required="true" aria-invalid="false">
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col-md-3 form-group">
                                        <label for="etb" class="control-label mb-1">Mode de reglement </label>
                                   <select id="montant" name="reglement20" value="" class="form-control single" aria-required="true" aria-invalid="false" >
                                        <option value="Virement" selected="selected">Virement</option>
                                        <option value="Cheque">Cheque</option>
                                    </select>
                                   </div>
                                    <div class="col-md-3 form-group">
                                        <label for="etb" class="control-label mb-1">Banque </label>
                                   <select id="montant" name="domicile20" value="" class="form-control single" aria-required="true" aria-invalid="false" >
                                        <option>Choisir la banque</option>
                                        <option value="AFRILAND FIRST BANK">AFRILAND FIRST BANK</option>
                                        <option value="BACI">BACI</option>
                                        <option value="BBG-CI">BBG-CI</option>
                                        <option value="BDA">BDA</option>
                                        <option value="BDU-CI">BDU-CI</option>
                                        <option value="BGFIBANK">BGFIBANK</option>
                                        <option value="BHCI">BHCI</option>
                                        <option value="BIAO-CI">BIAO-CI</option>
                                        <option value="BICICI">BICICI</option>
                                        <option value="BMS">BMS</option>
                                        <option value="BNI">BNI</option>
                                        <option value="BOA">BOA</option>
                                        <option value="BRM-CI">BRM-CI</option>
                                        <option value="BSIC-CI">BSIC-CI</option>
                                        <option value="CBI-CI">CBI-CI</option>
                                        <option value="CITIBANK">CITIBANK</option>
                                        <option value="CNCE-CI">CNCE-CI</option>
                                        <option value="DBCI">DBCI</option>
                                        <option value="ECOBANK-CI">ECOBANK-CI</option>
                                        <option value="FIDELIS">FIDELIS</option>
                                        <option value="GTBANK-CI">GTBANK-CI</option>
                                        <option value="MANSA BANK">MANSA BANK</option>
                                        <option value="NSIA BANQUE">NSIA BANQUE</option>
                                        <option value="OAC">OAC</option>
                                        <option value="ORABANK">ORABANK</option>
                                        <option value="SAFCA">SAFCA</option>
                                        <option value="SCBCI">SCBCI</option>
                                        <option value="SGBCI">SGBCI</option>
                                        <option value="SIB">SIB</option>
                                        <option value="STABIC BANK">STABIC BANK</option>
                                        <option value="UBA">UBA</option>
                                        <option value="VERSUS BANQUE">VERSUS BANQUE</option>
                                    </select>
                                   </div>
                                   <div class="col-md-3 form-group">
                                        <label for="etb" class="control-label mb-1">N° Compte </label>
                                        <input id="name" name="compte20" value="" placeholder="Numero de Compte" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                   </div>

                                      <div class="col-md-3 form-group">
                                    <label for="name" class="control-label mb-1">Statut Contrat </label>
                                      <select name="contrat19" class="form-control single" id="serv">
                                            <option value="">option du contrat</option>
                                          <?php
                                                foreach($contrats as $cont){?>                                               
                                                  
                                                <option value="<?= $cont->contrat; ?>"> 
                                                <?=$cont->contrat;?> 
                                                 </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select> 
                                   </div>
                                </div>


                                </div>

                            <div id="BAUX2">
                                     <!-- AVENANTS -->
                                    <div class="col-md-8 form-group">
                                    <label for="name" class="control-label mb-1">Libellé</label>
                                    <input id="name" name="libelle19" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                 <div class="row">
                                  <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Numéro  </label>
                                    <input id="name" name="numero19" value="" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Duree</label>
                                    <input id="name" name="duree" value="" type="text" class="form-control" placeholder="Entrer la durée" aria-required="true" aria-invalid="false" >
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="etb" class="control-label mb-1">Date Effet </label>
                                    <input id="name" name="effet19" value="" placeholder="Date d'effet ..." type="date" class="form-control" aria-required="true" aria-invalid="false">
                                   </div>
                                   
                               </div>
                               <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Objet du contrat </label>
                                    <textarea id="name" name="objet19" value="" placeholder="Objet du contrat" class="form-control"></textarea>
                                   </div>
                                   <div class="row">
                                       <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Statut Contrat </label>
                                      <select name="contrat19" class="form-control single" id="serv">
                                            <option value="">option du contrat</option>
                                          <?php
                                                foreach($contrats as $cont){?>                                               
                                                  
                                                <option value="<?= $cont->contrat; ?>"> 
                                                <?=$cont->contrat;?> 
                                                 </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select> 
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli19" value="" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                            

                               </div>
                              

                               </div>

                        
                                    <div id="BAUX3">
                                     <!-- RIB -->

                                     <div class="row">
                                        <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Numéro RIB  </label>
                                    <input id="name" name="numero18" value="" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                  <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Code Banque  </label>
                                    <input id="name" name="codebanque" value="" type="text" class="form-control" placeholder="Entrer le code" aria-required="true" aria-invalid="false">
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Code guichet</label>
                                    <input id="name" name="codeguichet" value="" type="text" class="form-control" placeholder="Entrer le code guichet" aria-required="true" aria-invalid="false" >
                                   </div>
                                   
                                   
                               </div>
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                    <label for="etb" class="control-label mb-1">Domiciliation </label>
                                    <select id="etb" name="domicile" value="" class="form-control single" aria-required="true" aria-invalid="false" >
                                        <option>Choisir la Banque</option>
                                        <option value="AFRILAND FIRST BANK">AFRILAND FIRST BANK</option>
                                        <option value="BACI">BACI</option>
                                        <option value="BBG-CI">BBG-CI</option>
                                        <option value="BDA">BDA</option>
                                        <option value="BDU-CI">BDU-CI</option>
                                        <option value="BGFIBANK">BGFIBANK</option>
                                        <option value="BHCI">BHCI</option>
                                        <option value="BIAO-CI">BIAO-CI</option>
                                        <option value="BICICI">BICICI</option>
                                        <option value="BMS">BMS</option>
                                        <option value="BNI">BNI</option>
                                        <option value="BOA">BOA</option>
                                        <option value="BRM-CI">BRM-CI</option>
                                        <option value="BSIC-CI">BSIC-CI</option>
                                        <option value="CBI-CI">CBI-CI</option>
                                        <option value="CITIBANK">CITIBANK</option>
                                        <option value="CNCE-CI">CNCE-CI</option>
                                        <option value="DBCI">DBCI</option>
                                        <option value="ECOBANK-CI">ECOBANK-CI</option>
                                        <option value="FIDELIS">FIDELIS</option>
                                        <option value="GTBANK-CI">GTBANK-CI</option>
                                        <option value="MANSA BANK">MANSA BANK</option>
                                        <option value="NSIA BANQUE">NSIA BANQUE</option>
                                        <option value="OAC">OAC</option>
                                        <option value="ORABANK">ORABANK</option>
                                        <option value="SAFCA">SAFCA</option>
                                        <option value="SCBCI">SCBCI</option>
                                        <option value="SGBCI">SGBCI</option>
                                        <option value="SIB">SIB</option>
                                        <option value="STABIC BANK">STABIC BANK</option>
                                        <option value="UBA">UBA</option>
                                        <option value="VERSUS BANQUE">VERSUS BANQUE</option>
                                    </select>
                                   </div>
                                  <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Cle RIB  </label>
                                    <input id="name" name="rib" value="" type="text" class="form-control" placeholder="Entrer la clé RIB" aria-required="true" aria-invalid="false">
                                   </div>
                                    <div class="col-md-8 form-group">
                                    <label for="name" class="control-label mb-1">N° Compte</label>
                                    <input id="name" name="compte18" value="" type="text" class="form-control" placeholder="Entrer le numéro de compte" aria-required="true" aria-invalid="false" >
                                   </div>
                                   
                                   
                               </div>

                                    </div>

                                    <div id="BAUX4">
                                     <!-- PROCURATION -->
                                     <div class="row">
                                  <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Numéro  </label>
                                    <input id="name" name="numero17" value="" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli17" value="" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                   
                               </div>
                                    <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Objet </label>
                                    <textarea id="name" name="objet17" value="" placeholder="Objet ..." class="form-control"></textarea>
                                   </div>


                                    </div>

                                    <div id="BAUX5">
                                     <!-- ACTE D'INDIVIDUALITE -->
                                <div class="row">
                                  <div class="col-md-6 form-group">
                                    <label for="name" class="control-label mb-1">Numéro</label>
                                    <input id="name" name="numero21" value="" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                    <div class="col-md-6 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli21" value="" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                   
                               </div>
                                    <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Objet </label>
                                    <textarea id="name" name="objet21" value="" placeholder="Objet ..." class="form-control"></textarea>
                                   </div>



                                    </div>

                                    <div id="RESS1">
                                        <!-- PERSONNEL -->
                                <div class="row">
                                        <div class="col-md-8 form-group">
                                    <label for="name" class="control-label mb-1">Intitulé </label>
                                    <input id="name" name="libelle14" value="" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                       
                                  <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Numéro  </label>
                                    <input id="name" name="numero14" value="" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                   
                               </div>
                                    <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Description </label>
                                    <textarea id="name" name="objet14" value="" placeholder="Objet ..." class="form-control"></textarea>
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli14" value="" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                   
                                    </div> 
                                    <div id="RESS2">
                                        <!-- ATTESTATION -->

                                    <div class="row">
                                    <div class="col-md-8 form-group">
                                    <label for="name" class="control-label mb-1">Intitulé  </label>
                                    <input id="name" name="libelle15" value="" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                       
                                  <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Numéro  </label>
                                    <input id="name" name="numero15" value="" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                   
                               </div>
                                    <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Description </label>
                                    <textarea id="name" name="objet15" value="" placeholder="Objet ..." class="form-control"></textarea>
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli15" value="" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>

                                    </div>
                                    <div id="RESS3">
                                        <!-- DECISION -->

                                        <div class="row">
                                    <div class="col-md-8 form-group">
                                    <label for="name" class="control-label mb-1">Intitulé  </label>
                                    <input id="name" name="libelle16" value="" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                       
                                  <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Numéro  </label>
                                    <input id="name" name="numero16" value="" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                   
                               </div>
                                    <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Description </label>
                                    <textarea id="name" name="objet16" value="" placeholder="Objet ..." class="form-control"></textarea>
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli16" value="" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                    </div>
                                    <div id="RESS4">
                                        <!-- FICHE DE SORTIE -->

                                        <div class="row">
                                    <div class="col-md-8 form-group">
                                    <label for="name" class="control-label mb-1">Intitulé  </label>
                                    <input id="name" name="libelle12" value="" type="text" class="form-control" placeholder="Entrer le libelle ..." aria-required="true" aria-invalid="false">
                                   </div>
                                       
                                  <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Numero  </label>
                                    <input id="name" name="numero12" value="" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                   
                               </div>
                                    <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Description </label>
                                    <textarea id="name" name="objet12" value="" placeholder="Objet ..." class="form-control"></textarea>
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli12" value="" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                    </div>
                                    <div id="RESS5">
                                        <!-- FICHE DE PRESENCE -->

                                        <div class="row">
                                       
                                  <div class="col-md-6 form-group">
                                    <label for="name" class="control-label mb-1">Numéro  </label>
                                    <input id="name" name="numero11" value="" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                   <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli11" value="" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                   
                               </div>
                                    <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Description </label>
                                    <textarea id="name" name="objet11" value="" placeholder="Objet ..." class="form-control"></textarea>
                                   </div>
                                    

                                    </div> 
                                    <div id="RESS6">
                                        <!-- ORDRE DE MISSION -->
                                        <div class="row">
                                   
                                  <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Numéro  </label>
                                    <input id="name" name="numero13" value="" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date depart</label>
                                    <input id="name" name="effet13" value="" type="date" class="form-control" placeholder="Entrer la date depart" aria-required="true" aria-invalid="false">
                                   </div>
                                   <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date de retour</label>
                                    <input id="name" name="retour" value="" type="date" class="form-control" placeholder="Entrer la date retour" aria-required="true" aria-invalid="false">
                                   </div>
                                   
                               </div>
                                    <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Objet mission </label>
                                    <textarea id="name" name="objet13" value="" placeholder="Objet de la mission ..." class="form-control"></textarea>
                                   </div>
                                    <div class="row">
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Imputation Budgetaire</label>
                                    <input id="name" name="imputation" value="" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli13" value="" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>

                                  </div>
                                    </div> 
                                    <div id="RESS7">
                                        <!-- NOTE INTERNE -->

                                         <div class="row">
                                    <div class="col-md-8 form-group">
                                    <label for="name" class="control-label mb-1">Intitulé  </label>
                                    <input id="name" name="libelle10" value="" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                       
                                  <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Numéro  </label>
                                    <input id="name" name="numero10" value="" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                   
                               </div>
                                    <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Description </label>
                                    <textarea id="name" name="objet10" value="" placeholder="Objet ..." class="form-control"></textarea>
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli10" value="" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>

                                    </div>

                                    <div id="RESS8">
                                    <!-- AUTRES TYPOLOGIE -->
                                     <div class="row">
                                    <div class="col-md-8 form-group">
                                    <label for="name" class="control-label mb-1">Intitulé</label>
                                    <input id="name" name="libelle" value="" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                       
                                  <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Numéro  </label>
                                    <input id="name" name="numero" value="" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                   
                               </div>
                                    
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli" value="" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>

                                    </div>

                                        <div id="COURRIER">
                                        <!-- NOTE INTERNE -->

                                         <div class="row">
                                    <div class="col-md-8 form-group">
                                    <label for="name" class="control-label mb-1">Objet  </label>
                                    <input id="name" name="libelle22" value="" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                       
                                  <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Numéro  </label>
                                    <input id="name" name="numero22" value="" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                   
                               </div>
                                    <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Description</label>
                                    <textarea id="name" name="objet22" value="" placeholder="Description ..." class="form-control"></textarea>
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli22" value="" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>

                                    </div>


                                  

                                
                                    
                                       
                                    
                              <!--  
                               
                                <div class="form-group">
                                    <label for="desc" class="control-label mb-1">Description</label>
                                    <textarea id="desc" name="description" class="form-control" aria-required="true" aria-invalid="false" required></textarea>
                                </div>
                              -->

                                
<!-- debut charger fichier
                <h2 class="mb10">FICHIERS A CHARGER</h2>
                    <div class="col-lg-12" >
                           

                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row" id="product_images_box">
                           <?php $loop_count_num=1; 
                            
                           # foreach($productImagesArr as $key=>$val):
                           
                             
                                $loop_count_prev=$loop_count_num;
                             #$pIArr=(array)$val;
                              ?>
                                       <input id="piid" name="piid[]" value="" type="hidden" class="form-control" aria-required="true" aria-invalid="false"> -->
                                        <!--<input type="hidden" name="MAX_FILE_SIZE" value="s" />-->
                                        <!--<div class="col-md-10 product_images_$loop_count_num++">
                                            <label for="images" class="control-label mb-1">Fichier</label>
                                            <input id="imagess" name="fichier[]" type="file" class="form-control" aria-required="true" aria-invalid="false"/>
                                            <span class="text-center" style="color:red;">Formats autorisés :'jpg','png','gif','jpeg','html','php','doc','docx','csv','pdf','xlsx','xls','rar','zip','3gp','mp4','mpeg','flv'</span>
                                    
                                        </div>  
                                          <div class="col-md-2">
                                            <label for="images" class="control-label mb-1">ACTION</label>
                                          
                                            <?php if($loop_count_num == 1): ?>                                                <button type="button" class="btn btn-success btn-lg" onclick="add_images_more()"><i class="fa fa-plus"></i> Ajouter</button>
                                            <?php else: ?>
                                               <a href=""><button type="button" class="btn btn-danger btn-lg"><i class="fa fa-plus"></i> Supprimer</button></a> 
                                            <?php endif; ?>                                        
                                          </div>
                            <?php #endforeach; ?>
                                     
                                      

                             
                                        </div>
                                </div>
                            </div>
                            
                        </div>
                    
                    </div> -->


                <h2 class="mb10">SCANNER FICHIERS</h2>
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <a href="/scan-setup.exe" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Télécharger le logiciel de Scan</a>
          </div>
                    <div class="col-lg-12" >
                            

                            <div class="card">
                                <div class="card-body">


                        <button type="button" class="btn btn-success" onclick="scanToJpg();">Demarrer le Scan</button>
 
    <div id="images">
         <div class="zone"></div>
    </div>

    <!-- Previous lines are same as demo-01, below is new addition to demo-02 | https://asprise.com/scan/applet/upload.php?action=dump-->

   <!--
        <input type="text" id="sample-field" name="sample-field" value="Test scan"/>
        <input type="button" value="Submit" name="images" onclick="submitFormWithScannedImages();">
    -->

    <div id="server_response"></div>

    
                                </div>
                            </div>
                    </div>

                                               
                            <div class="row mt-2">
                            <div class="col-md-8 offset-md-2 form-group">
                            <button id="payment-button" type="submit" class="btn btn-lg btn-primary btn-block" >
                                Valider
                            </button>
                        </div>
                    </div>





                        </div>
                    </div>
                    </form>
                </div>




            </div>

        </div>
    </div>


                  

                  
                  <hr>
     
                </div>

         <div class="modal fade" id="modal-id">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                     
                                                        <h4 class="modal-title" align="center">CREER USAGER</h4>
                                                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="">
                                                            <div class="form-group">
                                <label for="slug" class="control-label mb-1">Usager</label>
                                <input id="slug" name="usagers" placeholder="Nom de l'usager ..."  value="" type="text" class="form-control" aria-required="true" aria-invalid="false" required>    
                            </div> 
         <?php 
            $req="select * from status";
            $valides = Db::getInstance()->query($req);
            $valide = $valides->fetchAll();
         ?>
                              <div class="form-group">
                                    <label for="serv" class="control-label mb-1">Type Usager</label>
                                        <select name="typos" id="usagers" class="form-control usager" required>
                                            <option value="">Choisir type Usager</option>
                                          <?php
                                                foreach($valide as $liste){?>
                                          
                                                 <option value="<?=$liste->id;?>" >
                                                <?=$liste->types;?> 
                                                 </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>                                    
                                 </div>
                                 <div id="particulier"> 
                                    <div class="form-group">
                                <label for="slug1" class="control-label mb-1">Matricule</label>
                                <input id="slug1" name="matricule" placeholder="Matricule ..." type="text" class="form-control" aria-required="true" aria-invalid="false">
                                 </div> 

                                 <div class="form-group">
                                  <label for="slug2" class="control-label mb-1">Emploi</label>
                                  <input id="slug2" name="fonction" placeholder="Fonction ..." type="text" class="form-control" aria-required="true" aria-invalid="false">
                                 </div> 

                                 <div class="form-group">
                                  <label for="slug3" class="control-label mb-1">Catégorie</label>
                                  <input id="slug3" name="grade" type="text" placeholder="Grade ..." class="form-control" aria-required="true" aria-invalid="false">
                                 </div> 

                                 <div class="form-group">
                                  <label for="slug4" class="control-label mb-1">Etablissement</label>
                                  <input id="slug4" name="etable" type="text" placeholder="Etablissement ..." class="form-control" aria-required="true" aria-invalid="false">
                                 </div>

                                 <div class="form-group">
                                  <label for="slug5" class="control-label mb-1">Date de service</label>
                                  <input id="slug5" name="dateserv" type="date" class="form-control" aria-required="true" aria-invalid="false">
                                 </div>  

                                 </div>
                            <div class="form-group">
                                <label for="slug" class="control-label mb-1">Contact</label>
                                <input id="slug" name="contact" type="text" placeholder="Contact ..." class="form-control" aria-required="true" aria-invalid="false">
                            </div> 
                           <div id="entreprise">
                          
                              <div class="form-group">
                                <label for="slug" class="control-label mb-1">Email</label>
                               <input id="slug" name="email" type="text" placeholder="Email ..." class="form-control" aria-required="true" aria-invalid="false"> 
                            </div> 
                              <div class="form-group">
                                <label for="slug" class="control-label mb-1">Adresse</label>
                               <input id="slug" name="adresse" type="text" placeholder="Adresse ..." class="form-control" aria-required="true" aria-invalid="false">  
                            </div>
                           </div> 
                           <div class="form-group">
                                <label for="slug" class="control-label mb-1">Domaine d'intervention</label>
                                <select name="domaines" class="form-control" id="slug">
                                            <option value="">Choisir domaine</option>
                                          <?php
                                                foreach($domaines as $data){?>
                                                    
                                                 <option  value="<?=$data->id;?>" >
                                                 <?=$data->designation;?>
                                                 </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>
                                        
                            </div>


                                      

                                      <div class="row mt-2">
                            <div class="col-md-8 offset-md-2 form-group">
                            <button id="payment-button" type="submit"name="used" class="btn btn-lg btn-success btn-block" >
                                Ajouter usager
                            </button>
                        </div>
                    </div>
                </form>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 

                <!-- HELP_LINKS_START help links at the bottom -->
    <style>
        .asprise-footer, .asprise-footer a:visited { font-family: Arial, Helvetica, sans-serif; color: #999; font-size: 13px; }
        .asprise-footer a {  text-decoration: none; color: #999; }
        .asprise-footer a:hover {  padding-bottom: 2px; border-bottom: solid 1px #9cd; color: #06c; }
    </style>

                <?php
                 }else{
                    header("Location:/users/login");
                    exit;
        
    } ?>