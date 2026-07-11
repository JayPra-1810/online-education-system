<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-4xl mx-auto w-full">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Course</h1>
            <p class="text-gray-500 mt-1">Update your course details.</p>
        </div>
        <a href="<?= URL_ROOT ?>/courses/manage" class="text-gray-500 hover:text-gray-900 font-medium text-sm transition flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Manage
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form action="<?= URL_ROOT ?>/courses/edit/<?= $data['id'] ?>" method="post" enctype="multipart/form-data" class="space-y-6" x-data="{ uploadMode: 'file' }">
            <input type="hidden" name="csrf_token" value="<?= Session::generateCsrfToken() ?>">

            <!-- Current Thumbnail Preview -->
            <div class="flex items-start gap-6 pb-6 border-b border-gray-50">
                <div class="w-40 h-24 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0 border border-gray-200 shadow-inner">
                    <?php if($data['thumbnail']): ?>
                        <?php 
                            $thumb_url = $data['thumbnail'];
                            if(!filter_var($thumb_url, FILTER_VALIDATE_URL)) {
                                $thumb_url = URL_ROOT . '/uploads/' . $data['thumbnail'];
                            }
                        ?>
                        <img src="<?= $thumb_url ?>" alt="Current thumbnail" class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 mb-1">Update Course Thumbnail</h4>
                    <p class="text-xs text-gray-500 max-w-sm">Choose a new thumbnail to represent your course. You can upload a file or use a public link. If left unchanged, the current one will persist.</p>
                </div>
            </div>

            <!-- Thumbnail Selection -->
            <div>
                <div class="flex gap-4 mb-4 mt-2">
                    <button type="button" 
                        @click="uploadMode = 'file'"
                        :class="uploadMode === 'file' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="px-4 py-2 rounded-xl text-sm font-bold transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        Upload File
                    </button>
                    <button type="button" 
                        @click="uploadMode = 'url'"
                        :class="uploadMode === 'url' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="px-4 py-2 rounded-xl text-sm font-bold transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                        Public URL
                    </button>
                </div>

                <!-- File Upload Input -->
                <div x-show="uploadMode === 'file'" class="transition-all">
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="mb-1 text-sm text-gray-500"><span class="font-bold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-400">PNG, JPG or WEBP (Max. 2MB)</p>
                            </div>
                            <input type="file" name="thumbnail_file" class="hidden" accept="image/*" />
                        </label>
                    </div>
                </div>

                <!-- URL Input -->
                <div x-show="uploadMode === 'url'" class="transition-all">
                    <input type="url" name="thumbnail_url" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none transition" placeholder="Paste image URL here..." value="<?= filter_var($data['thumbnail'], FILTER_VALIDATE_URL) ? $data['thumbnail'] : '' ?>">
                </div>
                <span class="text-sm text-red-500 mt-1"><?= $data['thumbnail_err'] ?></span>
            </div>

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Course Title</label>
                <input type="text" name="title" id="title" class="w-full px-4 py-3 border <?= (!empty($data['title_err'])) ? 'border-red-500' : 'border-gray-300' ?> rounded-xl focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none transition" value="<?= $data['title'] ?>" placeholder="e.g. Mastering UI/UX Design">
                <span class="text-sm text-red-500 mt-1"><?= $data['title_err'] ?></span>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Course Description</label>
                <textarea name="description" id="description" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none transition placeholder-gray-400" placeholder="Briefly describe what students will learn..."><?= $data['description'] ?></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price (USD)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">$</span>
                        </div>
                        <input type="number" step="0.01" name="price" id="price" class="w-full pl-7 px-4 py-3 border <?= (!empty($data['price_err'])) ? 'border-red-500' : 'border-gray-300' ?> rounded-xl focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none transition" value="<?= $data['price'] ?>" placeholder="0.00">
                    </div>
                    <span class="text-sm text-red-500 mt-1"><?= $data['price_err'] ?></span>
                </div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category" id="category" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none transition bg-white">
                        <option value="Programming" <?= $data['category'] == 'Programming' ? 'selected' : '' ?>>Programming</option>
                        <option value="Design" <?= $data['category'] == 'Design' ? 'selected' : '' ?>>Design</option>
                        <option value="Business" <?= $data['category'] == 'Business' ? 'selected' : '' ?>>Business</option>
                        <option value="Marketing" <?= $data['category'] == 'Marketing' ? 'selected' : '' ?>>Marketing</option>
                    </select>
                </div>

                <!-- Difficulty -->
                <div>
                    <label for="difficulty_level" class="block text-sm font-medium text-gray-700 mb-1">Difficulty Level</label>
                    <select name="difficulty_level" id="difficulty_level" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none transition bg-white">
                        <option value="beginner" <?= $data['difficulty_level'] == 'beginner' ? 'selected' : '' ?>>Beginner</option>
                        <option value="intermediate" <?= $data['difficulty_level'] == 'intermediate' ? 'selected' : '' ?>>Intermediate</option>
                        <option value="advanced" <?= $data['difficulty_level'] == 'advanced' ? 'selected' : '' ?>>Advanced</option>
                    </select>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                <a href="<?= URL_ROOT ?>/courses/manage" class="px-6 py-2.5 bg-white border border-gray-300 rounded-full font-medium text-gray-700 hover:bg-gray-50 transition">Cancel</a>
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-full font-medium hover:bg-purple-800 transition shadow-sm">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<?php require_once '../app/views/layouts/header.php'; ?>
