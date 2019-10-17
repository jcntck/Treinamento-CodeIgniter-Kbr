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
	}

	public function index()
	{
		$data['title'] = 'Categorias';
		$data['categorias'] = $this->categorias_model->get_categorias();

		$this->load->view('templates/header', $data);
		$this->load->view('categorias/index', $data);
		$this->load->view('templates/footer');
	}

	// public function view($slug = NULL) 
	// {
	// 	$data['news_item'] = $this->news_model->get_news($slug);

	// 	if (empty($data['news_item']))
	//     {
	//             show_404();
	// 	}

	// 	$data['title'] = $data['news_item']['title'];

	// 	$this->load->view('templates/header', $data);
	// 	$this->load->view('news/view', $data);
	// 	$this->load->view('templates/footer');
	// }

	public function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = 'Cadastro categorias';

		$this->form_validation->set_rules('titulo', 'Nome', 'required|max_length[128]|is_unique[categorias.titulo]');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('categorias/create');
			$this->load->view('templates/footer');
		} else {
			$data['success'] = TRUE;
			$this->categorias_model->insert_categoria();
			$data['categorias'] = $this->categorias_model->get_categorias();

			$this->load->view('templates/header', $data);
			$this->load->view('categorias/index', $data);
			$this->load->view('templates/footer');
		}
	}
}
