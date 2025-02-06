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
<div class="card shadow mb-4">
    <div class="card-header py-3">
             <h1 class="m-0 font-weight-bold text-primary">AJOUTER UN EMPRUNT</h1>
    </div>
     <div class="card shadow mb-4" id="h1">
    <div class="card-header py-3">
      <h3 class="m-0 font-weight-bold text-primary">PIECE N° <?= $afficheFile->reference; ?></h3>
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Créateur : <i class="fas fa-user fa-sm text-white-50"></i> 
                <?=$afficheFile->nom." ".$afficheFile->prenom;?>
            </a>
          </div>
       </div>
       
       <div class="card-body">
       <div class="table-responsive">
<?php if ($afficheFile->id_types == 1 || $afficheFile->id_types == 3) {
    // CERTIFICATION DE NON HEBERGEMENT 
    // CERTIFICAT DE PREMIERE PRISE DE SERVICE
 ?>
<div class="row mt-2">
    <div class="col-md-4"><h3 style="color:red">Dossier : </h3><?=$afficheFile->dossier;?></div>
    <div class="col-md-4"><h3 style="color:red">Domaine : </h3><?=$afficheFile->designation;?></div>
    <div class="col-md-4"><h3 style="color:red">Typologie : </h3><?=$afficheFile->type;?></div>
    </div><hr/><?php if($afficheFile->type_usager==1){ ?>


<div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
    <div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } else{ ?>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Matricule : </h3><?=$afficheFile->matricule;?></div>
    <div class="col-md-4"><h3 style="color:red">Emploi : </h3><?=$afficheFile->fonction;?></div>
    </div><hr/>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Catégorie : </h3> <?= $afficheFile->grade;?></div>
    <div class="col-md-4"><h3 style="color:red">Date de prise de service : </h3> <?= $afficheFile->date_service;  ?></div>
    <div class="col-md-4"><h3 style="color:red">Etablissement : </h3> <?= $afficheFile->etablissement;  ?></div>
</div><hr/><?php } ?>
<div class="row mt2"><div class="col-md-4"><h3 style="color:red">Fait le : </h3><?= date('d-m-Y',strtotime($afficheFile->etabli));?></div></div>
<hr/>
<?php  } ?>

<?php if ($afficheFile->id_types == 2) {
    // ARRETE DE NOMMINATION
 ?>
<div class="row mt-2">
    <div class="col-md-4"><h3 style="color:red">Dossier : </h3><?=$afficheFile->dossier;?></div>
    <div class="col-md-4"><h3 style="color:red">Domaine : </h3><?=$afficheFile->designation;?></div>
    <div class="col-md-4"><h3 style="color:red">Typologie : </h3><?=$afficheFile->type;?></div>
    </div><hr/>
<div class="col-md-8"><h3 style="color:red">Libéllé : </h3><?=$afficheFile->libelle;?></div>
<hr/>
    <?php if($afficheFile->type_usager==1){ ?>
<div class="row mt2">

    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
    <div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } else{ ?>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Matricule : </h3><?=$afficheFile->matricule;?></div>
    <div class="col-md-4"><h3 style="color:red">Emploi : </h3><?=$afficheFile->fonction;?></div>
    </div><hr/>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Catégorie : </h3> <?= $afficheFile->grade;?></div>
    <div class="col-md-4"><h3 style="color:red">Date de prise de service : </h3> <?= $afficheFile->date_service;  ?></div>
    <div class="col-md-4"><h3 style="color:red">Etablissement : </h3> <?= $afficheFile->etablissement;  ?></div>
</div><hr/><?php } ?>
<div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Fait le : </h3><?= date('d-m-Y',strtotime($afficheFile->etabli));?></div>

</div>
<hr/>
<?php  } ?>

