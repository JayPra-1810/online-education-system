<?php

class Review {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getReviewsByCourse($course_id) {
        $this->db->query("SELECT r.*, u.name as user_name FROM reviews r 
                          JOIN users u ON r.user_id = u.id 
                          WHERE r.course_id = :course_id 
                          ORDER BY r.created_at DESC");
        $this->db->bind(':course_id', $course_id);
        return $this->db->resultSet();
    }

    public function getAverageRating($course_id) {
        $this->db->query("SELECT AVG(rating) as avg_rating, COUNT(*) as review_count FROM reviews WHERE course_id = :course_id");
        $this->db->bind(':course_id', $course_id);
        return $this->db->single();
    }

    public function addReview($data) {
        $this->db->query('INSERT INTO reviews (course_id, user_id, rating, review_text) VALUES(:course_id, :user_id, :rating, :review_text)');
        $this->db->bind(':course_id', $data['course_id']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':rating', $data['rating']);
        $this->db->bind(':review_text', $data['review_text']);
        return $this->db->execute();
    }

    public function checkUserReview($course_id, $user_id) {
        $this->db->query("SELECT id FROM reviews WHERE course_id = :course_id AND user_id = :user_id");
        $this->db->bind(':course_id', $course_id);
        $this->db->bind(':user_id', $user_id);
        return $this->db->single() ? true : false;
    }
}
