<?php
  session_start();

 
/*les formulaire sont utilisés par les utilisateurs pour
  introduire de mauvaise données sur un serveur

  l'utilisateur à travers le devTool il peut modifier le code
  d'un site et risque de provoquer des erreurs voir pire
  pirater le serveur en injectant du code (faille par injection de code)
  ex.SQL injection en ecrivant du SQL dans un champ afin de faire exécuter 
  cela par la base de données). on doit donc verifier l'integralité des valeurs
  transmises dans le teableau $_POST :*/
  /*le premier filtre supprime une chaine de caractere de toute présence de caractere donc
   pas d'injection de code HTML possible!
  le deuxieme filtre validera le prix que s'il est un nombre à virgule 
  le troisème ne validera la quantité que si celle-ci est un nombre entier,au moins égal à 1.
  */
   if(isset($_POST['submit'])){
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, "price" , FILTER_VALIDATE_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
    $qtt = filter_input(INPUT_POST, "qtt" ,FILTER_VALIDATE_INT); 
/*à la suite de ça , on doit veirfier si les filtres ont functionés*/  
   

//contiennent respectivement les valeurs nettoyées et/ou validées du formulaire
if($name && $price && $qtt){
// ajout tableau product = clé 
     $product = [
        "name" => $name,
        "price" => $price,
        "qtt" => $qtt,
        "total" => $price*$qtt
     ];
// PHP crée automatiquement une session pour associer le tableau "products" à cette clé
   //  et que la session lui même est un tableau
     if(!isset($_SESSION['products'])) {
      $_SESSION['products'] = [];
     }

     $_SESSION['products'][] = $product; 
     }
   }

 header("Location: index.php");
 exit();
?>
  