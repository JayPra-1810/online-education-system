<?php

class CreatorController extends Controller {
    private $postModel;
    private $creatorModel;

    public function __construct() {
        AuthMiddleware::requireRole('creator');
        $this->postModel = $this->model('Post');
        $this->creatorModel = $this->model('Creator');
    }

    public function dashboard() {
        $creator_id = $_SESSION['user_id'];
        $analytics = $this->creatorModel->getAnalytics($creator_id);

        $data = [
            'title' => 'Creator Dashboard',
            'stats' => $analytics
        ];
        $this->view('creator/dashboard', $data);
    }

    public function analytics() {
        $creator_id = $_SESSION['user_id'];
        $analytics = $this->creatorModel->getAnalytics($creator_id);

        $data = [
            'title' => 'Course Analytics',
            'stats' => $analytics
        ];
        $this->view('creator/analytics', $data);
    }

    public function feed() {
        $posts = $this->postModel->getPostsByCreator($_SESSION['user_id']);
        $data = [
            'title' => 'My Learning Feed',
            'posts' => $posts
        ];
        $this->view('creator/feed', $data);
    }

    public function createPost() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'creator_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'video_url' => trim($_POST['video_url']),
                'title_err' => ''
            ];

            if(empty($data['title'])) {
                $data['title_err'] = 'Please enter a title for your post';
            }

            if(empty($data['title_err'])) {
                if($this->postModel->addPost($data)) {
                    Session::flash('feed_message', 'Update posted successfully!');
                    $this->redirect('creator/feed');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('creator/feed', $data);
            }
        }
    }

    public function deletePost($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($this->postModel->deletePost($id, $_SESSION['user_id'])) {
                Session::flash('feed_message', 'Post removed.');
            } else {
                Session::flash('feed_message', 'Something went wrong.');
            }
            $this->redirect('creator/feed');
        }
    }
}
