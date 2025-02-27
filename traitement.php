<?php
// cette fonction a deux utilités: démarrer une session sur le serveur pour l'utilisateur courant,
// ou recupérer la session de ce même utitlisateur s'il en avait déjà une.
// La 2ème fonctionnalité: au démarrage d'une session , le serveur enregistrera un cookie PHPSESSID
//dans le navitagateur client,contenant l'identifiant de la session appartenant à celui-ci.  
  session_start();

 
/*les formulaires sont utilisés par les utilisateurs pour
  introduire de mauvaise données sur un serveur

  l'utilisateur à travers le devTool il peut modifier le code
  d'un site et risque de provoquer des erreurs voire pire
  pirater le serveur en injectant du code (faille par injection de code)
  ex.SQL injection en ecrivant du SQL dans un champ afin de faire exécuter 
  cela par la base de données). on doit donc verifier l'integralité des valeurs
  transmises dans le teableau $_POST :*/
  /*le premier filtre supprime une chaine de caractere de toute présence de caractere donc
   pas d'injection de code HTML possible!
  le deuxieme filtre validera le prix que s'il est un nombre à virgule 
  le troisème ne validera la quantité que si celle-ci est un nombre entier,au moins égal à 1.
  */
  // Vérification de l'existence de la clé "submit" dans le tableau $_POST, cette clé correspond
  // à l'attribut "name" du bouton <input type="submit" name="submit"> du formulaire.
  // $_POST = 
   if(isset($_POST['submit'])){
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, "price" , FILTER_VALIDATE_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
    $qtt = filter_input(INPUT_POST, "qtt" ,FILTER_VALIDATE_INT); 
/*à la suite de ça , on doit veirfier si les filtres ont functionné*/  
   

//contiennent respectivement les valeurs nettoyées et/ou validées du formulaire
if($name && $price && $qtt){
// ajout tableau product = clé 
     $product1 = [
        "name" => "Banane",
        "price" => 1.25,
        "qtt" => 3,
        "total" => $price*$qtt
     ];
     $product2 = [
      "name" => "Pomme",
      "price" => 2.5,
      "qtt" => 10,
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
  
// La condition "header" effectue une redirection au formulaire(formulaire soumis ou non)
// après traitement.
 header("Location: index.php");
 exit();
?>
  