
<?php// var_dump($annonces); ?>

<h1 align="center"> ANNONCE N° <?= $annonce->id ?> </h1>

<article>
	<h2><?= ucfirst($annonce->titre); ?></h2>
	<p><?= $annonce->description; ?> <address><?= date("d-m-Y H:i:s",strtotime($annonce->create_at)); ?></address></p>
</article>
