<?php

class Magasin extends Pratique{
    protected static $_table = 'magasin';
    
    public function getProduits(){

        return Database::selectByJoin("magasin", "produit", "liste", "id_magasin=$this->id_magasin");

    }
}