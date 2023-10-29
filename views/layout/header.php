<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Tienda de camisetas</title>
        <link rel="stylesheet" href="<?=BASE_URL?>assets/css/styles.css">
    </head>
    <body>
        <div id="container">
            <!--HEADER-->
            <header id="header">
                <div id="logo">
                    <img src="<?=BASE_URL?>assets/images/camiseta.png" alt="Camiseta logo"/>
                    <a href="index.php">Tienda de camisetas</a>
                </div>
            </header>

            <!--MENU-->
            <?php $categorias = Utils::showCategorias(); ?>
            <nav id="menu">
                <ul>
                    <li>
                        <a href="<?=BASE_URL?>">Inicio</a>
                    </li>
                    <?php while($categoria = $categorias->fetch_object()): ?>
                        <li>
                            <a href="<?=BASE_URL?>categoria/ver_productos&id=<?=$categoria->id?>"><?=$categoria->nombre?></a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </nav>

            <div id="content">
