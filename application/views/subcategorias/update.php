<?php
$this->load->view('templates/header');
$this->load->view('templates/menu'); ?>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        <li class="nav-item active">
            <a class="nav-link btn-default d-inline mb-2 mb-lg-2" href="<?= base_url('subcategorias/') ?>">Voltar</a>
        </li>
    </ul>
</div>
</nav>
<div class="container-fluid">
    <div class="col-lg-6 m-auto">
        <h2 class="my-5 title">Atualização de subcategoria:</h2>
        <?php
        if ($errors) {
            echo '<div class="alert alert-danger">';
            echo $errors;
            echo "</div>";
        }
        ?>

        <?php echo form_open('subcategorias/update/' . $subcategoria->id); ?>
        <div class="row">
            <div class="col">
                <label for="categoria">Categoria mãe:</label>
                <select class="form-control <?php if (!empty(form_error('categoria_id'))) : ?> is-invalid <?php endif; ?>" id="categoria" name="categoria_id">
                    <option value="">-- Selecione uma categoria --</option>
                    <?php foreach ($categorias as $categoria) : ?>
                        <option value="<?= $categoria->id ?>" <?php if ($categoria->id == $subcategoria->categoria_id) : ?> selected <?php endif; ?>><?= $categoria->titulo ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="titulo">Nome da subcategoria: </label>
                <input type="text" name="titulo" id="titulo" maxlength="129" class="form-control <?php if (!empty(form_error('titulo'))) : ?> is-invalid <?php endif; ?>" placeholder="Subcategoria" value="<?php echo $subcategoria->titulo ?>">
            </div>
        </div>
        <div class="float-right mt-4">
            <button type="submit" class="btn btn-form">Editar</button>
            <a href="<?php echo site_url('subcategorias/'); ?>" class="btn btn-form">Voltar</a>
        </div>
        </form>
        </form>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>