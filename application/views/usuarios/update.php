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
<div class="container-fluid">
    <div class='col-lg-6 m-auto'>
        <h2 class="my-5 title">Editar usuário:</h2>
        <?php
        if ($errors) {
            echo '<div class="alert alert-danger">';
            echo $errors;
            echo "</div>";
        }
        ?>

        <?php echo form_open_multipart('usuarios/update/' . $usuario->id); ?>
        <div class="row my-md-2">
            <div class="col">
                <label for="nome">Nome: </label>
                <input type="text" name="nome" id="nome" maxlength="129" class="form-control <?php if (!empty(form_error('nome'))) : ?> is-invalid <?php endif; ?>" placeholder="Digite seu nome" value="<?= $usuario->nome ?>">
            </div>
        </div>

        <div class="row my-md-2">
            <div class="col">
                <label for="email">E-mail: </label>
                <input type="email" name="email" id="email" maxlength="129" class="form-control <?php if (!empty(form_error('email'))) : ?> is-invalid <?php endif; ?>" placeholder="Digite seu e-mail" aria-describedby="emailHelp" value="<?= $usuario->email ?>">
                <small id="emailHelp" class="form-text text-muted">Ex.: seuemail@seuprovedor.com</small>
            </div>
        </div>

        <div class="row my-md-2">
            <div class="col">
                <label for="nascimento">Data de Nascimento: </label>
                <input type="text" name="nascimento" id="nascimento" maxlength="10" class="form-control <?php if (!empty(form_error('nascimento'))) : ?> is-invalid <?php endif; ?>" placeholder="Digite sua data de nascimento" value="<?= date('d/m/Y', strtotime($usuario->dt_nascimento)) ?>">
            </div>
        </div>

        <div class="row my-md-2">
            <div class="col">
                <label for="foto">Selecione uma foto: </label>
                <input type="file" name="foto" id="seleciona-imagem" class="form-control-file <?php if (!empty(form_error('foto'))) : ?> is-invalid <?php endif; ?>">
                <!-- <div class="my-3">
                    <img id="preview" class="col-5">
                </div> -->
            </div>
        </div>

        <div class="row my-md-2">
            <div class="col">
                <label for="foto">Preview da Imagem: <span class="small text-danger">Não faça outro upload caso queira permanecer com a mesma foto.</span></label>
                <div class="col-sm-10" id="imagem-box">
                    <?php if (!$usuario->ft_perfil) : ?>
                        <h6>Escolha a imagem para recortar</h6>
                    <?php else : ?>
                        <img src="<?= base_url('assets/images/crop/' . $usuario->ft_perfil) ?>" class="img-thumbnail">
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row my-md-2">
            <div class="col">
                <label for="categoria">Categoria: </label>
                <select class="form-control <?php if (!empty(form_error('categoria_id'))) : ?> is-invalid <?php endif; ?>" id="categoria_user" name="categoria_id">
                    <option value="">-- Selecione uma categoria --</option>
                    <?php foreach ($categorias as $categoria) : ?>
                        <option value="<?= $categoria->id ?>" <?php if ($categoria->id == $usuario->catId) : ?> selected <?php endif; ?>><?= $categoria->titulo ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="row my-md-2">
            <div class="col">
                <label for="subcategoria">Subcategoria: </label>
                <select class="form-control <?php if (!empty(form_error('categoria_id'))) : ?> is-invalid <?php endif; ?>" id="subcategoria" name="subcategoria_id">
                    <option value="">-- Selecione uma subcategoria --</option>
                    <?php foreach ($subcategorias as $subcategoria) :
                        if ($subcategoria->categoria_id == $usuario->catId) :
                            ?>
                            <option value="<?= $subcategoria->id ?>" <?php if ($subcategoria->id == $usuario->subcategoria_id) : ?> selected <?php endif; ?>><?= $subcategoria->titulo ?></option>
                    <?php endif;
                    endforeach; ?>
                </select>
            </div>
        </div>

        <div class="row my-md-2">
            <div class="col">
                <label for="descricao">Comente sobre você: </label>
                <textarea type="text" name="descricao" class="form-control" style="height: 200px" id="editor" placeholder="Descreva um pouco de você">
                    <?= $usuario->descricao ?>
                </textarea>
            </div>
        </div>

        <div class="float-right my-4">
            <button type="submit" class="btn btn-form">Editar</button>
            <a href="<?php echo site_url('usuarios/'); ?>" class="btn btn-form">Voltar</a>
        </div>

        <!-- JCROP -->
        <input type="hidden" id="x" name="x" />
        <input type="hidden" id="y" name="y" />
        <input type="hidden" id="wcrop" name="wcrop" />
        <input type="hidden" id="hcrop" name="hcrop" />
        <input type="hidden" id="wvisualizacao" name="wvisualizacao" />
        <input type="hidden" id="hvisualizacao" name="hvisualizacao" />
        <input type="hidden" id="woriginal" name="woriginal" />
        <input type="hidden" id="horiginal" name="horiginal" />
        <!-- Subcategoria -->
        <input type="hidden" id="idSubcategoria" value='<?= $usuario->subcategoria_id ?>'>

        </form>
    </div>
</div>



<?php $this->load->view('templates/footer'); ?>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: '/codeigniter/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
            }
        })
</script>