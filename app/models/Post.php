<?php

class Post {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getPostsByCreator($creator_id) {
        $this->db->query("SELECT * FROM posts WHERE creator_id = :creator_id ORDER BY created_at DESC");
        $this->db->bind(':creator_id', $creator_id);
        return $this->db->resultSet();
    }

    public function getAllPosts() {
        $this->db->query("SELECT p.*, u.name as creator_name FROM posts p JOIN users u ON p.creator_id = u.id ORDER BY p.created_at DESC");
        return $this->db->resultSet();
    }

    public function getFeedForStudent($user_id) {
        $this->db->query("SELECT DISTINCT p.*, u.name as creator_name 
                          FROM posts p 
                          JOIN users u ON p.creator_id = u.id 
                          JOIN courses c ON c.creator_id = u.id 
                          JOIN enrollments e ON e.course_id = c.id 
                          WHERE e.user_id = :user_id 
                          ORDER BY p.created_at DESC");
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }

    public function addPost($data) {
        $this->db->query('INSERT INTO posts (creator_id, title, content, video_url) VALUES(:creator_id, :title, :content, :video_url)');
        
        $this->db->bind(':creator_id', $data['creator_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':video_url', $data['video_url']);

        return $this->db->execute();
    }

    public function deletePost($id, $creator_id) {
        $this->db->query("DELETE FROM posts WHERE id = :id AND creator_id = :creator_id");
        $this->db->bind(':id', $id);
        $this->db->bind(':creator_id', $creator_id);
        return $this->db->execute();
    }
}
