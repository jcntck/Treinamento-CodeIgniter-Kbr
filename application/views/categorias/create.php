<?php echo validation_errors(); ?>

<?php echo form_open('categorias/create'); ?>
<div class="row">
    <div class="col-4">
        <label for="titulo">Nome da categoria: </label>
        <input type="text" name="titulo" id="titulo" maxlength="129" class="form-control" placeholder="Categoria">
    </div>
</div>
<button type="submit" class="btn btn-primary mt-3">Cadastrar</button>
</form>