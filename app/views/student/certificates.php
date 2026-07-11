<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-7xl mx-auto w-full">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">My Certificates</h1>
        <p class="text-gray-500 mt-1">View and download your earned certificates of completion.</p>
    </div>

    <!-- Certificates List -->
    <?php if(empty($data['certificates'])): ?>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
            <div class="inline-flex w-20 h-20 rounded-full bg-purple-50 text-primary items-center justify-center mb-6">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
            </div>
            <h2 class="text-xl font-bold text-gray-900 mb-2">No certificates yet</h2>
            <p class="text-gray-500 max-w-sm mx-auto mb-8">Complete a course 100% to earn your professional certificate of completion.</p>
            <a href="<?= URL_ROOT ?>/student/dashboard" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-full shadow-sm text-base font-medium text-white bg-primary hover:bg-purple-800 transition">
                Continue Learning
            </a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach($data['certificates'] as $cert): ?>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition group">
                    <div class="h-40 bg-gradient-to-br from-indigo-500 to-purple-600 p-6 flex items-center justify-center relative">
                        <svg class="w-16 h-16 text-white/20 absolute -right-4 -bottom-4 rotate-12" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.827a1 1 0 00-.788 0l-7 3a1 1 0 000 1.846l7 3a1 1 0 00.788 0l7-3a1 1 0 000-1.846l-7-3z"></path><path d="M6.75 6.75C6.75 5.784 7.534 5 8.5 5h3c.966 0 1.75.784 1.75 1.75v3.583l-2.646 1.133a1 1 0 01-.708 0L6.75 10.333V6.75z"></path></svg>
                        <div class="text-white text-center z-10">
                            <svg class="w-12 h-12 mx-auto mb-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-xs font-bold uppercase tracking-widest text-white/80">Certified</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-gray-900 mb-1 line-clamp-2 h-12"><?= $cert->course_title ?></h3>
                        <p class="text-xs text-gray-500 mb-6">Issued on <?= date('M j, Y', strtotime($cert->issued_at)) ?></p>
                        <div class="flex items-center justify-between gap-3">
                            <a href="<?= URL_ROOT ?>/learning/viewCertificate/<?= $cert->course_id ?>" target="_blank" class="flex-1 bg-primary/10 text-primary px-4 py-2.5 rounded-xl text-center text-sm font-bold hover:bg-primary hover:text-white transition">View PDF</a>
                            <button class="p-2.5 text-gray-400 hover:text-gray-600 border border-gray-100 rounded-xl transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
