<?php
$this->load->view('templates/header');
$this->load->view('templates/menu'); ?>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        <li class="nav-item active">
            <a class="nav-link btn-default d-inline mb-2 mb-lg-2" href="<?= base_url('usuarios/') ?>">Voltar</a>
        </li>
    </ul>
</div>
</nav>
<!-- <?= var_dump($usuario) ?> -->
<div class="container-fluid">
    <div class='col-lg-8 m-auto'>
        <section class="text-center border-bottom">
            <?php if($usuario->ft_perfil): ?>
            <div class="mt-5 ft-perfil mx-auto" style="background: url(<?= base_url('assets/images/crop/') . $usuario->ft_perfil ?>) no-repeat center ;"></div>
            <?php endif; ?>
            <h2 class="title my-5"><?= $usuario->nome ?></h2>
        </section>
        <section class="my-3">
            <p class="text-muted text-center small">Categoria: <span class="h5 text-dark"><?=$usuario->catTitulo?></span> | Subcategoria: <span class="h5 text-dark"><?=$usuario->subTitulo?></span> </p>
        </section>
        <section class="my-3 border p-4">
            <h4 class="title">Informações pessoais:</h4>
            <p>Data de nascimento: <?=date('d/m/Y', strtotime($usuario->dt_nascimento))?></p>
            <p>E-mail: <?=$usuario->email?></p>
            <p><small>Usuário criado em: <?=date('d/m/Y H:i:s' , strtotime($usuario->created_at))?></small></p>
            <p><small>Última atualização: <?=date('d/m/Y H:i:s' , strtotime($usuario->updated_at))?></small></p>
        </section>
        <section class="border p-4">
            <h4 class="title">Descrição:</h4>
            <div class="desc border">
                <?=$usuario->descricao?>
            </div>
        </section>
    </div>
</div>