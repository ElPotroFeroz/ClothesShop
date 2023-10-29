<?php

class Categoria{
    private $id;
    private $nombre;
    private $db;
    
    public function __construct(){
        $this->db = Database::connect();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNombre($nombre): void {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function getAll() {
        $all_categorias = $this->db->query("SELECT * FROM categorias ORDER BY id DESC;");
        if($all_categorias) {
        return $all_categorias;
        } else {
            return null;
        }
    }
    
    public function getOne() {
        $categoria = $this->db->query("SELECT * FROM categorias WHERE id = {$this->getId()};");
        if($categoria && $categoria->num_rows > 0) {
            return $categoria->fetch_object();
        } else {
            return null;
        }
    }
    
    public function save() {
        $sql = "INSERT INTO categorias VALUES(null, '{$this->getNombre()}');";
        $save = $this->db->query($sql);
        
        $result = false;
        if($save) {
            $result = true;
        }
        return $result;
    }
    
    public function delete($nombre_delete) {
        $sql = "DELETE FROM categorias WHERE nombre = '$nombre_delete';";
        $delete = $this->db->query($sql);
    
        $result = false;
        if($delete) {
            $result = true;
        }
        return $result;
    }
    
}
