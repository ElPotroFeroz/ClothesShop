<?php
session_start();
require_once 'autoload.php';                //Autoload
require_once 'config/db.php';               //Conexion to database
require_once 'config/parameters.php';       //Constants
require_once 'helpers/utils.php';           //Helpers
require_once 'views/layout/header.php';     //Header and menu
require_once 'views/layout/sidebar.php';    //Sidebar

//Create a function for errors
function show_error() {
    $error = new ErrorController(); //call ErrorController to create an object
    $error->index();
}

//Check if we recived the controller by url
if(isset($_GET['controller'])) {
    $name_controller = $_GET['controller'].'Controller';
} 
elseif(!isset($_GET['controller']) && !isset($_GET['action'])) {
    $name_controller = CONTROLLER_DEFAULT;
}
else {
    show_error();
    exit();
}
//Check if esxists the controller
if(class_exists($name_controller)) {
    $controller_obj = new $name_controller();
    //After check if we recive the action and if the method exists
    if(isset($_GET['action']) && method_exists($name_controller, $_GET['action'])) {
        $action = $_GET['action'];
        $controller_obj->$action();
    }
    elseif(!isset($_GET['controller']) && !isset($_GET['action'])) {
        $action_default = ACTION_DEFAULT;
        $controller_obj->$action_default();
    }
    else {
        show_error();
    }
} else {
    show_error();
}

require_once 'views/layout/footer.php';    //Footer