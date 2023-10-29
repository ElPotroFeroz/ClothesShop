<?php
require_once 'models/producto.php';

class ProductoController{
    public function index() {
        $productos = new Producto();
        $all_products = $productos->getAll();
        require_once 'views/producto/destacados.php';
    }
    
    public function gestion() {
        Utils::isAdmin();   //Directory helpers
        
        $producto_obj = new Producto();
        $productos = $producto_obj->getAll();
        
        require_once 'views/producto/gestion.php';
    }
    
    public function create() {
        Utils::isAdmin();   //Directory helpers
        require_once 'views/producto/create.php';
    }
    
    public function save() {
        //Here we reutiliced the code for save to add edit also in the same method
        Utils::isAdmin();   //Directory helpers
        if(isset($_POST)) {
            $name = isset($_POST['name']) ? $_POST['name'] : false;
            $description = isset($_POST['description']) ? $_POST['description'] : false;
            $price = isset($_POST['price']) ? $_POST['price'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            
            if($name && $description && $price && $stock && $categoria) {
                $producto = new Producto();
                $producto->setName($name);
                $producto->setDescription($description);
                $producto->setPrice($price);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);
                
                //save image
                if(isset($_FILES['file'])) {
                    $file = $_FILES['file'];
                    //Where we save the files
                    $uploadDirectory = 'uploadd/';
                    
                    // Verify if directory exists
                    if (!file_exists($uploadDirectory)) {
                        mkdir($uploadDirectory, 0777, true);
                    }
                    
                    // Obtain the name of the directory and his temporal ubi
                    $fileName = $file['name'];
                    $tmpName = $file['tmp_name'];

                    // Move the file to the destination directory
                    $destination = $uploadDirectory . $fileName;

                    if (move_uploaded_file($tmpName, $destination)) {
                        $_SESSION['image'] = "La imagen se ha subido correctamente a la carpeta '$uploadDirectory'.";
                        $producto->setImage($fileName);
                    } else {
                        $_SESSION['image'] = "failed";
                    }
                }
                
                if(isset($_GET['id'])) { //If the user is going to edit
                    $id = $_GET['id'];
                    $producto->setId($id);
                    $_SESSION['edit'] = true;
                    $save = $producto->edit();
                } else { //If the user is creating a new product           
                $save = $producto->save();
                }
                
                if($save) {
                    $_SESSION['producto'] = "complete";
                } else {
                    $_SESSION['producto'] = "failed";
                }
            } else {
                $_SESSION['producto'] = "failed";
            }
        } else {
            $_SESSION['producto'] = "failed";
        }
        header('Location:'.BASE_URL.'producto/gestion');
    }
    
    public function editar() {
        Utils::isAdmin();   //Directory helpers
        if(isset($_GET)) {
            $id = $_GET['id'];
            $edit = true;
            $object_product = new Producto();
            $object_product->setId($id);
            $mi_producto = $object_product->getOne();
            if(is_object($mi_producto)) {
                require_once 'views/producto/create.php';
            }
        }
    }
    
    public function eliminar() {
        Utils::isAdmin();   //Directory helpers
        
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $object_product = new Producto();
            $object_product->setId($id);
            $delete = $object_product->delete();
            if($delete) {
                header('Location:'.BASE_URL.'producto/gestion');
                } 
            else {
                $_SESSION['error_delete'] = "Error al intentar eliminar el producto";                      
            }
        } else {
            $_SESSION['error_delete'] = "Error al intentar eliminar el producto";
        }
        header('Location:'.BASE_URL.'producto/gestion');
    }
    
    public function ver() {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            
            $object_product = new Producto();
            $object_product->setId($id);
            $producto = $object_product->getOne();
            $query_category = $object_product->getAllCategory();
            if($query_category) {
                $nombre_categoria = $query_category->fetch_object();
            } else {$nombre_categoria = false; }
        }
        require_once 'views/producto/ver.php';
    }
    
}