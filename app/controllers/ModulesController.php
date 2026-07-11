<?php

class ModulesController extends Controller {
    private $moduleModel;
    private $courseModel;

    public function __construct() {
        AuthMiddleware::requireRole('creator');
        $this->moduleModel = $this->model('Module');
        $this->courseModel = $this->model('Course');
    }

    public function manage($course_id) {
        // Validate ownership
        $course = $this->courseModel->getCourseById($course_id);
        if(!$course || $course->creator_id != $_SESSION['user_id']) {
            $this->redirect('courses/manage');
        }

        $modules = $this->moduleModel->getCourseContent($course_id);

        $data = [
            'course' => $course,
            'modules' => $modules
        ];

        $this->view('modules/manage', $data);
    }

    public function add($course_id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'course_id' => $course_id,
                'title' => trim($_POST['title']),
                'order_number' => $_POST['order_number'] ?? 0
            ];

            if($this->moduleModel->addModule($data)) {
                Session::flash('module_message', 'Module added successfully');
            } else {
                Session::flash('module_message', 'Failed to add module');
            }
            $this->redirect('modules/manage/' . $course_id);
        }
    }

    public function addLesson($module_id) {
         if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'module_id' => $module_id,
                'title' => trim($_POST['title']),
                'type' => trim($_POST['type']), // video, text
                'video_url' => trim($_POST['video_url']),
                'content' => trim($_POST['content']),
                'order_number' => $_POST['order_number'] ?? 0
            ];

            if($this->moduleModel->addLesson($data)) {
                Session::flash('module_message', 'Lesson added successfully');
            } else {
                Session::flash('module_message', 'Failed to add lesson');
            }
            $this->redirect('modules/manage/' . $_POST['course_id']);
        }
    }
}
