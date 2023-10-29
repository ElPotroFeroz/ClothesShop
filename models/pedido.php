<?php
    class Pedido{
        
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    
    private $db;
    
    public function __construct(){
        $this->db = Database::connect();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getUsuario_id() {
        return $this->usuario_id;
    }

    public function getProvincia() {
        return $this->provincia;
    }

    public function getLocalidad() {
        return $this->localidad;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getCoste() {
        return $this->coste;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getHora() {
        return $this->hora;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setUsuario_id($usuario_id): void {
        $this->usuario_id = $usuario_id;
    }

    public function setProvincia($provincia): void {
        $this->provincia = $this->db->real_escape_string($provincia);
    }

    public function setLocalidad($localidad): void {
        $this->localidad = $this->db->real_escape_string($localidad);
    }

    public function setDireccion($direccion): void {
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    public function setCoste($coste): void {
        $this->coste = $coste;
    }

    public function setEstado($estado): void {
        $this->estado = $estado;
    }

    public function setFecha($fecha): void {
        $this->fecha = $fecha;
    }

    public function setHora($hora): void {
        $this->hora = $hora;
    }
        
    public function save() {
        $sql = "INSERT INTO pedidos VALUES(null, {$this->getUsuario_id()}, '{$this->getProvincia()}', "
        . "'{$this->getLocalidad()}', '{$this->getDireccion()}', {$this->getCoste()}, 'confirmado', CURDATE(), "
                . "CURTIME());";
        $save = $this->db->query($sql);
        
        $result = false;
        if($save) {
            $result = true;
        }
        return $result;
    }
    
    public function getAll() {
        $sql = "SELECT * FROM pedidos;";
        $consulta = $this->db->query($sql);
        
        $result = false;
        if($consulta) {
            return $consulta;
        }
        else {
            return $result;
        }
    }
    
    public function getOne() {
        $sql = "SELECT * FROM pedidos WHERE id = {$this->getId()};";
        $consulta = $this->db->query($sql);
        
        $result = false;
        if($consulta) {
            return $consulta->fetch_object();
        }
        else {
            return $result;
        }
    }
    
    public function save_linea_pedido() {
        //We can create another class for lineas_pedidos but we also can make the method inside the class pedido
        $sql = "SELECT  LAST_INSERT_ID() as 'pedido_id';";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido_id;
        
        foreach($_SESSION['carrito'] as $indice => $elemento) {
            $producto = $elemento['producto'];
            
            $insert = "INSERT INTO lineas_pedidos VALUES(null, {$pedido_id}, {$producto->id}, {$elemento['unidades']});";
            $save = $this->db->query($insert);
        }
        
        $result = false;
        if($save) {
            $result = true;
        }
        return $result;
    }
    
    public function getOneByUser() {
        $sql = "SELECT p.id, p.coste FROM pedidos p "
                . "INNER JOIN lineas_pedidos lp ON lp.pedido_id = p.id "
                . "WHERE p.usuario_id = {$this->getUsuario_id()} "
                . "ORDER BY id DESC LIMIT 1;";
        $pedido = $this->db->query($sql);
        
        return $pedido->fetch_object();
    }
    
    public function getLineasOfOnePedido($id) {
        $sql = "SELECT * FROM lineas_pedidos "
                . "WHERE lineas_pedidos.pedido_id = $id";
        $lineas_pedidos = $this->db->query($sql);
        
        $unidades = array(); // Inicializamos un array para almacenar las unidades
        
        if ($lineas_pedidos) {
            //Here we obtain an array with all the rows of the query so we can reutilice this code for other functions
            while ($row = $lineas_pedidos->fetch_object()) {
                $unidades[] = $row;
            }
        }
        
        return $unidades;
    }
    
    public function getUnidades($id) {
        
        $unidades = $this->getLineasOfOnePedido($id);
        
        //After we count the units with the for adding up the units of each row
        $total_unidades = 0; //Inicialice the variable for avoid errors
        foreach($unidades as $fila) {
            $total_unidades += $fila->unidades;
        }

    return $total_unidades; //return the total of the units that correspons with the id of the order (pedido)
                
    }
    
    public function getProductosByPedido($id) {
        $sql = "SELECT * FROM productos WHERE id IN "
                . "(SELECT producto_id FROM lineas_pedidos WHERE pedido_id = $id);";
        $sql = "SELECT pr.*, lp.unidades FROM productos pr "
                . "INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id "
                . "WHERE lp.pedido_id = $id;";
        $productos = $this->db->query($sql);
        
        return $productos;
    }
        
    public function getAllByUser() {
        $sql = "SELECT p.* FROM pedidos p "               
                . "WHERE p.usuario_id = {$this->getUsuario_id()} "
                . "ORDER BY id DESC;";
        $pedido = $this->db->query($sql);
        
        return $pedido;
    }
    
    public function cambiar_estado() {
        $sql = "UPDATE pedidos SET estado = '{$this->getEstado()}' "
        . "WHERE id = {$this->getId()};";
        
        $update = $this->db->query($sql);
        
        if($update) {
            return true;
        } else {
            return false;
        }
    }
    
}
    
