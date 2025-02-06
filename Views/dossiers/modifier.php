 <?php 
 use App\Core\Form;
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){
    
   ?>
  
  <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">MODIFIER LE DOSSIER</h1>
                  </div>
                 
                 

    <div class="row m-t-30">
        <div class="col-md-12">

            <div class="row">
                <div class="col-lg-12">
                    <form id="form1" action="" method="post" enctype="multipart/form-data"target="_blank">

                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="slug" class="control-label mb-1">Dossier</label>
                                <input id="slug" name="dossier"  value="<?= $dossier->dossier;?>" type="text" class="form-control" aria-required="true" aria-invalid="false" <?= $hasDocument ? 'readonly' : ''; ?>>
                            </div>  

                             <div class="form-group">
                                <label for="description" class="control-label mb-1">Description Typoldossier</label>
                                <textarea id="description" name="description"  value="<?= $dossier->desc_dossier;?>" type="text" class="form-control" aria-required="true" aria-invalid="false"><?= $dossier->desc_dossier;?> </textarea>
                            </div> 


                                        <div class="form-group">
                                    <label for="serv" class="control-label mb-1">Domaine de gestion</label>
                                        <select name="domaine" class="form-control single" id="domaine">
                                            <option value="">Choisir le domaine</option>
                                          <?php
                                                foreach($domaines as $domaine){?>
                                                    <?php if($domaine->id==$dossier->id_cat): ?>
                                                 <option selected="selected" value="<?= $domaine->id; ?>" >
                                                     <?php else: ?>
                                                <option value="<?= $domaine->id; ?>">
                                                <?php endif; ?>
                                                <?=$domaine->designation;?> 
                                                 </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>                                    
                                      </div>

                                      <div class="form-group">
                                    <label for="serv" class="control-label mb-1">Boite d'Archive</label>
                                        <select name="boite" class="form-control single" id="boite">
                                            <option value="">Choisir la Boite</option>
                                          <?php
                                                foreach($boites as $boite){?>
                                                    <?php if($boite->id==$dossier->id_boite): ?>
                                                 <option selected="selected" value="<?= $boite->id; ?>" >
                                                     <?php else: ?>
                                                <option value="<?= $boite->id; ?>">
                                                <?php endif; ?>
                                                <?=$boite->boite;?> 
                                                 </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>                                    
                                      </div>
                                       <div class="row">
                                  <!--  <div class=" col-md-3 form-group">
                                    <label for="doss" class="control-label mb-1">Ville</label>
                                       <!--<input type="text" name="ville" value="" id="ville" class="form-control" /> -->
                                     <!--   <select name="ville" class="form-control single" id="ville" disabled>
                                            
                                         
                                        </select>                                     
                                    </div>
                                     <div class=" col-md-3 form-group">
                                    <label for="doss" class="control-label mb-1">Salle</label>
                                       <!--<input type="text" name="ville" value="" id="ville" class="form-control" /> -->
                                      <!--  <select name="salle" class="form-control single" id="salle" disabled>
                                        </select>                                     
                                    </div>
                                     <div class=" col-md-3 form-group">
                                    <label for="doss" class="control-label mb-1">Rayon</label>
                                       <!--<input type="text" name="ville" value="" id="ville" class="form-control" /> -->
                                        <!--<select name="rayon" class="form-control single" id="rayon" disabled>
                                        </select>                                     
                                    </div>
                                     <div class=" col-md-3 form-group">
                                    <label for="doss" class="control-label mb-1">Etagère</label>
                                       <!--<input type="text" name="ville" value="" id="ville" class="form-control" /> -->
                                        <!--<select name="etagere" class="form-control single" id="etagere" disabled>
                                        </select>                                     
                                    </div>-->
                            </div>

                                      <div class="row mt-2">
                            <div class="col-md-8 offset-md-2 form-group">
                            <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block" >
                                Modifier le Dossier
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
      <!-- Modal -->
      <div id="errorModal" class="modal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Erreur</h5>
                      <button type="button" class="close" aria-label="Close" onclick="closeModal()">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <p id="errorMessage">Le libellé du dossier contient des caractères non autorisés.</p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" onclick="closeModal()">Fermer</button>
                  </div>
              </div>
          </div>
      </div>
                </div>
    <script>
        document.getElementById('form1').addEventListener('submit', function(event) {
            var dossier = document.getElementById('slug').value;
            var description = document.getElementById('slug').value; // Utilisez un autre ID si nécessaire
            var regex = /^[a-zA-Z0-9\s-_]+$/; // Autorise lettres, chiffres, espaces, tirets et underscores

            // Validation du champ dossier
            if (!regex.test(dossier)) {
                event.preventDefault(); // Empêche l'envoi du formulaire
                document.getElementById('errorMessage').innerText = 'Le libellé du dossier contient des caractères non autorisés. Veuillez utiliser uniquement des lettres, chiffres, espaces, tirets(-) ou underscores(_).';
                showModal(); // Affiche le modal
            }

        });

        function showModal() {
            document.getElementById('errorModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('errorModal').style.display = 'none';
        }
    </script>
                 <?php
     }else{
    http_response_code(404);
    die("Vous ne pouvez pas acceder a cette page");
    exit;
} ?>

