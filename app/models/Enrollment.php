<?php

class Enrollment {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function checkEnrollment($course_id, $user_id) {
        $this->db->query("SELECT * FROM enrollments WHERE course_id = :course_id AND user_id = :user_id");
        $this->db->bind(':course_id', $course_id);
        $this->db->bind(':user_id', $user_id);
        
        $row = $this->db->single();
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function enrollUser($course_id, $user_id) {
        $this->db->query('INSERT INTO enrollments (course_id, user_id, payment_status) VALUES(:course_id, :user_id, :payment_status)');
        
        $this->db->bind(':course_id', $course_id);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':payment_status', 'completed');

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addPaymentRecord($course_id, $user_id, $amount) {
        $this->db->query('INSERT INTO payments (course_id, user_id, amount, payment_method, status) VALUES(:course_id, :user_id, :amount, :payment_method, :status)');
        
        $this->db->bind(':course_id', $course_id);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':amount', $amount);
        $this->db->bind(':payment_method', 'mock_gateway');
        $this->db->bind(':status', 'completed');

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getEnrolledCourses($user_id) {
        $this->db->query("SELECT c.*, e.purchase_date, u.name as creator_name,
                        (SELECT COUNT(*) FROM lessons l JOIN modules m ON l.module_id = m.id WHERE m.course_id = c.id) as total_lessons,
                        (SELECT COUNT(*) FROM lesson_progress lp JOIN lessons l ON lp.lesson_id = l.id JOIN modules m ON l.module_id = m.id WHERE m.course_id = c.id AND lp.user_id = :user_id AND lp.completed = 1) as completed_lessons
                        FROM courses c 
                        JOIN enrollments e ON c.id = e.course_id 
                        JOIN users u ON c.creator_id = u.id
                        WHERE e.user_id = :user_id
                        ORDER BY e.purchase_date DESC");
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }
}
