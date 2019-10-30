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
        $this->form_validation->set_rules('foto', '"Foto"', 'callback_validate_image');
        if ($this->input->post('categoria_id')) {
            $this->form_validation->set_rules('subcategoria_id', '"Subcategoria"', 'trim|required', array('required' => 'Selecione a subcategoria referente a categoria escolhida.'));
        }

        if ($this->form_validation->run() === FALSE) {
            $data['errors'] = validation_errors();
            $this->create($data);
        } else {
            $posts = $this->input->post();
            $post = [
                'nome' => $posts['nome'],
                'email' => $posts['email'],
                'nascimento' => $posts['nascimento'],
                'foto' => $this->uploadImage(),
                'descricao' => $posts['descricao']
            ];
            $id = $this->usuarios_model->insert($post);
            $data['usuario'] = $this->usuarios_model->find($id);
            $data['update'] = 0;
            $data['title'] = 'CONFIRMAÇÃO DE CADASTRO';
            if ($this->SendEmailToUser($posts['email'], $posts['nome'], $data['title'], $data)) {
                $this->session->set_flashdata('success', "Usuário cadastrado");
            }
            redirect('usuarios/');
        }
    }

    public function edit($id, $data = null)
    {
        $data['title'] = 'Atualizar usuários';
        $data['usuario'] = $this->usuarios_model->find($id);
        $data['categorias'] = $this->categorias_model->get();
        $data['subcategorias'] = $this->subcategorias_model->get();

        if (empty($data['errors'])) {
            $data['errors'] = null;
        }

        $this->load->view('usuarios/update', $data);
    }

    public function update($id)
    {
        $usuario = $this->usuarios_model->find($id);

        if ($this->input->post('email') != $usuario->email) {
            $this->form_validation->set_rules('email', '"Email"', 'trim|required|valid_email|max_length[128]|is_unique[usuarios.email]', array('is_unique' => 'Esse e-mail já existe.'));
        } else {
            $this->form_validation->set_rules('email', '"Email"', 'trim|required|valid_email|max_length[128]');
        }
        $this->form_validation->set_rules('nome', '"Nome"', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('nascimento', '"Data de Nascimento"', 'trim|required|callback_date_valid', array('date_valid' => 'Digite uma data válida.'));
        $this->form_validation->set_rules('foto', '"Foto"', 'callback_validate_image');
        if ($this->input->post('categoria_id')) {
            $this->form_validation->set_rules('subcategoria_id', '"Subcategoria"', 'trim|required', array('required' => 'Selecione a subcategoria referente a categoria escolhida.'));
        }

        if ($this->form_validation->run() === FALSE) {
            $data['errors'] = validation_errors();
            $this->edit($id, $data);
        } else {
            $posts = $this->input->post();

            $img = $this->uploadImage();
            if ($img != null) {
                unlink('./assets/images/crop/' . $usuario->ft_perfil);
            } else {
                $img = $usuario->ft_perfil;
            }
            $post = [
                'nome' => $posts['nome'],
                'email' => $posts['email'],
                'nascimento' => $posts['nascimento'],
                'foto' => $img,
                'descricao' => $posts['descricao']
            ];
            $this->usuarios_model->update($id, $post);
            $data['usuario'] = $this->usuarios_model->find($id);
            $data['update'] = 1;
            $data['title'] = 'ATUALIZAÇÃO DE USUÁRIO';
            if ($this->SendEmailToUser($posts['email'], $posts['nome'], $data['title'], $data)) {
                $this->session->set_flashdata('success', 'Usuário atualizado!');
            }
            redirect('usuarios/');
        }
    }

    public function view($id)
    {
        $usuario = $this->usuarios_model->find($id);
        $data['title'] = 'Vizualizar usuário - ' . $usuario->nome;
        $data['usuario'] = $usuario;

        $this->load->view('usuarios/view', $data);
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

        echo json_encode($subcategorias);
    }


    function date_valid($date)
    {
        $day = (int) substr($date, 0, 2);
        $month = (int) substr($date, 3, 2);
        $year = (int) substr($date, 6, 4);
        return checkdate($month, $day, $year);
    }

    function validate_image()
    {
        $check = TRUE;

        if (isset($_FILES['foto']) && $_FILES['foto']['size'] != 0) {
            $allowedExts = array("gif", "jpeg", "jpg", "png", "JPG", "JPEG", "GIF", "PNG");
            $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
            $extension = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
            $detectedType = exif_imagetype($_FILES['foto']['tmp_name']);
            $type = $_FILES['foto']['type'];
            if (!in_array($detectedType, $allowedTypes)) {
                $this->form_validation->set_message('validate_image', 'Conteúdo de imagem inválido!');
                $check = FALSE;
            }
            if (filesize($_FILES['foto']['tmp_name']) > 2000000) {
                $this->form_validation->set_message('validate_image', 'O arquivo de imagem não pode exceder 20MB!');
                $check = FALSE;
            }
            if (!in_array($extension, $allowedExts)) {
                $this->form_validation->set_message('validate_image', "A extenção {$extension} é inválida!");
                $check = FALSE;
            }
        }
        return $check;
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
            $configCrop['quality'] = 100;
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
                $nomeImagem = $dadosImagem['file_name'];
                unlink($dadosImagem['full_path']);
                return $nomeImagem;
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

    private function SendEmailToUser($to, $toName, $subject, $data)
    {
        $this->load->library('email');

        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $config['protocol'] = 'smtp';
        $config['smtp_port'] = 587;
        $config['smtp_host'] = 'smtp.ambiente-dev5.provisorio.ws';
        $config['smtp_user'] = 'webmaster@ambiente-dev5.provisorio.ws';
        $config['smtp_pass'] = 'Producao5435!2';
        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";

        $this->email->initialize($config);

        $this->email->from('webmaster@ambiente-dev5.provisorio.ws', 'CodeIgniter - CrUd');
        $this->email->to($to, $toName);

        $message = $this->load->view('templates/email', $data, TRUE);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send())
            return true;
        else
            return false;
    }

    public function ViewEmail()
    {
        $data['title'] = 'Edit';
        $data['usuario'] = $this->usuarios_model->find(3);
        $data['update'] = 1;

        $this->load->view('templates/email', $data);
    }
}
