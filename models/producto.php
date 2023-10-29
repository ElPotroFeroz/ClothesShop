<?php

class Producto{
    
    private $id;
    private $categoria_id;
    private $name;
    private $description;
    private $price;
    private $stock;
    private $offer;
    private $date;
    private $image;
    
    private $db;
    
    public function __construct(){
        $this->db = Database::connect();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getCategoria_id() {
        return $this->categoria_id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getStock() {
        return $this->stock;
    }

    public function getOffer() {
        return $this->offer;
    }

    public function getDate() {
        return $this->date;
    }

    public function getImage() {
        return $this->image;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setCategoria_id($categoria_id): void {
        $this->categoria_id = $categoria_id;
    }

    public function setName($name): void {
        $this->name = $this->db->real_escape_string($name);
    }

    public function setDescription($description): void {
        $this->description = $this->db->real_escape_string($description);
    }

    public function setPrice($price): void {
        $this->price = $this->db->real_escape_string($price);
    }

    public function setStock($stock): void {
        $this->stock = $this->db->real_escape_string($stock);
    }

    public function setOffer($offer): void {
        $this->offer = $this->db->real_escape_string($offer);
    }

    public function setDate($date): void {
        $this->date = $date;
    }

    public function setImage($image): void {
        $this->image = $image;
    }

    public function getAll() {
        $sql = "SELECT * FROM productos ORDER BY id DESC;";
        $all_products = $this->db->query($sql);
        return $all_products;
    }
    
    public function getAllCategory() {
        $sql = "SELECT p.*, c.nombre AS 'nombre_categoria' FROM productos p "
                . "INNER JOIN categorias c ON c.id = p.categoria_id "
                . "WHERE p.categoria_id = {$this->getCategoria_id()} "
                . "ORDER BY id DESC;";
        $all_products = $this->db->query($sql);
        return $all_products;
    }
    
    public function save() { //Metod to save a new product
        $sql = "INSERT INTO productos VALUES(null, '{$this->getCategoria_id()}','{$this->getName()}',"
        . " '{$this->getDescription()}', {$this->getPrice()}, {$this->getStock()}, "
        . "null, CURDATE(), '{$this->getImage()}');";
        $save = $this->db->query($sql);
        
        $result_query = false;    //Variable to determine if the query was successful
        if($save) { //If the query is successful then set variable to true
            $result_query = true;
        }
        return $result_query;
    }
    
    public function delete() { //Metod to delete a product
        $sql = "DELETE from productos WHERE id = '$this->id';";
        $delete = $this->db->query($sql);
        return $delete;
    }
    
    public function getOne() { //Metod to find one product and return it
        $sql = "SELECT * FROM productos WHERE id = '$this->id';";
        $product = $this->db->query($sql);
        return $product->fetch_object();
    }
    
    public function edit() { //Metod to edit one product
        $sql = "UPDATE productos SET nombre ='{$this->getName()}', descripcion ='{$this->getDescription()}', "
        . "precio = {$this->getPrice()}, categoria_id = {$this->getCategoria_id()}, stock = {$this->getStock()}";
        //Check if the image is changed
        if($this->getImage() != null) {
            $sql .= ", imagen = '{$this->getImage()}'";
        }
        $sql .= " WHERE id={$this->getId()};"; //Finish query in $sql
        $save = $this->db->query($sql); //Execute the query
        
        $result_query = false;    //Variable to determine if the query was successful
        if($save) { //If the query is successful then set variable to true
            $result_query = true;
        }
        return $result_query;
    }
    
    public function getPaginated($page, $per_page) {
        //Calculate the number of products that have to show
        $offset = ($page - 1) * $per_page;

        //Obtain products of the actual page
        $sql = "SELECT * FROM productos LIMIT $offset, $per_page";
        $result = $this->db->query($sql);

        //Return an object product that contain the objects of the actual page
        if($result) {
            return $result;
        } else {
            return false;
        }
    }
    
    public function count() {
        $sql = "SELECT * FROM productos";
        $result = $this->db->query($sql);
        return count($result->fetch_assoc());
        
    }
    
}