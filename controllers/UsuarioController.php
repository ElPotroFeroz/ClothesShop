<?php
require_once 'models/usuario.php';

class UsuarioController{
    public function index() {
        echo "Controlador Usuarios, Accion index";
    }
    public function register() {
        //Throw a view to register one new user
        require_once 'views/usuario/registro.php';
    }
    public function save() {
        //Save the data that user enters in register
        if(isset($_POST)) {
            //Validation
            //First check if they are not empty
            $name = isset($_POST['name']) ? $_POST['name'] : false ;
            $surname = isset($_POST['surname']) ? $_POST['surname'] : false ;
            $email = isset($_POST['email']) ? trim($_POST['email']) : false ;
            $password = isset($_POST['password']) ? $_POST['password'] : false ;
            //After second validation: we call the method from helpers for validate          
            if (Utils::validation_register($name, $surname, $email, $password)) {
            //Set data user
            $usuario = new Usuario();
            $usuario->setName($name);
            $usuario->setSurname($surname);
            $usuario->setEmail($email);
            $usuario->setPassword($password);
            
            $save = $usuario->save();   //Make the query to insert data in database
            if($save) {
                $_SESSION['register']['general'] = "complete";
                
            } else {
                $_SESSION['register']['general'] = "failed";
               
            }
        } else {
            $_SESSION['register']['general'] = "failed";
        }
        }
        header("Location: ".BASE_URL."usuario/register");
    }
    
    public function login() {
        if(isset($_POST)) {
            $usuario = new Usuario();
            $identity = $usuario->login($_POST['email'], $_POST['password']);
            
            //Crear una session
            if($identity && is_object($identity)) {
                $_SESSION['identity']['user'] = $identity;
                
                if($identity->rol == 'admin') {
                    $_SESSION['identity']['admin'] = true;
                }
            } else {
                $_SESSION['identity']['error'] = "Identificación fallida!";
            }
        }
        header("Location:".BASE_URL);
    }
    
    public function logout() {
        if(isset($_SESSION['identity'])) {
            Utils::delete_session('identity'); //Delete session 
        }
        header("Location:".BASE_URL);
    }
}