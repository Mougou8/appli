<?php
/*ici nous aurons besoin de parcourir le tableau de session donc on appelle la function
session_start() pour recuperer la session de l'utilisateur */

session_start();
    ?>
   
<!-- Permet d'afficher de manière organisée et exhaustive la liste des produits 
 présents en session. Elle doit également présenter le total de l'ensemble de ceux-ci. -->

<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Recapitulatif des produits</title>
    </head>
    <body>
       <?php 
       // Ajout d'une condition qui vérifie: soit la clé "products" du tableau de session n'existe pas:!isset(),
       // soit cette clé existe mais ne contient aucune donnée: empty()
            if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
        echo "<p>Aucun produit en session... </p> ";
       }
       else {
        echo "<table>",// affichage des produits dans le tableau HTML<table> à 
                       //  une liste de données ordonné eet bien décomposée
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
                  "<td>".number_format($product['price'],2,",","&nbsp;")."&nbsp;€</td>",
                  "<td>".$product['qtt']."</td>",
                  "<td>".number_format($product['total'],2,",","&nbsp;")."&nbsp;€</td>",
              "</tr>";
         $totalGeneral += $product['total']; 
        }
        echo "<tr>",
                "<td colspan=4>Total général : </td>",
                "<td><strong>".number_format($totalGeneral,2,",", "&nbsp;")."&nbsp;€</strong></td>",
            "</tr>",
         "</tbody>",
         "</table>";
       }     
       ?> 
    </body>
    </html>