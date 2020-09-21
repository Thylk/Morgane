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
	<link rel="stylesheet" type="text/css" href="assets/css/index.css">
	<link rel="stylesheet" type="text/css" href="assets/css/footer.css">
	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/bccceca99e.js" crossorigin="anonymous"></script>
	<!-- Cookies -->
	<!-- jQuery -->
</head>

<body>

    
<?php include 'includes/header.php';?>


<main>
	
	<div id="first-container">

		<h1 id="title">Morgane Ballif</h1>
		<h2 id="subtitle">Confection sur mesure</h2>

		<div  id="card-container">
		
			<div id="row">

			<?php
				// Include config file
				require_once "includes/dbh.inc.php";
				
				// Attempt select query execution
				$sql = "SELECT * FROM articles ORDER BY ordreimg ASC";
				if($result = $pdo->query($sql)){
					if($result->rowCount() > 0){

							while($row = $result->fetch()){
								echo '
										<div class="column">
											<div class="card">
												<img class="img-accueil" src="assets/img/img_articles/'.$row['img'].'"/>
												<div id="descri-box">
													<p>'.$row["nom"].'</p>
													<p>'.$row["descri"].'</p>
												</div>
											</div>
										</div>
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
	
			</div>

		</div>

	</div>

</main>

<?php include 'includes/footer.php';?>

</body>

<script src="assets/js/menu.js"></script>
</html>