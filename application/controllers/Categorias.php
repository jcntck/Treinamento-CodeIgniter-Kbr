<?php
defined('BASEPATH') or exit('Nenhum acesso direto ao script permitido');

class Categorias extends CI_Controller
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
		$this->load->model('categorias_model');
		$this->load->helper('url_helper');
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'Categorias';
		$data['categorias'] = $this->categorias_model->get();

		$this->load->view('templates/header', $data);
		$this->load->view('categorias/index', $data);
		$this->load->view('templates/footer');
	}

	public function create()
	{
		$data['title'] = 'Cadastro categorias';

		$this->load->view('templates/header', $data);
		$this->load->view('categorias/create');
		$this->load->view('templates/footer');
	}


	public function store()
	{

		$this->form_validation->set_rules(
			'titulo',
			'"Categoria"',
			'required|max_length[128]|is_unique[categorias.titulo]',
			array('is_unique' => $this->input->post('titulo') . ' já existe.')
		);

		if ($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('errors', validation_errors());
			redirect(site_url('categorias/create'));
		} else {
			$this->categorias_model->insert();
			$this->session->set_flashdata('success', 'Categoria cadastrada!');
			redirect('categorias/');
		}
	}

	public function edit($id)
	{
		$data['title'] = 'Atualizar categorias';
		$data['categoria'] = $this->categorias_model->find($id);

		$this->load->view('templates/header', $data);
		$this->load->view('categorias/update', $data);
		$this->load->view('templates/footer');
	}

	public function update($id)
	{
		$categoria = $this->categorias_model->find($id);

		if ($this->input->post('titulo') != $categoria->titulo) {
			$this->form_validation->set_rules(
				'titulo',
				'"Categoria"',
				'required|max_length[128]|is_unique[categorias.titulo]',
				array('is_unique' => $this->input->post('titulo') . ' já existe.')
			);
		} else {
			$this->form_validation->set_rules(
				'titulo',
				'"Categoria"',
				'required|max_length[128]'
			);
		}


		if ($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('errors', validation_errors());
			redirect(site_url('categorias/edit/') . $id);
		} else {
			$this->categorias_model->update($id);
			$this->session->set_flashdata('success', 'Categoria cadastrada!');
			redirect('categorias/');
		}
	}

	public function delete($id)
	{
		$this->categorias_model->delete($id);
		$this->session->set_flashdata('success', 'Categoria deletada!');
		redirect('categorias/');
	}
}
