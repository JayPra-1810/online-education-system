<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-6xl mx-auto w-full">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Manage Courses</h1>
            <p class="text-gray-500 mt-1">View and edit your created courses.</p>
        </div>
        <a href="<?= URL_ROOT ?>/courses/create" class="bg-primary text-white px-5 py-2.5 rounded-full font-medium shadow-sm hover:bg-purple-800 transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Create Course
        </a>
    </div>

    <?php Session::flash('course_message'); ?>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <?php if(empty($data['courses'])) : ?>
            <div class="p-8 text-center">
                <div class="inline-flex w-16 h-16 rounded-full bg-gray-50 text-gray-400 items-center justify-center mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h4 class="text-lg font-medium text-gray-900 mb-1">No courses found</h4>
                <p class="text-gray-500 mb-0 max-w-sm mx-auto">You haven't created any courses yet.</p>
            </div>
        <?php else : ?>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach($data['courses'] as $course) : ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-16 flex-shrink-0 bg-gray-100 rounded-md overflow-hidden">
                                        <?php if($course->thumbnail): ?>
                                            <img src="<?= (filter_var($course->thumbnail, FILTER_VALIDATE_URL)) ? $course->thumbnail : URL_ROOT . '/uploads/' . $course->thumbnail ?>" alt="" class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <div class="w-full h-full bg-gradient-to-tr from-purple-100 to-indigo-100 flex items-center justify-center">
                                                <svg class="w-4 h-4 text-primary/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900"><?= $course->title ?></div>
                                        <div class="text-sm text-gray-500"><?= ucfirst($course->category) ?> &middot; <?= ucfirst($course->difficulty_level) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                <?= $course->price == 0 ? 'Free' : '$' . number_format($course->price, 2) ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?= $course->status == 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
                                    <?= ucfirst($course->status) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= date('M j, Y', strtotime($course->created_at)) ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="<?= URL_ROOT ?>/courses/edit/<?= $course->id ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <a href="<?= URL_ROOT ?>/modules/manage/<?= $course->id ?>" class="text-primary hover:text-purple-900 font-semibold">Content Builder &rarr;</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
