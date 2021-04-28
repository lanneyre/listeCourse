<?php

class Magasin extends Pratique{
    protected static $_table = 'magasin';
    
    public function getProduits(){

        return Database::selectByJoin("produit", "liste", "id_magasin=$this->id_magasin");

    }

    public function __construct($nom = "", $contact = ""){
        $this->nom = $nom;
        $this->contact = $contact;
        $this->createData();
    }
    
    private function createData(){
        $this->data["nom"] = $this->nom;
        $this->data["contact"] = $this->contact;
    }
}