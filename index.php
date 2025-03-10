<?php
session_start();
$nombreProduits = isset($_SESSION['panier']) ? count($_SESSION['panier']) : 0;
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);
?>

!DOCTYPE html>
<html lang= "fr">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Ajout produit</title>
</head>
<body>
<div class="container">
        <h1>Bienvenue sur la page d'accueil</h1>
        <p>Ceci est un exemple de page d'accueil.</p>
        <a href="recap.php" class="button">Voir le récapitulatif</a>
        <!--  <div class="container">
        <?php if ($message): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?> -->
        <!-- Contenu de votre formulaire -->
    </div> 
    </div>
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="recap.php">Recap</a>
        <a href="#">Produits en session: <?php echo $nombreProduits; ?></a>
        <!-- <span style="float:right; padding: 14px 16px;">Produits en session: <?php echo $nbProduits; ?></span> -->
    </div>
    <h1>Ajouter un produit</h1>
    <!-- balise <form> comporte deux attributs: -->
    <!--action=le fichier à atteindre lorsque l'user soumettra le formulaire.
        méthod= précise par quelle méthode HTTP données de formulaire seront transmises au serveur--> 
    <form action="traitement.php?action=add" method="post">
        <p>
            <label>
                Nom du produit:
                <input type="text" name="name">
            </label>
        </p>
        <p>
            <label>
                Prix du produit:
                <input type="number" step="any" name="price">
            </label>
        </p>
        <p>
            <label>
                Quantité désirée :
                <input type="number" name="qtt" value="1">
            </label>
        </p>
        <p>
            <!-- le bouton de soumission"Submit" du formumaire, contient lui aussi un attribut "name".
             Cela nous permettra de vérifier côté serveur que le formulaire a bien été validé 
             par l'utilisateur -->
            <input type="submit" name="submit" value="Ajouter le produit">
        </p>
</form>

</body>
</html>

