<?php

class DiscussionsController extends Controller {
    private $discussionModel;

    public function __construct() {
        if(!AuthMiddleware::isLoggedIn()) {
            $this->redirect('users/login');
        }
        $this->discussionModel = $this->model('Discussion');
    }

    public function create() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'course_id' => $_POST['course_id'],
                'user_id' => $_SESSION['user_id'],
                'content' => trim($_POST['content'])
            ];

            if(!empty($data['content'])) {
                if($this->discussionModel->addDiscussion($data)) {
                    Session::flash('discussion_message', 'Question posted!');
                } else {
                    Session::flash('discussion_message', 'Something went wrong.', 'error');
                }
            }
            $this->redirect('learning/course/' . $data['course_id']);
        }
    }

    public function reply() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'course_id' => $_POST['course_id'], // for redirect
                'discussion_id' => $_POST['discussion_id'],
                'user_id' => $_SESSION['user_id'],
                'content' => trim($_POST['content'])
            ];

            if(!empty($data['content'])) {
                if($this->discussionModel->addReply($data)) {
                    Session::flash('discussion_message', 'Reply posted!');
                } else {
                    Session::flash('discussion_message', 'Something went wrong.', 'error');
                }
            }
            $this->redirect('learning/course/' . $data['course_id']);
        }
    }
}
