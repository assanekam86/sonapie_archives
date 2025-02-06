<h1>Inscription</h1>
<?php  

use App\Core\Form;
if(Form::hasFlash()){
foreach(Form::getFlash() as $type => $message):  ?>

                    <div class="alert alert-<?= $type;?>">
                      <?= $message; ?>
                    </div>
                  <?php endforeach;
}?>
<?= $registerForm; ?>
<a href="/users/login">Déjà inscrit - me connecter</a>