<?php if ($afficheFile->id_types == 4) {
    // ATTESTATION DE NON LOGEMENT
 ?>
<div class="row mt-2">
    <div class="col-md-4"><h3 style="color:red">Dossier : </h3><?=$afficheFile->dossier;?></div>
    <div class="col-md-4"><h3 style="color:red">Domaine : </h3><?=$afficheFile->designation;?></div>
    <div class="col-md-4"><h3 style="color:red">Typologie : </h3><?=$afficheFile->type;?></div>
</div><hr/>
<div class="col-md-8"><h3 style="color:red">Taux Indemnité : </h3><?=$afficheFile->tauxindem;?></div><hr/>
    <?php if($afficheFile->type_usager==1){ ?>

<div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
    <div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } else{ ?>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Matricule : </h3><?=$afficheFile->matricule;?></div>
    <div class="col-md-4"><h3 style="color:red">Emploi : </h3><?=$afficheFile->fonction;?></div>
    </div><hr/>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Catégorie : </h3> <?= $afficheFile->grade;?></div>
    <div class="col-md-4"><h3 style="color:red">Date de prise de service : </h3> <?= $afficheFile->date_service;  ?></div>
    <div class="col-md-4"><h3 style="color:red">Etablissement : </h3> <?= $afficheFile->etablissement;  ?></div>
</div><hr/><?php } ?>
<div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Fait le : </h3><?= date('d-m-Y',strtotime($afficheFile->etabli));?></div>

</div>
<hr/>
<?php  } ?>

<?php if ($afficheFile->id_types == 5 || $afficheFile->id_types == 6) {
    // BULLETIN DE SOLDE
 ?>
<div class="row mt-2">
    <div class="col-md-4"><h3 style="color:red">Dossier : </h3><?=$afficheFile->dossier;?></div>
    <div class="col-md-4"><h3 style="color:red">Domaine : </h3><?=$afficheFile->designation;?></div>
    <div class="col-md-4"><h3 style="color:red">Typologie : </h3><?=$afficheFile->type;?></div>
    </div><hr/>
<div class="row mt-2">
<div class="col-md-4"><h3 style="color:red">Intitulé : </h3><?=$afficheFile->libelle;?></div>
<div class="col-md-4"><h3 style="color:red">Gains : </h3><?=$afficheFile->gains;?></div>
<div class="col-md-4"><h3 style="color:red">Retenues : </h3><?=$afficheFile->retenues;?></div>
</div><hr/>
<div class="row mt-2">
<div class="col-md-4"><h3 style="color:red">Montant : </h3><?=$afficheFile->montant;?></div>
<div class="col-md-4"><h3 style="color:red">Solde : </h3><?=$afficheFile->compte;?></div>
<div class="col-md-4"><h3 style="color:red">Mode de reglement : </h3><?=$afficheFile->reglement;?></div>
</div><hr/>
    <?php if($afficheFile->type_usager==1){ ?>


<div class="row mt2">

    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
    <div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } else{ ?>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Matricule : </h3><?=$afficheFile->matricule;?></div>
    <div class="col-md-4"><h3 style="color:red">Emploi : </h3><?=$afficheFile->fonction;?></div>
    </div><hr/>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Catégorie : </h3> <?= $afficheFile->grade;?></div>
    <div class="col-md-4"><h3 style="color:red">Date de prise de service : </h3> <?= $afficheFile->date_service;  ?></div>
    <div class="col-md-4"><h3 style="color:red">Etablissement : </h3> <?= $afficheFile->etablissement;  ?></div>
</div><hr/><?php } ?>
<div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Fait le : </h3><?= date('d-m-Y',strtotime($afficheFile->etabli));?></div>

</div>
<hr/>
<?php  } ?>

<?php if ($afficheFile->id_types == 7) {
    // DECISION D'AFFECTATION DE LOGEMENT
 ?>
<div class="row mt-2">
    <div class="col-md-4"><h3 style="color:red">Dossier : </h3><?=$afficheFile->dossier;?></div>
    <div class="col-md-4"><h3 style="color:red">Domaine : </h3><?=$afficheFile->designation;?></div>
    <div class="col-md-4"><h3 style="color:red">Typologie : </h3><?=$afficheFile->type;?></div>
</div><hr/>
<div class="row mt-2">
<div class="col-md-4"><h3 style="color:red">Logement : </h3><?=$afficheFile->logement;?></div>
<div class="col-md-4"><h3 style="color:red">Log Groupe : </h3><?=$afficheFile->logroupe;?></div>
<div class="col-md-4"><h3 style="color:red">Pièce : </h3><?=$afficheFile->pieces;?></div>
</div><hr/>
<div class="row mt-2">
<div class="col-md-4"><h3 style="color:red">Montant : </h3><?=$afficheFile->montant;?></div>
<div class="col-md-4"><h3 style="color:red">Baille : </h3><?=$afficheFile->baille;?></div>
<!--<div class="col-md-4"><h3 style="color:red">Mode de reglement : </h3><?=$afficheFile->reglement;?></div>-->
</div><hr/>
    <?php if($afficheFile->type_usager==1){ ?>


<div class="row mt2">

    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
    <div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } else{ ?>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Matricule : </h3><?=$afficheFile->matricule;?></div>
    <div class="col-md-4"><h3 style="color:red">Emploi : </h3><?=$afficheFile->fonction;?></div>
    </div><hr/>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Catégorie : </h3> <?= $afficheFile->grade;?></div>
    <div class="col-md-4"><h3 style="color:red">Date de prise de service : </h3> <?= $afficheFile->date_service;  ?></div>
    <div class="col-md-4"><h3 style="color:red">Etablissement : </h3> <?= $afficheFile->etablissement;  ?></div>
</div><hr/><?php } ?>
<div class="row mt2">
    <!--<div class="col-md-4"><h3 style="color:red">Fait le : </h3><?= date('d-m-Y',strtotime($afficheFile->etabli));?></div>-->

</div>
<hr/>
<?php  } ?>

