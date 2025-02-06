<?php 
use App\Core\Form;
use App\Controllers\UsersController;
use App\Core\Db;
if(isset($_SESSION['user'])){
    $query ="SELECT * FROM categories ORDER BY designation asc";
    $result = Db::getInstance()->query($query);
    $rows = $result->rowCount();
    //var_dump($boites);
   ?>
 <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">AJOUTER UN DOSSIER</h1>
                  </div>
                 
                  <div class="row m-t-30">
        <div class="col-md-12">

            <div class="row">
                <div class="col-lg-12">
                    <form id="form1" action="" method="post" enctype="multipart/form-data"target="">

                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="slug" class="control-label mb-1">Libéllé Dossier</label>
                                <input id="slug" name="dossier" type="text" class="form-control" aria-required="true" aria-invalid="false" required>    
                            </div>  

                             <div class="form-group">
                                <label for="description" class="control-label mb-1">Description Dossier</label>
                                <textarea id="description" name="description" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Description de la boite ..."></textarea>
                            </div> 
                            <div class="form-group">
                                    <label for="serv" class="control-label mb-1">Domaine de gestion</label>
                                    <input type="text" name="domaine" value="<?=$boites->designation;?>" class="form-control" disabled>
                                         <input type="hidden" name="domaine" value="<?=$boites->idcat;?>">                                   
                              </div>

                            <div class="form-group">
                                    <label for="etagere" class="control-label mb-1">Boite d'Archive</label>
                                         <input type="text" name="boite" value="<?=$boites->boite;?>" class="form-control" disabled>
                                         <input type="hidden" name="boite" value="<?=$boites->id;?>">                                    
                                      </div>
                            <div class="row">
                                    <div class=" col-md-3 form-group">
                                    <label for="doss" class="control-label mb-1">Ville</label>
                                       <!--<input type="text" name="ville" value="" id="ville" class="form-control" /> -->
                                      <input type="text" name="ville" value="<?=$boites->ville;?>" class="form-control" disabled>                                    
                                    </div>
                                     <div class=" col-md-3 form-group">
                                    <label for="doss" class="control-label mb-1">Salle</label>
                                       <!--<input type="text" name="ville" value="" id="ville" class="form-control" /> -->
                                        <input type="text" name="salle" value="<?=$boites->salle;?>" class="form-control" disabled>                                    
                                    </div>
                                     <div class=" col-md-3 form-group">
                                    <label for="doss" class="control-label mb-1">Rayon</label>
                                       <!--<input type="text" name="ville" value="" id="ville" class="form-control" /> -->
                                      <input type="text" name="rayon" value="<?=$boites->rayon;?>" class="form-control" disabled>                                    
                                    </div>
                                     <div class=" col-md-3 form-group">
                                    <label for="doss" class="control-label mb-1">Etagère</label>
                                       <!--<input type="text" name="ville" value="" id="ville" class="form-control" /> -->
                                       <input type="text" name="etagere" value="<?=$boites->etagere;?>" class="form-control" disabled>                                   
                                    </div>
                            </div>

                                        
                                      

                                      <div class="row mt-2">
                            <div class="col-md-8 offset-md-2 form-group">
                            <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block" >
                                Créer le Dossier
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
     <!-- Modal -->
     <div id="errorModal" class="modal" tabindex="-1" role="dialog">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Erreur</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
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
                 <?php }else{
    header("Location:/users/login");
  } ?>

<script>
    document.getElementById('form1').addEventListener('submit', function(event) {
        var dossier = document.getElementById('slug').value;
        var regex = /^[a-zA-Z0-9\s-_]+$/; // Autorise lettres, chiffres, espaces, tirets et underscores

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

