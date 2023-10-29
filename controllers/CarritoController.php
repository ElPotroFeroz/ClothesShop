<?php

require_once 'models/producto.php';

class CarritoController{
    
    public function index() {
        require_once 'views/carrito/index.php';
    }  
    
    public function add() {
        //Add product to the BuyBag(carrito)
        if(isset($_GET['id'])) {
            $producto_id = $_GET['id'];
            
            $producto = new Producto();
            $producto->setId($producto_id);
            $product = $producto->getOne();
        } else {
            header('Location: ' . BASE_URL);
        }
        if(isset($_SESSION['carrito'])) {
            $counter = 0;
            // Recorre el carrito de compras
            foreach($_SESSION['carrito'] as $indice => $elemento) {
                if($elemento['id_producto'] == $producto_id) {
                    // Verifica si la clave "unidades" existe en el elemento actual
                    if(isset($_SESSION['carrito'][$indice]['unidades']) && $_SESSION['carrito'][$indice]['unidades'] < $product->stock) {
                        $_SESSION['carrito'][$indice]['unidades']++;
                    } 
                    if($_SESSION['carrito'][$indice]['unidades'] == $product->stock){
                        $_SESSION['error']['stock'] = "Límite de Stock alcanzado";
                    }
                    $counter++;
                }
            }
        }
            if(!isset($counter) || $counter == 0) {
                //Follow product
                if(is_object($product)) {
                    $_SESSION['carrito'][] = array(
                        "id_producto" => $product->id,
                        "nombre" => $product->nombre,
                        "precio" => $product->precio,
                        "unidades" => 1,
                        "producto" => $product
                    );
                }
            }           
        header('Location: ' . BASE_URL . 'carrito/index');
    }
    
    public function remove() {
        if(isset($_GET['index'])) {
            $indice = $_GET['index'];
            unset($_SESSION['carrito'][$indice]);
        }
        header('Location: ' . BASE_URL . 'carrito/index');
    }
    
    public function up_unidades() {
        if(isset($_GET['index'])) {
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']++;
        }
        header('Location: ' . BASE_URL . 'carrito/index');
    }
    
     public function less_unidades() {
        if(isset($_GET['index'])) {
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']--;
            if($_SESSION['carrito'][$index]['unidades'] == 0) {
                unset($_SESSION['carrito'][$index]);
                 header('Location: ' . BASE_URL . 'carrito/index');
            }
        }
        header('Location: ' . BASE_URL . 'carrito/index');
    }
    
    public function delete_all() {
        unset($_SESSION['carrito']);
        header('Location: ' . BASE_URL . 'carrito/index');
    }
}
