<?php

class Progress {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getLessonProgress($user_id, $lesson_id) {
        $this->db->query("SELECT * FROM lesson_progress WHERE user_id = :user_id AND lesson_id = :lesson_id");
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':lesson_id', $lesson_id);
        return $this->db->single();
    }

    public function markAsComplete($user_id, $lesson_id) {
        $this->db->query("INSERT INTO lesson_progress (user_id, lesson_id, completed, completed_at) 
                        VALUES (:user_id, :lesson_id, 1, NOW()) 
                        ON DUPLICATE KEY UPDATE completed = 1, completed_at = NOW()");
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':lesson_id', $lesson_id);
        return $this->db->execute();
    }

    public function getCourseProgressStatus($user_id, $course_id) {
        $this->db->query("SELECT lp.lesson_id, lp.completed 
                        FROM lesson_progress lp 
                        JOIN lessons l ON lp.lesson_id = l.id 
                        JOIN modules m ON l.module_id = m.id 
                        WHERE m.course_id = :course_id AND lp.user_id = :user_id");
        $this->db->bind(':course_id', $course_id);
        $this->db->bind(':user_id', $user_id);
        $results = $this->db->resultSet();
        
        $progress = [];
        foreach($results as $row) {
            $progress[$row->lesson_id] = $row->completed;
        }
        return $progress;
    }
}
