<?php 
ob_start();
?>
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Platform Overview</h1>
    <p class="text-gray-500 mt-1">Monitor the overall health of the platform.</p>
</div>

<!-- Analytics Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 border-l-4 border-l-blue-500">
        <p class="text-sm text-gray-500 font-medium">Total Users</p>
        <h3 class="text-2xl font-bold text-gray-900 mt-1"><?= $data['stats']['total_users'] ?? 0 ?></h3>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 border-l-4 border-l-purple-500">
        <p class="text-sm text-gray-500 font-medium">Total Courses</p>
        <h3 class="text-2xl font-bold text-gray-900 mt-1"><?= $data['stats']['total_courses'] ?? 0 ?></h3>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 border-l-4 border-l-green-500">
        <p class="text-sm text-gray-500 font-medium">Total Revenue</p>
        <h3 class="text-2xl font-bold text-gray-900 mt-1">$<?= number_format($data['stats']['total_revenue'] ?? 0, 2) ?></h3>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 border-l-4 border-l-orange-500">
        <p class="text-sm text-gray-500 font-medium">Total Enrollments</p>
        <h3 class="text-2xl font-bold text-gray-900 mt-1"><?= $data['stats']['total_enrollments'] ?? 0 ?></h3>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <h2 class="text-lg font-bold text-gray-900 mb-4">Recent Users</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined At</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if(!empty($data['stats']['recent_users'])): ?>
                    <?php foreach($data['stats']['recent_users'] as $user): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($user->name) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize"><?= htmlspecialchars($user->role) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date('M j, Y', strtotime($user->created_at)) ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">No recent users.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php 
$admin_content = ob_get_clean();
require_once '../app/views/layouts/admin_layout.php';
?>