<?php if ($afficheFile->id_types == 8) {
    // ATTESTATION DE FIN DE PAIEMENT
 ?>
<div class="row mt-2">
    <div class="col-md-4"><h3 style="color:red">Dossier : </h3><?=$afficheFile->dossier;?></div>
    <div class="col-md-4"><h3 style="color:red">Domaine : </h3><?=$afficheFile->designation;?></div>
    <div class="col-md-4"><h3 style="color:red">Typologie : </h3><?=$afficheFile->type;?></div>
    <div class="col-md-8"><h3 style="color:red">Montant : </h3><?=$afficheFile->montant;?></div>
</div><hr/> <?php if($afficheFile->type_usager==1){ ?>


<div class="row mt2">

    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
    <div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } else{ ?>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Matricule : </h3><?=$afficheFile->matricule;?></div>
    <div class="col-md-4"><h3 style="color:red">Emploi : </h3><?=$afficheFile->fonction;?></div>
    </div><hr/>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Catégorie : </h3> <?= $afficheFile->grade;?></div>
    <div class="col-md-4"><h3 style="color:red">Date de prise de service : </h3> <?= $afficheFile->date_service;  ?></div>
    <div class="col-md-4"><h3 style="color:red">Etablissement : </h3> <?= $afficheFile->etablissement;  ?></div>
</div><hr/><?php } ?>
<div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Fait le : </h3><?= date('d-m-Y',strtotime($afficheFile->etabli));?></div>

</div>
<hr/>
<?php  } ?>

<?php if ($afficheFile->id_types == 9) {
    // SITUATION REGLEMENT ACQUEREUR
 ?>
<div class="row mt-2">
    <div class="col-md-4"><h3 style="color:red">Dossier : </h3><?=$afficheFile->dossier;?></div>
    <div class="col-md-4"><h3 style="color:red">Domaine : </h3><?=$afficheFile->designation;?></div>
    <div class="col-md-4"><h3 style="color:red">Typologie : </h3><?=$afficheFile->type;?></div>
</div><hr/>
    <div class="row mt-2">
<div class="col-md-4"><h3 style="color:red">Montant : </h3><?=$afficheFile->montant;?></div>
<div class="col-md-4"><h3 style="color:red">Decision : </h3><?=$afficheFile->decision;?></div>
<div class="col-md-4"><h3 style="color:red">Date de mise en vigueur : </h3><?=$afficheFile->pieces;?></div>
</div><hr/>
<div class="row mt-2">
<div class="col-md-3"><h3 style="color:red">Arriérés : </h3><?=$afficheFile->arriere;?></div>
<div class="col-md-3"><h3 style="color:red">Nombre P : </h3><?=$afficheFile->nbrep;?></div>
<div class="col-md-3"><h3 style="color:red">Expertise : </h3><?=$afficheFile->expertise;?></div>
<div class="col-md-3"><h3 style="color:red">Solde : </h3><?=$afficheFile->solde;?></div>
</div><hr/>
    <?php if($afficheFile->type_usager==1){ ?>




<div class="row mt2">

    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
    <div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } else{ ?>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Matricule : </h3><?=$afficheFile->matricule;?></div>
    <div class="col-md-4"><h3 style="color:red">Emploi : </h3><?=$afficheFile->fonction;?></div>
    </div><hr/>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Catégorie : </h3> <?= $afficheFile->grade;?></div>
    <div class="col-md-4"><h3 style="color:red">Date de prise de service : </h3> <?= $afficheFile->date_service;?></div>
    <div class="col-md-4"><h3 style="color:red">Etablissement : </h3> <?= $afficheFile->etablissement;  ?></div>
</div><hr/><?php } ?>
<div class="row mt2">
    <!--<div class="col-md-4"><h3 style="color:red">Fait le : </h3><?= date('d-m-Y',strtotime($afficheFile->etabli));?></div>-->

</div>
<hr/>
<?php  } ?>

