<?php
    session_start(); // récupération de la session pour consulter le tableau de session
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Ajout produit</title>
    </head>
    <body>
        <nav> <!-- barre de navigation -->
            <a href = "index.php">INDEX</a>
            <a href = "recap.php">RECAP</a>
        </nav>
        <h1>Ajouter un produit</h1>
        <form action="traitement.php?action=add" method="post"> <!-- cible le fichier traitement.php pour soumettre le formulaire en utilisant la méthode POST -->
            <p>
                <label>
                    Nom du produit :
                    <input type="text" name="name"> <!-- premier champ du formulaire -->
                </label>
            </p>
            <p>
                <label>
                    Prix du produit :
                    <input type="number" step="any" name="price"> <!-- deuxième champ du formulaire -->
                </label>
            </p>
            <p>
                <label>
                    Quantité désirée :
                    <input type="number" name="qtt" value="1"> <!--troisième champ du formulaire -->
                </label>
            </p>
            <p>
                <input type="submit" name="submit" value="Ajouter le produit"> <!-- bouton pour soumettre le formulaire -->
            </p>
        </form>     

        <p>
            <!-- message de confirmation de l'enregistrement du produit -->
            <?php echo $_SESSION['enregistrement'];
             ?> 
        </p>
        
    </body>
</html>











