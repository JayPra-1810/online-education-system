<?php

class StudentController extends Controller {
    private $enrollmentModel;
    private $streakModel;
    private $certificateModel;
    private $postModel;

    public function __construct() {
        AuthMiddleware::requireRole('student');
        $this->enrollmentModel = $this->model('Enrollment');
        $this->streakModel = $this->model('Streak');
        $this->certificateModel = $this->model('Certificate');
        $this->postModel = $this->model('Post');
    }

    public function dashboard() {
        $user_id = $_SESSION['user_id'];
        $enrolled_courses = $this->enrollmentModel->getEnrolledCourses($user_id);
        $streak = $this->streakModel->getStreak($user_id);
        
        $data = [
            'title' => 'Student Dashboard',
            'courses' => $enrolled_courses,
            'streak' => $streak
        ];
        $this->view('student/dashboard', $data);
    }

    public function certificates() {
        $user_id = $_SESSION['user_id'];
        $certificates = $this->certificateModel->getCertificatesByUser($user_id);
        
        $data = [
            'title' => 'My Certificates',
            'certificates' => $certificates
        ];
        $this->view('student/certificates', $data);
    }

    public function feed() {
        $user_id = $_SESSION['user_id'];
        $posts = $this->postModel->getFeedForStudent($user_id);
        
        $data = [
            'title' => 'Learning Feed',
            'posts' => $posts
        ];
        $this->view('student/feed', $data);
    }
}
