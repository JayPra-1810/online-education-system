<?php

class EnrollmentsController extends Controller {
    private $enrollmentModel;
    private $courseModel;

    public function __construct() {
        $this->enrollmentModel = $this->model('Enrollment');
        $this->courseModel = $this->model('Course');
    }

    public function checkout() {
        AuthMiddleware::requireLogin();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $course_id = $_POST['course_id'];
            $user_id = $_SESSION['user_id'];

            // Validate course exists
            $course = $this->courseModel->getCourseById($course_id);
            if(!$course) {
                die("Course not found");
            }

            // Check if already enrolled
            if($this->enrollmentModel->checkEnrollment($course_id, $user_id)) {
                Session::flash('course_message', 'You are already enrolled in this course.');
                $this->redirect('student/dashboard');
                return;
            }

            $data = [
                'course' => $course
            ];

            $this->view('enrollments/checkout', $data);

        } else {
            $this->redirect('courses');
        }
    }

    public function processPayment() {
        AuthMiddleware::requireLogin();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $course_id = $_POST['course_id'];
            $user_id = $_SESSION['user_id'];

            // Validate course exists
            $course = $this->courseModel->getCourseById($course_id);
            if(!$course) {
                die("Course not found");
            }

            // Simulate payment processing delay or validation
            // In a real app, this is where you'd confirm the Stripe payment session.

            if($this->enrollmentModel->enrollUser($course_id, $user_id)) {
                if($course->price > 0) {
                    $this->enrollmentModel->addPaymentRecord($course_id, $user_id, $course->price);
                }

                Session::flash('course_message', 'Payment successful! You are now enrolled in ' . $course->title);
                $this->redirect('student/dashboard');
            } else {
                die("Something went wrong during enrollment.");
            }
        } else {
            $this->redirect('courses');
        }
    }
}
