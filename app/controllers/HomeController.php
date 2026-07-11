<?php

class HomeController extends Controller {
    public function __construct() {
        // Initialization if needed
    }

    public function index() {
        $data = [
            'title' => 'Welcome to Modern LMS'
        ];

        $this->view('pages/index', $data);
    }
}
