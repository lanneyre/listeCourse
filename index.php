<?php
    require_once "include/app.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Liste Course</title>
</head>
<body>
    <fieldset>
        <legend>Read</legend>
        <section>
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
                <?php foreach($produit->getMagasins() as $mag) { 
                    
        ?>      <li><?php echo ucfirst($mag->nom); ?> : <?php echo $mag->quantite; ?> </li>
        <?php
                } ?>
            </ul>
            <?php }
            ?>
        </section>
        <section>
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
    </fieldset>
    
    <fieldset>
        <legend>Insert</legend>
        <section>
        <h2>Insertion Produit</h2>
            <form action="" method="POST" id="InsertProduit">
                <label for="insertNomProduitID"><input type="text" name="nom" id="insertNomProduitID" value="" placeholder="Nom du produit" required>
                <label for="insertPrix_unitProduitID"><input type="number" name="prix_unit" id="insertPrix_unitProduitID" value="" placeholder="Prix du produit" required>
                <br>
                <input type="submit" value="Insérer" name="InsertProduit">
                <input type="reset" value="Annuler">
            </form>
        </section>
        <section>
            <h2>Insertion Magasin</h2>
            <form action="" method="POST" id="InsertMagasin">
                <label for="insertNomMagasinID"><input type="text" name="nom" id="insertNomMagasinID" value="" placeholder="Nom du magasin" required>
                <label for="insertcontactMagasinID"><input type="text" name="contact" id="insertcontactMagasinID" value="" placeholder="contact du magasin" required>
                <br>
                <input type="submit" value="Insérer" name="InsertMagasin">
                <input type="reset" value="Annuler">
            </form>
        </section>
    </fieldset>

    <fieldset>
        <legend>Delete</legend>
        <section>
            <h2>Liste des produits</h2>
            <form action="" method="post">
                <select name="Produits" id="ProduitsToDelete" required>
                    <option value="" disabled selected>-- Choisir un produit --</option>
                    <?php foreach(Produit::getAll() as $produit) { 
            ?>      <option value="<?php echo $produit->id_produit; ?>"> <?php echo $produit->nom;?></option>
            <?php
                    } ?>
                </select>
                <br>
                <input type="submit" value="Supprimer" name="DeleteProduit">
            </form>
        </section>
        <section>
            <h2>Delete des Magasins</h2>
            <form action="" method="post">
                <select name="Magasins" id="MagasinsToDelete" required>
                    <option value="" disabled selected>-- Choisir un magasin --</option>
                    <?php foreach(Magasin::getAll() as $magasin) { 
            ?>      <option value="<?php echo $magasin->id_magasin; ?>"> <?php echo $magasin->nom;?></option>
            <?php
                    } ?>
                </select>
                <br>
                <input type="submit" value="Supprimer" name="DeleteMagasin">
            </form>
        </section>
    </fieldset>

    <fieldset>
        <legend>Edit</legend>
        <section>
            <form action="" method="post" id="formEditProduit">
                <h2>Liste des produits</h2>
                <select name="EditProduits" id="EditProduits" required>
                    <option value="" disabled selected>-- Choisir un produit --</option>
                    <?php foreach(Produit::getAll() as $produit) { 
            ?>      <option value="<?php echo $produit->id_produit; ?>"> <?php echo $produit->nom;?></option>
            <?php
                    } ?>
                </select>
            </form>
            <?php
            if(!empty($_POST['EditProduits'])){ 
                $produit = Produit::getById((int)$_POST['EditProduits']);
            ?>
            <h2>Edition du produit : <?php echo $produit->nom; ?></h2>
            <form action="" method="POST" id="FormEditProduit">
                <label for="editNomProduitID"><input type="text" name="nom" id="editNomProduitID" value="<?php echo $produit->nom; ?>" placeholder="Nom du produit" required>
                <label for="editPrix_unitProduitID"><input type="number" name="prix_unit" id="editPrix_unitProduitID" value="<?php echo $produit->prix_unit; ?>" placeholder="Prix du produit" required>
                <br>
                <input type="hidden" value="<?php echo $produit->id_produit; ?>" name="id_produit">
                <input type="submit" value="Modifier" name="FormEditProduit">
                <input type="reset" value="Annuler">
            </form>
            <?php }
            ?>
        </section>
        <section>
            <form action="" method="post" id="formEditMagasin">
                <h2>Liste des Magasins</h2>
                <select name="EditMagasins" id="EditMagasins" required>
                    <option value="" disabled selected>-- Choisir un magasin --</option>
                    <?php foreach(Magasin::getAll() as $magasin) { 
            ?>      <option value="<?php echo $magasin->id_magasin; ?>"> <?php echo $magasin->nom;?></option>
            <?php
                    } ?>
                </select>
            </form>
            <?php
            if(!empty($_POST['EditMagasins'])){ 
                $magasin = Magasin::getById((int)$_POST['EditMagasins']);
            ?>
            <h2>Edition du magasin : <?php echo $magasin->nom; ?></h2>
            <form action="" method="POST" id="FormEditMagasin">
                <label for="editNomMagasinID"><input type="text" name="nom" id="editNomMagasinID" value="<?php echo $magasin->nom; ?>" placeholder="Nom du magasin" required>
                <label for="editContactMagasinID"><input type="text" name="contact" id="editContactMagasinID" value="<?php echo $magasin->contact; ?>" placeholder="Contact du magasin">
                <br>
                <input type="hidden" value="<?php echo $magasin->id_magasin; ?>" name="id_magasin">
                <input type="submit" value="Modifier" name="FormEditMagasin">
                <input type="reset" value="Annuler">
            </form>
            <?php }
            ?>

            <script type="text/javascript">
            document.getElementById("EditMagasins").addEventListener("change", function(e){
                document.getElementById("formEditMagasin").submit();
            });
            document.getElementById("EditProduits").addEventListener("change", function(e){
                document.getElementById("formEditProduit").submit();
            });
            </script>
        </section>
    </fieldset>
</body>
</html>