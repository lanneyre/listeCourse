<?php
require_once 'include/config.php';
require_once 'include/Autoloader.php';
Autoloader::register();


if(isset($_POST['InsertProduit'])){
    $produit = new Produit($_POST['nom'], $_POST['prix_unit']);
    if($produit->store()){
        header("Location: index.php?statut=produitInsertOk");
    } else {
        header("Location: index.php?statut=produitInsertKo");
    }
    exit;
}

if(isset($_POST['InsertMagasin'])){
    $magasin = new Magasin($_POST['nom'], $_POST['contact']);
    if($magasin->store()){
        header("Location: index.php?statut=magasinInsertOk");
    } else {
        header("Location: index.php?statut=magasinInsertKo");
    }
    exit;
}