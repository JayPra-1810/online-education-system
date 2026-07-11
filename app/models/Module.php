<?php

class Module {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getModulesByCourse($course_id) {
        $this->db->query("SELECT * FROM modules WHERE course_id = :course_id ORDER BY order_number ASC");
        $this->db->bind(':course_id', $course_id);
        return $this->db->resultSet();
    }

    public function getLessonsByModule($module_id) {
        $this->db->query("SELECT * FROM lessons WHERE module_id = :module_id ORDER BY order_number ASC");
        $this->db->bind(':module_id', $module_id);
        return $this->db->resultSet();
    }

    public function getCourseContent($course_id) {
        $modules = $this->getModulesByCourse($course_id);
        foreach($modules as $module) {
            $module->lessons = $this->getLessonsByModule($module->id);
        }
        return $modules;
    }

    public function addModule($data) {
        $this->db->query('INSERT INTO modules (course_id, title, order_number) VALUES(:course_id, :title, :order_number)');
        
        $this->db->bind(':course_id', $data['course_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':order_number', $data['order_number']);

        return $this->db->execute();
    }

    public function addLesson($data) {
        $this->db->query('INSERT INTO lessons (module_id, title, type, video_url, content, order_number) VALUES(:module_id, :title, :type, :video_url, :content, :order_number)');
        
        $this->db->bind(':module_id', $data['module_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':video_url', $data['video_url']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':order_number', $data['order_number']);

        return $this->db->execute();
    }
}
