<h1>Gestionar Categorias</h1>

<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
    </tr>
        <?php while($categoria = $categorias->fetch_object()): ?>
            <tr>
                <td><?=$categoria->id?></td>
                <td><?=$categoria->nombre?></td>
            </tr>
        <?php endwhile; ?>   
</table>
<a href="<?=BASE_URL?>categoria/create" class="button button-small">Crear o borrar categoria</a>