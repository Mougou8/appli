<?php
// cette fonction a deux utilités: démarrer une session sur le serveur pour l'utilisateur courant,
// ou recupérer la session de ce même utitlisateur s'il en avait déjà une.
// La 2ème fonctionnalité: au démarrage d'une session , le serveur enregistrera un cookie PHPSESSID
//dans le navitagateur client,contenant l'identifiant de la session appartenant à celui-ci.  
  session_start();
  $message = '';

 
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
  // isset() renverra false lors de la vérification d'une variable de valeur nulle. 
 
        if(isset($_POST['submit'])){
          $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
          $price = filter_input(INPUT_POST, "price" , FILTER_VALIDATE_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
          $qtt = filter_input(INPUT_POST, "qtt" ,FILTER_VALIDATE_INT); 
      /*à la suite de ça , on doit veirfier si les filtres ont functionné*/  

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
             if(!isset($_SESSION['product'])) {
              $_SESSION['product'] = [];
             }
        
             $_SESSION['product'][] = $product; 
        
            // Traitement de votre formulaire
        // Exemple : ajout d'un produit en session
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // $produit = $_POST['produit'];
            // $_SESSION['produits'][] = $produit;
             $_SESSION['message'] = "Produit ajouté avec succès !";
             }
           }
          
        // La condition "header" effectue une redirection au formulaire(formulaire soumis ou non)
        // après traitement.
         header("Location: index.php");
         }  
      
        if(isset($_GET['action'])) {

        switch($_GET['action']){

        case "add":
        //  (isset($_GET['article'])){
        //   ajouterAuPanier($_GET['article']);
          echo "ajouter article au panier.";
          break;
        case "delete":
          echo " produit supprimé.";
          break;
        case "clear":
          // Supprimer le panier 
          unset($_SESSION['product']); 
          break;
        case "up-qtt":
          // Modifier les quantités de chaque produit grâce au plus
          $_SESSION ['product'][$_GET['id']]['qtt'] ++;
          // Renvoie à la page recap.php 
          header("Location: recap.php");
           break;

        case "down-qtt":
          // Modifier les quantités de chaque produit grâce au moins
          if ($_SESSION ['product'][$_GET['id']] ['qtt'] >1) {

            $_SESSION ['product'][$_GET['id']] ['qtt'] --;
          }

          //Renvoie à la page recap.php 
         header("Location: recap.php");
        break;

       }

      }

   

//   $action = isset($_GET['action']) ? $_GET['action'] : '';

// switch ($action) {
//     case 'add':
//         // Ajouter un produit au panier
//         $products = $_GET['products'];
//         $_SESSION['panier'][] = $products;
//         break;
//     }  

    //contiennent respectivement les valeurs nettoyées et/ou validées du formulaire

?>
  