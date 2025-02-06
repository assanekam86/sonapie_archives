<?php 
use App\Controllers\UsersController;
use App\Core\Db;
use App\Core\Form; 
if($_SESSION['user']){
 // var_dump($typologies);
   
   ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>ARCHIVE - MODIFIER </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Kamara Assane">



    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">

                <div class="col-lg-12 text-center ">
                   <?php
              
          if(Form::hasFlash()){
          foreach(Form::getFlash() as $type => $message):  ?>

                    <div class="alert alert-<?= $type;?>">
                      <?= $message; ?>
                    </div>
                  <?php endforeach;
                }?>
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-8">MODIFIER UN COMPTE UTILISATEUR!</h1>
                        </div> 
                        
                        <div class="row m-t-30">
        <div class="col-md-12">

            <div class="row">
                <div class="col-lg-12">
                    <form id="form1" action="" method="post">

                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="slug" class="control-label mb-1">Matricule :</label>
                                <input id="slug" name="matricule"  value="<?= $user->matricule;?>" type="text" class="form-control" aria-required="true" aria-invalid="false">    
                            </div>  

                             <div class="form-group">
                                <label for="slug1" class="control-label mb-1">Nom :</label>
                                <input id="slug1" name="nom"  value="<?= $user->nom;?>" type="text" class="form-control" aria-required="true" aria-invalid="false">    
                            </div>

                            <div class="form-group">
                                <label for="slug2" class="control-label mb-1">Prénoms :</label>
                                <input id="slug2" name="prenom"  value="<?= $user->prenom;?>" type="text" class="form-control" aria-required="true" aria-invalid="false">    
                            </div>
                            
                            <div class="form-group">
                                <label for="slug5" class="control-label mb-1">Fonction :</label>
                                <input id="slug5" name="fonction"  value="<?= $user->fonction;?>" type="text" class="form-control" aria-required="true" aria-invalid="false">    
                            </div>


                            <div class="form-group">
                                    <label for="serv" class="control-label mb-1">Direction :</label>
                                        <select name="direction" class="form-control single" id="serv">
                                            <option value="">Choisir la Direction</option>
                                          <?php
                                                foreach($directions as $direction){?>
                                                    <?php if($direction->id==$user->direction): ?>
                                                 <option selected="selected" value="<?= $direction->id; ?>" >
                                                     <?php else: ?>
                                                <option value="<?= $direction->id; ?>">
                                                <?php endif; ?>
                                                <?=$direction->designation;?> 
                                                 </option>
                                                 <?php
                                                    }
                                         ?>
                                        </select>                                    
                            </div> 
                            <?php 
                            $var=[];
                            foreach($typologies as $types){
                                //var_dump($types);
                                array_push($var, $types['id_type']);
                            }
                            //var_dump($var);

                             ?>
                                <?php //var_dump($typesusers); ?>
                            <div class="form-group">
                                    <label for="typo" class="control-label mb-1">Domaine :</label>
                                        <select name="domaine[]" multiple="multiple" class="form-control single" id="typo">
                                            <option value="">Choisir le(s) domaine(s)</option>
                                          <?php
                                              // foreach($typologies as $typo){
                                                foreach($typesusers as $typeuser){  
                                                    ?>
                                                    <?php if(in_array($typeuser->id,$var)): ?>
                                                 <option selected="selected" value="<?= $typeuser->id; ?>" >
                                                     <?php else: ?>
                                                <option value="<?=$typeuser->id;?>">
                                                <?php endif; ?>
                                                <?=$typeuser->designation;?> 
                                                 </option>
                                                 <?php
                                             }
                                                  // }
                                         ?>
                                        </select>                                    
                            </div>

                            <div class="form-group">
                                <label for="slug3" class="control-label mb-1">Contact :</label>
                                <input id="slug3" name="contact"  value="<?= $user->contact;?>" type="text" class="form-control" aria-required="true" aria-invalid="false">    
                            </div>

                            <div class="form-group">
                                <label for="slug4" class="control-label mb-1">Email :</label>
                                <input id="slug4" name="email"  value="<?= $user->email;?>" type="text" class="form-control" aria-required="true" aria-invalid="false">    
                            </div>

                            <div class="form-group">
                                <label for="slug0" class="control-label mb-1">Login :</label>
                                <input id="slug0" name="login"  value="<?= $user->login;?>" type="text" class="form-control" aria-required="true" aria-invalid="false">    
                            </div>
                            


                                      <div class="row mt-2">
                            <div class="col-md-8 offset-md-2 form-group">
                            <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block" >
                                Modifier Utilisateur
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
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

Core plugin JavaScript
<script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

Custom scripts for all pages
<script src="/js/sb-admin-2.min.js"></script>-->

</body>

</html>

   <?php }else{
    header("Location:/");
  } ?>


