<?php
require_once './Cores/Database7.php';

class seleksi_penempatan
{
    private $db;
    private $table = 'applications';

    public function __construct()
    {
        $this->db = new Database7;
    }

    public function getAllApplications()
    {
        $this->db->query("SELECT a.*, u.name AS user_name, s.description AS schedule_desc
                          FROM applications a
                          JOIN users u ON a.user_id = u.id
                          JOIN schedules s ON a.schedule_id = s.id
                          ORDER BY a.created_at DESC");
        return $this->db->resultSet();
    }

    public function apply($userId, $scheduleId)
    {
        $this->db->query("INSERT INTO $this->table (user_id, schedule_id) VALUES (:user_id, :schedule_id)");
        $this->db->bind('user_id', $userId);
        $this->db->bind('schedule_id', $scheduleId);
        return $this->db->execute();
    }

    public function updateStatus($id, $status)
    {
        $this->db->query("UPDATE $this->table SET status = :status WHERE id = :id");
        $this->db->bind('status', $status);
        $this->db->bind('id', $id);
        return $this->db->execute();
    }

    public function findById($id)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }
}
