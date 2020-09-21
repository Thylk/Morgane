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
	<link rel="stylesheet" type="text/css" href="assets/css/admin.css">
	<!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/bccceca99e.js" crossorigin="anonymous"></script>
	<!-- Cookies -->
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>

<body>

<?php include 'includes/header.php';?>

<main>

    <div id="admin-container">

        <h1>Admin</h1>

        <div id="admin-box">

            <div id="add-article-container">

                <button id="show-add">Ajouter une image d'accueil</button>

                <div id="add-article-box">
                    
                    <form enctype="multipart/form-data" action="includes/add-article.inc.php" method="post">
                        
                            <div class="form-signup">
                                <input type="file" name="img">
                            </div>
                            <div class="form-signup">
                                <input class="form-input" type="text" name="nom" placeholder="Nom">
                            </div>
                            <div class="form-signup">
                                <textarea class="form-input" type="text" name="descri" placeholder="Description"></textarea>
                            </div>
                        
                        <button type="submit" name="signup-submit">Ajouter article</button>
                    </form>
                    <button id="close-add">Fermer</button>
                </div>
                
            </div>

            <div id="add-box">

                <button id="show-visu">Voir les images d'accueil</button>

                <div id="img-container">

                    <ul id="img-accueil-container" class="container">

                        <?php
                            // Include config file
                            require_once "includes/dbh.inc.php";
                            
                            // Attempt select query execution
                            $sql = "SELECT * FROM articles ORDER BY ordreimg ASC";
                            if($result = $pdo->query($sql)){
                                if($result->rowCount() > 0){

                                        while($row = $result->fetch()){
                                            echo '

                                                    <li draggable="true" class="img-accueil-box">
                                                        <input class="hiddenvalue" name="idphoto" type="hidden" value='.$row['id'].' />
                                                        <img src="assets/img/img_articles/'.$row['img'].'" height="150px" />

                                                                <a class="icone_modif" href="includes/article-modify.inc.php?id= '. $row["id"] .'" title="Update Record" data-toggle="tooltip">'.'<i class="fas fa-pencil-alt"></i></a>
                                                                <a class="icone_delete" href="includes/article-del.inc.php?id= '. $row['id'] .'" title="Delete Record" data-toggle="tooltip">'.'<i class="fas fa-trash"></i></a>

                                                        
                                                    </li>

                                                ';
                                        }
                                    // Free result set
                                    unset($result);
                                } else{
                                    echo "<p'>No records were found.</p>";
                                }
                            } else{
                                echo "ERROR: Could not able to execute $sql. " . $pdo->error;
                            }
                            
                            // Close connection
                            unset($pdo);
                        ?>
                    
                    </ul>

                    <button id="btnIndex">ENREGISTRER</button>

                    <button id="close-visu">Fermer</button>

                </div>

            </div>

        </div>

    </div>

</main>

</body>

<script src="assets/js/menu.js"></script>

<script src="assets/js/admin.js"></script>

<script>

$( function() {
	$( "#img-accueil-container" ).sortable();
	$( "#img-accueil-container" ).disableSelection();
} );

$("#btnIndex").click(function(){
	
	// var str = $("#sortable li").length; Nombre de Li's
	// var str = $("#sortable li").index();
	// var str = "ok";
	// console.log(str);

	var listItems = $("#img-accueil-container li");
	listItems.each(function(idx, li) {
		var product = $(li);

		var str = product.index();
		// console.log(str);

		var otr = product.find('.hiddenvalue').val();
		// console.log(otr);

		// TEST
		jQuery.ajax({
			type: "POST",
			data:  'ordre=' + str + '&imgid=' + otr,
			url: "includes/orderupdate.inc.php",
			dataType : 'html'
			// beforeSend: function(){
			// 	$('#aboutStatus').fadeIn(250).css('color', '#017c04').html('processing...');
			// },
			// success: function(){
			// 	$('#aboutStatus').fadeIn(250).css('color', '#017c04').html('Saved Successfully!').delay(2500).fadeOut(250);
			// },
			// error: function(){
			// 	$('#aboutStatus').fadeIn(250).css('color', '#ff464a').html('An error occurred!').delay(2500).fadeOut(250);
			// }
		});
		// -----------------------------------------

	});	

});

</script>

<!-- <script src="assets/js/sort.js"></script> -->

</html>