<?php
require_once './Cores/Database7.php';

class karyawan_model
{
    private $db;
    private $table = 'users';

    public function __construct()
    {
        $this->db = new Database7;
    }

    public function getAll()
    {
        $this->db->query("SELECT * FROM $this->table ORDER BY role ASC, name ASC");
        return $this->db->resultSet();
    }

    public function getAllAdmins()
    {
        $this->db->query("SELECT * FROM users WHERE role = 'admin' ORDER BY name ASC");
        return $this->db->resultSet();
    }

    public function getAllKaryawans()
    {
        $this->db->query("SELECT * FROM users WHERE role = 'karyawan' ORDER BY name ASC");
        return $this->db->resultSet();
    }
}
