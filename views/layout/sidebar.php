 <!--LATERAL BAR-->
<aside id="lateral">
    <div id="carrito" class="block_aside">
        <h3>Mi carrito</h3>
        <?php $stats = Utils::statsCarrito(); ?>
        <ul>
             <!--CARRITO-->
            <li><strong><a href="<?=BASE_URL?>carrito/index">Ver carrito</a></strong></li> 
            <li><strong>Productos(<?=$stats['count']?>)</strong></li>
            <li><strong>Total: <?=$stats['total']?> $</strong></li>
        </ul>
    </div>
    <div id="login" class="block_aside">
        <!--LOGIN-->
        <?php if(!isset($_SESSION['identity']) || isset($_SESSION['identity']['error'])): ?>            
            <h3>Entrar a la web</h3>
            <?php if(isset($_SESSION['identity']['error'])): ?>
                <strong class="alert_red">Identificación fallida!</strong>
                <?php Utils::delete_session('identity'); ?>
            <?php endif; ?>
            <form action="<?=BASE_URL?>usuario/login" method="POST">
                <label for="email">Email</label>
                <input type="email" name="email" />

                <label for="password">Password</label>
                <input type="password" name="password" />

                <input type="submit" value="Send"/>
            </form>
            <ul>
                <!--REGISTRATION NEW USER-->
                <li><a href="<?=BASE_URL?>usuario/register">Registrarse</a></li>  
            </ul>
        <?php elseif(isset($_SESSION['identity']) && !isset($_SESSION['identity']['error'])): ?>
            <h3>Bienvenido <?=$_SESSION['identity']['user']->nombre?></h3> 

            <ul>         
                <li><a href="<?=BASE_URL?>pedido/mis_pedidos">Mis pedidos</a></li>
                <?php if(isset($_SESSION['identity']['admin'])): ?>
                    <li><a href="<?=BASE_URL?>pedido/gestionar">Gestionar pedidos</a></li>
                    <li><a href="<?=BASE_URL?>categoria/index">Gestionar categorias</a></li>
                    <li><a href="<?=BASE_URL?>producto/gestion">Gestionar productos</a></li>
                <?php endif; ?>        
                <li><a href="<?=BASE_URL?>usuario/logout">Cerrar sesion</a></li>                              
            </ul>
        <?php endif; ?>
    </div>
</aside>
<!--CENTRAL CONTENT-->
<div id="central">