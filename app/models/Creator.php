<?php

class Creator {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAnalytics($creator_id) {
        $analytics = [];

        // Total Courses
        $this->db->query("SELECT COUNT(*) as total FROM courses WHERE creator_id = :creator_id");
        $this->db->bind(':creator_id', $creator_id);
        $analytics['total_courses'] = $this->db->single()->total;

        // Total Students (Distinct enrollments across all creator's courses)
        $this->db->query("SELECT COUNT(DISTINCT e.user_id) as total 
                          FROM enrollments e 
                          JOIN courses c ON e.course_id = c.id 
                          WHERE c.creator_id = :creator_id");
        $this->db->bind(':creator_id', $creator_id);
        $analytics['total_students'] = $this->db->single()->total;

        // Total Revenue
        $this->db->query("SELECT SUM(p.amount) as total 
                          FROM payments p 
                          JOIN courses c ON p.course_id = c.id 
                          WHERE c.creator_id = :creator_id AND p.status = 'completed'");
        $this->db->bind(':creator_id', $creator_id);
        $analytics['total_revenue'] = $this->db->single()->total ?? 0;

        // Course Performance
        $this->db->query("SELECT c.id, c.title, c.price, 
                          (SELECT COUNT(*) FROM enrollments WHERE course_id = c.id) as enrollment_count,
                          (SELECT SUM(amount) FROM payments WHERE course_id = c.id AND status = 'completed') as revenue
                          FROM courses c 
                          WHERE c.creator_id = :creator_id 
                          ORDER BY enrollment_count DESC");
        $this->db->bind(':creator_id', $creator_id);
        $analytics['course_performance'] = $this->db->resultSet();

        // Recent Enrollments
        $this->db->query("SELECT e.purchase_date, u.name as student_name, c.title as course_title 
                          FROM enrollments e 
                          JOIN users u ON e.user_id = u.id 
                          JOIN courses c ON e.course_id = c.id 
                          WHERE c.creator_id = :creator_id 
                          ORDER BY e.purchase_date DESC 
                          LIMIT 5");
        $this->db->bind(':creator_id', $creator_id);
        $analytics['recent_enrollments'] = $this->db->resultSet();

        return $analytics;
    }
}
