<?php
    session_start(); // démarrage d'une nouvelle session ou récupération d'une session existante via l'identifiant de session (cookie)


// vérification de la clé 'submit' dans le tableau $_POST pour limiter l'accès à 'traitement.php'
// le bouton de soumission du formulaire dispose de la clé en attribut 'name=' donc pas d'accès à 'traitement.php' autrement qu'avec le bouton du formulaire 
                 

   if(isset($_GET['action'])){
   
        switch($_GET['action']){
            case "add":
                if(isset($_POST['submit'])){ 
                                   
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
                    } else
                    // $enregistrement = ;
                    $_SESSION['enregistrement'] = "Le produit n'a pas pu être enregistré !";
                }                 
                break;

            case "delete":
                unset($_SESSION["products"]);
            case "clear":
                unset($_SESSION["products"][$_GET['id']]);
            case "up-qtt":
                $_SESSION["products"][$_GET['qtt']]++;
            case "down-qtt":
                $_SESSION["products"][$_GET['qtt']]--;
        }
   }




    header("Location:index.php"); // redirection vers 'index.php' - page "par défaut" (fonction header)
                                    //suite à la soumission du formulaire ou en cas d'accès à 'traitement' sans valider la vérification de la clé
  
  
    