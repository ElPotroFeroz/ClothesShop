<?php if(isset($gestion)): ?>

    <h1>Todos los pedidos</h1>
    
    <?php if(isset($_SESSION['error_cambio'])): ?>
        <strong class="alert_red">Error al intentar cambiar el estado del pedido</strong>
        <?php Utils::delete_session('error_cambio'); ?>
    <?php endif; ?>
    <?php if(isset($_SESSION['success_message'])): ?>
        <strong class="alert_green">El estado del pedido se cambió con éxito.</strong>
        <?php Utils::delete_session('success_message'); ?>
    <?php endif; ?>

<?php else: ?>

    <h1>Mis pedidos</h1>

<?php endif; ?>
    
<table>
    <tr>
        <th>Nª</th>
        <th>Coste</th>
        <th>Fecha</th>
        <th>Estado</th>
    </tr>
    
    <?php while($pedido = $pedidos->fetch_object()): ?>
        <tr>            
            <td>
                <a href="<?=BASE_URL?>pedido/detalle_pedido&id=<?=$pedido->id?>">
                    <?=$pedido->id?>
                </a>
            </td>
           
            <td>
                <?=$pedido->coste?> $
            </td>
            
            <td>
                <?=$pedido->fecha?>
            </td>
            
             <td>
                <?=$pedido->estado?>
            </td>
        </tr>
    <?php endwhile; ?>
</table>


