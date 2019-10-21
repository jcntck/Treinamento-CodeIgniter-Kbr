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
        <h2 class="my-5 title">Atualização de categoria:</h2>
        <?php
        if ($errors) {
            echo '<div class="alert alert-danger">';
            echo $errors;
            echo "</div>";
        }
        ?>

        <form method="post" action="<?php echo site_url('categorias/update/' . $categoria->id); ?>">
            <div class="row">
                <input type="hidden" name="id" id="id" value="<?php echo $categoria->id ?>">
                <div class="col">
                    <label for="titulo">Nome da categoria: </label>
                    <input type="text" name="titulo" id="titulo" maxlength="129" class="form-control <?php if (!empty(form_error('titulo'))) : ?> is-invalid <?php endif; ?>" placeholder="Categoria" value="<?php echo $categoria->titulo ?>">
                </div>
            </div>
            <div class="float-right mt-4">
                <button type="submit" class="btn btn-form">Editar</button>
                <a href="<?php echo site_url('categorias/'); ?>" class="btn btn-form">Voltar</a>
            </div>
        </form>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>