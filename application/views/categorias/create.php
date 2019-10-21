<?php
$this->load->view('templates/header');
$this->load->view('templates/menu'); ?>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        <li class="nav-item active">
            <a class="nav-link btn-default d-inline mb-2 mb-lg-2" href="<?= base_url('categorias/') ?>">Voltar</a>
        </li>
    </ul>
</div>
</nav>
<div class="container-fluid">
    <div class='col-lg-6 m-auto'>
        <h2 class="my-5 title">Cadastro de categoria:</h2>
        <?php
        if ($errors) {
            echo '<div class="alert alert-danger">';
            echo $errors;
            echo "</div>";
        }
        ?>

        <?php echo form_open('categorias/store'); ?>
        <div class="row">
            <div class="col">
                <label for="titulo">Nome da categoria: </label>
                <input type="text" name="titulo" id="titulo" maxlength="129" class="form-control <?php if (!empty(form_error('titulo'))) : ?> is-invalid <?php endif; ?>" placeholder="Categoria" value="<?php echo set_value('titulo'); ?>">
            </div>
        </div>
        <div class="float-right mt-4">
            <button type="submit" class="btn btn-form">Cadastrar</button>
            <a href="<?php echo site_url('categorias/'); ?>" class="btn btn-form">Voltar</a>
        </div>
        </form>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>