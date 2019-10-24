<?php

class Usuarios extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('categorias_model', 'subcategorias_model', 'usuarios_model'));
        $this->load->helper(array('form'));
        $this->load->library(array('session', 'form_validation'));
    }

    public function index()
    {
        $data['title'] = 'Usuários';
        $data['usuarios'] = $this->usuarios_model->get();
        $data['categorias'] = $this->categorias_model->get();

        $this->load->view('usuarios/index', $data);
    }

    public function create($data = null)
    {
        $data['title'] = 'Cadastro usuários';
        $data['categorias'] = $this->categorias_model->get();
        if (empty($data['errors'])) {
            $data['errors'] = null;
        }

        $this->load->view('usuarios/create', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('nome', '"Nome"', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('email', '"Email"', 'trim|required|valid_email|max_length[128]|is_unique[usuarios.email]', array('is_unique' => 'Esse e-mail já existe.'));
        $this->form_validation->set_rules('nascimento', '"Data de Nascimento"', 'trim|required|callback_date_valid', array('date_valid' => 'Digite uma data válida.'));

        if ($this->form_validation->run() === FALSE) {
            $data['errors'] = validation_errors();
            $this->create($data);
        } else {
            $posts = $this->input->post();
            $post = [
                'nome' => $posts['nome'],
                'email' => $posts['email'],
                'nascimento' => $posts['nascimento'],
                'foto' => $this->uploadImage()
            ];
            $this->usuarios_model->insert($post);
            $this->session->set_flashdata('success', 'Usuário cadastrado!');
            redirect('usuarios/');
        }
    }

    public function delete($id)
	{
        $usuario = $this->usuarios_model->find($id);
		$this->usuarios_model->delete($usuario);
		$this->session->set_flashdata('success', 'Usuário deletado!');
		redirect('usuarios/');
	}

    public function filtrarSubcategorias()
    {
        $idCategoria = $this->input->post('idCategoria');

        $subcategorias = $this->subcategorias_model->findByCategoria($idCategoria);

        $option = "<option value=''>-- Selecione uma subcategoria --</option>";
        foreach ($subcategorias as $subcategoria) {
            $option .= "<option value='" . $subcategoria->id . "'>" . $subcategoria->titulo . "</option>";
        }
        echo $option;
    }

    function date_valid($date)
    {
        $day = (int) substr($date, 0, 2);
        $month = (int) substr($date, 3, 2);
        $year = (int) substr($date, 6, 4);
        return checkdate($month, $day, $year);
    }

    private function uploadImage()
    {
        $configUpload['upload_path'] = './assets/images';
        $configUpload['allowed_types'] = 'jpg|png';
        $configUpload['encrypt_name'] = TRUE;

        $this->load->library('upload');
        $this->upload->initialize($configUpload);

        if (!$this->upload->do_upload('foto')) {
            $data['errors'] = $this->upload->display_errors();
            return var_dump($data);
        } else {
            $dadosImagem = $this->upload->data();
            $tamanhos = $this->CalculaPercetual($this->input->post());

            $configCrop['image_library'] = 'gd2';
            $configCrop['source_image'] = $dadosImagem['full_path'];
            $configCrop['new_image'] = './assets/images/crop/';
            $configCrop['maintain_ratio'] = FALSE;
            $configCrop['quality']= 100;
            $configCrop['width']  = $tamanhos['wcrop'];
            $configCrop['height'] = $tamanhos['hcrop'];
            $configCrop['x_axis'] = $tamanhos['x'];
            $configCrop['y_axis'] = $tamanhos['y'];

            $this->load->library('image_lib');
            $this->image_lib->initialize($configCrop);

            if (!$this->image_lib->crop()) {
                $data['errors'] = $this->image_lib->display_errors();
                return var_dump($data);
            } else {
                $urlImagem = 'assets/images/crop/' . $dadosImagem['file_name'];
                unlink($dadosImagem['full_path']);
                return $urlImagem;
            }
        }
    }

    private function CalculaPercetual($dimensoes)
    {
        if ($dimensoes['woriginal'] > $dimensoes['wvisualizacao']) {

            $percentual = $dimensoes['woriginal'] / $dimensoes['wvisualizacao'];

            $dimensoes['x'] = round($dimensoes['x'] * $percentual);
            $dimensoes['y'] = round($dimensoes['y'] * $percentual);
            $dimensoes['wcrop'] = round($dimensoes['wcrop'] * $percentual);
            $dimensoes['hcrop'] = round($dimensoes['hcrop'] * $percentual);
        }

        return $dimensoes;
    }
}
