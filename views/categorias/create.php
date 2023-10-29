<h1 class="h1_form">Crear nueva categoria</h1>

<form action="<?=BASE_URL?>categoria/save" method="POST">
    <label for="name">Nombre</label>
    <input type="text" name="name" required>

    <input type="submit" value="Guardar">
</form>
</br></br>

<h1>Borrar categoria</h1>

<form action="<?=BASE_URL?>categoria/delete" method="POST">
    <label for="delete">Nombre</label>
    <input type="text" name="delete" required>

    <input type="submit" value="Borrar">
</form>
<?php if(isset($_SESSION['error_delete'])): ?>
<strong class="alert_red"><?=$_SESSION['error_delete']?></strong>
<?php Utils::delete_session('error_delete'); ?>
<?php endif; ?>

