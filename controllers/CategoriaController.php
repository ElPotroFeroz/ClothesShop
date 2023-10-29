<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';

class CategoriaController{
    public function index() {
        Utils::isAdmin();
        $all_categorias = new Categoria;
        $categorias = $all_categorias->getAll();
        
        require_once 'views/categorias/index.php';
    }
    
    public function create() {
        Utils::isAdmin();
        require_once 'views/categorias/create.php';
    }
    
    public function save() {
        Utils::isAdmin();
        
        if(isset($_POST['name'])) {
            //Save categoria
            $categoria = new Categoria();
            $categoria->setNombre($_POST['name']);
            $save = $categoria->save();
        }
        header('Location:'.BASE_URL.'categoria/index');
    }
    
    public function delete() {
        Utils::isAdmin();
        
        if(isset($_POST['delete'])) {
            //delete categoria
            $nombre = $_POST['delete'];
            $categoria = new Categoria();
            $delete = $categoria->delete($nombre);
        }
        if($delete) {
            header('Location:'.BASE_URL.'categoria/index');
        } else {
            $_SESSION['error_delete'] = "No se ha encontrado la categoria que quieres eliminar";
            header('Location:'.BASE_URL.'categoria/create');           
        }
    }
    
    public function ver_productos() {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            //Get category
            $categoria = new Categoria();
            $categoria->setId($id);         //Set the id
            $category = $categoria->getOne(); //Obtain the category that correspons with the id                                           
            
            //Get product
            $producto = new Producto();
            $producto->setCategoria_id($id);
            $productos = $producto->getAllCategory();
        }        
        require_once 'views/categorias/ver_productos.php';        
    }
}