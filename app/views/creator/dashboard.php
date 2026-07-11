<?php require_once '../app/views/layouts/header.php'; ?>

<div class="flex flex-col md:flex-row gap-6">
    <!-- Sidebar -->
    <div class="w-full md:w-64 flex-shrink-0">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sticky top-24">
            <div class="flex items-center gap-3 mb-6 p-2">
                <div class="w-12 h-12 rounded-full bg-purple-100 text-primary flex items-center justify-center font-bold text-xl">
                    <?= substr($_SESSION['user_name'], 0, 1) ?>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 line-clamp-1"><?= $_SESSION['user_name'] ?></h3>
                    <p class="text-xs text-gray-500 capitalize"><?= $_SESSION['user_role'] ?></p>
                </div>
            </div>

            <nav class="space-y-1">
                <a href="<?= URL_ROOT ?>/creator/dashboard" class="flex items-center gap-3 px-3 py-2.5 bg-primary/10 text-primary rounded-xl font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
                <a href="<?= URL_ROOT ?>/courses/manage" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    My Courses
                </a>
                <a href="<?= URL_ROOT ?>/creator/analytics" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Analytics
                </a>
                <a href="<?= URL_ROOT ?>/creator/feed" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    Learning Feed
                </a>
            </nav>
        </div>
    </div>

    <!-- Main Dashboard Area -->
    <div class="flex-1">
        <div class="mb-6 flex justify-between items-end">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Good morning, <?= explode(' ', trim($_SESSION['user_name']))[0] ?> 👋</h1>
                <p class="text-gray-500 mt-1">Here is what's happening with your courses today.</p>
            </div>
            <a href="<?= URL_ROOT ?>/courses/create" class="bg-primary text-white px-5 py-2.5 rounded-full font-medium shadow-sm hover:bg-purple-800 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Create Course
            </a>
        </div>

        <!-- Analytics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-green-50 text-success flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Revenue</p>
                    <h3 class="text-2xl font-bold text-gray-900">$<?= number_format($data['stats']['total_revenue'], 2) ?></h3>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Enrollments</p>
                    <h3 class="text-2xl font-bold text-gray-900"><?= number_format($data['stats']['total_students']) ?></h3>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-purple-50 text-primary flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Active Courses</p>
                    <h3 class="text-2xl font-bold text-gray-900"><?= $data['stats']['total_courses'] ?></h3>
                </div>
            </div>
        </div>

        <!-- Recent Courses -->
        <h3 class="text-lg font-bold text-gray-900 mb-4">Your Courses Performance</h3>
        <?php if(empty($data['stats']['course_performance'])): ?>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center">
                <div class="inline-flex w-16 h-16 rounded-full bg-gray-50 text-gray-400 items-center justify-center mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h4 class="text-lg font-medium text-gray-900 mb-1">No courses yet</h4>
                <p class="text-gray-500 mb-6 max-w-sm mx-auto">You haven't created any courses yet. Start by creating your first course and share your knowledge.</p>
                <a href="<?= URL_ROOT ?>/courses/create" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-full shadow-sm text-sm font-medium text-white bg-primary hover:bg-purple-800 transition">
                    Create First Course
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 gap-4">
                <?php foreach($data['stats']['course_performance'] as $course): ?>
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 flex-shrink-0 overflow-hidden">
                            <?php if($course->thumbnail): ?>
                                <img src="<?= (filter_var($course->thumbnail, FILTER_VALIDATE_URL)) ? $course->thumbnail : URL_ROOT . '/uploads/' . $course->thumbnail ?>" alt="" class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-primary">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 line-clamp-1"><?= $course->title ?></h4>
                            <p class="text-xs text-gray-500"><?= $course->enrollment_count ?> Enrolled &bull; $<?= number_format($course->revenue ?? 0, 2) ?> Earned</p>
                        </div>
                    </div>
                    <a href="<?= URL_ROOT ?>/courses/edit/<?= $course->id ?>" class="text-sm font-bold text-primary hover:underline">Edit Course</a>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
