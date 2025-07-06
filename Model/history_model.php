<?php
require_once './Cores/Database7.php';

class History
{
    private $db;
    private $table = 'history';

    public function __construct()
    {
        $this->db = new Database7;
    }

    // Simpan riwayat baru
    public function simpanRiwayat($data)
    {
        $this->db->query("INSERT INTO $this->table 
            (user_id, schedule_id, absensi, notes, salary) 
            VALUES (:user_id, :schedule_id, :absensi, :notes, :salary)");
        $this->db->bind('user_id', $data['user_id']);
        $this->db->bind('schedule_id', $data['schedule_id']);
        $this->db->bind('absensi', $data['absensi']);
        $this->db->bind('notes', $data['notes']);
        $this->db->bind('salary', $data['salary']);
        return $this->db->execute();
    }

    // Ambil semua riwayat (untuk admin)
    public function getAll()
    {
        $this->db->query("SELECT h.*, u.name AS user_name, s.description AS schedule_desc
                          FROM $this->table h
                          JOIN users u ON h.user_id = u.id
                          JOIN schedules s ON h.schedule_id = s.id
                          ORDER BY h.created_at DESC");
        return $this->db->resultSet();
    }

    // Ambil riwayat untuk user tertentu
    public function getByUser($user_id)
    {
        $this->db->query("SELECT h.*, s.description AS schedule_desc 
                          FROM $this->table h 
                          JOIN schedules s ON h.schedule_id = s.id 
                          WHERE h.user_id = :uid 
                          ORDER BY h.created_at DESC");
        $this->db->bind('uid', $user_id);
        return $this->db->resultSet();
    }

    
}
