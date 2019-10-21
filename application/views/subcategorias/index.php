<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/menu'); ?>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        <li class="nav-item active">
            <a class="nav-link btn-default d-inline mb-2 mb-lg-2" href="<?= base_url('subcategorias/create') ?>">Criar subcategoria</a>
        </li>
    </ul>
</div>
</nav>
<div class="container-fluid">
    <div class='col-lg-8 m-auto'>
        <h2 class="my-5 title">Subcategorias</h2>

        <!-- Mensagens de retorno -->
        <?php if ($this->session->flashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif ($this->session->flashdata('errors')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $this->session->flashdata('errors'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if (!count($categorias)) : ?>
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Alerta!</h4>
                <p>Nenhuma categoria foi cadastrado no sistema.</p>
                <hr>
                <p class="mb-0">Para cadastrar uma subcategoria é necessário existir pelo menos 1 categoria.</p>
            </div>
        <?php endif; ?>

        <!-- Tabela -->
        <?php if (count($subcategorias) > 0) : ?>
            <table class="table">
                <thead class="lead">
                    <tr>
                        <td scope="col">ID</td>
                        <td scope="col">Nome da categoria</td>
                        <td scope="col">Categoria</td>
                        <td scope="col">Ações</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($subcategorias as $subcategoria) : ?>
                        <tr>
                            <td><?php echo $subcategoria->id; ?></td>
                            <td><?php echo $subcategoria->titulo; ?></td>
                            <td><?php echo $subcategoria->categoria; ?></td>
                            <td>
                                <form method="DELETE" action="<?php echo site_url('subcategorias/delete/' . $subcategoria->id); ?>">
                                    <a href="<?php echo site_url('subcategorias/edit') . "/" . $subcategoria->id ?>" class="btn btn-outline-secondary" title="Editar"><i class="fas fa-edit"></i></a>
                                    <button type="submit" class="btn btn-danger" title="Deletar"><i class="far fa-trash-alt"></i></button>
                                </form> 
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
<?php
$this->load->view('templates/footer');
?>