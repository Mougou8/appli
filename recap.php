<?php
/*ici nous aurons besoin de parcourir le tableau de session donc on appelle la function
session_start() pour recuperer la session de l'utilisateur */

session_start();
$nombreProduits = isset($_SESSION['panier']) ? count($_SESSION['panier']) : 0;
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);
    ?>
   
<!-- Permet d'afficher de manière organisée et exhaustive la liste des produits 
 présents en session. Elle doit également présenter le total de l'ensemble de ceux-ci. -->

<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Recapitulatif des produits</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
      <div class="navbar">
        <a href="index.php">Home</a>
        <a href="recap.php">Recap</a>
        <a href="#">Produits en session: <?php echo $nombreProduits; ?></a>
        <span style="float:right; padding: 14px 16px;">Produits en session: <?php echo $nbProduits; ?></span>
    </div>
       <?php 
      
       // Ajout d'une condition qui vérifie: soit la clé "products" du tableau de session n'existe pas:!isset(),
       // soit cette clé existe mais ne contient aucune donnée: empty()
            if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
        echo "<p>Aucun produit en session... </p> ";
       }
       else {
        echo "<table>",// affichage des produits dans le tableau HTML<table> à 
                       //  une liste de données ordonné est bien décomposée
               "<thead>",
                 "<tr>",
                    "<th>#</th>",
                    "<th>Nom</th>",
                    "<th>Prix</th>",
                    "<th>Quantié</th>",
                    "<th>Total</th>",
                 "</tr>",
                "</thead>",
                "<tbody>";
        $totalGeneral = 0; 
        // la boucle itérative foreach(), particulièrement efficace pour exécuter, produit par produit,
        // les mêmes intructions permerttront à l'affichage uniforme de chacun d'entre eux.
        //Dispositions au sein de la boucle de deux variables pour chaque donnée dans $_SESSION['products']     
        foreach ($_SESSION['products'] as $index => $product){
         echo "<tr>",
         //sert à numéroter chaque produit dans le tableau HTML
                  "<td>".$index."</td>",
         // Cette variable contiendra le produit, sous forme de tableau,tel que l'a créé
         // et stocké en sesssion le fichier traitement.php.        
                  "<td>".$product['name']."</td>",
                  // La fonction number_format est souvent utilisée pour afficher des prix, des statistiques 
                  // ou tout autre type de données numériques de manière plus lisible pour les utilisateurs.
                  "<td>".number_format($product['price'],2,",","&nbsp;")."&nbsp;€</td>",
                  "<td>".$product['qtt']."</td>",
                  "<td>".number_format($product['total'],2,",","&nbsp;")."&nbsp;€</td>",
              "</tr>";
         $totalGeneral += $product['total']; 
        }
        echo "<tr>",
        // L'attribut colspan est utilisé dans les balises <td> ou <th> pour indiquer combien de colonnes 
        // une cellule doit occuper dans un tableau HTML. Cela permet de fusionner plusieurs colonnes en une seule cellule.
                "<td colspan=4>Total général : </td>",
                "<td><strong>".number_format($totalGeneral,2,",", "&nbsp;")."&nbsp;€</strong></td>",
            "</tr>",
         "</tbody>",
         "</table>";
       }     
       ?> 
    </body>
    </html>
    <!-- Une session contient les données stockées dans la session utilisateur côté serveur. -->
    <!-- Une session en PHP correspond à une façon de stocker des données différentes pour 
     chaque utilisateur en utilisant un identifiant de session unique. -->
    <!-- Un des grands intérêts des sessions est qu'on va pouvoir conserver des informations pour
      un utilisateur lorsqu'il navigue d'une page à une autre.  -->

    <!-- Superglobales = PHP dispose de plusieurs variables dites "Superglobales" pour accéder à 
     toutes les informations pouvant être transmises par le client au serveur. -->
    <!-- Toute les superglobales sont du type tableau, proposant ainsi une manière simple d'y 
     regrouper plusieurs informations sous forme de paires "clé / valeur". -->

      <!-- $_POST = liée à la méthode HTTP POST, contient toutes les données transmises au serveur
        par l'intermediaire de l'URL d'un formulaire -->

        <!-- Un tableau associé est un tableau qui va utiliser des clés textuelles 
         qu'on va associer à chaque valeur. -->

         <!-- Faille XSS(cross Site Scripting)est une faille qui permet d'injecter 
          du code HTML et/ou Javscript dans des variables ou des bases de données mal protégées -->

          <!--Protection de la Faille XSS = plusieurs moyens et des étapes à suivre:
            filtrer et valider les entrées utilisateur (filter_input sur le $name en faisant la soumission) 
            utiliser des en-têtes HTTp appropriés avec "header"
            protéger les zones sensibles -->