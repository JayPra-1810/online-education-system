<?php

class Certificate {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getCertificatesByUser($user_id) {
        $this->db->query("SELECT c.*, co.title as course_title FROM certificates c 
                          JOIN courses co ON c.course_id = co.id 
                          WHERE c.user_id = :user_id 
                          ORDER BY c.issued_at DESC");
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }

    public function getCertificate($user_id, $course_id) {
        $this->db->query("SELECT * FROM certificates WHERE user_id = :user_id AND course_id = :course_id");
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':course_id', $course_id);
        return $this->db->single();
    }

    public function generate($user_id, $course_id) {
        // Check if already exists
        if($this->getCertificate($user_id, $course_id)) {
            return true;
        }

        $certificate_no = 'CERT-' . strtoupper(uniqid());
        
        $this->db->query('INSERT INTO certificates (user_id, course_id, certificate_url) VALUES(:user_id, :course_id, :url)');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':course_id', $course_id);
        $this->db->bind(':url', $certificate_no);

        return $this->db->execute();
    }
}
