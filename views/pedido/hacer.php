<?php if(isset($_SESSION['identity'])): ?>
<h1 class="h1_form">Hacer pedido</h1>

<h3>Rellena los datos de tu pedido</h3>
<form action="<?=BASE_URL?>pedido/add" method="POST">
    <label for="provincia">Provincia</label>
    <input type="text" name="provincia" required>
    
    <label for="localidad">Localidad</label>
    <input type="text" name="localidad" required>
    
    <label for="direccion">Dirección</label>
    <input type="text" name="direccion" required>
    
    <input type="submit" value="Confirmar">
</form>

<?php else: ?>
<h1>Necesitas etsar identificado</h1>
<p>Porfavor inicia sesión con tu usuario y contraseña para continuar con el pedido</p>
<?php endif; ?> 


