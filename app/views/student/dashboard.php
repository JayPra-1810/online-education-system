<?php require_once '../app/views/layouts/header.php'; ?>

<div class="flex flex-col md:flex-row gap-6">
    <!-- Sidebar -->
    <div class="w-full md:w-64 flex-shrink-0">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sticky top-24">
            <div class="flex items-center gap-3 mb-6 p-2">
                <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xl">
                    <?= substr($_SESSION['user_name'], 0, 1) ?>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 line-clamp-1"><?= $_SESSION['user_name'] ?></h3>
                    <p class="text-xs text-gray-500 capitalize"><?= $_SESSION['user_role'] ?></p>
                </div>
            </div>

            <!-- Learning Streaks Widget (Based on UI Ref) -->
            <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl p-4 mb-6 text-white text-center">
                <p class="text-sm text-purple-100 font-medium mb-1">Learning Streak</p>
                <div class="flex items-baseline justify-center gap-1">
                    <span class="text-3xl font-extrabold text-white"><?= $data['streak']->current_streak ?></span>
                    <span class="text-purple-100 font-medium"><?= $data['streak']->current_streak == 1 ? 'Day' : 'Days' ?></span>
                </div>
            </div>

            <nav class="space-y-1">
                <a href="<?= URL_ROOT ?>/student/dashboard" class="flex items-center gap-3 px-3 py-2.5 bg-primary/10 text-primary rounded-xl font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    My Learning
                </a>
                <a href="<?= URL_ROOT ?>/student/feed" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    Learning Feed
                </a>
                <a href="<?= URL_ROOT ?>/courses" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    Catalog
                </a>
                <a href="<?= URL_ROOT ?>/student/certificates" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                    Certificates
                </a>
            </nav>
        </div>
    </div>

    <!-- Main Dashboard Area -->
    <div class="flex-1">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Good morning, <?= explode(' ', trim($_SESSION['user_name']))[0] ?> ✨</h1>
            <p class="text-gray-500 mt-1">Welcome back. Let's continue your learning journey.</p>
        </div>

        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-900">In progress learning</h3>
            <a href="#" class="text-sm font-medium text-primary hover:underline">View all</a>
        </div>
        
        <!-- Empty State for Courses -->
        <?php if(empty($data['courses'])): ?>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center mb-10">
                <div class="inline-flex w-16 h-16 rounded-full bg-indigo-50 text-indigo-400 items-center justify-center mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h4 class="text-lg font-medium text-gray-900 mb-1">No enrolled courses</h4>
                <p class="text-gray-500 mb-6 max-w-sm mx-auto">Explore our catalog and find the perfect course to advance your skills.</p>
                <a href="<?= URL_ROOT ?>/courses" class="inline-flex items-center justify-center px-6 py-2 border border-transparent rounded-full shadow-sm text-sm font-medium text-white bg-primary hover:bg-purple-800 transition">
                    Explore Catalog
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 mb-8 gap-4">
                <?php foreach($data['courses'] as $course): 
                    $progress = 0;
                    if($course->total_lessons > 0) {
                        $progress = round(($course->completed_lessons / $course->total_lessons) * 100);
                    }
                ?>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition flex flex-col md:flex-row">
                    <div class="w-full md:w-64 h-32 bg-gray-200 flex-shrink-0 relative">
                        <?php if($course->thumbnail): ?>
                            <img src="<?= (filter_var($course->thumbnail, FILTER_VALIDATE_URL)) ? $course->thumbnail : URL_ROOT . '/uploads/' . $course->thumbnail ?>" alt="Course preview" class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="absolute inset-0 bg-gradient-to-tr from-purple-400 to-indigo-500 opacity-80"></div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="p-5 flex-1 flex flex-col sm:flex-row gap-4 justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="inline-block px-2 text-primary bg-purple-50 text-xs font-semibold rounded"><svg class="w-3 h-3 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg> Course</span>
                            </div>
                            <h4 class="font-bold text-gray-900 line-clamp-1 mb-1"><?= $course->title ?></h4>
                            <p class="text-xs text-gray-500 mb-3 sm:mb-0"><?= $course->total_lessons ?> Materials &bull; By <?= $course->creator_name ?></p>
                        </div>
                        
                        <div class="flex items-center sm:items-start gap-6">
                            <div class="hidden sm:block text-center min-w-[100px]">
                                <p class="text-xs text-gray-500 mb-1">Completion</p>
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Simple circular progress indicator -->
                                    <div class="relative w-6 h-6 rounded-full border-2 border-gray-100 flex items-center justify-center overflow-hidden">
                                        <div class="absolute inset-0 bg-success" style="clip-path: polygon(50% 50%, 50% 0, 100% 0, 100% <?= max(0, min(100, $progress)) ?>%, 50% 50%);"></div>
                                        <div class="absolute inset-0.5 bg-white rounded-full"></div>
                                    </div>
                                    <span class="text-sm font-bold text-gray-700"><?= $progress ?>%</span>
                                </div>
                            </div>
                            <div class="hidden sm:block text-center">
                                <p class="text-xs text-gray-500 mb-1">Deadline</p>
                                <p class="text-sm font-bold text-gray-700 flex items-center gap-1">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Lifetime
                                </p>
                            </div>
                            
                            <a href="<?= URL_ROOT ?>/learning/course/<?= $course->id ?>" class="inline-flex items-center justify-center ml-auto px-5 py-2 border border-gray-200 rounded-lg text-sm font-bold text-gray-700 hover:border-gray-300 hover:bg-gray-50 transition min-w-[100px]">
                                <?= $progress == 0 ? 'Start' : 'Continue' ?>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