<?php if ($afficheFile->id_types == 10 || $afficheFile->id_types == 12 || $afficheFile->id_types == 14 || $afficheFile->id_types == 15 || $afficheFile->id_types == 16) {
    // NOTE INTERNE
    // FICHE DE SORTIE DE FOURNITURE
    // PERSONNEL 
    // ATTESTATION
    //DECISION
 ?>
<div class="row mt-2">
    <div class="col-md-4"><h3 style="color:red">Dossier : </h3><?=$afficheFile->dossier;?></div>
    <div class="col-md-4"><h3 style="color:red">Domaine : </h3><?=$afficheFile->designation;?></div>
    <div class="col-md-4"><h3 style="color:red">Typologie : </h3><?=$afficheFile->type;?></div>
</div><hr/>
<div class="col-md-8"><h3 style="color:red">Libelle : </h3><?=$afficheFile->libelle;?></div>
<div class="col-md-10"><h3 style="color:red">Description : </h3><?=$afficheFile->description;?></div><hr/>
    <?php if($afficheFile->type_usager==1){ ?>

<div class="row mt2">

    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
    <div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } else{ ?>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Matricule : </h3><?=$afficheFile->matricule;?></div>
    <div class="col-md-4"><h3 style="color:red">Emploi : </h3><?=$afficheFile->fonction;?></div>
    </div><hr/>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Catégorie : </h3> <?= $afficheFile->grade;?></div>
    <div class="col-md-4"><h3 style="color:red">Date de prise de service : </h3> <?= $afficheFile->date_service;  ?></div>
    <div class="col-md-4"><h3 style="color:red">Etablissement : </h3> <?= $afficheFile->etablissement;  ?></div>
</div><hr/><?php } ?>
<div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Fait le : </h3><?= date('d-m-Y',strtotime($afficheFile->etabli));?></div>

</div>
<hr/>
<?php  } ?>


<?php if ($afficheFile->id_types == 11 || $afficheFile->id_types == 17 || $afficheFile->id_types == 21 ) {
    // FICHE DE PRESENCE
    // PROCURATION
    // ACTE D'INDIVIDUALITE
 ?>
<div class="row mt-2">
    <div class="col-md-4"><h3 style="color:red">Dossier : </h3><?=$afficheFile->dossier;?></div>
    <div class="col-md-4"><h3 style="color:red">Domaine : </h3><?=$afficheFile->designation;?></div>
    <div class="col-md-4"><h3 style="color:red">Typologie : </h3><?=$afficheFile->type;?></div>
</div><hr/>
<div class="col-md-10"><h3 style="color:red">Description : </h3><?=$afficheFile->description;?></div><hr/>
    <?php if($afficheFile->type_usager==1){ ?>

<div class="row mt2">

    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
    <div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } else{ ?>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Matricule : </h3><?=$afficheFile->matricule;?></div>
    <div class="col-md-4"><h3 style="color:red">Emploi : </h3><?=$afficheFile->fonction;?></div>
    </div><hr/>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Catégorie : </h3> <?= $afficheFile->grade;?></div>
    <div class="col-md-4"><h3 style="color:red">Date de prise de service : </h3> <?= $afficheFile->date_service;  ?></div>
    <div class="col-md-4"><h3 style="color:red">Etablissement : </h3> <?= $afficheFile->etablissement;  ?></div>
</div><hr/><?php } ?>
<div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Fait le : </h3><?= date('d-m-Y',strtotime($afficheFile->etabli));?></div>

</div><hr/>
<hr/>
<?php  } ?>
<?php if ($afficheFile->id_types == 13) {
    // ORDRE DE MISSION
 ?>
<div class="row mt-2">
    <div class="col-md-4"><h3 style="color:red">Dossier : </h3><?=$afficheFile->dossier;?></div>
    <div class="col-md-4"><h3 style="color:red">Domaine : </h3><?=$afficheFile->designation;?></div>
    <div class="col-md-4"><h3 style="color:red">Typologie : </h3><?=$afficheFile->type;?></div>
</div><hr/>
<div class="col-md-4"><h3 style="color:red">Objet de mission : </h3><?=$afficheFile->description;?></div><hr/>
<div class="row mt-2">

<div class="col-md-4"><h3 style="color:red">Date depart : </h3><?= date('d-m-Y',strtotime($afficheFile->effet));?></div>
<div class="col-md-4"><h3 style="color:red">Date de retour : </h3><?= date('d-m-Y',strtotime($afficheFile->retour));?></div>
<div class="col-md-3"><h3 style="color:red">Imputation : </h3><?=$afficheFile->imputation;?></div>
</div><hr/>

    <?php if($afficheFile->type_usager==1){ ?>




<div class="row mt2">

    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
    <div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } else{ ?>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Matricule : </h3><?=$afficheFile->matricule;?></div>
    <div class="col-md-4"><h3 style="color:red">Emploi : </h3><?=$afficheFile->fonction;?></div>
    </div><hr/>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Catégorie : </h3> <?= $afficheFile->grade;?></div>
    <div class="col-md-4"><h3 style="color:red">Date de prise de service : </h3> <?= $afficheFile->date_service;?></div>
    <div class="col-md-4"><h3 style="color:red">Etablissement : </h3> <?= $afficheFile->etablissement;  ?></div>
</div><hr/><?php } ?>
<div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Fait le : </h3><?= date('d-m-Y',strtotime($afficheFile->etabli));?></div>

</div>
<hr/>
<?php  } ?>

