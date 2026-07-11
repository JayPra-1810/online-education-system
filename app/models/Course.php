<?php

class Course {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getCourses() {
        $this->db->query("SELECT c.*, u.name as creator_name FROM courses c JOIN users u ON c.creator_id = u.id WHERE c.status = 'published' ORDER BY c.created_at DESC");
        return $this->db->resultSet();
    }

    public function getCoursesByCreator($creator_id) {
        $this->db->query("SELECT * FROM courses WHERE creator_id = :creator_id ORDER BY created_at DESC");
        $this->db->bind(':creator_id', $creator_id);
        return $this->db->resultSet();
    }

    public function addCourse($data) {
        $this->db->query('INSERT INTO courses (creator_id, title, description, price, category, difficulty_level, status, thumbnail) VALUES(:creator_id, :title, :description, :price, :category, :difficulty_level, :status, :thumbnail)');
        
        $this->db->bind(':creator_id', $data['creator_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':difficulty_level', $data['difficulty_level']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':thumbnail', $data['thumbnail'] ?? null);

        if($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    public function getCourseById($id) {
        $this->db->query("SELECT c.*, u.name as creator_name, u.profile_image FROM courses c JOIN users u ON c.creator_id = u.id WHERE c.id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function updateCourse($id, $data) {
        $this->db->query('UPDATE courses SET title = :title, description = :description, price = :price, category = :category, difficulty_level = :difficulty_level, status = :status, thumbnail = :thumbnail WHERE id = :id');
        
        $this->db->bind(':id', $id);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':difficulty_level', $data['difficulty_level']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':thumbnail', $data['thumbnail'] ?? null);

        return $this->db->execute();
    }
}
