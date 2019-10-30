<?php

class Usuarios_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url');
    }

    public function get()
    {
        $this->db->select('usuarios.id, usuarios.nome, usuarios.email, usuarios.dt_nascimento, usuarios.ft_perfil, usuarios.descricao, usuarios.subcategoria_id, usuarios.created_at, usuarios.updated_at, subcategorias.titulo as subTitulo, subcategorias.categoria_id, categorias.titulo as catTitulo, categorias.id as catId');
        $this->db->from('usuarios');
        $this->db->join('subcategorias', 'usuarios.subcategoria_id = subcategorias.id', 'left');
        $this->db->join('categorias', 'subcategorias.categoria_id = categorias.id', 'left');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function find($id)
    {
        $this->db->select('usuarios.id, usuarios.nome, usuarios.email, usuarios.dt_nascimento, usuarios.ft_perfil, usuarios.descricao, usuarios.subcategoria_id, usuarios.created_at, usuarios.updated_at, subcategorias.titulo as subTitulo, subcategorias.categoria_id, categorias.titulo as catTitulo, categorias.id as catId');
        $this->db->from('usuarios');
        $this->db->join('subcategorias', 'usuarios.subcategoria_id = subcategorias.id', 'left');
        $this->db->join('categorias', 'subcategorias.categoria_id = categorias.id', 'left');
        $this->db->where('usuarios.id', $id);
        $query = $this->db->get();
        return $query->row();
    }


    public function insert($post)
    {
        $this->nome = $post['nome'];
        $this->email = $post['email'];
        $this->dt_nascimento = self::date_converter($post['nascimento']);
        $this->ft_perfil = $post['foto'];
        $this->descricao = $post['descricao'];
        $this->subcategoria_id = $this->input->post('subcategoria_id') ? $this->input->post('subcategoria_id') : null;

        $this->db->insert('usuarios', $this);
        return $this->db->insert_id();
    }

    public function update($id, $post)
    {
        $this->nome = $post['nome'];
        $this->email = $post['email'];
        $this->dt_nascimento = self::date_converter($post['nascimento']);
        $this->ft_perfil = $post['foto'];
        $this->descricao = $post['descricao'];
        $this->subcategoria_id = $this->input->post('subcategoria_id') ? $this->input->post('subcategoria_id') : null;
        $this->db->where('id', $id);

        return $this->db->update('usuarios', $this);
    }

    public function delete($usuario) 
    {
        unlink('./assets/images/crop/' . $usuario->ft_perfil);
        $this->db->delete('usuarios', array('id' => $usuario->id));
    }

    private function date_converter($_date = null)
    {
        $format = '/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/';
        if ($_date != null && preg_match($format, $_date, $partes)) {
            return $partes[3] . '-' . $partes[2] . '-' . $partes[1];
        }
        return false;
    }
}
