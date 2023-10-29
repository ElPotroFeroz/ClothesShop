<?php if(isset($_SESSION['pedido_save']) && $_SESSION['pedido_save']): ?>
    <h1 style="color: green">Tu pedido ha sido confirmado</h1>
    
    <?php 
        if (isset($pedido_info)) {
        // Accede a los elementos de la cookie 'pedido_info' si está definida
        $pedido = $pedido_info['pedido'];
        $id = $pedido_info['id'];
        $unidades = $pedido_info['unidades'];
        $array_lineas = $pedido_info['array_lineas'];
        $pedido_productos = $pedido_info['pedido_productos'];
        }
    ?>
    <p>Tu pedido ha sido guardado correctamente, cuando hagas la transferencia del coste del pedido se procesará el envío del mismo.</p>
    <p>Realiza la transferencia a ES 0050 4058 3029 3389</p>
    </br>
    <h3>Datos del pedido:</h3>   
        Numero de pedido: <strong><?=$pedido->id?></strong>
        </br>
        Total a pagar: <strong><?=$pedido->coste?> $</strong>
        </br>
        Total productos: <strong><?=count($array_lineas)?></strong>
        </br>
        Total unidades: <strong><?=$unidades?></strong>
        
        </br></br></br>
    <h3>Estos son los nombres de los productos que has confirmado:</h3>
      
        <?php while($producto = $pedido_productos->fetch_object()): ?>
        <ul>
            <li>
                <?=$producto->nombre?> x<?=$producto->unidades?>
            </li>
        </ul>
        <?php endwhile; ?>
        <?php unset($_SESSION['carrito']); ?>
<?php else: ?>
    <h1 style="color: red">Tu pedido NO ha sido confirmado</h1>
<?php endif; ?>
