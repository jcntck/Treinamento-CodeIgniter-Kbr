<?php
class Subcategorias_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url');
    }

    public function get()
    {
        $this->db->select('*');
        $this->db->from('subcategorias');
        $this->db->join('categorias', 'categorias.id = subcategorias.categoria_id');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function find($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('subcategorias');
        return $query->row();
    }

    public function insert()
    {
        $this->titulo = $this->input->post('titulo');
        $this->db->insert('subcategorias', $this);
    }

    // public function update($id)
    // {
    //     $this->titulo = $this->input->post('titulo');
    //     $this->db->where('id', $id);
    //     $this->db->update('categorias', $this);
    // }

    public function delete($id) 
    {
        $this->db->delete('subcategorias', array('id' => $id));
    }
}
