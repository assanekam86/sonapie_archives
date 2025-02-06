<p>Page d'accueil des Annonces</p>
<?php// var_dump($annonces); ?>


<h1 align="center">LISTE DES ANNONCES</h1>
<?php 
	foreach($annonces as $annonce):
 ?>
<article>
	<h2><a href="/annonces/lire/<?= $annonce->id ?>"><?= ucfirst($annonce->titre); ?></a></h2>
	<p><?= $annonce->description; ?> <address><?= date("d-m-Y H:i:s",strtotime($annonce->create_at)); ?></address></p>
</article>
<?php endforeach; ?>
<a href="/annonces/ajouter" class="btn btn-info text-right"> Ajouter une annonce</a>
