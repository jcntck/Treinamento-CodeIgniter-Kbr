<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        body {
            padding: 0;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .title {
            padding: 5px;
            background-color: #1a2930;
            color: white;
        }

        .title h1 {
            font-weight: 400;
            text-align: center;
        }

        .container {
            width: 680px;
            margin: auto;
        }

        .container h2 {
            margin: 50px 0;
        }

        
        .ft-perfil {
            float: right;
        }
        
        .desc {
            margin-top: 80px;
        }
        .desc h3 {
            font-weight: 400;
        }

        .desc div {
            border: 1px solid #ccc;
            padding: 0 30px;
        }

        footer {
            text-align: center;
            margin-top: 50px;
        }

        footer .small {
            font-size: 0.9em;
            color: #444;
        }
    </style>
</head>

<body>
    <div class="title">
        <h1 class="title"><?= $title ?></h1>
    </div>
    <div class="container">
        <?php if (!$update) : ?>
            <h2>Dados cadastrados:</h2>
        <?php else : ?>
            <h2>Dados atualizados: </h2>
        <?php endif; ?>
        <section class="d-flex">
            <?php if ($usuario->ft_perfil) : ?>
                <div class="ft-perfil">
                    <img src="<?= base_url('assets/images/crop/') . $usuario->ft_perfil ?>" alt="Foto de perfil">
                </div>
            <?php else : ?>
                <p>Sem foto</p>
            <?php endif; ?>
            <div>
                <p>Nome: <?= $usuario->nome ?></p>
                <p>E-mail: <?= $usuario->email ?></p>
                <p>Data de nascimento: <?= date('d/m/Y', strtotime($usuario->dt_nascimento)) ?></p>
            </div>
        </section>
        <section class="desc">
            <h3>Descrição</h3>
            <div>
                <?= $usuario->descricao ?>
            </div>
        </section>
        <footer class="text-center my-5">
            <?php if (!$update) : ?>
                <p class="small">Conta criada em: <?= date('d/m/Y H:i:s', strtotime($usuario->created_at)) ?></p>
            <?php else : ?>
                <p class="small">Conta atualizada em: <?= date('d/m/Y H:i:s', strtotime($usuario->updated_at)) ?></p>
            <?php endif; ?>
            <p>Atenciosamente, <br> Dev.</p>
        </footer>
    </div>
</body>

</html>