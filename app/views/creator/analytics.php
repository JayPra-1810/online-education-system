<?php require_once '../app/views/layouts/header.php'; ?>

<div class="flex flex-col md:flex-row gap-8">
    <!-- Sidebar -->
    <div class="w-full md:w-64 flex-shrink-0">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sticky top-24">
            <div class="flex items-center gap-3 mb-8 p-2">
                <div class="w-12 h-12 rounded-full bg-indigo-100 text-primary flex items-center justify-center font-bold text-xl">
                    <?= substr($_SESSION['user_name'], 0, 1) ?>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 line-clamp-1"><?= $_SESSION['user_name'] ?></h3>
                    <p class="text-xs text-gray-500 capitalize"><?= $_SESSION['user_role'] ?></p>
                </div>
            </div>

            <nav class="space-y-1">
                <a href="<?= URL_ROOT ?>/creator/dashboard" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>
                <a href="<?= URL_ROOT ?>/courses/manage" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    My Courses
                </a>
                <a href="<?= URL_ROOT ?>/creator/analytics" class="flex items-center gap-3 px-3 py-2.5 bg-primary/10 text-primary rounded-xl font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Analytics
                </a>
                <a href="<?= URL_ROOT ?>/creator/feed" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    Learning Feed
                </a>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1">
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900">Course Analytics</h1>
            <p class="text-gray-500 mt-1">Detailed performance tracking for your published content.</p>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center gap-4 mb-2">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <span class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Students</span>
                </div>
                <p class="text-3xl font-black text-gray-900"><?= number_format($data['stats']['total_students']) ?></p>
            </div>
            
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center gap-4 mb-2">
                    <div class="w-10 h-10 rounded-xl bg-green-50 text-green-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Revenue</span>
                </div>
                <p class="text-3xl font-black text-gray-900">$<?= number_format($data['stats']['total_revenue'], 2) ?></p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center gap-4 mb-2">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 text-primary flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <span class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Courses</span>
                </div>
                <p class="text-3xl font-black text-gray-900"><?= $data['stats']['total_courses'] ?></p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Course Performance -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50">
                    <h3 class="font-bold text-gray-900">Individual Course Performance</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-medium">
                            <tr>
                                <th class="px-6 py-3">Course Title</th>
                                <th class="px-6 py-3">Students</th>
                                <th class="px-6 py-3">Revenue</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php foreach($data['stats']['course_performance'] as $course): ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <p class="text-sm font-bold text-gray-900 line-clamp-1"><?= $course->title ?></p>
                                    <p class="text-xs text-gray-400">$<?= number_format($course->price, 2) ?></p>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <?= $course->enrollment_count ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-bold text-gray-900">
                                    $<?= number_format($course->revenue ?? 0, 2) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="p-6 border-b border-gray-50">
                    <h3 class="font-bold text-gray-900">Recent Enrollments</h3>
                </div>
                <div class="p-6 space-y-6">
                    <?php if(empty($data['stats']['recent_enrollments'])): ?>
                        <div class="text-center py-8">
                            <p class="text-gray-500 text-sm">No recent enrollments to show.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach($data['stats']['recent_enrollments'] as $enrollment): ?>
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-indigo-50 text-primary flex items-center justify-center font-bold">
                                <?= substr($enrollment->student_name, 0, 1) ?>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-gray-900 truncate"><?= $enrollment->student_name ?></p>
                                <p class="text-xs text-gray-500 truncate">Joined: <?= $enrollment->course_title ?></p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-400"><?= date('M j, Y', strtotime($enrollment->purchase_date)) ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
