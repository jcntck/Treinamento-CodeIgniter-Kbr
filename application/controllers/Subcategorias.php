<?php
defined('BASEPATH') or exit('Nenhum acesso direto ao script permitido');

class Subcategorias extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('subcategorias_model', 'categorias_model'));
		$this->load->helper(array('url_helper', 'html', 'form'));
		$this->load->library(array('session', 'form_validation'));
	}

	public function index()
	{
		$data['title'] = 'Subcategorias';
		$data['categorias'] = $this->categorias_model->get();
		$data['subcategorias'] = $this->subcategorias_model->get();

		$this->load->view('subcategorias/index', $data);
	}

	public function create($data = null)
	{
		$data['title'] = 'Cadastro subcategorias';
		$data['categorias'] = $this->categorias_model->get();
		if (empty($data['errors'])) {
			$data['errors'] = null;
		}

		$this->load->view('subcategorias/create', $data);
	}


	public function store()
	{
		$this->form_validation->set_rules('categoria_id', '"Categoria"', 'required');
		$this->form_validation->set_rules(
			'titulo',
			'"Subcategoria"',
			'trim|required|max_length[128]|is_unique[subcategorias.titulo]',
			array('is_unique' => $this->input->post('titulo') . ' já existe.')
		);

		if ($this->form_validation->run() === FALSE) {
			$data['errors'] = validation_errors();

			$this->create($data);
		} else {
			if ($this->subcategorias_model->insert()) {
				$this->session->set_flashdata('success', 'Subcategoria cadastrada!');
			} else {
				$this->session->set_flashdata('errors', 'Não foi possível cadastrar a Subcategoria. Tente novamente mais tarde!');
			}
			redirect('subcategorias/');
		}
	}

	public function edit($id, $data = null)
	{
		$data['title'] = 'Atualizar subcategorias';
		$data['categorias'] = $this->categorias_model->get();
		$data['subcategoria'] = $this->subcategorias_model->find($id);
		if (empty($data['errors'])) {
			$data['errors'] = null;
		}

		$this->load->view('subcategorias/update', $data);
	}

	public function update($id)
	{
		$subcategoria = $this->subcategorias_model->find($id);

		$this->form_validation->set_rules('categoria_id', '"Categoria"', 'required');
		if ($this->input->post('titulo') != $subcategoria->titulo) {
			$this->form_validation->set_rules(
				'titulo',
				'"Subcategoria"',
				'trim|required|max_length[50]|is_unique[subcategorias.titulo]',
				array('is_unique' => $this->input->post('titulo') . ' já existe.')
			);
		} else {
			$this->form_validation->set_rules(
				'titulo',
				'"Subcategoria"',
				'trim|required|max_length[50]'
			);
		}


		if ($this->form_validation->run() === FALSE) {
			$data['errors'] = validation_errors();
			$this->edit($id, $data);
		} else {
			if ($this->subcategorias_model->update($id)) {
				$this->session->set_flashdata('success', 'Subcategoria atualizada!');
			} else {
				$this->session->set_flashdata('error', 'Não foi possível atualizar esta subcategoria. Tente novamente mais tarde.');
			}
			redirect('subcategorias/');
		}
	}

	public function delete($id)
	{
		$this->subcategorias_model->delete($id);
		$this->session->set_flashdata('success', 'Subcategoria deletada!');
		redirect('subcategorias/');
	}
}
