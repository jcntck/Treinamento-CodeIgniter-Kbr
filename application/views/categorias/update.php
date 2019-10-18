<?php
if ($this->session->flashdata('errors')) {
    echo '<div class="alert alert-danger">';
    echo $this->session->flashdata('errors');
    echo "</div>";
}
?>

<form method="post" action="<?php echo site_url('categorias/update/' . $categoria->id); ?>">
    <div class="row">
        <input type="hidden" name="id" id="id" value="<?php echo $categoria->id ?>">
        <div class="col-4">
            <label for="titulo">Nome da categoria: </label>
            <input type="text" name="titulo" id="titulo" maxlength="129" class="form-control" placeholder="Categoria" value="<?php echo $categoria->titulo ?>">
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Cadastrar</button>
    <a href="<?php echo site_url('categorias/'); ?>" class="btn btn-primary mt-3">Voltar</a>
</form>