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

            <nav class="space-y-1">
                <a href="<?= URL_ROOT ?>/student/dashboard" class="flex items-center gap-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    My Learning
                </a>
                <a href="<?= URL_ROOT ?>/student/feed" class="flex items-center gap-3 px-3 py-2.5 bg-primary/10 text-primary rounded-xl font-medium transition">
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

    <!-- Main Feed Area -->
    <div class="flex-1">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Learning Feed ✨</h1>
            <p class="text-gray-500 mt-1">Latest micro-learning updates from your instructors.</p>
        </div>

        <?php if(empty($data['posts'])): ?>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                <div class="inline-flex w-20 h-20 rounded-full bg-indigo-50 text-indigo-400 items-center justify-center mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-2">Your feed is quiet</h4>
                <p class="text-gray-500 max-w-sm mx-auto mb-8">Enroll in more courses to see regular updates and micro-learning tips from our world-class instructors.</p>
                <a href="<?= URL_ROOT ?>/courses" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-full shadow-sm text-base font-medium text-white bg-primary hover:bg-purple-800 transition">
                    Explore Catalog
                </a>
            </div>
        <?php else: ?>
            <div class="space-y-8 max-w-2xl">
                <?php foreach($data['posts'] as $post): ?>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                    <div class="p-6">
                        <!-- Post Header -->
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 text-primary flex items-center justify-center font-bold">
                                <?= substr($post->creator_name, 0, 1) ?>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900"><?= $post->creator_name ?></h4>
                                <p class="text-xs text-gray-500"><?= date('M j, Y', strtotime($post->created_at)) ?></p>
                            </div>
                        </div>

                        <!-- Post Content -->
                        <div class="prose prose-indigo max-w-none">
                            <h3 class="text-xl font-bold mb-2 text-gray-900"><?= $post->title ?></h3>
                            <p class="text-gray-600 leading-relaxed"><?= nl2br($post->content) ?></p>
                        </div>

                        <!-- Video Embed (if exists) -->
                        <?php if(!empty($post->video_url)): ?>
                        <div class="mt-4 rounded-xl overflow-hidden aspect-video bg-black shadow-inner">
                            <?php 
                                $embed_url = $post->video_url;
                                if(strpos($post->video_url, 'youtube.com/watch?v=') !== false) {
                                    $video_id = explode('v=', $post->video_url)[1];
                                    $video_id = explode('&', $video_id)[0];
                                    $embed_url = "https://www.youtube.com/embed/" . $video_id;
                                } elseif(strpos($post->video_url, 'youtu.be/') !== false) {
                                    $video_id = explode('youtu.be/', $post->video_url)[1];
                                    $embed_url = "https://www.youtube.com/embed/" . $video_id;
                                }
                            ?>
                            <iframe class="w-full h-full" src="<?= $embed_url ?>" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
