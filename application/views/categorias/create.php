<?php
if ($this->session->flashdata('errors')) {
    echo '<div class="alert alert-danger">';
    echo $this->session->flashdata('errors');
    echo "</div>";
}
?>

<?php echo form_open('categorias/store'); ?>
<div class="row">
    <div class="col-4">
        <label for="titulo">Nome da categoria: </label>
        <input type="text" name="titulo" id="titulo" maxlength="129" class="form-control <?php if (!empty(form_error('titulo'))) : ?> is-invalid <?php endif; ?>" placeholder="Categoria" value="<?php echo set_value('titulo'); ?>">
    </div>
</div>
<button type="submit" class="btn btn-primary mt-3">Cadastrar</button>
<a href="<?php echo site_url('categorias/'); ?>" class="btn btn-primary mt-3">Voltar</a>
</form>