<?php

class Produit extends Pratique{
    protected static $_table = 'produit';
    public $id_produit;
    public $nom;
    public $prix_unit;
    
    public function getMagasins(){
        return Database::selectByJoin("magasin", "liste", "id_produit=$this->id_produit");
    }

    public static function Build($nom = "", $prix_unit = 1, $id_produit = null){
        $obj = new static;
        $obj->nom = $nom;
        $obj->prix_unit = $prix_unit;
        $obj->id_produit = $id_produit;
        $obj->createData();
        return $obj;
    }

    public function createData(){
        $this->data["id_produit"] = $this->id_produit;
        $this->data["nom"] = $this->nom;
        $this->data["prix_unit"] = $this->prix_unit;
    }
}