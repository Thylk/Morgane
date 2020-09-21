<?php
    
// Include config file
require_once "dbh.inc.php";
 
// Define variables and initialize with empty values
$nom = $descri = "";
$nom_err = $descri_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];

    // EFFACER LES ANCIENNES PHOTOS

        // Prepare a select statement
        $sql = "SELECT * FROM articles WHERE id = :id";
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":id", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    // Retrieve individual field value
                    $imgFile = $row['img'];

                    unlink("../assets/img/img_articles/$imgFile");

                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

    // 


    // IMAGE 1
    $img = $_FILES['img'];
    // print_r($file);
    $imgName = $_FILES['img']['name'];
    $imgTmpName = $_FILES['img']['tmp_name'];
    $imgSize = $_FILES['img']['size'];
    $imgError = $_FILES['img']['error'];
    $imgType = $_FILES['img']['type'];

    $upload_dir = '../assets/img/img_articles/';
    $imgExt = strtolower(pathinfo($imgName,PATHINFO_EXTENSION));
    $valid_extensions = array('jpg', 'jpeg', 'png');
    $picProfile = rand(1000, 1000000).'.'.$imgExt;
    move_uploaded_file($imgTmpName, $upload_dir.$picProfile);
    
    // Validate name
    $input_nom = trim($_POST["nom"]);
    if(empty($input_nom)){
        $nom_err = "Please enter a name for the article";
    } elseif(!filter_var($input_nom, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nom_err = "Please enter a valid name.";
    } else{
        $nom = $input_nom;
    }
    
    // Validate description
    $input_descri = trim($_POST["descri"]);
    if(empty($input_descri)){
        $descri_err = "Please enter a description.";     
    } else{
        $descri = $input_descri;
    }

    // Check input errors before inserting in database
    if(empty($nom_err) && empty($descri_err)){
        // Prepare an update statement
        $sql = "UPDATE articles SET img=:img, nom=:nom, descri=:descri WHERE id=:id";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":img", $param_img);
            $stmt->bindParam(":nom", $param_nom);
            $stmt->bindParam(":descri", $param_descri);
            $stmt->bindParam(":id", $param_id);
            
            // Set parameters
            $param_img = $picProfile;
            $param_nom = $nom;
            $param_descri = $descri;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: ../admin.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM articles WHERE id = :id";
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":id", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    // Retrieve individual field value
                    $imgFile = $row['img'];
                    $nom = $row["nom"];
                    $descri = $row["descri"];

                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
        
        // Close connection
        unset($pdo);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        // header("location: error.php");
        // exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
	
<head>
	<META NAME="Author" CONTENT="Maxime Regnault">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Atelier à façon</title>
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../assets/css/resetstyle.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/menu.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/article-modify.css">
	<!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/bccceca99e.js" crossorigin="anonymous"></script>
	<!-- Cookies -->
	<!-- jQuery -->
</head>

<body>

<?php include 'header.php';?>
<main>

    <div id="box_update_article">

        <h2>Modifier l'article</h2>

        <img src="../assets/img/img_articles/<?php echo $imgFile; ?>" width="200px" />
        <form enctype="multipart/form-data" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

            <div class="form-signup">
                <input type="file" name="img">
            </div>
            <div class="form-signup">
                <input class="form-input" type="text" name="nom" placeholder="Nom" value="<?php echo $nom; ?>">
            </div>
            <div class="form-signup">
                <input class="form-input" type="text" name="descri" placeholder="Description" value="<?php echo $descri; ?>">
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <button type="submit" name="signup-submit">Modifier</button>
            <a href="stock.php" class="btn btn-default">Retour</a>

        </form>

    </div>

</main>

</body>
</html>