<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Tienda de camisetas</title>
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body>
        <div id="container">
            <!--HEADER-->
            <header id="header">
                <div id="logo">
                    <img src="assets/images/camiseta.png" alt="Camiseta logo"/>
                    <a href="index.php">Tienda de camisetas</a>

                </div>
            </header>

            <!--MENU-->
            <nav id="menu">
                <ul>
                    <li>
                        <a href="">Inicio</a>
                    </li>
                    <li>
                        <a href="">Categoria 1</a>
                    </li>
                    <li>
                        <a href="">Categoria 2</a>
                    </li>
                    <li>
                        <a href="">Categoria 3</a>
                    </li>
                    <li>
                        <a href="">Categoria 4</a>
                    </li>
                    <li>
                        <a href="">Categoria 5</a>
                    </li>
                </ul>
            </nav>

            <div id="content">
                <!--LATERAL BAR-->
                <aside id="lateral">
                    <h3>Entrar a la web</h3>
                    <div id="login" class="block_aside">
                        <form action="" method="post">
                            <label for="email">Email</label>
                            
                            <input type="email" name="email" />

                            <label for="email">Password</label>
                            
                            <input type="email" name="email" />

                            <input type="submit" value="Send"/>
                        </form>
                        <ul>
                            <li><a haref="">Mis pedidos</a></li>
                            <li><a haref="">Gestionar pedidos</a></li>
                            <li><a haref="">Gestionar categorias</a></li>
                        </ul>
                    </div>
                </aside>

                <!--CENTRAL CONTENT-->
                <div id="central">
                    <h1>Productos destacados</h1>
                    <div class="product">
                        <img src="assets/images/camiseta.png" />
                        <h2>Camiseta azul</h2>
                        <p>30$</p>
                        <a href="" class="button_comprar">Comprar</a>
                    </div>
                    <div class="product">
                        <img src="assets/images/camiseta.png" />
                        <h2>Camiseta azul</h2>
                        <p>30$</p>
                        <a href="" class="button_comprar">Comprar</a>
                    </div>
                    <div class="product">
                        <img src="assets/images/camiseta.png" />
                        <h2>Camiseta azul</h2>
                        <p>30$</p>
                        <a href="" class="button_comprar">Comprar</a>
                    </div>
                </div>
            </div>
            <!--FOOTER-->
            <footer id="footer">
                <p>Dessarrollado por César Ferrando Pastor &copy;</p>
            </footer>
        </div>
    </body>
</html>