<?php if ($afficheFile->id_types == 18) {
    // RIB
 ?>
<div class="row mt-2">
    <div class="col-md-4"><h3 style="color:red">Dossier : </h3><?=$afficheFile->dossier;?></div>
    <div class="col-md-4"><h3 style="color:red">Domaine : </h3><?=$afficheFile->designation;?></div>
    <div class="col-md-4"><h3 style="color:red">Typologie : </h3><?=$afficheFile->type;?></div>
</div><hr/>
<div class="row mt-2">
<div class="col-md-4"><h3 style="color:red">Code Banque : </h3><?= $afficheFile->codebanque;?></div>
<div class="col-md-4"><h3 style="color:red">Code Guichet : </h3><?= $afficheFile->codeguichet;?></div>
<div class="col-md-4"><h3 style="color:red">Clé RIB : </h3><?= $afficheFile->rib;?></div>
</div><hr/>
<div class="row mt-2">
<div class="col-md-4"><h3 style="color:red">Domociliation : </h3><?=$afficheFile->domiciliation;?></div>
<div class="col-md-6"><h3 style="color:red">N° de Compte : </h3><?= $afficheFile->compte;?></div>

</div><hr/>

    <?php if($afficheFile->type_usager==1){ ?>




<div class="row mt2">

    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
    <div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } else{ ?>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Matricule : </h3><?=$afficheFile->matricule;?></div>
    <div class="col-md-4"><h3 style="color:red">Emploi : </h3><?=$afficheFile->fonction;?></div>
    </div><hr/>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Catégorie : </h3> <?= $afficheFile->grade;?></div>
    <div class="col-md-4"><h3 style="color:red">Date de prise de service : </h3> <?= $afficheFile->date_service;?></div>
    <div class="col-md-4"><h3 style="color:red">Etablissement : </h3> <?= $afficheFile->etablissement;  ?></div>
</div><?php } ?>
<div class="row mt2">
    <!--<div class="col-md-4"><h3 style="color:red">Fait le : </h3><?= date('d-m-Y',strtotime($afficheFile->etabli));?></div>-->

</div>
<hr/>
<?php  } ?>

