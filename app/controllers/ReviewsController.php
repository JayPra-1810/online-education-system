<?php

class ReviewsController extends Controller {
    private $reviewModel;

    public function __construct() {
        if(!AuthMiddleware::isLoggedIn()) {
            $this->redirect('users/login');
        }
        $this->reviewModel = $this->model('Review');
    }

    public function add() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'course_id' => $_POST['course_id'],
                'user_id' => $_SESSION['user_id'],
                'rating' => $_POST['rating'],
                'review_text' => trim($_POST['review_text'])
            ];

            // Verify the user hasn't already reviewed this course
            if(!$this->reviewModel->checkUserReview($data['course_id'], $data['user_id'])) {
                if($this->reviewModel->addReview($data)) {
                    Session::flash('review_message', 'Thank you for your review!');
                } else {
                    Session::flash('review_message', 'Something went wrong.', 'error');
                }
            } else {
                Session::flash('review_message', 'You have already reviewed this course.');
            }
            
            $this->redirect('courses/show/' . $data['course_id']);
        }
    }
}
