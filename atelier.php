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
	<link rel="stylesheet" type="text/css" href="assets/css/atelier.css">
	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/bccceca99e.js" crossorigin="anonymous"></script>
	<!-- Cookies -->
	<!-- jQuery -->
</head>

<body>


<?php include 'includes/header.php';?>

    <main>

        <div id="atelier-container">

			<h1>Mon Atelier</h1>

            <img class="mySlides" src="assets/img/img-atelier/brother.jpg">
            <img class="mySlides" src="assets/img/img-atelier/etagere.jpg">
            <img class="mySlides" src="assets/img/img-atelier/fil.jpg">
            <img class="mySlides" src="assets/img/img-atelier/musee.jpeg">
            <img class="mySlides" src="assets/img/img-atelier/tissus.jpg">

        </div>

    </main>

</body>

<script src="assets/js/menu.js"></script>

<script>

    var slideIndex = 0;
    carousel();

    function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > x.length) {slideIndex = 1}
    x[slideIndex-1].style.display = "block";
    setTimeout(carousel, 3000); // Change image every 2 seconds
    }

</script>

</html>