<?php if ($afficheFile->id_types == 19) {
    // AVENANTS
 ?>
<div class="row mt-2">
    <div class="col-md-4"><h3 style="color:red">Dossier : </h3><?=$afficheFile->dossier;?></div>
    <div class="col-md-4"><h3 style="color:red">Domaine : </h3><?=$afficheFile->designation;?></div>
    <div class="col-md-4"><h3 style="color:red">Typologie : </h3><?=$afficheFile->type;?></div>
</div><hr/>
<div class="row mt-2">
<div class="col-md-4"><h3 style="color:red">Intitulé : </h3><?=$afficheFile->libelle;?></div>
<div class="col-md-8"><h3 style="color:red">description : </h3><?= $afficheFile->description;?></div>

</div><hr/>

<div class="row mt-2">
<div class="col-md-4"><h3 style="color:red">Date effet : </h3><?=date('d-m-Y',strtotime($afficheFile->effet));?></div>
<div class="col-md-4"><h3 style="color:red">Durée : </h3><?= $afficheFile->duree;?></div>

</div><hr/>

    <?php if($afficheFile->type_usager==1){ ?>




<div class="row mt2">

    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
    <div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } else{ ?>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Matricule : </h3><?=$afficheFile->matricule;?></div>
    <div class="col-md-4"><h3 style="color:red">Emploi : </h3><?=$afficheFile->fonction;?></div>
    </div><hr/>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Catégorie : </h3> <?= $afficheFile->grade;?></div>
    <div class="col-md-4"><h3 style="color:red">Date de prise de service : </h3> <?= $afficheFile->date_service;?></div>
    <div class="col-md-4"><h3 style="color:red">Etablissement : </h3> <?= $afficheFile->etablissement;  ?></div>
</div><?php } ?>
<div class="row mt2">
    <!--<div class="col-md-4"><h3 style="color:red">Fait le : </h3><?= date('d-m-Y',strtotime($afficheFile->etabli));?></div>-->

</div>
<hr/>
<?php  } ?>

<?php if ($afficheFile->id_types == 20) {
    // CONTRAT DE BAILLE
 ?>
<div class="row mt-2">
    <div class="col-md-4"><h3 style="color:red">Dossier : </h3><?=$afficheFile->dossier;?></div>
    <div class="col-md-4"><h3 style="color:red">Domaine : </h3><?=$afficheFile->designation;?></div>
    <div class="col-md-4"><h3 style="color:red">Typologie : </h3><?=$afficheFile->type;?></div>
</div><hr/>
<div class="row mt-2">
<div class="col-md-4"><h3 style="color:red">Intitulé : </h3><?=$afficheFile->libelle;?></div>
<div class="col-md-6"><h3 style="color:red">Description : </h3><?= $afficheFile->description;?></div>

</div><hr/>
<div class="row mt-2">
<div class="col-md-4"><h3 style="color:red">Mise en vigueur : </h3><?= date('d-m-Y',strtotime($afficheFile->effet));?></div>
<div class="col-md-4"><h3 style="color:red">Durée : </h3><?= $afficheFile->duree;?></div>
<div class="col-md-4"><h3 style="color:red">Ville : </h3><?= $afficheFile->ville;?></div>
</div><hr/>
<div class="row mt-2">
<div class="col-md-4"><h3 style="color:red">N° Compte : </h3><?= $afficheFile->compte;?></div>
<div class="col-md-4"><h3 style="color:red">Mode de reglement : </h3><?= $afficheFile->reglement;?></div>
<div class="col-md-4"><h3 style="color:red">Montant : </h3><?= $afficheFile->Montant;?></div>
</div><hr/>

    <?php if($afficheFile->type_usager==1){ ?>




<div class="row mt2">

    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
    <div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } else{ ?>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
    <div class="col-md-4"><h3 style="color:red">Matricule : </h3><?=$afficheFile->matricule;?></div>
    <div class="col-md-4"><h3 style="color:red">Emploi : </h3><?=$afficheFile->fonction;?></div>
    </div><hr/>
    <div class="row mt2">
    <div class="col-md-4"><h3 style="color:red">Catégorie : </h3> <?= $afficheFile->grade;?></div>
    <div class="col-md-4"><h3 style="color:red">Date de prise de service : </h3> <?= $afficheFile->date_service;?></div>
    <div class="col-md-4"><h3 style="color:red">Etablissement : </h3> <?= $afficheFile->etablissement;  ?></div>
</div><?php } ?>
<div class="row mt2">
    <!--<div class="col-md-4"><h3 style="color:red">Fait le : </h3><?= date('d-m-Y',strtotime($afficheFile->etabli));?></div>-->

</div>

<hr/>
<?php  } ?>

<h3 style="color:red">FICHIER(S) : </h3>

<div class="row mt-3">
       <div class="col-md-10 offset-md-1">
       <div class="card-body">
       <div class="table-responsive">
    <table class="table table-bordered table-striped" id="dataTable1" width="" cellspacing="0"  data-order="[[ 1, &quot;desc&quot; ]]">
