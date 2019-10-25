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
        $this->db->select('subcategorias.id, subcategorias.titulo, subcategorias.categoria_id, categorias.titulo as categoria');
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

    public function findByCategoria($idCategoria)
    {
        $this->db->select('subcategorias.titulo, categorias.titulo as tituloCategoria, subcategorias.id, subcategorias.categoria_id');
        $this->db->from('subcategorias');
        $this->db->join('categorias', 'categorias.id = categoria_id');
        $this->db->where('categoria_id', $idCategoria);
        $query = $this->db->get();
        return $query->result();
    }

    public function insert()
    {
        $this->titulo = $this->input->post('titulo');
        $this->categoria_id = $this->input->post('categoria_id');
        return $this->db->insert('subcategorias', $this);
    }

    public function update($id)
    {
        $this->titulo = $this->input->post('titulo');
        $this->categoria_id = $this->input->post('categoria_id');
        $this->db->where('id', $id);
        return $this->db->update('subcategorias', $this);
    }

    public function delete($id) 
    {
        $this->db->delete('subcategorias', array('id' => $id));
    }
}
