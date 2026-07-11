<?php

class Admin {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAnalytics() {
        $stats = [];

        // Total Users
        $this->db->query("SELECT COUNT(*) AS total FROM users WHERE role != 'admin'");
        $stats['total_users'] = $this->db->single()->total;

        // Total Revenue
        $this->db->query("SELECT SUM(amount) AS total FROM payments WHERE status = 'completed'");
        $stats['total_revenue'] = $this->db->single()->total ?? 0;

        // Total Courses
        $this->db->query("SELECT COUNT(*) AS total FROM courses");
        $stats['total_courses'] = $this->db->single()->total;

        // Total Enrollments
        $this->db->query("SELECT COUNT(*) AS total FROM enrollments");
        $stats['total_enrollments'] = $this->db->single()->total;

        // Recent Activity
        $this->db->query("SELECT u.name, u.role, u.created_at FROM users u ORDER BY u.created_at DESC LIMIT 5");
        $stats['recent_users'] = $this->db->resultSet();

        return $stats;
    }

    public function getPendingCourses() {
        $this->db->query("SELECT c.*, u.name as creator_name FROM courses c JOIN users u ON c.creator_id = u.id WHERE c.status = 'draft' ORDER BY c.created_at ASC");
        return $this->db->resultSet();
    }

    public function updateCourseStatus($course_id, $status) {
        $this->db->query("UPDATE courses SET status = :status WHERE id = :id");
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $course_id);
        return $this->db->execute();
    }

    public function getUsers() {
        $this->db->query("SELECT id, name, email, role, status, created_at FROM users WHERE role != 'admin' ORDER BY created_at DESC");
        return $this->db->resultSet();
    }

    public function updateUserStatus($user_id, $status) {
        $this->db->query("UPDATE users SET status = :status WHERE id = :id");
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $user_id);
        return $this->db->execute();
    }

    public function getPayments() {
        $this->db->query("SELECT p.*, u.name as user_name, u.email as user_email, c.title as course_title 
                          FROM payments p 
                          JOIN users u ON p.user_id = u.id 
                          JOIN courses c ON p.course_id = c.id 
                          ORDER BY p.created_at DESC");
        return $this->db->resultSet();
    }
}
