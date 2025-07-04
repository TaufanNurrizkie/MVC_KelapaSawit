<?php
require_once './Cores/Database7.php';

class area_kerja
{
    private $table = 'areas';
    private $db;

    public function __construct()
    {
        $this->db = new Database7;
    }

    public function getAll()
    {
        $this->db->query("SELECT * FROM $this->table");
        return $this->db->resultSet();
    }


    public function create($data)
    {
        $this->db->query("INSERT INTO $this->table (name, size, quantity_of_trees, type_of_soil) VALUES (:name, :size, :qty, :soil)");
        $this->db->bind('name', $data['name']);
        $this->db->bind('size', $data['size']);
        $this->db->bind('qty', $data['quantity_of_trees']);
        $this->db->bind('soil', $data['type_of_soil']);
        return $this->db->execute();
    }

    public function findById($id)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function update($data)
    {
        $this->db->query("UPDATE $this->table SET name = :name, size = :size, quantity_of_trees = :qty, type_of_soil = :soil WHERE id = :id");
        $this->db->bind('id', $data['id']);
        $this->db->bind('name', $data['name']);
        $this->db->bind('size', $data['size']);
        $this->db->bind('qty', $data['quantity_of_trees']);
        $this->db->bind('soil', $data['type_of_soil']);
        return $this->db->execute();
    }

    public function delete($id)
    {
        $this->db->query("DELETE FROM $this->table WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->execute();
    }
}
