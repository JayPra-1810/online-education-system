<?php require_once '../app/views/layouts/header.php'; ?>

<div class="flex flex-col md:flex-row gap-6 bg-gray-50 min-h-[calc(100vh-64px)] p-6">
    <!-- Sidebar -->
    <div class="w-full md:w-64 flex-shrink-0">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sticky top-24">
            <div class="flex items-center gap-3 mb-6 p-2">
                <div class="w-12 h-12 rounded-full bg-gray-800 text-white flex items-center justify-center font-bold text-xl">
                    A
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 line-clamp-1">Admin User</h3>
                    <p class="text-xs text-gray-500 capitalize">Platform Admin</p>
                </div>
            </div>

            <?php
            // Helper function to define active state classes
            $current_page = basename($_SERVER['REQUEST_URI']);
            function isActive($page, $current) {
                return $page === $current 
                    ? 'bg-gray-900 text-white' 
                    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900';
            }
            ?>

            <nav class="space-y-1">
                <a href="<?= URL_ROOT ?>/admin/dashboard" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition <?= isActive('dashboard', $current_page) ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>
                <a href="<?= URL_ROOT ?>/admin/users" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition <?= isActive('users', $current_page) ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Users
                </a>
                <a href="<?= URL_ROOT ?>/admin/courses" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition <?= isActive('courses', $current_page) ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    Pending Courses
                </a>
                <a href="<?= URL_ROOT ?>/admin/payments" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition <?= isActive('payments', $current_page) ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    Transactions
                </a>
            </nav>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="flex-1 overflow-x-hidden">
        <?= $admin_content ?? '' ?>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
