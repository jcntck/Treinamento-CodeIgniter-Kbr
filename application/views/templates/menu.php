<body>
    <div class="d-flex toggled" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-default border-right-custom" id="sidebar-wrapper">
            <div class="sidebar-heading">CodeIgniter - CRUD </div>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action item-custom">Usuários</a>
                <a href="<?=base_url('categorias/');?>" class="list-group-item list-group-item-action item-custom">Categorias</a>
                <a href="<?=base_url('subcategorias/');?>" class="list-group-item list-group-item-action item-custom">Subcategorias</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-default border-bottom-custom">
                <button class="btn btn-default" id="menu-toggle"><i class="fas fa-bars"></i></button>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

        