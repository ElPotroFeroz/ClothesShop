<h1 class="h1_form">Productos destacados</h1>

<div class="products">  
    
    <?php
        // Create a variable for the actual page
        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
        
         // Obtain the products of the actual page
        $products = $productos->getPaginated($page, 9); //9 products per page

    ?>
    <?php
        //Show products
        while($producto = $products->fetch_object()):
    ?>
        <div class="product">
            <?php if($producto->imagen != null): ?>
                <img src="<?=BASE_URL?>uploadd/<?=$producto->imagen?>" />         
            <?php else: ?>
                <img src="<?=BASE_URL?>assets/images/camiseta.png" />
            <?php endif; ?>
            <h2><?=$producto->nombre?></h2>
            <p><?=$producto->precio . "$" ?></p>
            <a href="<?=BASE_URL?>producto/ver&id=<?=$producto->id?>" class="button_ver">Ver</a>
        </div>
    <?php endwhile; ?>
    
</div>

<?php
    
    // Obtain the total number of rows in the result
    $total_rows = $all_products->num_rows;

    // Calculate the total number of pages
    $total_pages = ceil($total_rows / 9);
?>
</br></br>
<div class="pages">
    <?php
        //Create a link for every page
        for ($i = 1; $i <= $total_pages; $i++) {
            $class = ($i == $page) ? 'active' : '';
            echo "<a class='$class' href='?page=$i'> $i </a>";
        }
    ?>
</div>