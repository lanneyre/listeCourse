<?php

class Produit extends Pratique{
    protected static $_table = 'produit';
    protected $nom;
    protected $prix_unit;
    
    public function getMagasins(){
        return Database::selectByJoin("magasin", "liste", "id_produit=$this->id_produit");
    }

    public function __construct($nom = "", $prix_unit = 1){
        $this->nom = $nom;
        $this->prix_unit = $prix_unit;
        $this->createData();
    }
    
    private function createData(){
        $this->data["nom"] = $this->nom;
        $this->data["prix_unit"] = $this->prix_unit;
    }
}