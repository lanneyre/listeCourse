<?php

class Magasin extends Pratique{
    protected static $_table = 'magasin';
    public $id_magasin;
    public $nom;
    public $contact;
    
    public function getProduits(){

        return Database::selectByJoin("produit", "liste", "id_magasin=$this->id_magasin");

    }

    public static function build($nom = "", $contact = "", $id_magasin = null){
        $obj = new static;
        $obj->nom = $nom;
        $obj->contact = $contact;
        $obj->id_magasin = $id_magasin;
        $obj->createData();
        return $obj;
    }
    
    public function createData(){
        $this->data["id_magasin"] = $this->id_magasin;
        $this->data["nom"] = $this->nom;
        $this->data["contact"] = $this->contact;
    }
}