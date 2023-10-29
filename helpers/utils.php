<?php

class Utils{
    
    public static function delete_session($name) {
        if(isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        return $name;
    }
    
    public static function validation_register($name, $surname, $email, $password) {
        $validation = false;
        if(!isset($_SESSION)) {
            session_start();
        }       
        $array_errores = array(); //Create an array for errors
        //If is not false and is not empty start validation
        if($name != false && !empty($name) && $surname != false && !empty($surname) 
            && $email != false && !empty($email) && $password != false && !empty($password)){           
             //Check name 
             if(!is_numeric($name) && !preg_match("/[0-9]/", $name)) {
                 $validate_name = true; //name correct
             } else { $validate_name = false; $array_errores['name'] = "Nombre no valido"; }
             //Check surname
             if(!is_numeric($surname) && !preg_match("/[0-9]/", $surname)) {
                 $validate_surname = true; //surname correct
             } else { $validate_surname = false; $array_errores['surname'] = "Apellido no valido";}
             //Check email
             if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                 $validate_email = true; //email correct
             } else { $validate_email = false; $array_errores['email'] = "Email no valido"; }
             //Check password
             if (strlen($password) > 8 && strlen($password) < 33) {
                 $validate_password = true; //password correct
             } else { $validate_password = false; 
             $array_errores['password'] = "Password no valida, debe contener entre 9 y 32 caracteres"; }
        }
        //If we have errors we save the array with the errors inside the variable of the SESSION
        $_SESSION['register']['errores'] = $array_errores;
        if ($validate_name && $validate_surname && $validate_email && $validate_password) {
            $validation = true;
            $_SESSION['register']['errores'] = null; //If there aren't errors the variable SESSION is null
        }
        return $validation;
    }
    
    public static function isAdmin() {
        if(!isset($_SESSION['identity']['admin'])) {
            header('Location:'.BASE_URL);
        } else {
            return true;
        }
    }
    
     public static function isLoged() {
        if(!isset($_SESSION['identity'])) {
            header('Location:'.BASE_URL);
        } else {
            return true;
        }
    }
    
    public static function showCategorias() {
        require_once 'models/categoria.php';
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        return $categorias;
    }
    
    public static function statsCarrito() {
        $stats = array(
            'count' => 0,
            'total' => 0
            );
        if(isset($_SESSION['carrito'])) {
            foreach($_SESSION['carrito'] as $indice => $unidades){
                $stats['count'] += $_SESSION['carrito'][$indice]['unidades'];
            }
            
            foreach ($_SESSION['carrito'] as $producto) {
               $stats['total'] += $producto['precio']*$producto['unidades']; 
            }       
        }
        return $stats;
    }
    
}

