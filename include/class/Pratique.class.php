<?php
abstract class Pratique{
    
    protected static $_table = '';
    protected $data = [];

    public static function getAll(){
        return Database::selectAll(static::$_table);
    }

    public static function getById($id){
        if(is_int($id)){
            return Database::selectAll(static::$_table, "id_".static::$_table."=$id", false);
        } 
        return false;
    }

    public function store(){
        return Database::insert(static::$_table, $this->data);
    }
}