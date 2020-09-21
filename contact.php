<!DOCTYPE html>
<html lang="fr">
	
<head>
	<META NAME="Author" CONTENT="Maxime Regnault">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Atelier à façon</title>
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/resetstyle.css">
    <link rel="stylesheet" type="text/css" href="assets/css/menu.css">
	<link rel="stylesheet" type="text/css" href="assets/css/contact.css">
	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/bccceca99e.js" crossorigin="anonymous"></script>
	<!-- Cookies -->
	<!-- jQuery -->
</head>

<body>

    
<?php include 'includes/header.php';?>


<main>
	
	<div id="contact-container">

		<h1 id="title">Demande de devis</h1>

        <form id="contact-form" action="includes/contact-form.inc.php" method="post">
            
                <input class="form-signup" type="text" name="name" placeholder=" Nom Prénom"/>
            
            
                <input class="form-signup" type="text" name="mail" placeholder=" Votre e-mail"/>
            
           
                <input class="form-signup" type="text" name="subject" placeholder=" Objet"/>
            
            
                <textarea class="form-signup" name="message" placeholder=" Décrivez vos besoins"></textarea>
            
            <button type="submit" name="submit">Envoyer</button>
        </form>

		<?php include 'includes/error.inc.php';?>

	</div>

</main>


</body>

<script src="assets/js/menu.js"></script>
</html>