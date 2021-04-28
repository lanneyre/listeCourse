<?php
abstract class Pratique{
    
    protected static $_table = '';

    public static function getAll(){
        return Database::selectAll(static::$_table);
    }

    public static function getById($id){
        if(is_int($id)){
            return Database::selectAll(static::$_table, "id_".static::$_table."=$id");
        } 
        return false;
    }
}