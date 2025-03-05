<?php
    session_start(); // démarrage d'une nouvelle session ou récupération d'une session existante via l'identifiant de session (cookie)


// vérification de la clé 'submit' dans le tableau $_POST pour limiter l'accès à 'traitement.php'
// le bouton de soumission du formulaire dispose de la clé en attribut 'name=' donc pas d'accès à 'traitement.php' autrement qu'avec le bouton du formulaire 

   if(isset($_GET['action'])){
   

        // action à effectuer en fonction de ce qui est demander
        switch($_GET['action']){
            case "add":
                if(isset($_POST['submit'])){ // soumission du formulaire 
                                   
                    // filtrage des données entrées dans le fomulaire pour s'assurer qu'elles correspondent à ce qui est attendu (eviter injection de code)
                    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS); // chaine de caractère sans caractères spéciaux
                    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION); // nombre à virgule avec ',' ou '.' permis pour les décimales
                    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT); // nombre entier différent de zéro                  
            
                    // vérification de la validité des variables après filtrage
                    if($name && $price && $qtt){
            
                        $product = [ // stockage des données en session dans un tableau associatif '$product'
                            "name"  => $name,
                            "price" => $price,
                            "qtt"   => $qtt,
                            "total" => $price*$qtt
                        ];

                        $_SESSION['products'][] = $product; // enregistrement du produit '$product' dans le tableau $_SESSION avec la clé 'products'
                        $_SESSION['enregistrement'] = "Le produit à été enregistré avec succès !";
                    } else //si le produit n'est pas enregistré
                    $_SESSION['enregistrement'] = "Le produit n'a pas pu être enregistré !";
                }                 
                break;

            case "delete": // vider le panier
                unset($_SESSION["products"]);
                break;
            case "clear": // supprimer un produit
                unset($_SESSION["products"][$_GET['id']]);
                break;
            case "up-qtt": // augmenter la quantité d'un produit
                $_SESSION["products"][$_GET["id"]]["qtt"]++;
                $_SESSION["products"][$_GET["id"]]["total"] = $_SESSION["products"][$_GET["id"]]["qtt"]*$_SESSION["products"][$_GET["id"]]["price"];
                break;
            case "down-qtt": // diminuer la quantité d'un produit
                $_SESSION["products"][$_GET["id"]]["qtt"]--;
                $_SESSION["products"][$_GET["id"]]["total"] = $_SESSION["products"][$_GET["id"]]["qtt"]*$_SESSION["products"][$_GET["id"]]["price"];
                break;
        }
   }




    header("Location:index.php"); // redirection vers 'index.php' - page "par défaut" (fonction header)
                                    //suite à la soumission du formulaire ou en cas d'accès à 'traitement' sans valider la vérification de la clé
  
  
    