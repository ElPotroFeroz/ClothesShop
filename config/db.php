<?php

class Database{
    public static function connect(){
        //$db = new mysqli('localhost', 'root', '', 'tienda_master');
        $db = new mysqli('localhost', 'u321563526_admin', '6cDhdM6[', 'u321563526_shop_clothes');
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}