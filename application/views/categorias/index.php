<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/menu'); ?>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        <li class="nav-item active">
            <a class="nav-link btn-default d-inline mb-2 mb-lg-2" href="<?= base_url('categorias/create') ?>">Criar categoria</a>
        </li>
    </ul>
</div>
</nav>

<div class="container-fluid">
    <div class='col-lg-8 m-auto'>
        <h2 class="my-5 title">Categorias</h2>

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
        <!-- Tabela -->
        <?php if (count($categorias) > 0) : ?>
            <table class="table" id="table">
                <thead class="lead">
                    <tr>
                        <td scope="col">ID</td>
                        <td scope="col">Nome da categoria</td>
                        <td scope="col">Ações</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categorias as $categoria) : ?>
                        <tr>
                            <td scope="row"><?php echo $categoria->id; ?></td>
                            <td><?php echo $categoria->titulo; ?></td>
                            <td>
                                <form method="DELETE" action="<?php echo site_url('categorias/delete/' . $categoria->id); ?>">
                                    <a href="<?php echo site_url('categorias/edit') . "/" . $categoria->id ?>" class="btn btn-outline-secondary" title="Editar"><i class="fas fa-edit"></i></a>
                                    <button type="submit" class="btn btn-outline-danger" title="Deletar"><i class="far fa-trash-alt"></i></button>
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