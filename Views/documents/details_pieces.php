<?php 
 
if(isset($_SESSION['user'])){
    
   ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <a href="<?= $_SERVER['HTTP_REFERER']; ?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Retour</a>
          </div>
<div class="card shadow mb-4" id="h1">
    <div class="card-header py-3">
      <h1 class="m-0 font-weight-bold text-primary">DETAILS PIECE N° <?= $afficheFile->reference; ?></h1>
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Créateur : <i class="fas fa-user fa-sm text-white-50"></i> 
            	<?=$afficheFile->nom." ".$afficheFile->prenom;?>
            </a>
          </div>
       </div>
       
       <div class="card-body">
       <div class="table-responsive">
       	<?php if($afficheFile->numero!=''): ?>
<div class="row mt-2">
	<div class="col-md-6 offset-md-4"><h3 style="color:red">Numéro : <?=$afficheFile->numero;?></h3></div>
</div><hr/>
       	<?php endif; ?>
<?php if ($afficheFile->id_types == 1 || $afficheFile->id_types == 3) {
	// CERTIFICATION DE NON HEBERGEMENT 
	// CERTIFICAT DE PREMIERE PRISE DE SERVICE
 ?>
<div class="row mt-2">
	<div class="col-md-4"><h3 style="color:red">Dossier : </h3><?=$afficheFile->dossier;?></div>
	<div class="col-md-4"><h3 style="color:red">Domaine : </h3><?=$afficheFile->designation;?></div>
	<div class="col-md-4"><h3 style="color:red">Typologie : </h3><?=$afficheFile->type;?></div>
	</div><hr/><?php if($afficheFile->type_usager==1 && $afficheFile->cases==1){ ?>


<div class="row mt2">
	<div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager==''?'NEANT':$afficheFile->usager;?></div>
	<div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact==''?'NEANT':$afficheFile->contact;?></div>
	<div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse==''?'NEANT':$afficheFile->adresse;?></div>
</div><hr/><?php } elseif($afficheFile->type_usager==2 && $afficheFile->cases==1){ ?>
    <div class="row mt2">
	<div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager==''?'NEANT':$afficheFile->usager;?></div>
	<div class="col-md-4"><h3 style="color:red">Matricule : </h3><?=$afficheFile->matricule==''?'NEANT':$afficheFile->matricule;?></div>
	<div class="col-md-4"><h3 style="color:red">Emploi : </h3><?=$afficheFile->fonction==''?'NEANT':$afficheFile->fonction;?></div>
	</div><hr/>
 	<div class="row mt2">
	<div class="col-md-4"><h3 style="color:red">Catégorie : </h3> <?= $afficheFile->grade==''?'NEANT':$afficheFile->grade;?></div>
	<div class="col-md-4"><h3 style="color:red">Date de prise de service : </h3> <?= $afficheFile->date_service==''?'NEANT':$afficheFile->date_service;  ?></div>
	<div class="col-md-4"><h3 style="color:red">Etablissement : </h3> <?= $afficheFile->etablissement==''?'NEANT':$afficheFile->etablissement;  ?></div>
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
	<?php if($afficheFile->type_usager==1 && $afficheFile->cases==1){ ?>
<div class="row mt2">

	<div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
	<div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
	<div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } elseif($afficheFile->type_usager==2 && $afficheFile->cases==1){ ?>
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
	<?php if($afficheFile->type_usager==1 && $afficheFile->cases==1){ ?>

<div class="row mt2">
	<div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
	<div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
	<div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } elseif($afficheFile->type_usager==2 && $afficheFile->cases==1){ ?>
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
<div class="col-md-3"><h3 style="color:red">Montant : </h3><?=$afficheFile->montant;?></div>
<div class="col-md-3"><h3 style="color:red">Solde : </h3><?=$afficheFile->compte;?></div>
<div class="col-md-3"><h3 style="color:red">Mode de reglement : </h3><?=$afficheFile->reglement;?></div>
<div class="col-md-3"><h3 style="color:red">Banque : </h3><?=$afficheFile->domiciliation;?></div>
</div><hr/>
	<?php if($afficheFile->type_usager==1 && $afficheFile->cases==1){ ?>


<div class="row mt2">

	<div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
	<div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
	<div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } elseif($afficheFile->type_usager==2 && $afficheFile->cases==1){ ?>
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
	<?php if($afficheFile->type_usager==1 && $afficheFile->cases==1){ ?>


<div class="row mt2">

	<div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
	<div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
	<div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } elseif($afficheFile->type_usager==2 && $afficheFile->cases==1){ ?>
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
</div><hr/>	<?php if($afficheFile->type_usager==1 && $afficheFile->cases==1){ ?>


<div class="row mt2">

	<div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
	<div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
	<div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } elseif($afficheFile->type_usager==2 && $afficheFile->cases==1){ ?>
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
	<?php if($afficheFile->type_usager==1 && $afficheFile->cases==1){ ?>




<div class="row mt2">

	<div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
	<div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
	<div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } elseif($afficheFile->type_usager==2 && $afficheFile->cases==1){ ?>
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
<div class="row mt-2">
<div class="col-md-6"><h3 style="color:red">Libelle : </h3><?=$afficheFile->libelle;?></div>
<div class="col-md-6"><h3 style="color:red">Description : </h3><?=$afficheFile->description;?></div>
</div>
<hr/>
	<?php if($afficheFile->type_usager==1 && $afficheFile->cases==1){ ?>

<div class="row mt2">

	<div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
	<div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
	<div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } elseif($afficheFile->type_usager==2 && $afficheFile->cases==1){ ?>
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
<?php if ($afficheFile->id_types == 22 || $afficheFile->id_types == 23) {
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
<div class="row mt-2">
<div class="col-md-6"><h3 style="color:red">Objet : </h3><?=$afficheFile->libelle;?></div>
<div class="col-md-6"><h3 style="color:red">Description : </h3><?=$afficheFile->description;?></div>
</div>
<hr/>
	<?php if($afficheFile->type_usager==1 && $afficheFile->cases==1){ ?>

<div class="row mt2">

	<div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
	<div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
	<div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } elseif($afficheFile->type_usager==2 && $afficheFile->cases==1){ ?>
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
<div class="col-md-10"><h3 style="color:red; text-align: center;">Description : </h3><?=$afficheFile->description;?></div><hr/>
	<?php if($afficheFile->type_usager==1 && $afficheFile->cases==1){ ?>

<div class="row mt2">

	<div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
	<div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
	<div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } elseif($afficheFile->type_usager==2 && $afficheFile->cases==1){ ?>
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

	<?php if($afficheFile->type_usager==1 && $afficheFile->cases==1){ ?>




<div class="row mt2">

	<div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
	<div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
	<div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } elseif($afficheFile->type_usager==2 && $afficheFile->cases==1){ ?>
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

	<?php if($afficheFile->type_usager==1 && $afficheFile->cases==1){ ?>




<div class="row mt2">

	<div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
	<div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
	<div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } elseif($afficheFile->type_usager==2 && $afficheFile->cases==1){ ?>
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
<div class="col-md-6"><h3 style="color:red">Intitulé : </h3><?=$afficheFile->libelle;?></div>
<div class="col-md-6"><h3 style="color:red">description : </h3><?= $afficheFile->description;?></div>

</div><hr/>

<div class="row mt-2">
<div class="col-md-4"><h3 style="color:red">Date effet : </h3><?=date('d-m-Y',strtotime($afficheFile->effet));?></div>
<div class="col-md-4"><h3 style="color:red">Durée : </h3><?= $afficheFile->duree;?></div>
<div class="col-md-4"><h3 style="color:red">Statut Contrat : </h3><?= $afficheFile->contrat;?></div>

</div><hr/>

	<?php if($afficheFile->type_usager==1 && $afficheFile->cases==1){ ?>




<div class="row mt2">

	<div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
	<div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
	<div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } elseif($afficheFile->type_usager==2 && $afficheFile->cases==1){ ?>
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
<div class="col-md-6"><h3 style="color:red">Intitulé : </h3><?=$afficheFile->libelle;?></div>
<div class="col-md-6"><h3 style="color:red">Description : </h3><?= $afficheFile->description;?></div>

</div><hr/>
<div class="row mt-2">
<div class="col-md-3"><h3 style="color:red">Mise en vigueur : </h3><?= date('d-m-Y',strtotime($afficheFile->effet));?></div>
<div class="col-md-3"><h3 style="color:red">Durée : </h3><?= $afficheFile->duree;?></div>
<div class="col-md-3"><h3 style="color:red">Ville : </h3><?= $afficheFile->ville;?></div>
<div class="col-md-3"><h3 style="color:red">Statut Contrat : </h3><?= $afficheFile->contrat;?></div>
</div><hr/>
<div class="row mt-2">
<div class="col-md-3"><h3 style="color:red">N° Compte : </h3><?= $afficheFile->compte;?></div>
<div class="col-md-3"><h3 style="color:red">Mode de reglement : </h3><?= $afficheFile->reglement;?></div>
<div class="col-md-3"><h3 style="color:red">Banque : </h3><?= $afficheFile->domiciliation;?></div>
<div class="col-md-3"><h3 style="color:red">Montant : </h3><?= $afficheFile->montant;?></div>
</div><hr/>

	<?php if($afficheFile->type_usager==1 && $afficheFile->cases==1){ ?>




<div class="row mt2">

	<div class="col-md-4"><h3 style="color:red">Usager : </h3><?=$afficheFile->usager;?></div>
	<div class="col-md-4"><h3 style="color:red">Contact : </h3><?=$afficheFile->contact;?></div>
	<div class="col-md-4"><h3 style="color:red">Adresse : </h3><?=$afficheFile->adresse;?></div>
</div><hr/><?php } elseif($afficheFile->type_usager==2 && $afficheFile->cases==1){ ?>
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
			
				<div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" target="_blank">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Actions:</div>
                      	<?php if(isset($_SESSION['user']) && ($_SESSION['user']['roles'] =='ROLE_ADMIN' || $_SESSION['user']['roles'] =='ROLE_SUPERUSER')){?>
                    <div class="dropdown-item" style="text-center">  
					<a class="btn btn-primary" title="Voir la pièce" href="/archives/<?= $files->designation."/".$files->typ."/".$files->dossier."/".$files->fichier;?>"  target="_blank">
				<?php
				if($files->type == 'jpg' || $files->type == 'jpeg' || $files->type == 'png' || $files->type == 'gif' || $files->type == 'swf'){
					echo'<i class="fa fa-file-picture-o"></i>';
				}elseif ($files->type == 'docx' || $files->type == 'doc') {
					// code...
					echo'<i class="fa fa-file-word-o"></i>';
				}elseif($files->type == 'pdf'){
					echo'<i class="fa fa-file-pdf-o"></i>';
				}elseif ($files->type == 'xlsx' || $files->type == 'xls' || $files->type == 'xlsm') {
					// code...
					echo'<i class="fa fa-file-excel-o"></i>';
				}elseif ($files->type == 'pptx' || $files->type == 'ppt') {
					// code...
					echo'<i class="fa fa-file-powerpoint-o"></i>';
				}elseif ($files->type == 'mp3' || $files->type == 'amr') {
					// code...
					echo'<i class="fa fa-file-sound-o"></i>';
				}elseif ($files->type == 'mpeg' || $files->type == 'mp4' || $files->type == 'avi' || $files->type == 'flv') {
					// code...
					echo'<i class="fas fa-file-video-o"></i>';
				}elseif ($files->type == 'zip' || $files->type == 'rar') {
					// code...
					echo'<i class="fas fa-file-archive-o"></i>';
				}else{
					echo'<i class="fa fa-file"></i>';
				}

					
				 ?></a>
				</div><?php } ?>
				
<?php $tab=array('doc','docx','html','php','rar','zip','csv','xls','xlsx','mp4','mp3','flv','3gp','mpeg','amr','avi','accdb');				
 if(!in_array($files->type,$tab)){
				  ?>
				
					<?php if($files->type == "pdf"){ ?>
						<?php //$_SESSION['fichier_id']=$files->id; ?>
						<div class="dropdown-item">
<a href="/documents/imprimer/<?=$files->id?>" class="btn btn-info" onclick="javascript:imprime_bloc('titre','imprime_moi');" target="_blank" title="Voir la pièce"  target="_blank">
	<i class="fa fa-print"></i>
</a>
</div>
<div class="dropdown-item">
<a href="/documents/supp_fichiers/<?=$files->id?>"  title="Supprimer le fichier" class="btn btn-danger"  target="_blank">
						<i class="fas fa-trash fa-1x"></i> </a>
</div>
<?php }elseif($files->type == "png" || $files->type == "jpeg" || $files->type == "jpg" || $files->type == "gif") {  //$_SESSION['fichier_id']=$files->id;?>
	<div class="dropdown-item">
		<a href="/documents/imprime/<?=$files->id?>" class="btn btn-info" onclick="javascript:imprime_bloc('titre','imprime_moi');" target="_blank" title="Voir la pièce">
	<i class="fa fa-print"></i></a>
</div>
	<div class="dropdown-item">	<?php if(isset($_SESSION['user']) && $_SESSION['user']['roles'] =='ROLE_ADMIN'){?>
			<a href="/documents/supp_fichiers/<?=$files->id?>"  title="Supprimer le fichier" class="btn btn-danger"  target="_blank">
						<i class="fas fa-trash fa-1x"></i>
					</a><?php } ?>
<?php } ?>
				 </div> 
				<!--<div class="dropdown-item"> 
				<a href="/documents/signatures/<?=$files->id?>"  title="signer le fichier" class="btn btn-success">
						<i class="fas fa-sign-out-alt fa-1x"></i>
					</a></div>-->
				<?php } ?>
				<!--
                      <div class="dropdown-item"><a href="/documents/supp_fichiers/<?=$files->id?>"  title="Supprimer le fichier" class="btn btn-danger">
						<i class="fas fa-trash fa-1x"></i>
					</a></div>
				-->
                      
                    
                  </div>




				
				 
				 <!--<input type="button" id="btnPrint" value="Print" />

				 <a href="" onclick="window.print()" class="btn btn-info"><i class="fa fa-print"></i></a>
				 
				  <button type="button" class="btn btn-info" onclick="Myprint()" value=""><i class="fa fa-print"></i> </button>
				 -->
				
				<!--	
				</td>-->
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
       </div>
   </div>
</div>
<?php }else{
	header("Location:/users/login");
} ?>