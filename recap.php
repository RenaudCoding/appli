<?php
    session_start(); // récupération de la session pour consulter le tableau de session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Récapitulatif des produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
    <nav> <!-- barre de navigation -->
        <a href = "index.php">INDEX</a>
        <a href = "recap.php">RECAP</a>
    </nav>
    <?php 
        if(!isset($_SESSION['products']) || empty($_SESSION['products'])){ // verification de l'existance du tableau 'produit' dans la session 
            echo "<p>Aucun produit en session...</p>"; // si tableau 'produit' inexistant
        }
        else{ // tableau 'produit existant
            echo "<table>", // entête du tableau
                    "<thead>",
                        "<tr>",
                            "<th>#</th>",
                            "<th>Nom</th>",
                            "<th>Prix</th>",
                            "<th>Quantité</th>",
                            "<th>Total</th>",
                        "</tr>",
                    "</thead>",
                    "<tbody>";
            $totalGeneral = 0;
            $totalArticles = 0;
            foreach($_SESSION['products'] as $index => $product){ // remplissage du tableau
                echo "<tr>",
                    "<td>".$index."</td>",
                    "<td>".$product['name']."</td>",
                    "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>", // prix unitaire du produit
                    "<td>".$product['qtt']."</td>",                                    
                    "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>", // prix total du produit commander
                    "<td>"
                        ?>
                        <a href="traitement.php?action=clear&id=<?= $index?>">supprimer</a> <!-- lien pour supprimer un produit (URL) -->
                        <a href='traitement.php?action=down-qtt&id=<?= $index?>'>-</a> <!-- lien pour réduire la quantité d'un produit (URL) -->
                        <a href="traitement.php?action=up-qtt&id=<?= $index?>">+</a> <!-- lien pour augmenter la quantité d'un produit (URL) -->
                        <?php
                    "</tr>";
                $totalGeneral+= $product['total']; // prix total du panier
                $totalArticles += $product['qtt']; // nombre total d'article dans le panier
                
                
            }
            echo "<tr>",   
                "<td colspan=4>Total général : </td>",
                "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp,")."&nbsp,€</strong></td>", // prix total du panier
                "</tr>",
                "<tr>",
                "<td colspan=4> Nombre total d'articles : </td>", // nombre total d'article
                "<td><strong>".number_format($totalArticles, 0, ",", "&nbsp,")."</strong></td>",
                "</tr>",
            "</tbody>",
            "</table>";
            ;      
           
        }
    ?>

    <a href="traitement.php?action=delete">Vider le panier</a> <!-- lien pour vider le panier -->

    </div>
</body>
</html>