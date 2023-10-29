<!<!-- Here is the list of all the products and you can select edit or delete -->
<h1 class="h1_form">Gestion de productos</h1>

<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == "failed"): ?>
    <strong class="alert_red">El producto no se ha guardado</strong> 
    <?php Utils::delete_session('producto'); ?>
<?php endif; ?>
    
<?php if(isset($_SESSION['image']) && $_SESSION['image'] == "failed" && !isset($_SESSION['edit'])): ?>
    <strong class="alert_red">No se ha guardado la imagen</strong> 
    <?php Utils::delete_session('image'); ?>
<?php endif; ?>

<?php if(isset($_SESSION['error_delete'])): ?>
    <strong class="alert_red"><?=$_SESSION['error_delete']?></strong>
    <?php Utils::delete_session('error_delete'); ?>
<?php endif; ?>
<?php if(isset($_SESSION['edit'])) { Utils::delete_session('edit'); }?>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Acción</th>
    </tr>
        <?php while($producto = $productos->fetch_object()): ?>
            <tr>
                <td><?=$producto->id?></td>
                <td><?=$producto->nombre?></td>
                <td><?=$producto->precio?></td>
                <td><?=$producto->stock?></td>
                <td>
                    <a href="<?=BASE_URL?>producto/editar&id=<?=$producto->id?>" class="button button_editar">Editar</a>
                    <a href="<?=BASE_URL?>producto/eliminar&id=<?=$producto->id?>" class="button button_eliminar">Eliminar</a>                    
                </td>
            </tr>
        <?php endwhile; ?>   
</table>
<a href="<?=BASE_URL?>producto/create" class="button button-small">Crear o borrar producto</a>
