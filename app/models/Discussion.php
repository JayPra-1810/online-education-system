<?php

class Discussion {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getDiscussionsByCourse($course_id) {
        $this->db->query("SELECT d.*, u.name as user_name FROM discussions d 
                          JOIN users u ON d.user_id = u.id 
                          WHERE d.course_id = :course_id 
                          ORDER BY d.created_at DESC");
        $this->db->bind(':course_id', $course_id);
        $discussions = $this->db->resultSet();
        
        foreach($discussions as $discussion) {
            $discussion->replies = $this->getReplies($discussion->id);
        }
        
        return $discussions;
    }

    public function getReplies($discussion_id) {
        $this->db->query("SELECT r.*, u.name as user_name FROM replies r 
                          JOIN users u ON r.user_id = u.id 
                          WHERE r.discussion_id = :discussion_id 
                          ORDER BY r.created_at ASC");
        $this->db->bind(':discussion_id', $discussion_id);
        return $this->db->resultSet();
    }

    public function addDiscussion($data) {
        $this->db->query('INSERT INTO discussions (course_id, user_id, content) VALUES(:course_id, :user_id, :content)');
        $this->db->bind(':course_id', $data['course_id']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':content', $data['content']);
        return $this->db->execute();
    }

    public function addReply($data) {
        $this->db->query('INSERT INTO replies (discussion_id, user_id, content) VALUES(:discussion_id, :user_id, :content)');
        $this->db->bind(':discussion_id', $data['discussion_id']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':content', $data['content']);
        return $this->db->execute();
    }
}
