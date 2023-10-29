<?php if(isset($producto)): ?>
    <h1 class="h1_form"><?=$producto->nombre?></h1>
    <!--VISUALICE PRODUCT-->
    <div class="form_container">
        <div class="form-column">
            
            <h3>Descripción: </h3><h2><?=$producto->descripcion?></h2></br>
            <h3>Precio: </h3><h2><?=$producto->precio?> $</h2></br>
            <h3>Stock: </h3><h2><?=$producto->stock?></h2></br>
            <?php if($nombre_categoria): ?>
                <h3>Categoria: </h3><h2><?=$nombre_categoria->nombre_categoria?></h2></br>
            <?php else: ?>
                <h3>Categoria: </h3><h2>Categoria no encontrada</h5></br>
            <?php endif; ?>
            <?php if(isset($_SESSION['carrito'])): 
                foreach($_SESSION['carrito'] as $indice => $elemento): 
            ?>
                    <?php if($_SESSION['carrito'][$indice]['id_producto'] == $_GET['id']): ?>
                        <a href="<?=BASE_URL?>carrito/add&id=<?=$producto->id?>" class="button_anadir">Añadir otra unidad al carrito</a>
                        <?php $check_product = true; //For check if product is second time added ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                    
            <?php endif; ?>
            <?php if(!isset($check_product) || $check_product != true): ?>
                    <a href="<?=BASE_URL?>carrito/add&id=<?=$producto->id?>" class="button_anadir">Añadir al carrito</a>
                <?php endif; ?>
        </div>
        <div class="image_column">
           <?php if(isset($producto) && !empty($producto->imagen)): ?>
                <img src="<?=BASE_URL?>uploadd/<?=$producto->imagen?>" id="uploaded-image"/>
           <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <h1 class="h1_form">No se ha encontrado el producto</h1>
<?php endif; ?>


