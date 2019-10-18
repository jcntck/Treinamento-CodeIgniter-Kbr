<p class="construcao">Página em constução ...</p>
<ul>
    <li><a href="<?php echo site_url('categorias/create'); ?>">Criar categoria</a></li>
</ul>

<?php if($this->session->flashdata('success')) : ?>
    <p><?php echo $this->session->flashdata('success'); ?></p>
<?php endif; ?>

<?php if (count($categorias) > 0) : ?>
    <table class="view-data">
        <thead>
            <tr>
                <td>ID</td>
                <td>Nome da categoria</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $categoria) : ?>
                <tr>
                    <td><?php echo $categoria->id; ?></td>
                    <td><?php echo $categoria->titulo; ?></td>
                    <td>
                        <form method="DELETE" action="<?php echo site_url('categorias/delete/'.$categoria->id);?>">
                        <a href="<?php echo site_url('categorias/edit')."/". $categoria->id ?>" class="btn btn-info">Editar</a>
                        <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>