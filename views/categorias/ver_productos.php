<?php if(isset($category) && $category != null): ?>
    <h1 class="h1_form"><?=$category->nombre?></h1>
    <?php if($productos->num_rows == 0): ?>
        <p>No hay productos de esta categoria</p>
    <?php else: ?>
        <div class="products">   
            <?php while($product = $productos->fetch_object()): ?>
                <div class="product">
                    <?php if($product->imagen != null): ?>
                        <img src="<?=BASE_URL?>uploadd/<?=$product->imagen?>" />         
                    <?php else: ?>
                        <img src="<?=BASE_URL?>assets/images/camiseta.png" />
                    <?php endif; ?>
                    <h2><?=$product->nombre?></h2>
                    <p><?=$product->precio . "$" ?></p>
                    <a href="<?=BASE_URL?>producto/ver&id=<?=$product->id?>" class="button_ver">Ver</a>
                </div>
            <?php endwhile; ?>   
        </div>
    <?php endif; ?>
<?php else: ?>
    <h1>No se ha encontrado la categoria</h1>
<?php endif; ?>

