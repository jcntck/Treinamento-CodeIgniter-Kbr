<?php

class Usuarios extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model(array('categorias_model', 'subcategorias_model'));
		$this->load->helper(array('form'));
		$this->load->library(array('session', 'form_validation'));
	}

    public function index()
    {
        $data['title'] = 'Usuários';

        $this->load->view('usuarios/index', $data);
    }

    public function create($data = null)
	{
        $data['title'] = 'Cadastro usuários';
        $data['categorias'] = $this->categorias_model->get();
		if(empty($data['errors'])) {
			$data['errors'] = null;
        }

		$this->load->view('usuarios/create', $data);
    }
    
    public function filtrarSubcategorias()
    {
        $idCategoria = $this->input->post('idCategoria');

        $subcategorias = $this->subcategorias_model->findByCategoria($idCategoria);

        $option = "<option value=''>-- Selecione uma subcategoria --</option>";
        foreach($subcategorias as $subcategoria) {
            $option .= "<option value='".$subcategoria->id."'>".$subcategoria->titulo."</option>";
        }
        echo $option;
    }
}
