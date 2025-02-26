<!DOCTYPE html>
<html lang= "fr">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content="width=device-width, initial-scale=1.0">

        <title>Ajout produit</title>
</head>
<body>

    <h1>Ajouter un produit</h1>
    <!--action=fichier à atteindre lorsque l'user soumettra le formulaire
        méthod=par quelle méthode HTTP données de formulaireseront transmises au serveur--> 
    <form action="traitement.php" method="post">
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

