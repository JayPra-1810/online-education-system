<?php

class Controller {
    // Load model
    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    // Load view
    public function view($view, $data = []) {
        // If view exists
        if(file_exists('../app/views/' . $view . '.php')) {
            // Extract data to variables
            extract($data);
            // Require view file
            require_once '../app/views/' . $view . '.php';
        } else {
            // View does not exist
            die('View does not exist');
        }
    }

    // Redirect
    public function redirect($page) {
        header('Location: ' . URL_ROOT . '/' . $page);
        exit;
    }
}
