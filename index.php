<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Ajout produit</title>
    </head>
    <body>
        
        <h1>Ajouter un produit</h1>
        <form action="traitement.php" method="post"> <!-- cible le fichier traitement.php pour soumettre le formulaire en utilisant la méthode POST -->
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
        
    </body>
</html>




<!--
* barre de navigation entre index et recap
* afficher le nombre total d'article en session (count)
* afficher message de traitement.php sur index en fonction d'erreur ou de succès
* 3 fonctionnalités dans recap.php avec SWITCH
    - supprimer un produit au choix
    - supprimer tous les produits d'un coup
    - modifier quantité produits + message notification











