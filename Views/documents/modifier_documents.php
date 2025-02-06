 <?php 
use App\Core\Form; 
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user']['id']) && ($_SESSION['user']['roles']=='ROLE_ADMIN' || $_SESSION['user']['roles']=='ROLE_SUPERUSER') ){
 

    $query ="SELECT * FROM contrats ORDER BY contrat asc";
    $result = Db::getInstance()->query($query);
    $contrats = $result->fetchAll(PDO::FETCH_OBJ);

 
//var_dump($docs);
   ?>


<div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">MODIFIER UN DOCUMENT</h1>
                  </div>
                 
                 
<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <a href="<?= $_SERVER['HTTP_REFERER']; ?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Retour</a>
          </div>
    <div class="row m-t-30">
        <div class="col-md-12">

            <div class="row">
                <div class="col-lg-12">
                    <form id="form1" action="" method="post" enctype="multipart/form-data"target="">

                    <div class="card">
                        <div class="card-body">

                                 <div class="form-group">
                                    <label for="name" class="control-label mb-1">Référence Pièce : <?= $docs->reference; ?> </label>
                                    <input id="name" name="reference" value="<?= $docs->reference; ?>" type="hidden" class="form-control" aria-required="true" aria-invalid="false" >
                                </div>
                                <div class="form-group">
                                    <label for="name" class="control-label mb-1">Numéro : </label>
                                    <input id="name" name="numero" value="<?= $docs->numero; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                </div>



                                   

                                <div class="form-group">    
                                    <label for="category_id" class="control-label  mb-1">Domaine</label>
                                    <select id="category_id" name="domaine" class="form-control single" aria-required="true" aria-invalid="false">
                                        <option value="">Choisir le domaine</option>
                                        
                                          <?php


                                                foreach($categories as $categorie){?>
                                                    <?php if($categorie->id==$docs->id_cat):?>
                                                <option selected="selected" value="<?= $categorie->id; ?>">

                                                    <?php else: ?>
                                                <option value="<?= $categorie->id; ?>">
                                                <?php endif; ?>
                                                    <?=$categorie->designation;?>
                                                        
                                                    </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>    
                                    </div>



                                    <div class="form-group">    
                                    <label for="category_id" class="control-label mb-1">Typologie</label>
                                    <select id="category_id" name="types" class="form-control single" aria-required="true" aria-invalid="false" required>
                                        <option value="">Choisir Type</option>
                                        
                                          <?php


                                                foreach($types as $type){?>
                                                    <?php if($type->id==$docs->id_types):?>
                                                <option selected="selected" value="<?= $type->id; ?>">

                                                    <?php else: ?>
                                                <option value="<?= $type->id; ?>">
                                                <?php endif; ?>
                                                    <?=$type->type;?>
                                                        
                                                    </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>    
                                    </div>

                                <div class="form-group">
                                    <label for="serv" class="control-label mb-1">Dossier</label>
                                        <select name="dossier" class="form-control single" id="serv">
                                            <option value="">Choisir le service</option>
                                          <?php
                                                foreach($dossiers as $doss){?>
                                                    <?php if($doss->id==$docs->id_dos): ?>
                                                 <option selected="selected" value="<?= $doss->id; ?>" >
                                                     <?php else: ?>
                                                <option value="<?= $doss->id; ?>">
                                                <?php endif; ?>
                                                <?=$doss->dossier;?> 
                                                 </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>                                    
                                      </div>

<!--  DEBUT OPTION TYPE  --><?php if($docs->id_types == 4){ ?>

                                <div id="">
                                        <!-- ATTESTATION DE NON LOGEMENT  -->
                                <div class="row">
                                    
                                    <div class="col-md-4 form-group">
                                    <label for="idem" class="control-label mb-1">Taux d'indemnité </label>
                                    <input id="idem" name="indemnite" value="<?= $docs->tauxindem; ?>" placeholder="Entrer taux d'indemnité" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                   </div>
                                   <div class="col-md-4 form-group">
                                    <label for="etb" class="control-label mb-1">Etabli le </label>
                                    <input id="name" name="etabli4" value="<?= $docs->etabli; ?>" placeholder="Date d'edition" type="date" class="form-control" aria-required="true" aria-invalid="false">
                                   </div>
                               </div>

                                </div>
                            <?php }elseif($docs->id_types == 1 || $docs->id_types == 3){ ?>
                                <div id="">
                                        <!-- CERTIFICAT DE NON HEBERGEMENT  -->
                                         <!-- CERTIFICAT DE PREMIERE PRISE DE SERVICE  -->

                                    
                                   <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Etabli le </label>
                                    <input id="name" name="etabli1" value="<?= $docs->etabli; ?>" placeholder="Date d'edition" type="date" class="form-control" aria-required="true" aria-invalid="false">
                                   </div>

                                </div>
                              <?php } elseif($docs->id_types == 2){?>
                                <div id="">
                                     <!-- ARRETE DE NOMMINATION  -->

                                    <div class="form-group">
                                    <label for="name" class="control-label mb-1">Libellé</label>
                                    <input id="name" name="libelle2" value="<?= $docs->libelle; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                   <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Etabli le </label>
                                    <input id="name" name="etabli2" value="<?= $docs->etabli; ?>" placeholder="Date d'edition" type="date" class="form-control" aria-required="true" aria-invalid="false">
                                   </div>

                                </div>
                            <?php }elseif($docs->id_types == 5 || $docs->id_types == 6){ ?>
                                  <div id="">
                                     <!-- BULLETIN DE SOLDE -->
                                <div class="row"> 

                               
                                <div class="col-md-6 form-group">
                                    <label for="name" class="control-label mb-1">Intitulé</label>
                                    <input id="name" name="libelle5" value="<?= $docs->libelle; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col-md-4 form-group">
                                    <label for="gains" class="control-label mb-1">Gains</label>
                                    <input id="gains" name="gains" value="<?= $docs->gains; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                    </div>
                                    <div class="col-md-4 form-group">
                                    <label for="retenue" class="control-label mb-1">Retenues</label>
                                    <input id="retenue" name="retenues" value="<?= $docs->retenues; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                   <div class="col-md-4 form-group">
                                    <label for="montant" class="control-label mb-1">Montant net</label>
                                    <input id="montant" name="montant5" value=<?= $docs->montant; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col-md-4 form-group">
                                    <label for="regle" class="control-label mb-1">Mode de reglement</label>
                                    <input id="montant" name="reglement5" value="<?= $docs->reglement; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="compte" class="control-label mb-1">Numero Compte</label>
                                    <input id="compte" name="compte5" value="<?= $docs->compte; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                   <div class="col-md-4 form-group">
                                    <label for="etb" class="control-label mb-1">Domiciliation </label>
                                    <input id="name" name="domicile5" value="<?= $docs->domiciliation; ?>" placeholder="Banque" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                   </div>
                                   
                                    </div>
                                      <div class="col-md-4 form-group">
                                        <label for="etb" class="control-label mb-1">Etabli le </label>
                                        <input id="name" name="etabli5" value="<?= $docs->etabli; ?>" placeholder="Date d'edition" type="date" class="form-control" aria-required="true" aria-invalid="false">
                                    </div>
                                </div>
                                <?php }elseif($docs->id_types == 8){ ?>

                                  <div id="">
                                        <div class="row">                   <!-- ATTESTATION DE FIN DE PAIEMENT -->
                                   
                                   <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Montant</label>
                                    <input id="name" name="montant8" value="<?= $docs->montant; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                   <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date Paiement</label>
                                    <input id="name" name="etabli8" value="<?= $docs->etabli; ?>" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                               </div>
                                 </div>
                             <?php }elseif($docs->id_types == 9){ ?>

                                  <div id="">
                                       <div class="row">                      <!-- SITUATION DES REGLEMENTS ACQUEREUR -->
                                   
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">N° Décision</label>
                                    <input id="name" name="decision9" value="<?= $docs->decision; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date Décision</label>
                                    <input id="name" name="datedecision" value="<?= $docs->effet; ?>" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                      </div>
                                      <div class="row">
                                    <div class="col-md-6 form-group">
                                    <label for="name" class="control-label mb-1">MT Expertise</label>
                                    <input id="name" name="expertise" value="<?= $docs->expertise; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                    <div class="col-md-6 form-group">
                                    <label for="name" class="control-label mb-1">Nombre P</label>
                                    <input id="name" name="nbrep" value="<?= $docs->nbrep; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Montant à payer</label>
                                    <input id="name" name="montant9" value="<?= $docs->montant; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                     <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Solde</label>
                                    <input id="name" name="solde" value="<?= $docs->solde; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                      <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Arriérés</label>
                                    <input id="name" name="arriere" value="<?= $docs->arriere; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                   
                               </div>
                                 </div>
                             <?php }elseif($docs->id_types == 7){ ?>

                                 <div id="">
                                     <div class="row">                        <!-- DECISION AFFECTATION DE LOGEMENT -->
                                    
                                    <div class="col-md-6 form-group">
                                    <label for="name" class="control-label mb-1">Logement</label>
                                    <input id="name" name="logement7" value="<?= $docs->logement; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                       <div class="col-md-6 form-group">
                                    <label for="name" class="control-label mb-1">Baille</label>
                                    <input id="name" name="baille" value="<?= $docs->baille; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                               </div>
                               <div class="row">
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Loyer mensuel</label>
                                    <input id="name" name="montant7" value="<?= $docs->montant; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                       <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Logement du groupe </label>
                                    <input id="name" name="logroupe" value="<?= $docs->logroupe; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                     <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Pièces</label>
                                    <input id="name" name="pieces" value="<?= $docs->pieces; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                               </div>

                           </div>
                       <?php }elseif($docs->id_types == 20){ ?>

                                <div id="">
                                     <!-- CONTRAT DE BAIL -->
                                     <div class="col-md-8 form-group">
                                    <label for="name" class="control-label mb-1">Libellé</label>
                                    <input id="name" name="libelle20" value="<?= $docs->libelle; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli20" value="<?= $docs->etabli; ?>" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="etb" class="control-label mb-1">Ville </label>
                                    <input id="name" name="ville" value="<?= $docs->ville; ?>" placeholder="Ville ..." type="text" class="form-control" aria-required="true" aria-invalid="false">
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Numéro Bail </label>
                                    <input id="name" name="numero20" value="<?= $docs->reference; ?>" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                               </div>

                                   <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Objet du contrat </label>
                                    <textarea id="name" name="objet20" placeholder="Objet du contrat" class="form-control"><?= $docs->description; ?></textarea>
                                   </div>
                                <div class="row">
                                   <div class="col-md-4 form-group">
                                    <label for="etb" class="control-label mb-1">Loyer mensuel</label>
                                    <input id="name" name="montant20" value="<?= $docs->montant; ?>" placeholder="Loyer mensuel" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="etb" class="control-label mb-1">Durée</label>
                                    <input id="name" name="duree20" value="<?= $docs->duree; ?>" placeholder="Duree" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                   </div>
                                    <div class="col-md-4 form-group">
                                        <label for="etb" class="control-label mb-1">Date Effet</label>
                                        <input id="name" name="effet20" value="<?= $docs->effet; ?>" placeholder="Date d'effet" type="date" class="form-control" aria-required="true" aria-invalid="false">
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col-md-3 form-group">
                                        <label for="etb" class="control-label mb-1">Mode de reglement </label>
                                        <input id="name" name="reglement20" value="<?= $docs->reglement; ?>" placeholder="Mode de reglement ..." type="text" class="form-control" aria-required="true" aria-invalid="false">
                                   </div>
                                   <div class="col-md-3 form-group">
                                    <label for="etb" class="control-label mb-1">Banque </label>
                                    <input id="name" name="domicile20" value="<?= $docs->domiciliation; ?>" placeholder="Banque" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                   </div>
                                   <div class="col-md-3 form-group">
                                        <label for="etb" class="control-label mb-1">N° Compte </label>
                                        <input id="name" name="compte20" value="<?= $docs->compte; ?>" placeholder="Numero de Compte" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                   </div>
                                     <div class="col-md-3 form-group">
                                    <label for="name" class="control-label mb-1">Statut Contrat </label>
                                      <select name="contrat20" class="form-control single" id="serv">
                                            <option value="">option du contrat</option>
                                          <?php
                                                foreach($contrats as $cont){?>
                                                    <?php if($cont->contrat==$docs->contrat): ?>
                                                 <option selected="selected" value="<?= $cont->contrat; ?>" >
                                                     <?php else: ?>
                                                <option value="<?= $cont->contrat; ?>">
                                                <?php endif; ?>
                                                <?=$cont->contrat;?> 
                                                 </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select> 
                                   </div>
                                </div>


                                </div>
                            <?php }elseif($docs->id_types == 19){ ?>

                            <div id="">
                                     <!-- AVENANTS -->
                                    <div class="col-md-8 form-group">
                                    <label for="name" class="control-label mb-1">Libellé</label>
                                    <input id="name" name="libelle19" value="<?= $docs->libelle; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                 <div class="row">
                                  
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Duree</label>
                                    <input id="name" name="duree" value="<?= $docs->duree; ?>" type="text" class="form-control" placeholder="Entrer la durée" aria-required="true" aria-invalid="false" >
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="etb" class="control-label mb-1">Date Effet </label>
                                    <input id="name" name="effet19" value="<?= $docs->effet; ?>" placeholder="Date d'effet ..." type="date" class="form-control" aria-required="true" aria-invalid="false">
                                   </div>
                                   
                               </div>
                                    <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Objet du contrat </label>
                                    <textarea id="name" name="objet19" value="" placeholder="Objet du contrat" class="form-control"><?= $docs->description;?></textarea>
                                   </div>
                                   <div class="row">
                                      <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Statut Contrat </label>
                                      <select name="contrat19" class="form-control single" id="serv">
                                            <option value="">option du contrat</option>
                                          <?php
                                                foreach($contrats as $cont){?>
                                                    <?php if($cont->contrat==$docs->contrat): ?>
                                                 <option selected="selected" value="<?= $cont->contrat; ?>" >
                                                     <?php else: ?>
                                                <option value="<?= $cont->contrat; ?>">
                                                <?php endif; ?>
                                                <?=$cont->contrat;?> 
                                                 </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select> 
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli19" value="<?= $docs->etabli; ?>" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                            

                               </div>
                              

                               </div>
                           <?php }elseif($docs->id_types == 18){ ?>

                        
                                    <div id="">
                                     <!-- RIB -->

                                     <div class="row">
                                        <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Numéro RIB  </label>
                                    <input id="name" name="numero18" value="<?= $docs->rib; ?>" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                  <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Code Banque  </label>
                                    <input id="name" name="codebanque" value="<?= $docs->codebanque; ?>" type="text" class="form-control" placeholder="Entrer le code" aria-required="true" aria-invalid="false">
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Code guichet</label>
                                    <input id="name" name="codeguichet" value="<?= $docs->codeguichet; ?>" type="text" class="form-control" placeholder="Entrer le code guichet" aria-required="true" aria-invalid="false" >
                                   </div>
                                   
                                   
                               </div>
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                    <label for="etb" class="control-label mb-1">Domiciliation </label>
                                    <input id="name" name="domicile" value="<?= $docs->domiciliation; ?>" placeholder="Banque" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                   </div>
                                  <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Cle RIB  </label>
                                    <input id="name" name="rib" value="<?= $docs->rib; ?>" type="text" class="form-control" placeholder="Entrer la clé RIB" aria-required="true" aria-invalid="false">
                                   </div>
                                    <div class="col-md-8 form-group">
                                    <label for="name" class="control-label mb-1">N° Compte</label>
                                    <input id="name" name="compte18" value="<?= $docs->compte; ?>" type="text" class="form-control" placeholder="Entrer le numéro de compte" aria-required="true" aria-invalid="false" >
                                   </div>
                                   
                                   
                               </div>

                                    </div>
                                <?php }elseif($docs->id_types==17){ ?>

                                    <div id="">
                                     <!-- PROCURATION -->
                                     <div class="row">
                                  
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli17" value="<?= $docs->etabli; ?>" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                   
                               </div>
                                    <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Objet </label>
                                    <textarea id="name" name="objet17" value="" placeholder="Objet ..." class="form-control"><?= $docs->description; ?></textarea>
                                   </div>


                                    </div>
                                <?php }elseif($docs->id_types == 21){ ?>

                                    <div id="">
                                     <!-- ACTE D'INDIVIDUALITE -->
                                <div class="row">
                                  
                                    <div class="col-md-6 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli21" value="<?= $docs->etabli; ?>" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                   
                               </div>
                                    <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Objet </label>
                                    <textarea id="name" name="objet21" value="" placeholder="Objet ..." class="form-control"><?= $docs->description; ?></textarea>
                                   </div>

                                    </div>
                                <?php }elseif($docs->id_types == 14){ ?>

                                    <div id="">
                                        <!-- PERSONNEL -->
                                <div class="row">
                                        <div class="col-md-8 form-group">
                                    <label for="name" class="control-label mb-1">Intitulé </label>
                                    <input id="name" name="libelle14" value="<?= $docs->libelle; ?>" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                       
                                   
                               </div>
                                    <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Description </label>
                                    <textarea id="name" name="objet14" value="" placeholder="Objet ..." class="form-control"><?= $docs->description; ?></textarea>
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli14" value="<?= $docs->etabli; ?>" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                   
                                    </div> 
                                <?php }elseif($docs->id_types == 15){ ?>
                                    <div id="">
                                        <!-- ATTESTATION -->

                                    <div class="row">
                                    <div class="col-md-8 form-group">
                                    <label for="name" class="control-label mb-1">Intitulé  </label>
                                    <input id="name" name="libelle15" value="<?= $docs->libelle; ?>" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                       
                                                                   
                               </div>
                                    <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Description </label>
                                    <textarea id="name" name="objet15" value="" placeholder="Objet ..." class="form-control"><?= $docs->description; ?></textarea>
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli15" value="<?= $docs->etabli; ?>" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>

                                    </div>
                                <?php }elseif($docs->id_types == 16){ ?>
                                    <div id="">
                                        <!-- DECISION -->

                                        <div class="row">
                                    <div class="col-md-8 form-group">
                                    <label for="name" class="control-label mb-1">Intitulé  </label>
                                    <input id="name" name="libelle16" value="<?= $docs->libelle; ?>" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                       
                                   
                               </div>
                                    <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Description </label>
                                    <textarea id="name" name="objet16" value="" placeholder="Objet ..." class="form-control"><?= $docs->description; ?></textarea>
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli16" value="<?= $docs->etabli; ?>" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                    </div>
                                <?php }elseif($docs->id_types == 12){ ?>
                                    <div id="">
                                        <!-- FICHE DE SORTIE -->

                                        <div class="row">
                                    <div class="col-md-8 form-group">
                                    <label for="name" class="control-label mb-1">Intitulé  </label>
                                    <input id="name" name="libelle12" value="<?= $docs->libelle; ?>" type="text" class="form-control" placeholder="Entrer le libelle ..." aria-required="true" aria-invalid="false">
                                   </div>
                                       
                                                               
                               </div>
                                    <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Description </label>
                                    <textarea id="name" name="objet12" value="" placeholder="Objet ..." class="form-control"><?= $docs->description; ?></textarea>
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli12" value="<?= $docs->etabli; ?>" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                    </div>
                                <?php }elseif($docs->id_types == 11){ ?>
                                    <div id="">
                                        <!-- FICHE DE PRESENCE -->

                                        <div class="row">
                                       
                                   <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli11" value="<?= $docs->etabli; ?>" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                   
                               </div>
                                    <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Description </label>
                                    <textarea id="name" name="objet11" value="" placeholder="Objet ..." class="form-control"><?= $docs->description; ?></textarea>
                                   </div>
                                    

                                    </div> 
                                <?php }elseif($docs->id_types == 13){ ?>
                                    <div id="">
                                        <!-- ORDRE DE MISSION -->
                                        <div class="row">
                                   
                                  
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date depart</label>
                                    <input id="name" name="effet13" value="<?= $docs->effet; ?>" type="date" class="form-control" placeholder="Entrer la date depart" aria-required="true" aria-invalid="false">
                                   </div>
                                   <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date de retour</label>
                                    <input id="name" name="retour" value="<?= $docs->retour; ?>" type="date" class="form-control" placeholder="Entrer la date retour" aria-required="true" aria-invalid="false">
                                   </div>
                                   
                               </div>
                                    <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Objet mission </label>
                                    <textarea id="name" name="objet13" placeholder="Objet de la mission ..." class="form-control"><?= $docs->description; ?></textarea>
                                   </div>
                                    <div class="row">
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Imputation Budgetaire</label>
                                    <input id="name" name="imputation" value="<?= $docs->imputation; ?>" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli13" value="<?= $docs->etabli; ?>" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>

                                  </div>
                                    </div>
                                    <?php }elseif($docs->id_types == 10){ ?> 
                                    <div id="">
                                        <!-- NOTE INTERNE -->

                                         <div class="row">
                                    <div class="col-md-8 form-group">
                                    <label for="name" class="control-label mb-1">Intitulé  </label>
                                    <input id="name" name="libelle10" value="<?= $docs->libelle; ?>" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                                                                                   
                               </div>
                                    <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Description </label>
                                    <textarea id="name" name="objet10" value="" placeholder="Objet ..." class="form-control"><?= $docs->description; ?></textarea>
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli10" value="<?= $docs->etabli; ?>" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>

                                    </div>
                                <?php }elseif($docs->id_types == 22 || $docs->id_types == 23 ){ ?>
                                    <div id="">
                                        <!-- ARRIVE DEPART -->

                                        <div class="row">
                                    <div class="col-md-8 form-group">
                                    <label for="name" class="control-label mb-1">Objet  </label>
                                    <input id="name" name="libelle22" value="<?= $docs->libelle; ?>" type="text" class="form-control" placeholder="Entrer le libelle ..." aria-required="true" aria-invalid="false">
                                   </div>
                                       
                                                               
                               </div>
                                    <div class="form-group">
                                    <label for="etb" class="control-label mb-1">Description </label>
                                    <textarea id="name" name="objet22" value="" placeholder="Objet ..." class="form-control"><?= $docs->description; ?></textarea>
                                   </div>
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli22" value="<?= $docs->etabli; ?>" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>
                                    </div>
                                <?php }else{ ?>

                                    <div id="">
                                    <!-- AUTRES TYPOLOGIE -->
                                     <div class="row">
                                    <div class="col-md-8 form-group">
                                    <label for="name" class="control-label mb-1">Intitulé  </label>
                                    <input id="name" name="libelle" value="<?= $docs->libelle; ?>" type="text" class="form-control" placeholder="Entrer le numéro" aria-required="true" aria-invalid="false">
                                   </div>
                                 
                                   
                               </div>
                                    
                                    <div class="col-md-4 form-group">
                                    <label for="name" class="control-label mb-1">Date</label>
                                    <input id="name" name="etabli" value="<?= $docs->etabli; ?>" type="date" class="form-control" aria-required="true" aria-invalid="false" >
                                   </div>

                                    </div>
                                <?php } ?>

<!--  FIN OPTION TYPE  -->











<?php 
$req="select * from usagers ORDER BY usager asc";
$valides = Db::getInstance()->query($req);
$usagers = $valides->fetchAll();
 ?>          
 <?php 
//if($docs->cases == 2){

  ?>
                                        <div class="row">
                                                <div class="col-md-2 offset-md-3"><label>Pièce avec Usager:</label></div>
                                            <div class="col-md-4">
                                            NON &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 <input type="radio" name="cases" value="2" id="chkb_10" <?= $docs->cases==2?"checked=checked":""; ?> onclick="met(this,'texte_10','texte_20');" > 
                                 <input type="hidden" style="display:none" id="texte_10" value="">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            OUI &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                    <input type="radio" id="chkb_20" value="1" name="cases" <?= $docs->cases==1?"checked=checked":""; ?> onclick="met(this,'texte_20','texte_10');" >
                                        </div>
                                        </div> 

                     
                                <div class="form-group" id="texte_20">    
                                    <label for="nature_id" class="control-label mb-1">Usager</label>
                                    <select id="nature_id" name="usager" class="form-control single" aria-required="true" aria-invalid="false">
                                        <option value="">Choisir Usager</option>
                                        
                                         <?php


                                                foreach($usagers as $usage){?>
                                                    <?php if($usage->id == $docs->id_usager):?>
                                                <option selected="selected" value="<?= $usage->id; ?>">

                                                    <?php else: ?>
                                                <option value="<?= $usage->id; ?>">
                                                <?php endif; ?>
                                                    <?=$usage->usager;?>
                                                        
                                                    </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>
                                        <div style="float:right;" class="mt-2">
                                            <a data-toggle="modal" href='#modal-id' class="btn btn-primary">Créer usager</a>
                                        </div>    
                                    </div>
                                    
                                
    <?php// } ?>                           
    <!--                          

                                

                <h2 class="mb10">FICHIERS A CHARGER</h2>
                    <div class="col-lg-12" >
                           

                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <?php 
                            $loop_count_num=1; 
                            
                           foreach($fileModel as $file):
                           
                             
                                $loop_count_prev=$loop_count_num;
                             #$pIArr=(array)$val;
                              ?>
                              
                            <a href="/archives/<?= $docs->designation."/".$docs->type."/".$docs->dossier."/".$file->fichier;?>"><?php
                if($file->type == 'jpg' || $file->type == 'jpeg' || $file->type == 'png' || $file->type == 'gif' || $file->type == 'swf'){
                    echo'<i class="fa fa-file-picture-o fa-3x"></i>';
                }elseif ($file->type == 'docx' || $file->type == 'doc') {
                    // code...
                    echo'<i class="fa fa-file-word-o fa-3x"></i>';
                }elseif($file->type == 'pdf'){
                    echo'<i class="fa fa-file-pdf-o fa-3x"></i>';
                }elseif ($file->type == 'xlsx' || $file->type == 'xls') {
                    // code...
                    echo'<i class="fa fa-file-excel-o fa-3x"></i>';
                }elseif ($file->type == 'pptx' || $file->type == 'ppt') {
                    // code...
                    echo'<i class="fa fa-file-powerpoint-o fa-3x"></i>';
                }elseif ($file->type == 'mp3' || $file->type == 'amr') {
                    // code...
                    echo'<i class="fa fa-file-sound-o fa-3x"></i>';
                }elseif ($file->type == 'mpeg' || $file->type == 'mp4' || $file->type == 'avi' || $file->type == 'flv') {
                    // code...
                    echo'<i class="fa fa-file-film-o fa-3x"></i>';
                }elseif ($file->type == 'zip' || $file->type == 'rar') {
                    // code...
                    echo'<i class="fa fa-file-archive-o fa-3x"></i>';
                }else{
                    echo'<i class="fa fa-file fa-3x"></i>';
                }

                    
                 ?></a>
                              <!--
                              <img src="/uploads/<?= $docs->reference.'/'.$file->fichier ;?>" class="img-responsive" width="40" height="40">
                                 -->      
                           <!-- <?php endforeach; ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="row" id="product_images_box">

                                     
                                      <input id="piid" name="piid[]" value="" type="hidden" class="form-control" aria-required="true" aria-invalid="false"> 
                                        <!--<input type="hidden" name="MAX_FILE_SIZE" value="s" />-->
                                       <!-- <div class="col-md-10 product_images_$loop_count_num++">
                                            <label for="images" class="control-label mb-1">Fichier</label>
                                            <input id="imagess" name="fichier[]" type="file" class="form-control" aria-required="true" aria-invalid="false"/>
                                            
                                    
                                        </div>  
                                          <div class="col-md-2">
                                            <label for="imagess" class="control-label mb-1">ACTION</label>
                                          
                                            <?php if($loop_count_num == 1): ?>                                                <button type="button" class="btn btn-success btn-lg" onclick="add_images_more()"><i class="fa fa-plus"></i> Ajouter</button>
                                            <?php else: ?>
                                               <a href=""><button type="button" class="btn btn-danger btn-lg"><i class="fa fa-plus"></i> Supprimer</button></a> 
                                            <?php endif; ?>                                        
                                          </div>

                             
                                        </div>
                                </div>
                            </div>
                            
                        </div>
                    
                    </div>-->
<h2 class="mb10">SCANNER FICHIERS</h2>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <a href="/scan-setup.exe" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Télécharger le logiciel de Scan</a>
          </div>
                    <div class="col-lg-12" >
                       <?php  foreach($fileModel as $file):?>
                         <a href="/archives/<?= $docs->designation."/".$docs->type."/".$docs->dossier."/".$file->fichier;?>"><?php
                if($file->type == 'jpg' || $file->type == 'jpeg' || $file->type == 'png' || $file->type == 'gif' || $file->type == 'swf'){
                    echo'<i class="fa fa-file-picture-o fa-3x"></i>';
                }elseif ($file->type == 'docx' || $file->type == 'doc') {
                    // code...
                    echo'<i class="fa fa-file-word-o fa-3x"></i>';
                }elseif($file->type == 'pdf'){
                    echo'<i class="fa fa-file-pdf-o fa-3x"></i>';
                }elseif ($file->type == 'xlsx' || $file->type == 'xls') {
                    // code...
                    echo'<i class="fa fa-file-excel-o fa-3x"></i>';
                }elseif ($file->type == 'pptx' || $file->type == 'ppt') {
                    // code...
                    echo'<i class="fa fa-file-powerpoint-o fa-3x"></i>';
                }elseif ($file->type == 'mp3' || $file->type == 'amr') {
                    // code...
                    echo'<i class="fa fa-file-sound-o fa-3x"></i>';
                }elseif ($file->type == 'mpeg' || $file->type == 'mp4' || $file->type == 'avi' || $file->type == 'flv') {
                    // code...
                    echo'<i class="fa fa-file-film-o fa-3x"></i>';
                }elseif ($file->type == 'zip' || $file->type == 'rar') {
                    // code...
                    echo'<i class="fa fa-file-archive-o fa-3x"></i>';
                }else{
                    echo'<i class="fa fa-file fa-3x"></i>';
                }

                    
                 ?></a>
                              <!--
                              <img src="/uploads/<?= $docs->reference.'/'.$file->fichier ;?>" class="img-responsive" width="40" height="40">
                                 -->      
                            <?php endforeach; ?>   

                            <div class="card">
                                <div class="card-body">
                                    <button type="button" class="btn btn-success" onclick="scanToJpg();">Demarrer le Scan</button>
<input type="hidden" name="dosier[]" value="<?=$docs->dossier;?>">
    <div id="images">
        <div class="zone"></div>
    </div>

    <!-- Previous lines are same as demo-01, below is new addition to demo-02 | https://asprise.com/scan/applet/upload.php?action=dump-->

   <!--
        <input type="text" id="sample-field" name="sample-field" value="Test scan"/>
        <input type="button" value="Submit" name="images" onclick="submitFormWithScannedImages();">
    -->
    </form>

    <div id="server_response"></div>

    
                                </div>
                            </div>
                    </div>
                                                
                            <div class="row mt-2">
                            <div class="col-md-8 offset-md-2 form-group">
                            <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block" >
                                Modifier la pièce
                            </button>
                        </div>
                    </div>





                        </div>
                    </div>
                    
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
                                <select name="domaines" class="form-control" id="slug" >
                                            <option value="">Choisir domaine</option>
                                          <?php
                                                foreach($categories as $data){?>
                                                    
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
                <?php
                }else{
                    header("Location: /");
                    exit;
        
    } ?>