<?php
    require_once "include/app.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste Course</title>
</head>
<body>
    <section id="Read">
        <form action="" method="post" id="formProduit">
            <h2>Liste des produits</h2>
            <select name="Produits" id="Produits">
                <option value="" disabled selected>-- Choisir un produit --</option>
                <?php foreach(Produit::getAll() as $produit) { 
        ?>      <option value="<?php echo $produit->id_produit; ?>"> <?php echo $produit->nom;?></option>
        <?php
                } ?>
            </select>
        </form>
        <?php
        if(!empty($_POST['Produits'])){ 
            $produit = Produit::getById((int)$_POST['Produits']);
        ?>
        <h2>Liste de magasin par produit : <?php echo $produit->nom; ?></h2>
        <ul>
            <?php //var_dump($magasin->getProduits()); ?>
            <?php foreach($produit->getMagasins() as $mag) { 
                
    ?>      <li><?php echo ucfirst($mag->nom); ?> : <?php echo $mag->quantite; ?> </li>
    <?php
            } ?>
        </ul>
        <?php }
        ?>


        <form action="" method="post" id="formMagasin">
            <h2>Liste des Magasins</h2>
            <select name="Magasins" id="Magasins">
                <option value="" disabled selected>-- Choisir un magasin --</option>
                <?php foreach(Magasin::getAll() as $magasin) { 
        ?>      <option value="<?php echo $magasin->id_magasin; ?>"> <?php echo $magasin->nom;?></option>
        <?php
                } ?>
            </select>
        </form>
        <?php
        if(!empty($_POST['Magasins'])){ 
            $magasin = Magasin::getById((int)$_POST['Magasins']);
            $total = 0;
        ?>
        <h2>Liste de produit du magasin : <?php echo $magasin->nom; ?></h2>
        <ul>
            <?php //var_dump($magasin->getProduits()); ?>
            <?php foreach($magasin->getProduits() as $prod) { 
                $total += $prod->prix_unit*$prod->quantite;
    ?>      <li><?php echo ucfirst($prod->nom); ?>(<?php echo $prod->prix_unit; ?> * <?php echo $prod->quantite; ?>) : <?php echo $prod->prix_unit*$prod->quantite; ?>€ </li>
    <?php
            } ?>
        </ul>
        <h3>Total des courses : <?php echo $total; ?>€</h3>
        <?php }
        ?>

        <script type="text/javascript">
        document.getElementById("Magasins").addEventListener("change", function(e){
            document.getElementById("formMagasin").submit();
        });
        document.getElementById("Produits").addEventListener("change", function(e){
            document.getElementById("formProduit").submit();
        });
        </script>
    </section>

    <section id="Insert">
        <h2>Insertion Produit</h2>
        <form action="" method="POST" id="InsertProduit">
            <label for="insertNomProduitID"><input type="text" name="nom" id="insertNomProduitID" value="" placeholder="Nom du produit" required>
            <label for="insertPrix_unitProduitID"><input type="number" name="prix_unit" id="insertPrix_unitProduitID" value="" placeholder="Prix du produit" required>
            <br>
            <input type="submit" value="Insérer" name="InsertProduit">
            <input type="reset" value="Annuler">
        </form>

        <h2>Insertion Magasin</h2>
        <form action="" method="POST" id="InsertMagasin">
            <label for="insertNomMagasinID"><input type="text" name="nom" id="insertNomMagasinID" value="" placeholder="Nom du magasin" required>
            <label for="insertcontactMagasinID"><input type="text" name="contact" id="insertcontactMagasinID" value="" placeholder="contact du magasin" required>
            <br>
            <input type="submit" value="Insérer" name="InsertMagasin">
            <input type="reset" value="Annuler">
        </form>
    </section>
</body>
</html>