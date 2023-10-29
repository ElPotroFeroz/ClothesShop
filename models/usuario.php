<?php

class Usuario{
    private $id;
    private $name;
    private $surname;
    private $email;
    private $password;
    private $rol;
    private $image; 
    private $db;        //Connect to database
    
    public function __construct() {
        $this->db = Database::connect();
    }
    //Getters and Setters mehtods
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRol() {
        return $this->rol;
    }

    public function getImage() {
        return $this->image;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setName($name): void {
        $this->name = $this->db->real_escape_string($name);
    }

    public function setSurname($surname): void {
        $this->surname = $this->db->real_escape_string($surname);
    }

    public function setEmail($email): void {
        $this->email = $this->db->real_escape_string($email);
    }

    public function setPassword($password): void {
        $this->password = password_hash($this->db->real_escape_string($password), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    public function setRol($rol): void {
        $this->rol = $rol;
    }

    public function setImage($image): void {
        $this->image = $image;
    }
    // // //
    //Function for save the data of a new user in the database  
    public function save() {
        //Prepare the query
        $sql = "INSERT INTO usuarios VALUES(null, '{$this->getName()}', "
        . "'{$this->getSurname()}', '{$this->getEmail()}', '{$this->getPassword()}', "
        . "'user', null);";
        $save = $this->db->query($sql);
        $result_query = false;    //Variable to determine if the query was successful
        if($save) { //If the query is successful then set variable to true
            $result_query = true;
        }
        return $result_query;
      }
      
//    public function save() {              
//        /*If we want to do the data escaping only before the query 
//        delete real_escape_string() functions on setters and use this code*/       
//        //Prepare the query
//        $stmt = mysqli_prepare($db, "INSERT INTO usuarios (id, nombre, apellidos, email, password, rol, image) "
//                . "VALUES (null, ?, ?, ?, ?, ?, null");
//        mysqli_stmt_bind_param($stmt, "sssss", $name, $surname, $email, $password, $rol);
//        
//        $result = false;    //Variable to determinate if the query has been successful start in false
//        //Into this if() we execute the query
//        if(mysqli_stmt_execute($stmt)) {
//            $result = true; //If the query is successful set the variable to true
//        }
//        return $result;
//    }
      
    public function login($email, $password){
        $result = false; //The variable we are going to return
        $verify = false; //Inicialice for avoid errors
        //Query to check in database the email
        $sql = "SELECT * FROM usuarios WHERE email = '$email';";
        $login = $this->db->query($sql);
        
        if($login && $login->num_rows == 1) {
            $usuario = $login->fetch_object(); // Create object with all data of user
            $verify = password_verify($password, $usuario->password); //verify password
        }
        if($verify) {
            //if the password is good then save the user inside the variable result
            $result = $usuario;
        }
        return $result; //Return the object of the user or false
    }
}
