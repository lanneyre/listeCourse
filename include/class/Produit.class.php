<?php

class Produit extends Pratique{
    protected static $_table = 'produit';
    
    public function getMagasins(){

        return Database::selectByJoin("produit", "magasin", "liste", "id_produit=$this->id_produit");

    }
}