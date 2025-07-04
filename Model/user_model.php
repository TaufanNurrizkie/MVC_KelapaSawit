<?php
require_once './Cores/Database7.php';

class user_model {
    private $table = 'users';
    private $db;

    public function __construct() {
        $this->db = new Database7;
    }

    public function register($data) {
        $query = "INSERT INTO {$this->table} (name, email, username, password, role, availability_time)
                  VALUES (:name, :email, :username, :password, :role, :availability_time)";
        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind('role', $data['role']);
        $this->db->bind('availability_time', $data['availability_time']);
        return $this->db->execute();
    }

    public function login($username) {
        $this->db->query("SELECT * FROM {$this->table} WHERE username = :username");
        $this->db->bind('username', $username);
        return $this->db->single();
    }
}
