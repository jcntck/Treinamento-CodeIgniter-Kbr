<?php
class Categorias_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_categorias()
    {
        $query = $this->db->get('categorias');
        return $query->result();
    }

    public function insert_categoria()
    {
        $this->load->helper('url');

        $this->titulo = $this->input->post('titulo');

        $this->db->insert('categorias', $this);
    }
}
