<?php
    session_start(); // récupération de la session pour consulter le tableau de session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Récapitulatif des produits</title>
</head>
<body>
    <nav>
        <a href = "index.php">INDEX</a>
        <a href = "recap.php">RECAP</a>
    </nav>
    <?php 
        if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
            echo "<p>Aucun produit en session...</p>";
        }
        else{
            echo "<table>",
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
            foreach($_SESSION['products'] as $index => $product){
                echo "<tr>",
                    "<td>".$index."</td>",
                    "<td>".$product['name']."</td>",
                    "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                    "<td>".$product['qtt'];
                        ?>
                        <a href='traitement.php?action=down-qtt&id=<?= $index?>'>-</a>
                        <a href="traitement.php?action=up-qtt&id=<?= $index?>">+</a>
                        <?php "</td>",
                    "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                    "<td>"
                        ?>
                        <a href="traitement.php?action=clear&id=<?= $index?>">supprimer</a>
                        <?php
                    "</tr>";
                $totalGeneral+= $product['total'];
                $totalArticles += $product['qtt'];
                
                
            }
            echo "<tr>",   
                "<td colspan=4>Total général : </td>",
                "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp,")."&nbsp,€</strong></td>",
                "</tr>",
                "<tr>",
                "<td colspan=4> Nombre total d'articles : </td>",
                "<td><strong>".number_format($totalArticles, 0, ",", "&nbsp,")."</strong></td>",
                "</tr>",
            "</tbody>",
            "</table>";
            ;      

           
            var_dump($_SESSION);
        }
    ?>

    <form action="traitement.php?action=delete" method="post">
        <input type="submit" name="submit" value="Vider le panier">
    </form>


</body>
</html>