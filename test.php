<?php 


	
?>


<!DOCTYPE html>
<html lang="fr">
	
<head>
	<META NAME="Author" CONTENT="Maxime Regnault">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Atelier à façon</title>
	<!-- CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/resetstyle.css">
    <link rel="stylesheet" type="text/css" href="assets/css/test.css">
	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/bccceca99e.js" crossorigin="anonymous"></script>
	<!-- Cookies -->
	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>

<body>


<main>
	

	<div id="container">


		<ul id="sortable">

				<?php
					// Include config file
					require_once "includes/dbh.inc.php";
					
					// Attempt select query execution
					$sql = "SELECT * FROM articles ORDER BY ordreimg ASC";
					if($result = $pdo->query($sql)){
						if($result->rowCount() > 0){

								while($row = $result->fetch()){
									echo '

											<li class="img-accueil-box">
												<img src="assets/img/img_articles/'.$row['img'].'" width="300px" />
												<input class="hiddenvalue" name="idphoto" type="hidden" value='.$row['id'].' />
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
	</div>


</main>


</body>

<script>

$( function() {
	$( "#sortable" ).sortable();
	$( "#sortable" ).disableSelection();
} );

$("#btnIndex").click(function(){
	
	// var str = $("#sortable li").length; Nombre de Li's
	// var str = $("#sortable li").index();
	// var str = "ok";
	// console.log(str);

	var listItems = $("#sortable li");
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