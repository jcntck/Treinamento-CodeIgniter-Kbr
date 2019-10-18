<?php
// if ($this->session->flashdata('errors')) {
//     echo '<div class="alert alert-danger">';
//     echo $this->session->flashdata('errors');
//     echo "</div>";
// }
?>

<?php echo form_open('subcategorias/create'); ?>
<div class="row">
    <div class="col-4">
        <label for="categoria">Categoria mãe:</label>
        <select class="form-control" id="categoria" nome="categoria">
            <option value="">-- Selecione uma categoria --</option>
            <?php foreach ($categorias as $categoria) : ?>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<div class="row mt-3">
    <div class="col-4">
        <label for="titulo">Nome da subcategoria: </label>
        <input type="text" name="titulo" id="titulo" maxlength="129" class="form-control <?php if (!empty(form_error('titulo'))) : ?> is-invalid <?php endif; ?>" placeholder="Subcategoria" value="<?php echo set_value('titulo'); ?>">
    </div>
</div>
<button type="submit" class="btn btn-primary mt-3">Cadastrar</button>
<a href="<?php echo site_url('categorias/'); ?>" class="btn btn-primary mt-3">Voltar</a>
</form>