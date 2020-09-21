<?php

// Include config file
require_once "dbh.inc.php";

if(isset($_POST["action"])){
    
    $query = "
        SELECT * FROM articles
    ";

    $output = "";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();
    if($total_row > 0){
        foreach($result as $row){
            
            // $output = "";

            $output .= '

                <div id="produit" class="col-sm-8 col-md-6 col-lg-4">
                    <form method="post" action="#">
                        <div class="products">
                            <div id="img_article_boutique">
                                <img src="assets/img/img_articles/'.$row['img'].'"/>
                            </div>
                            <h4 class="text-info">'.$row['nom'].'</h4>
                            <p>'.$row['descri'].'</p>
                            <h4>'.$row['prix'].'</h4>
                            <input type="text" name="quantity" value="1" />
                            <input type="hidden" name="id" value="'.$row['id'].'" />
                            <input type="hidden" name="nom" value="'.$row['nom'].'" /> 
                            <input type="hidden" name="prix" value="'.$row['prix'].'" />
                            <input type="hidden" name="taille" value="'.$row['taille'].'" /> 
                            <input type="submit" id="add_to_cart" name="add_to_cart" class="btn btn-info" value="Ajouter au panier" />
                            <a class="btn btn-info" href="shop_article.php?id='.$row['id'].'">Voir</a>
                        </div>
                    </form>
                </div>
                
            ';
        }
    }
    echo $output;
    
}

?>