<thead>
        <tr>
        <th>Fichier</th>
        <th>type</th>   
        <th>Créé le</th>    
        <th>Modifié le</th> 
        <th width="13%">Action</th>
    
        </tr>
</thead>
    <tbody>
        <?php ?>
        <?php foreach ($affiche as $files ): ?>


            <tr>
                <td><?=$files->fichier;?></td>
                <td><?=$files->type?></td>
                <td><?= $files->date_creation;?></td>
                <td><?= $files->update_at;?></td>
                <td width="5%">
            
                 
                    <a class="btn btn-primary" title="Voir le fichier" href="/archives/<?= $files->designation."/".$files->typ."/".$files->dossier."/".$files->fichier;?>" target="_blank">
                <?php
                if($files->type == 'jpg' || $files->type == 'jpeg' || $files->type == 'png' || $files->type == 'gif' || $files->type == 'swf'){
                    echo'<i class="fa fa-file-picture-o fa-2x"></i>';
                }elseif ($files->type == 'docx' || $files->type == 'doc') {
                    // code...
                    echo'<i class="fa fa-file-word-o fa-2x"></i>';
                }elseif($files->type == 'pdf'){
                    echo'<i class="fa fa-file-pdf-o fa-2x"></i>';
                }elseif ($files->type == 'xlsx' || $files->type == 'xls' || $files->type == 'xlsm') {
                    // code...
                    echo'<i class="fa fa-file-excel-o fa-2x"></i>';
                }elseif ($files->type == 'pptx' || $files->type == 'ppt') {
                    // code...
                    echo'<i class="fa fa-file-powerpoint-o fa-2x"></i>';
                }elseif ($files->type == 'mp3' || $files->type == 'amr') {
                    // code...
                    echo'<i class="fa fa-file-sound-o fa-2x"></i>';
                }elseif ($files->type == 'mpeg' || $files->type == 'mp4' || $files->type == 'avi' || $files->type == 'flv') {
                    // code...
                    echo'<i class="fas fa-file-video-o fa-2x"></i>';
                }elseif ($files->type == 'zip' || $files->type == 'rar') {
                    // code...
                    echo'<i class="fas fa-file-archive-o fa-2x"></i>';
                }else{
                    echo'<i class="fa fa-file fa-2x"></i>';
                }

                    
                 ?></a>
               
                </td>
            </tr>
            <?php 
            
            
            if(isset($_GET['name'])){
                $file = $_GET['name'];

                $db = Db::getInstance()->prepare('UPDATE fichiers SET actif=? WHERE id_doc=? AND fichier=?');
                $db->execute([0,$affiches->id_doc,$file]);
                
                Form::setFlash('success','Un Fichier a été supprimé');
                header("Location: /documents/mes_documents");
                exit;
                
                                
                                    }
 ?>
        <?php endforeach; ?>
        
        
    </tbody>

</table>
</div></div>
</div>
</div>
   </div>

        <div class="row m-t-30">
            <div class="col-md-12">

            <div class="row">
                <div class="col-lg-12">
                <form action="" method="post" enctype="multipart/form-data">

                              <div class="row">
                                  
                              <input type="hidden" value="<?= $afficheFile->id;?>" name="entree">

                           <div class="form-group col-md-8">    
                                    <label for="category_id" class="control-label mb-1">Demandeur</label>
                                    <select id="category_id" name="user" class="form-control" aria-required="true" aria-invalid="false" required>
                                        <option value="">Choisir utilisateur</option>
                                        
                                          <?php


                                                foreach($users as $user){?>
                                                 <option value="<?=$user->id;?>"><?= $user->matricule." - ".strtoupper($user->nom)." ".strtoupper($user->prenom);?></option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>    
                            </div>
                             <div class="form-group col-md-4">
                                    <label for="slug" class="control-label mb-1">Date D'Emprunt</label>
                                    
                                    <input id="slug" name="datemprunt" type="datetime-local" class="form-control" aria-required="true" aria-invalid="false" required>                        
                                </div>
                              </div>       

                                       <div class="row mt-2">
                            <div class="col-md-8 offset-md-2 form-group">
                            <button id="payment-button" type="submit" class="btn btn-lg btn-primary btn-block" >
                                Valider Emprunt
                            </button>
                        </div>
                    </div>
                            </form>
                        </div>
                    </div>
               
              </div>

            </div>
          </div>
        </div>




</div>
 <?php
                 }else{
                    header("Location:/users/login");
                    exit;
        
    } ?>