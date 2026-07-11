<?php

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/Database.php';

echo "Starting Database Seeding...\n";

$db = new Database();

try {
    // 1. Clear existing non-admin data to prevent duplicates on multiple runs
    echo "Clearing old mock data...\n";
    $db->query("SET FOREIGN_KEY_CHECKS = 0");
    $db->execute();
    
    $tablesToTruncate = ['lesson_progress', 'payments', 'enrollments', 'lessons', 'modules', 'courses', 'replies', 'discussions', 'reviews', 'certificates'];
    foreach($tablesToTruncate as $table) {
        $db->query("TRUNCATE TABLE $table");
        $db->execute();
    }
    
    $db->query("DELETE FROM users WHERE role != 'admin'");
    $db->execute();
    
    $db->query("SET FOREIGN_KEY_CHECKS = 1");
    $db->execute();
    echo "Old data cleared.\n";

    // 2. Setup mock users
    $password = password_hash('password123', PASSWORD_DEFAULT);

    // Creator 1
    $db->query("INSERT INTO users (name, email, password, role) VALUES ('Alice Creator', 'creator@modernlms.com', :pwd, 'creator')");
    $db->bind(':pwd', $password);
    $db->execute();
    $creator_id = $db->lastInsertId();

    // Creator 2
    $db->query("INSERT INTO users (name, email, password, role) VALUES ('Bob Instructor', 'bob@modernlms.com', :pwd, 'creator')");
    $db->bind(':pwd', $password);
    $db->execute();
    $creator_id_2 = $db->lastInsertId();

    // Student
    $db->query("INSERT INTO users (name, email, password, role) VALUES ('Charlie Student', 'student@modernlms.com', :pwd, 'student')");
    $db->bind(':pwd', $password);
    $db->execute();
    $student_id = $db->lastInsertId();

    echo "Mock Users created.\n";

    // 3. Create Courses
    $courses = [
        [
            'creator_id' => $creator_id,
            'title' => 'Mastering UI/UX Design: A Guide for Beginners',
            'description' => 'Learn the fundamentals of UI/UX design. We will cover Figma, Wireframing, Prototyping, and more. Perfect for absolute beginners looking to build a career in design.',
            'price' => 49.99,
            'category' => 'design',
            'difficulty_level' => 'beginner',
            'status' => 'published'
        ],
        [
            'creator_id' => $creator_id,
            'title' => 'Advanced CSS & Tailwind Mastery',
            'description' => 'Take your CSS skills to the next level. Learn flexbox, grid, animations, and how to build complex layouts quickly using TailwindCSS.',
            'price' => 79.99,
            'category' => 'programming',
            'difficulty_level' => 'advanced',
            'status' => 'published'
        ],
        [
            'creator_id' => $creator_id_2,
            'title' => 'Full-stack Web Development with PHP & MySQL',
            'description' => 'Build a complete modern web application from scratch using PHP 8, MySQL, and Vanilla JS. A comprehensive guide to building your own MVC framework.',
            'price' => 99.99,
            'category' => 'programming',
            'difficulty_level' => 'intermediate',
            'status' => 'published'
        ],
        [
            'creator_id' => $creator_id,
            'title' => 'Introduction to Digital Marketing',
            'description' => 'Learn SEO, Social Media Marketing, and Google Ads. This is still a work in progress.',
            'price' => 29.99,
            'category' => 'marketing',
            'difficulty_level' => 'beginner',
            'status' => 'draft' // Won't show in catalog but will show in creator manage
        ],
        [
            'creator_id' => $creator_id_2,
            'title' => 'Business Strategy 101: Building Startups',
            'description' => 'Understand how to write business plans, pitch to investors, and scale your startup.',
            'price' => 0.00, // Free course
            'category' => 'business',
            'difficulty_level' => 'beginner',
            'status' => 'published'
        ],
        [
            'creator_id' => $creator_id_2,
            'title' => 'Python for Data Science',
            'description' => 'Pending review by admin.',
            'price' => 59.99, // Free course
            'category' => 'programming',
            'difficulty_level' => 'intermediate',
            'status' => 'draft'
        ]
    ];

    $course_ids = [];
    foreach ($courses as $c) {
        $db->query("INSERT INTO courses (creator_id, title, description, price, category, difficulty_level, status) VALUES (:creator_id, :title, :description, :price, :category, :difficulty_level, :status)");
        $db->bind(':creator_id', $c['creator_id']);
        $db->bind(':title', $c['title']);
        $db->bind(':description', $c['description']);
        $db->bind(':price', $c['price']);
        $db->bind(':category', $c['category']);
        $db->bind(':difficulty_level', $c['difficulty_level']);
        $db->bind(':status', $c['status']);
        $db->execute();
        
        $course_ids[] = $db->lastInsertId();
    }
    echo "Courses seeded.\n";

    // 4. Add Modules and Lessons for the first course
    if(count($course_ids) > 0) {
        $course1_id = $course_ids[0]; // UI/UX Course
        
        // Module 1
        $db->query("INSERT INTO modules (course_id, title, order_number) VALUES (:cid, 'Introduction to UI/UX', 1)");
        $db->bind(':cid', $course1_id);
        $db->execute();
        $mod1_id = $db->lastInsertId();

        $db->query("INSERT INTO lessons (module_id, title, type, video_url, content, order_number) VALUES (:mid, 'What is UI/UX?', 'video', 'https://www.youtube.com/watch?v=c9Wg6Cb_YlU', 'Welcome to the course. Here we discuss the fundamentals.', 1)");
        $db->bind(':mid', $mod1_id);
        $db->execute();
        $lesson1_id = $db->lastInsertId();

        $db->query("INSERT INTO lessons (module_id, title, type, video_url, content, order_number) VALUES (:mid, 'Design Thinking Process', 'text', NULL, 'To be a great designer, you need to think like one. The design thinking process has 5 phases: Empathize, Define, Ideate, Prototype, and Test. In this lecture we explore each of them in detail.', 2)");
        $db->bind(':mid', $mod1_id);
        $db->execute();

        // Module 2
        $db->query("INSERT INTO modules (course_id, title, order_number) VALUES (:cid, 'Getting Started with Figma', 2)");
        $db->bind(':cid', $course1_id);
        $db->execute();
        $mod2_id = $db->lastInsertId();

        $db->query("INSERT INTO lessons (module_id, title, type, video_url, content, order_number) VALUES (:mid, 'Figma Interface Overview', 'video', 'https://www.youtube.com/watch?v=Gu1so3pz4bA', 'A tour of the Figma interface, tools, and shortcuts.', 1)");
        $db->bind(':mid', $mod2_id);
        $db->execute();

        echo "Modules/Lessons seeded for Course 1.\n";

        // Enroll Student in Course 1
        $db->query("INSERT INTO enrollments (user_id, course_id, payment_status) VALUES (:uid, :cid, 'completed')");
        $db->bind(':uid', $student_id);
        $db->bind(':cid', $course1_id);
        $db->execute();

        $db->query("INSERT INTO payments (user_id, course_id, amount, payment_method, status) VALUES (:uid, :cid, 49.99, 'stripe', 'completed')");
        $db->bind(':uid', $student_id);
        $db->bind(':cid', $course1_id);
        $db->execute();

        // Enroll Student in Free Course (Course 5) -> index 4
        $course5_id = $course_ids[4];
        $db->query("INSERT INTO enrollments (user_id, course_id, payment_status) VALUES (:uid, :cid, 'completed')");
        $db->bind(':uid', $student_id);
        $db->bind(':cid', $course5_id);
        $db->execute();

        // Some Lesson Progress for Course 1
        $db->query("INSERT INTO lesson_progress (user_id, lesson_id, completed, completed_at) VALUES (:uid, :lid, 1, NOW())");
        $db->bind(':uid', $student_id);
        $db->bind(':lid', $lesson1_id);
        $db->execute();

        echo "Mock Enrollments and Progress seeded for student.\n";
    }

} catch(PDOException $e) {
    echo "Seeding failed: " . $e->getMessage() . "\n";
}

echo "Database seeding complete!\n";
