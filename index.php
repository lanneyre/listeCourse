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
<form action="" method="post" id="formMagasin">
    <h2>Liste des produits</h2>
    <select name="Produits" id="produits">
        <?php foreach(Produit::getAll() as $produit) { 
?>      <option value="<?php echo $produit->id_produit; ?>"> <?php echo $produit->nom;?></option>
<?php
        } ?>
    </select>

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
    <h3>Total des courses : <?php echo $total; ?>€</h2>
    <?php }

    ?>

    <script type="text/javascript">
    document.getElementById("Magasins").addEventListener("change", function(e){
        document.getElementById("formMagasin").submit();
    });
    </script>
</body>
</html>