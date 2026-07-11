<?php require_once '../app/views/layouts/header.php'; ?>

<div class="flex flex-col md:flex-row gap-6">
    <!-- Sidebar -->
    <div class="w-full md:w-64 flex-shrink-0">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sticky top-24">
            <nav class="space-y-1">
                <a href="<?= URL_ROOT ?>/creator/dashboard" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
                <a href="<?= URL_ROOT ?>/courses/manage" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    My Courses
                </a>
                <a href="<?= URL_ROOT ?>/creator/feed" class="flex items-center gap-3 px-3 py-2.5 bg-primary/10 text-primary rounded-xl font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    Learning Feed
                </a>
            </nav>
        </div>
    </div>

    <!-- Main Area -->
    <div class="flex-1">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 font-primary">Micro-learning Feed</h1>
            <p class="text-gray-500 mt-1">Post updates, tips, and quick lessons for your students.</p>
        </div>

        <?php Session::flash('feed_message'); ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Create Post Form -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                    <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Share an Update
                    </h3>
                    <form action="<?= URL_ROOT ?>/creator/createPost" method="post" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                            <input type="text" name="title" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:outline-none transition" placeholder="e.g. Quick Tip: MVC Structure" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">What's on your mind?</label>
                            <textarea name="content" rows="4" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:outline-none transition" placeholder="Share some knowledge..."></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Video URL (optional)</label>
                            <input type="text" name="video_url" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:outline-none transition" placeholder="YouTube or Vimeo link">
                        </div>
                        <button type="submit" class="w-full bg-primary text-white py-2.5 rounded-xl font-bold hover:bg-purple-800 transition shadow-sm">Post Update</button>
                    </form>
                </div>
            </div>

            <!-- Feed List -->
            <div class="lg:col-span-2">
                <div class="space-y-6">
                    <?php if(empty($data['posts'])): ?>
                        <div class="bg-white rounded-2xl p-12 text-center border border-dashed border-gray-200">
                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                            </div>
                            <h4 class="font-bold text-gray-900">Your feed is empty</h4>
                            <p class="text-gray-500 text-sm max-w-xs mx-auto mt-1">Start posting updates to keep your students engaged and informed.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach($data['posts'] as $post): ?>
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h3 class="font-bold text-gray-900 text-lg"><?= $post->title ?></h3>
                                            <p class="text-xs text-gray-400"><?= date('M j, Y \a\t g:i a', strtotime($post->created_at)) ?></p>
                                        </div>
                                        <form action="<?= URL_ROOT ?>/creator/deletePost/<?= $post->id ?>" method="post" onsubmit="return confirm('Delete this post?');">
                                            <button type="submit" class="text-gray-400 hover:text-red-500 transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="prose prose-sm text-gray-600 max-w-none">
                                        <?= nl2br($post->content) ?>
                                    </div>
                                    <?php if($post->video_url): ?>
                                        <div class="mt-4 rounded-xl overflow-hidden bg-gray-100 p-4 flex items-center gap-3 border border-gray-200">
                                            <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                                            <div class="flex-1">
                                                <p class="text-xs font-bold text-gray-900">Video Content Included</p>
                                                <a href="<?= $post->video_url ?>" target="_blank" class="text-xs text-primary hover:underline truncate block max-w-xs"><?= $post->video_url ?></a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
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
