<?php
class Gaji
{
    private $db;

    public function __construct()
    {
        $this->db = new Database7(); // asumsi kamu sudah punya class Database
    }

    public function getGajiByUser($userId)
    {
        $sql = "
        SELECT 
            g.id,
            g.schedule_id,
            a.name AS area_name,
            ws.choice_of_role,
            s.description,
            s.start_day,
            s.finish_day,
            g.salary,
            g.created_at
        FROM wages g
        LEFT JOIN schedules s ON g.schedule_id = s.id
        LEFT JOIN work_schedules ws ON ws.schedule_id = s.id AND ws.employee_id = g.employee_id
        LEFT JOIN areas a ON s.area_id = a.id
        WHERE g.employee_id = :user_id
        ORDER BY g.created_at DESC
    ";

        $this->db->query($sql);
        $this->db->bind('user_id', $userId);
        return $this->db->resultSet();
    }
}
