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
        $this->db->select('usuarios.id, usuarios.nome, usuarios.email, usuarios.dt_nascimento, usuarios.ft_perfil, usuarios.subcategoria_id, usuarios.update_at, subcategorias.titulo as subTitulo, subcategorias.categoria_id, categorias.titulo as catTitulo');
        $this->db->from('usuarios');
        $this->db->join('subcategorias', 'usuarios.subcategoria_id = subcategorias.id', 'left');
        $this->db->join('categorias', 'subcategorias.categoria_id = categorias.id', 'left');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function find($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('usuarios');
        return $query->row();
    }


    public function insert($post)
    {
        $this->nome = $post['nome'];
        $this->email = $post['email'];
        $this->dt_nascimento = self::date_converter($post['nascimento']);
        $this->ft_perfil = $post['foto'];
        $this->subcategoria_id = $this->input->post('subcategoria_id') ? $this->input->post('subcategoria_id') : null;

        return $this->db->insert('usuarios', $this);
    }

    public function delete($usuario) 
    {
        unlink($usuario->ft_perfil);
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
