<?php

    require_once "dbh.inc.php";
    
    $id = $_POST['imgid'];
    $ordre = $_POST['ordre'];

    // Prepare an update statement
    $sql = "UPDATE articles SET ordreimg=:ordreimg WHERE id=:id";

    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":ordreimg", $ordre_img);
        $stmt->bindParam(":id", $param_id);
        
        // Set parameters
        $ordre_img = $ordre;
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
