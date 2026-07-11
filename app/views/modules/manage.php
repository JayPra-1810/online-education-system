<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-6xl mx-auto w-full pb-16">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Manage Content: <?= $data['course']->title ?></h1>
            <p class="text-gray-500 mt-1">Build your curriculum by adding modules and lessons.</p>
        </div>
        <a href="<?= URL_ROOT ?>/courses/manage" class="text-gray-500 hover:text-gray-900 font-medium text-sm transition flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Courses
        </a>
    </div>

    <?php Session::flash('module_message'); ?>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Curriculum View -->
        <div class="lg:col-span-2 space-y-6 lg:order-1 order-2">
            <?php if(empty($data['modules'])): ?>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                    <div class="inline-flex w-16 h-16 rounded-full bg-indigo-50 text-indigo-400 items-center justify-center mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h4 class="text-lg font-medium text-gray-900 mb-1">Curriculum is empty</h4>
                    <p class="text-gray-500 max-w-sm mx-auto mb-6">Start by creating a module (e.g., "Introduction" or "Week 1") using the form.</p>
                </div>
            <?php else: ?>
                <?php foreach($data['modules'] as $module): ?>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden" x-data="{ open: true, showAddLesson: false }">
                        <!-- Module Header -->
                        <div class="bg-gray-50 px-6 py-4 flex items-center justify-between border-b border-gray-100">
                            <div class="flex items-center gap-4 cursor-pointer" @click="open = !open">
                                <svg :class="open ? 'rotate-180 transform' : ''" class="w-5 h-5 text-gray-500 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                <div>
                                    <h3 class="font-bold text-gray-900">Module <?= $module->order_number ?>: <?= $module->title ?></h3>
                                    <p class="text-xs text-gray-500"><?= count($module->lessons) ?> Lessons</p>
                                </div>
                            </div>
                            <button @click="showAddLesson = !showAddLesson" class="text-sm font-medium text-primary hover:text-purple-800 transition flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Add Lesson
                            </button>
                        </div>
                        
                        <!-- Lessons List -->
                        <div x-show="open" class="divide-y divide-gray-100">
                            <?php if(empty($module->lessons)): ?>
                                <p class="text-sm text-gray-500 text-center py-6">No lessons added yet. Click "Add Lesson" to start.</p>
                            <?php else: ?>
                                <?php foreach($module->lessons as $lesson): ?>
                                    <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition group">
                                        <div class="flex items-center gap-4">
                                            <!-- Icon based on type -->
                                            <?php if($lesson->type == 'video'): ?>
                                                <div class="w-8 h-8 rounded bg-red-50 text-red-500 flex items-center justify-center">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                                                </div>
                                            <?php else: ?>
                                                <div class="w-8 h-8 rounded bg-blue-50 text-blue-500 flex items-center justify-center">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                </div>
                                            <?php endif; ?>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900"><?= $lesson->title ?></p>
                                                <p class="text-xs text-gray-500 uppercase"><?= $lesson->type ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <!-- Add Lesson Form Template (Hidden by default) -->
                        <div x-show="showAddLesson" x-cloak class="p-6 bg-purple-50 border-t border-purple-100 mt-auto">
                            <h4 class="text-sm font-bold text-gray-900 mb-4">Add New Lesson</h4>
                            <form action="<?= URL_ROOT ?>/modules/addLesson/<?= $module->id ?>" method="post" class="space-y-4">
                                <input type="hidden" name="course_id" value="<?= $data['course']->id ?>">
                                
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Lesson Title</label>
                                    <input type="text" name="title" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-1 focus:ring-primary focus:border-primary">
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Type</label>
                                        <select name="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-1 focus:ring-primary focus:border-primary bg-white">
                                            <option value="video">Video</option>
                                            <option value="text">Text/Article</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Order Number</label>
                                        <input type="number" name="order_number" value="<?= count($module->lessons) + 1 ?>" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-1 focus:ring-primary focus:border-primary">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Video URL (If Video Type)</label>
                                    <input type="url" name="video_url" placeholder="https://youtube.com/..." class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-1 focus:ring-primary focus:border-primary">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Lesson Content (Optional text)</label>
                                    <textarea name="content" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-1 focus:ring-primary focus:border-primary"></textarea>
                                </div>
                                <div class="flex justify-end gap-2 pt-2">
                                    <button type="button" @click="showAddLesson = false" class="px-4 py-1.5 text-xs font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Cancel</button>
                                    <button type="submit" class="px-4 py-1.5 text-xs font-medium text-white bg-primary rounded-lg hover:bg-purple-800 shadow-sm">Save Lesson</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Add Module Column -->
        <div class="lg:col-span-1 lg:order-2 order-1">
            <div class="bg-gray-50 rounded-2xl border border-gray-200 p-6 sticky top-24">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Add New Module
                </h3>
                
                <form action="<?= URL_ROOT ?>/modules/add/<?= $data['course']->id ?>" method="post" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Module Title</label>
                        <input type="text" name="title" required placeholder="e.g. Getting Started" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Order Number</label>
                        <input type="number" name="order_number" min="1" value="<?= count($data['modules']) + 1 ?>" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none transition">
                    </div>
                    <button type="submit" class="w-full bg-primary text-white font-medium py-2.5 rounded-xl hover:bg-purple-800 transition shadow-sm">
                        Create Module
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
