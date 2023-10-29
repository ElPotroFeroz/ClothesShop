<?php if(isset($pedido)): ?>
    <h1>Detalles pedido</h1>
    <?php if(isset($_SESSION['identity']['admin'])): ?>
        <h3>Cambiar estado del pedido</h3>
        <?php if(isset($_SESSION['error_cambio'])): ?>
            <strong class="alert_red">Error al intentar cambiar el estado del pedido</strong>
            <?php Utils::delete_session('error_cambio'); ?>
        <?php endif; ?>
        <?php if(isset($_SESSION['success_message'])): ?>
            <strong class="alert_green">El estado del pedido se cambió con éxito.</strong>
            <?php Utils::delete_session('success_message'); ?>
        <?php endif; ?>    
        <form action="<?=BASE_URL?>pedido/estado" method="POST" name="estado">
            <input type="hidden" name="id" value="<?= $pedido->id ?>">
            <select name="estado">
                <option value="confirm">Pendiente</option>
                <option value="preparation">En preparación</option>
                <option value="ready">Listo para enviar</option>
                <option value="sended">Enviado</option>
            </select>
            <input type="submit" value="Cambiar">
        </form>
        </br>
    <?php endif; ?>
    <table>
        <tr>
            <th>Nª</th>
            <th>Coste</th>
            <th>Fecha</th> 
            <th>Provincia</th>
            <th>Direccion</th>
            <th>Estado</th>
        </tr>
        <tr>
            <td>
                <?=$pedido->id?>
            </td>
            <td>
                <?=$pedido->coste?> $
            </td>
            <td>
                <?=$pedido->fecha?>
            </td>
            <td>
                <?=$pedido->provincia?>
            </td>
            <td>
                <?=$pedido->direccion?>
            </td>
            <td>
                <?=$pedido->estado?>
            </td>
        </tr>
    </table> 
    <?php while($producto = $productos->fetch_object()): ?>
        <ul>
            <li>
                <strong><?=$producto->nombre?> x<?=$producto->unidades?></strong> <?php if(!empty($producto->imagen)): ?> 
                    <a href="<?=BASE_URL?>producto/ver&id=<?=$producto->id?>" >
                        <img src="<?=BASE_URL?>uploadd/<?=$producto->imagen?>" class="img-carrito"/>
                    </a>
                <?php else: ?>
                    <img src="<?=BASE_URL?>assets/images/camiseta.png" class="img-carrito"/>
                <?php endif; ?>
            </li>
        </ul>
    <?php endwhile; ?>
<?php else: ?>
    <h1>Error al buscar el pedido</h1>
<?php endif; ?>
