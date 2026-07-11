<?php 
ob_start();
?>
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Course Verification</h1>
</div>

<?php Session::flash('admin_message'); ?>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
        <h3 class="text-lg font-bold text-gray-900">Pending Approval</h3>
    </div>
    
    <?php if(empty($data['courses'])): ?>
        <div class="p-8 text-center">
            <div class="inline-flex w-16 h-16 rounded-full bg-green-50 text-green-500 items-center justify-center mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h4 class="text-lg font-medium text-gray-900 mb-1">All caught up!</h4>
            <p class="text-gray-500 mb-0">There are no courses pending approval at this time.</p>
        </div>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course Details</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Creator</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted</th>
                        <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach($data['courses'] as $course): ?>
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-16 flex-shrink-0 bg-gray-200 rounded overflow-hidden">
                                        <?php if($course->thumbnail): ?>
                                            <img src="<?= (filter_var($course->thumbnail, FILTER_VALIDATE_URL)) ? $course->thumbnail : URL_ROOT . '/uploads/' . $course->thumbnail ?>" alt="" class="w-full h-full object-cover">
                                        <?php endif; ?>
                                    </div>
                                    <div class="ml-4 max-w-xs">
                                        <div class="text-sm font-medium text-gray-900 truncate" title="<?= htmlspecialchars($course->title) ?>"><?= htmlspecialchars($course->title) ?></div>
                                        <div class="text-xs text-gray-500"><?= ucfirst(htmlspecialchars($course->category)) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($course->creator_name) ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                <?= $course->price == 0 ? 'Free' : '$' . number_format($course->price, 2) ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= date('M j, Y', strtotime($course->created_at)) ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="<?= URL_ROOT ?>/courses/show/<?= $course->id ?>" target="_blank" class="text-gray-500 hover:text-gray-900 px-3 py-1 border border-gray-300 rounded-md transition text-xs">Review</a>
                                    <form action="<?= URL_ROOT ?>/admin/approveCourse/<?= $course->id ?>" method="post" onsubmit="return confirm('Are you sure you want to approve this course?');">
                                        <button type="submit" class="text-white bg-success hover:bg-green-600 px-3 py-1 rounded-md transition text-xs shadow-sm font-medium">Approve</button>
                                    </form>
                                    <form action="<?= URL_ROOT ?>/admin/rejectCourse/<?= $course->id ?>" method="post" onsubmit="return confirm('Are you sure you want to reject this course? It will be sent back to draft.');">
                                        <button type="submit" class="text-white bg-red-500 hover:bg-red-600 px-3 py-1 rounded-md transition text-xs shadow-sm font-medium">Reject</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php 
$admin_content = ob_get_clean();
require_once '../app/views/layouts/admin_layout.php';
?>
