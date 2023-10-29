<h1 class="carrito-title">Tus pedidos del carrito</h1>

<?php if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1): ?>
<table class="carrito-tabla">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>Imagen</th>
            <th>x</th>
        </tr>
    </thead>
    <tbody>
        <!-- Fila -->
        <?php foreach ($_SESSION['carrito'] as $indice => $elemento): 
            $producto = $elemento['producto'];
        ?>       
            <tr>
                <td><strong style="color: blue;"><?=$elemento['nombre']?></strong></td>
                <td><strong style="color: #00fe42;">$<?=$elemento['precio']?></strong></td>
                <td class="button-container">
                    <a href="<?=BASE_URL?>carrito/up_unidades&index=<?=$indice?>" class="button-unidades up"></a>
                    <strong style="color: red;"><?=$elemento['unidades']?></strong>
                    <a href="<?=BASE_URL?>carrito/less_unidades&index=<?=$indice?>" class="button-unidades less"></a>
                
                <td>
                <?php if(!empty($producto->imagen)): ?> 
                    <a href="<?=BASE_URL?>producto/ver&id=<?=$producto->id?>" >
                        <img src="<?=BASE_URL?>uploadd/<?=$producto->imagen?>" class="img-carrito"/>
                    </a>
                <?php else: ?>
                    <img src="<?=BASE_URL?>assets/images/camiseta.png" class="img-carrito"/>
                <?php endif; ?>
                </td>
                <td>
                    <a href="<?=BASE_URL?>carrito/remove&index=<?=$indice?>" class="button-delete">Quitar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="delete-carrito">
    <a href="<?=BASE_URL?>carrito/delete_all" class="button-delete">Borrar carrito</a>
</div>
<div class="total-carrito">
    <?php $stats = Utils::statsCarrito(); ?>
    <h3>Precio total: <?=$stats['total']?> $</h3>
    <a href="<?=BASE_URL?>/pedido/hacerPedido" class="button-pedido">Hacer pedido</a>
</div>
<?php else: ?>
    <h1>No has añadido productos al carrito</h1>
<?php endif; ?>



