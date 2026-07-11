<?php

class LearningController extends Controller {
    private $courseModel;
    private $moduleModel;
    private $enrollmentModel;
    private $progressModel;
    private $discussionModel;
    private $certificateModel;
    private $streakModel;

    public function __construct() {
        AuthMiddleware::requireLogin();
        $this->courseModel = $this->model('Course');
        $this->moduleModel = $this->model('Module');
        $this->enrollmentModel = $this->model('Enrollment');
        $this->progressModel = $this->model('Progress');
        $this->discussionModel = $this->model('Discussion');
        $this->certificateModel = $this->model('Certificate');
        $this->streakModel = $this->model('Streak');
    }

    public function course($course_id, $lesson_id = null) {
        $user_id = $_SESSION['user_id'];

        // Verify Enrollment
        if($_SESSION['user_role'] == 'student' && !$this->enrollmentModel->checkEnrollment($course_id, $user_id)) {
            $this->redirect('courses/show/' . $course_id);
        }

        $course = $this->courseModel->getCourseById($course_id);
        if(!$course) {
            $this->redirect('courses');
        }

        $modules = $this->moduleModel->getCourseContent($course_id);

        $current_lesson = null;
        $active_module_id = null;

        // Determine which lesson to show
        if($lesson_id) {
            foreach($modules as $module) {
                foreach($module->lessons as $lesson) {
                    if($lesson->id == $lesson_id) {
                        $current_lesson = $lesson;
                        $active_module_id = $module->id;
                        break 2;
                    }
                }
            }
        } 
        
        // If no lesson specified or found, get the first one
        if(!$current_lesson && !empty($modules)) {
            foreach($modules as $module) {
                if(!empty($module->lessons)) {
                    $current_lesson = $module->lessons[0];
                    $active_module_id = $module->id;
                    break;
                }
            }
        }

        // Get progress status for all lessons in the course
        $completion_status = $this->progressModel->getCourseProgressStatus($user_id, $course_id);
        
        // Calculate progress percentage
        $total_lessons = 0;
        $completed_lessons = 0;
        foreach($modules as $m) $total_lessons += count($m->lessons);
        foreach($completion_status as $status) if($status) $completed_lessons++;
        
        $progress_pct = $total_lessons > 0 ? ($completed_lessons / $total_lessons) * 100 : 0;
        $is_completed = ($progress_pct >= 100);

        // Get certificate if exists
        $certificate = null;
        if($is_completed) {
            $certificate = $this->certificateModel->getCertificate($user_id, $course_id);
        }

        // Get discussions
        $discussions = $this->discussionModel->getDiscussionsByCourse($course_id);

        $data = [
            'course' => $course,
            'modules' => $modules,
            'current_lesson' => $current_lesson,
            'active_module_id' => $active_module_id,
            'completion_status' => $completion_status,
            'discussions' => $discussions,
            'progress_pct' => $progress_pct,
            'is_completed' => $is_completed,
            'certificate' => $certificate
        ];

        $this->view('learning/course', $data);
    }

    public function complete($course_id, $lesson_id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_id = $_SESSION['user_id'];
            
            if($this->progressModel->markAsComplete($user_id, $lesson_id)) {
                // Update Streak
                $this->streakModel->updateStreak($user_id);

                Session::flash('learning_message', 'Lesson marked as complete!');
                
                // Try to find the next lesson automatically
                $modules = $this->moduleModel->getCourseContent($course_id);
                $found_current = false;
                $next_lesson_id = null;

                foreach($modules as $module) {
                    foreach($module->lessons as $lesson) {
                        if($found_current) {
                            $next_lesson_id = $lesson->id;
                            break 2;
                        }
                        if($lesson->id == $lesson_id) {
                            $found_current = true;
                        }
                    }
                }

                if($next_lesson_id) {
                    $this->redirect('learning/course/' . $course_id . '/' . $next_lesson_id);
                } else {
                    $this->redirect('learning/course/' . $course_id . '/' . $lesson_id);
                }
            } else {
                Session::flash('learning_message', 'Something went wrong', 'danger');
                $this->redirect('learning/course/' . $course_id . '/' . $lesson_id);
            }
        }
    }

    public function generateCertificate($course_id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_id = $_SESSION['user_id'];
            
            // Re-verify 100% completion
            $modules = $this->moduleModel->getCourseContent($course_id);
            $completion_status = $this->progressModel->getCourseProgressStatus($user_id, $course_id);
            
            $total_lessons = 0;
            $completed_lessons = 0;
            foreach($modules as $m) $total_lessons += count($m->lessons);
            foreach($completion_status as $status) if($status) $completed_lessons++;
            
            if($total_lessons > 0 && $completed_lessons == $total_lessons) {
                if($this->certificateModel->generate($user_id, $course_id)) {
                    Session::flash('learning_message', 'Certificate generated successfully!');
                } else {
                    Session::flash('learning_message', 'Failed to generate certificate.', 'danger');
                }
            } else {
                Session::flash('learning_message', 'Please complete all lessons first.', 'warning');
            }
            
            $this->redirect('learning/course/' . $course_id);
        }
    }

    public function viewCertificate($course_id) {
        $user_id = $_SESSION['user_id'];
        $certificate = $this->certificateModel->getCertificate($user_id, $course_id);
        
        if(!$certificate) {
            $this->redirect('learning/course/' . $course_id);
        }
        
        $course = $this->courseModel->getCourseById($course_id);
        
        // Fetch user details for the certificate
        $db = new Database;
        $db->query("SELECT name FROM users WHERE id = :id");
        $db->bind(':id', $user_id);
        $user_data = $db->single();

        $data = [
            'certificate' => $certificate,
            'course' => $course,
            'user' => $user_data
        ];
        
        $this->view('learning/certificate', $data);
    }
}
