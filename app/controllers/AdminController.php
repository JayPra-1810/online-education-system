<?php

class AdminController extends Controller {
    private $adminModel;

    public function __construct() {
        AuthMiddleware::requireRole('admin');
        $this->adminModel = $this->model('Admin');
    }

    public function dashboard() {
        $stats = $this->adminModel->getAnalytics();
        $data = [
            'title' => 'Admin Dashboard',
            'stats' => $stats
        ];
        $this->view('admin/dashboard', $data);
    }

    public function courses() {
        $courses = $this->adminModel->getPendingCourses();
        $data = [
            'courses' => $courses
        ];
        $this->view('admin/courses', $data);
    }

    public function approveCourse($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($this->adminModel->updateCourseStatus($id, 'published')) {
                Session::flash('admin_message', 'Course approved successfully.');
            } else {
                Session::flash('admin_message', 'Something went wrong.');
            }
            $this->redirect('admin/courses');
        }
    }

    public function rejectCourse($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Reverting to draft or setting to a new 'rejected' status
            if($this->adminModel->updateCourseStatus($id, 'draft')) {
                Session::flash('admin_message', 'Course rejected and reverted to draft.');
            } else {
                Session::flash('admin_message', 'Something went wrong.');
            }
            $this->redirect('admin/courses');
        }
    }

    public function users() {
        $users = $this->adminModel->getUsers();
        $data = [
            'title' => 'User Management',
            'users' => $users
        ];
        $this->view('admin/users', $data);
    }

    public function toggleUserStatus($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $status = $_POST['status'] == 'active' ? 'banned' : 'active';
            if($this->adminModel->updateUserStatus($id, $status)) {
                Session::flash('admin_message', 'User status updated successfuly.');
            } else {
                Session::flash('admin_message', 'Something went wrong.');
            }
            $this->redirect('admin/users');
        }
    }

    public function payments() {
        $payments = $this->adminModel->getPayments();
        $data = [
            'title' => 'Payment Management',
            'payments' => $payments
        ];
        $this->view('admin/payments', $data);
    }
}
