<?php
class Categorias_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url');
    }

    public function get()
    {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('categorias');
        return $query->result();
    }

    public function find($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('categorias');
        return $query->row();
    }

    public function insert()
    {
        $this->titulo = $this->input->post('titulo');
        $this->db->insert('categorias', $this);
    }

    public function update($id)
    {
        $this->titulo = $this->input->post('titulo');
        $this->db->where('id', $id);
        $this->db->update('categorias', $this);
    }

    public function delete($id) 
    {
        $this->db->delete('categorias', array('id' => $id));
    }
}
