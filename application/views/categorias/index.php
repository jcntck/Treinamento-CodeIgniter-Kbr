<!-- <?php foreach ($news as $news_item) : ?>

    <h3><?php echo $news_item['title']; ?></h3>
    <div class="main">
        <?php echo $news_item['text']; ?>
    </div>
    <p><a href="<?php echo site_url('news/' . $news_item['slug']); ?>">View article</p>

<?php endforeach; ?> -->
<p class="construcao">Página em constução ...</p>
<ul>
    <li><a href="<?php echo site_url('categorias/create'); ?>">Criar categoria</a></li>
</ul>
<?php if (count($categorias) > 0) : ?>
    <table class="view-data">
        <thead>
            <tr>
                <td>ID</td>
                <td>Nome da categoria</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $categoria) : ?>
                <tr>
                    <td><?php echo $categoria->id; ?></td>
                    <td><?php echo $categoria->titulo; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>