<!-<!-- Here is the view for create products, but also is reutiliced for edit products -->
<?php if(isset($edit)): ?>
    <h1 class="h1_form">Editar productos</h1>
    <?php $url_action = BASE_URL.'producto/save&id='.$mi_producto->id; ?>
<?php else: ?>
    <h1 class="h1_form">Crear nuevos productos</h1>
    <?php $url_action = BASE_URL.'producto/save'; ?>
<?php endif; ?>
<div class="form_container">
    
    <div class="form-column">
        <form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
            <label for="name">Nombre</label>
            <input type="text" name="name" value="<?=isset($edit) && isset($mi_producto) ? $mi_producto->nombre : ''?>"/>

            <label for="description">Descripción</label>
            <textarea name="description"><?=isset($edit) && isset($mi_producto) ? $mi_producto->descripcion : ''?></textarea>

            <label for="price">Precio</label>
            <input type="number" name="price" value="<?=isset($edit) && isset($mi_producto) ? $mi_producto->precio : ''?>"/>

            <label for="stock">Stock</label>
            <input type="number" name="stock" value="<?=isset($edit) && isset($mi_producto) ? $mi_producto->stock : ''?>"/>

            <label for="categoria">Categoria</label>
            <?php $categorias = Utils::showCategorias(); ?>
                <select name="categoria">
                    <?php while($categoria = $categorias->fetch_object()): ?>
                        <option value="<?=$categoria->id?>" <?=isset($edit) && isset($mi_producto) && $categoria->id == $mi_producto->categoria_id ? 'selected' : ''?>>
                            <?=$categoria->nombre?>
                        </option>
                    <?php endwhile; ?>
                </select>

            <label for="file">Imagen</label>
            <input type="file" name="file"/>
            <input type="submit" value="Guardar"/>
            
        </form>
    </div>
    
    <div class="image_column">
        <?php if(isset($edit) && isset($mi_producto) && !empty($mi_producto->imagen)): ?>
            <img src="<?=BASE_URL?>uploadd/<?=$mi_producto->imagen?>" id="uploaded-image"/>
        <?php endif; ?>
    </div>  
    
</div>

