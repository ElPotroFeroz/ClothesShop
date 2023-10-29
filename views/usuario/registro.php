<h1>Registrarse</h1>

<?php if(isset($_SESSION['register']['general'])): ?>
    <?php if($_SESSION['register']['general'] == "complete"): ?>
    <strong class="alert_green">Registro existoso</strong>
    <?php elseif($_SESSION['register']['general'] == "failed"): ?>
        <strong class="alert_red">El registro no se ha completado</strong>
        <?php if(!empty($_SESSION['register']['errores'])){
            foreach ($_SESSION['register']['errores'] as $error) {
                echo "<p>$error</p>";
            } 
        } ?>
    <?php endif; ?>    
<?php endif; ?>
<?php Utils::delete_session('register'); //Delete session ?> 

<form action="<?=BASE_URL?>usuario/save" method="POST">
    <label for="name">Nombre</label>
    <input type="text" name="name" required/>
    
    <label for="surname">Apellidos</label>
    <input type="text" name="surname" required/>
    
    <label for="email">Email</label>
    <input type="email" name="email" required/>
    
    <label for="password">Password</label>
    <input type="password" name="password" required/>
    
    <input type="submit" value="Registrarse"/>
</form>