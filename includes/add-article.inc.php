<?php

session_start();

// Include config file
require_once "dbh.inc.php";
 
// Define variables and initialize with empty values
$img = $nom = $descri = "";
$img_err = $nom_err = $descri_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

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


    $query = "SELECT * FROM articles";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();


            // Check input errors before inserting in database
            if(empty($nom_err) && empty($descri_err)){
                // Prepare an insert statement
                $sql = "INSERT INTO articles (img, nom, descri, ordreimg) VALUES (:img, :nom, :descri, :ordreimg)";
        
                if($stmt = $pdo->prepare($sql)){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":img", $param_img);
                    $stmt->bindParam(":nom", $param_nom);
                    $stmt->bindParam(":descri", $param_descri);
                    $stmt->bindParam(":ordreimg", $param_ordre);
                    
                    
                    // Set parameters
                    $param_img = $picProfile;
                    $param_nom = $nom;
                    $param_descri = $descri;
                    $param_ordre = $total_row;
                    
                    // Attempt to execute the prepared statement
                    if($stmt->execute()){
                        

                        // Records created successfully. Redirect to landing page
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
}