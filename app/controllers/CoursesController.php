<?php

class CoursesController extends Controller {
    private $courseModel;
    private $moduleModel;
    private $reviewModel;
    private $enrollmentModel;

    public function __construct() {
        $this->courseModel = $this->model('Course');
        $this->moduleModel = $this->model('Module');
        $this->reviewModel = $this->model('Review');
        $this->enrollmentModel = $this->model('Enrollment');
    }

    public function index() {
        $courses = $this->courseModel->getCourses();
        $data = [
            'courses' => $courses
        ];
        $this->view('courses/index', $data);
    }

    public function create() {
        AuthMiddleware::requireRole('creator');

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // CSRF validation
            if(!isset($_POST['csrf_token']) || !Session::verifyCsrfToken($_POST['csrf_token'])) {
                die('CSRF token validation failed');
            }

            // Sanitize certain fields, but be careful with URLs and descriptions
            $data = [
                'creator_id' => $_SESSION['user_id'],
                'title' => filter_var(trim($_POST['title']), FILTER_SANITIZE_SPECIAL_CHARS),
                'description' => trim($_POST['description']), // Allowed to have more content
                'price' => filter_var(trim($_POST['price']), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
                'category' => filter_var(trim($_POST['category']), FILTER_SANITIZE_SPECIAL_CHARS),
                'difficulty_level' => filter_var(trim($_POST['difficulty_level']), FILTER_SANITIZE_SPECIAL_CHARS),
                'status' => 'draft',
                'thumbnail' => filter_var(trim($_POST['thumbnail_url']), FILTER_SANITIZE_URL),
                'title_err' => '',
                'price_err' => '',
                'thumbnail_err' => ''
            ];

            // Handle file upload
            if(!empty($_FILES['thumbnail_file']['name'])) {
                $file = $_FILES['thumbnail_file'];
                $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $file['name']);
                $uploadDir = APP_ROOT . '/public/uploads/';
                $targetFile = $uploadDir . $fileName;
                
                if(!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $check = getimagesize($file['tmp_name']);
                if($check !== false) {
                    if(move_uploaded_file($file['tmp_name'], $targetFile)) {
                        $data['thumbnail'] = $fileName;
                    } else {
                        $data['thumbnail_err'] = 'Failed to upload image. Check folder permissions.';
                    }
                } else {
                    $data['thumbnail_err'] = 'File is not an image';
                }
            }

            if(empty($data['title'])) { $data['title_err'] = 'Please enter a course title'; }
            if(empty($data['price']) && $data['price'] !== '0') { $data['price_err'] = 'Please enter a price (0 for free)'; }

            if(empty($data['title_err']) && empty($data['price_err']) && empty($data['thumbnail_err'])) {
                $courseId = $this->courseModel->addCourse($data);
                if($courseId) {
                    Session::flash('course_message', 'Course created successfully. You can now add modules and lessons.');
                    $this->redirect('courses/manage');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('courses/create', $data);
            }

        } else {
            $data = [
                'title' => '',
                'description' => '',
                'price' => '',
                'category' => '',
                'difficulty_level' => '',
                'thumbnail' => '',
                'title_err' => '',
                'price_err' => '',
                'thumbnail_err' => ''
            ];
            $this->view('courses/create', $data);
        }
    }

    public function manage() {
        AuthMiddleware::requireRole('creator');
        
        $courses = $this->courseModel->getCoursesByCreator($_SESSION['user_id']);
        $data = [
            'courses' => $courses
        ];
        
        $this->view('courses/manage', $data);
    }

    public function show($id) {
        $course = $this->courseModel->getCourseById($id);

        if(!$course) {
            $this->redirect('courses');
        }

        $modules = $this->moduleModel->getCourseContent($id);
        
        // Fetch reviews
        $reviews = $this->reviewModel->getReviewsByCourse($id);
        $rating_data = $this->reviewModel->getAverageRating($id);

        // Check enrollment if logged in
        $is_enrolled = false;
        if(AuthMiddleware::isLoggedIn()) {
            $is_enrolled = $this->enrollmentModel->checkEnrollment($id, $_SESSION['user_id']);
        }

        $data = [
            'course' => $course,
            'modules' => $modules,
            'reviews' => $reviews,
            'avg_rating' => $rating_data->avg_rating ?? 0,
            'review_count' => $rating_data->review_count ?? 0,
            'is_enrolled' => $is_enrolled
        ];

        $this->view('courses/show', $data);
    }

    public function edit($id) {
        AuthMiddleware::requireRole('creator');

        $course = $this->courseModel->getCourseById($id);

        // Check ownership
        if($course->creator_id != $_SESSION['user_id']) {
            $this->redirect('courses/manage');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // CSRF validation
            if(!isset($_POST['csrf_token']) || !Session::verifyCsrfToken($_POST['csrf_token'])) {
                die('CSRF token validation failed');
            }

            $data = [
                'id' => $id,
                'title' => filter_var(trim($_POST['title']), FILTER_SANITIZE_SPECIAL_CHARS),
                'description' => trim($_POST['description']),
                'price' => filter_var(trim($_POST['price']), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
                'category' => filter_var(trim($_POST['category']), FILTER_SANITIZE_SPECIAL_CHARS),
                'difficulty_level' => filter_var(trim($_POST['difficulty_level']), FILTER_SANITIZE_SPECIAL_CHARS),
                'status' => $course->status,
                'thumbnail' => !empty(trim($_POST['thumbnail_url'])) ? filter_var(trim($_POST['thumbnail_url']), FILTER_SANITIZE_URL) : $course->thumbnail,
                'title_err' => '',
                'price_err' => '',
                'thumbnail_err' => ''
            ];

            // Handle file upload
            if(!empty($_FILES['thumbnail_file']['name'])) {
                $file = $_FILES['thumbnail_file'];
                $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $file['name']);
                $uploadDir = APP_ROOT . '/public/uploads/';
                $targetFile = $uploadDir . $fileName;
                
                if(!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $check = getimagesize($file['tmp_name']);
                if($check !== false) {
                    if(move_uploaded_file($file['tmp_name'], $targetFile)) {
                        // Delete old file if it was a local file
                        if($course->thumbnail && file_exists($uploadDir . $course->thumbnail) && !filter_var($course->thumbnail, FILTER_VALIDATE_URL)) {
                            unlink($uploadDir . $course->thumbnail);
                        }
                        $data['thumbnail'] = $fileName;
                    } else {
                        $data['thumbnail_err'] = 'Failed to upload image. Check folder permissions.';
                    }
                } else {
                    $data['thumbnail_err'] = 'File is not an image';
                }
            }

            if(empty($data['title'])) { $data['title_err'] = 'Please enter a course title'; }
            if(empty($data['price']) && $data['price'] !== '0') { $data['price_err'] = 'Please enter a price (0 for free)'; }

            if(empty($data['title_err']) && empty($data['price_err']) && empty($data['thumbnail_err'])) {
                if($this->courseModel->updateCourse($id, $data)) {
                    Session::flash('course_message', 'Course updated successfully');
                    $this->redirect('courses/manage');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('courses/edit', $data);
            }

        } else {
            $data = [
                'id' => $id,
                'title' => $course->title,
                'description' => $course->description,
                'price' => $course->price,
                'category' => $course->category,
                'difficulty_level' => $course->difficulty_level,
                'status' => $course->status,
                'thumbnail' => $course->thumbnail,
                'title_err' => '',
                'price_err' => '',
                'thumbnail_err' => ''
            ];
            $this->view('courses/edit', $data);
        }
    }
}
