<?php

class Magasin extends Pratique{
    protected static $_table = 'magasin';
    
    public function getProduits(){

        return Database::selectByJoin("magasin", "produit", "liste", "id_produit=$this->id_produit");

    }
}