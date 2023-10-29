<?php
require_once 'models/pedido.php';

class PedidoController{
    public function hacerPedido() {
        require_once 'views/pedido/hacer.php';
    }
    
    public function add() {
        if(isset($_SESSION['identity'])) {
            //Save order
            $usuario = $_SESSION['identity'];
            $provincia = $_POST['provincia'] ? $_POST['provincia'] : false;
            $localidad = $_POST['localidad'] ? $_POST['localidad'] : false;
            $direccion = $_POST['direccion'] ? $_POST['direccion'] : false;
            $stats = Utils::statsCarrito();
            $coste = $stats['total'];
          
            if($provincia && $localidad && $direccion) {              
                $pedido = new Pedido();
                $pedido->setUsuario_id($usuario['user']->id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);
               
                $save = $pedido->save();    //save pedido in database
                $save_linea = $pedido->save_linea_pedido(); //save lineas_pedido in database
                  
                if($save && $save_linea) {
                    $_SESSION['pedido_save'] = true;
                    header('Location: '.BASE_URL.'pedido/confirmado');
                } else {
                    $_SESSION['pedido_save'] = false;
                } 
                
            } else {
                $_SESSION['pedido_save'] = false;
            }
        } else {
            header('Location: '.BASE_URL);          
        }
    }
    
    public function confirmado() {
        if (isset($_SESSION['identity'])) {
            $usuario = $_SESSION['identity'];
            $obj_pedido = new Pedido();
            $obj_pedido->setUsuario_id($usuario['user']->id);

            $pedido_info = false;
        
            if (isset($_COOKIE['pedido_info']) && $_COOKIE['pedido_info'] !== '') {
                $deserialized_data = json_decode($_COOKIE['pedido_info'], true);
                
                if (is_array($deserialized_data)) {
                    $pedido_info = $deserialized_data;
                }           
               
            if ($pedido_info !== false && $pedido_info['id'] == $usuario['user']->id) {
                // Los datos en la cookie son válidos
                $pedido = $pedido_info['pedido'];
                $id = $pedido_info['id'];
                $unidades = $pedido_info['unidades'];
                $array_lineas = $pedido_info['array_lineas'];
                $pedido_productos = $pedido_info['pedido_productos'];
            } else{
                //If is not the correct data will make the necessary querys
                $pedido = $obj_pedido->getOneByUser(); //Pedido
                $id = $pedido->id;
                $unidades = $obj_pedido->getUnidades($id); //total units
                $array_lineas = $obj_pedido->getLineasOfOnePedido($id); //We can count the products
                $pedido_productos = $obj_pedido->getProductosByPedido($id); //All rpoducts of the Pedido

                //Save all data in one cookie for 1 hour and half
                $pedido_info = array(
                    'pedido' => $pedido,
                    'id' => $id,
                    'unidades' => $unidades,
                    'array_lineas' => $array_lineas,
                    'pedido_productos' => $pedido_productos
                );
                setcookie('pedido_info', json_encode($pedido_info), time() + 5400);
                }
            }else{
                //If don't exist the COOKIE make the necessary querys
                $pedido = $obj_pedido->getOneByUser(); //Pedido
                $id = $pedido->id;
                $unidades = $obj_pedido->getUnidades($id); //total units
                $array_lineas = $obj_pedido->getLineasOfOnePedido($id); //We can count the products
                $pedido_productos = $obj_pedido->getProductosByPedido($id); //All rpoducts of the Pedido

                //Save all data in one cookie for 1 hour and half
                $pedido_info = array(
                    'pedido' => $pedido,
                    'id' => $id,
                    'unidades' => $unidades,
                    'array_lineas' => $array_lineas,
                    'pedido_productos' => $pedido_productos
                );
                setcookie('pedido_info', json_encode($pedido_info), time() + 5400);
                }
            }
            require_once 'views/pedido/confirmado.php';
        }
    
    public function mis_pedidos() {   
        
        Utils::isLoged();  //Check if is loged
        
        //User id
        $usuario_id = $_SESSION['identity']['user']->id;
        $pedido_base = new Pedido();
        
        //Catch the 'pedidos'(orders) of the user
        $pedido_base->setUsuario_id($usuario_id);
        $pedidos = $pedido_base->getAllByUser();
        
        require_once 'views/pedido/mis_pedidos.php';
    }
    
    public function detalle_pedido() {
        
        Utils::isLoged(); //Check if is loged
        
        if(isset($_GET['id'])) {           
            $id = $_GET['id'];
            $pedido_base = new Pedido();
            $pedido_base->setId($id);
            $pedido = $pedido_base->getOne();  //Catch 'pedido'  
            
            $productos = $pedido_base->getProductosByPedido($id);   //Catch products
            require_once 'views/pedido/detalle.php';
        } else {
            header('Location: pedido/mis_pedidos.php');
        }       
    }
    
    public function gestionar() {
        Utils::isAdmin();
        
        $gestion = true;
        
        $pedido = new Pedido();
        $pedidos = $pedido->getAll();
        
        require_once 'views/pedido/mis_pedidos.php';
    }
    
    public function estado() {
        Utils::isAdmin();
        if(isset($_POST) && isset($_POST['estado'], $_POST['id'])) {
            $estado = $_POST['estado'];
            $pedido = new Pedido();
            $pedido->setEstado($estado);
            
            $id = $_POST['id'];
            $pedido->setId($id);
            
            $change = $pedido->cambiar_estado();
            
            if($change) {
                header('Location: '.BASE_URL.'pedido/gestionar');
                $_SESSION['success_message'] = "El estado del pedido se cambió con éxito.";
            } else {
                $_SESSION['error_cambio'] = "Try tp change the state of the 'pedido' failed";
            }
        } else {
            $_SESSION['error_cambio'] = "Try tp change the state of the 'pedido' failed";
            header('Location: '.BASE_URL.'pedido/gestionar');         
        }
    }
    
}