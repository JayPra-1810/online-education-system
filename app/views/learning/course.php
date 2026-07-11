<?php require_once '../app/views/layouts/header.php'; ?>

<!-- Disable standard layout container wrapping for a full-width experience -->
<style>
    body { background-color: #f8fafc; }
    .main-container { padding: 0 !important; max-width: 100% !important; margin: 0 !important; }
    footer { display: none; } /* Hide standard footer in learning view */
</style>

<div class="flex h-[calc(100vh-64px)] overflow-hidden bg-white">
    
    <!-- Sidebar / Playlist -->
    <div class="w-80 border-r border-gray-200 bg-gray-50 flex flex-col h-full flex-shrink-0 z-10 shadow-sm" x-data="{ sidebarOpen: true }" :class="sidebarOpen ? 'block' : 'hidden md:block w-0 overflow-hidden'">
        <div class="p-5 border-b border-gray-200 bg-white">
            <h2 class="font-bold text-gray-900 line-clamp-2 leading-tight"><?= $data['course']->title ?></h2>
            
            <?php 
                $total_lessons = 0;
                $completed_count = 0;
                foreach($data['modules'] as $m) $total_lessons += count($m->lessons);
                foreach($data['completion_status'] as $status) if($status) $completed_count++;
                $progress_pct = $total_lessons > 0 ? round(($completed_count / $total_lessons) * 100) : 0;
            ?>
            <div class="mt-4">
                <div class="flex items-center justify-between text-xs font-medium text-gray-500 mb-1.5">
                    <span>Course Progress</span>
                    <span><?= $progress_pct ?>%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-success h-2 rounded-full" style="width: <?= $progress_pct ?>%"></div>
                </div>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto overflow-x-hidden p-3 space-y-2 custom-scrollbar">
            <?php if(empty($data['modules'])): ?>
                <div class="text-center p-6 bg-white rounded-lg shadow-sm border border-gray-100">
                    <p class="text-sm text-gray-500">No content available for this course yet.</p>
                </div>
            <?php else: ?>
                <?php foreach($data['modules'] as $index => $module): ?>
                    <div x-data="{ open: <?= ($data['active_module_id'] == $module->id || $index == 0) ? 'true' : 'false' ?> }" class="rounded-xl overflow-hidden bg-white border border-gray-200 shadow-sm transition-all duration-200">
                        <button @click="open = !open" class="w-full px-4 py-3.5 flex items-center justify-between bg-gray-50 hover:bg-gray-100 transition text-left focus:outline-none select-none">
                            <div class="pr-4">
                                <h3 class="font-bold text-gray-900 text-sm leading-tight leading-snug">Section <?= $index + 1 ?>: <?= $module->title ?></h3>
                                <div class="flex items-center gap-2 mt-1">
                                    <?php 
                                        $mod_lessons = count($module->lessons);
                                        $mod_completed = 0;
                                        foreach($module->lessons as $l) {
                                            if(isset($data['completion_status'][$l->id]) && $data['completion_status'][$l->id]) $mod_completed++;
                                        }
                                    ?>
                                    <span class="text-xs text-gray-500 font-medium"><?= $mod_completed ?> / <?= $mod_lessons ?></span>
                                </div>
                            </div>
                            <svg :class="open ? 'rotate-180 text-primary' : 'text-gray-400'" class="w-5 h-5 transition-transform duration-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="open" x-collapse.duration.300ms class="divide-y divide-gray-100">
                            <?php if(empty($module->lessons)): ?>
                                <p class="text-xs text-gray-500 px-4 py-3 italic">Empty module</p>
                            <?php else: ?>
                                <?php foreach($module->lessons as $lesson): ?>
                                    <?php 
                                        $isActive = ($data['current_lesson'] && $data['current_lesson']->id == $lesson->id);
                                        $isCompleted = isset($data['completion_status'][$lesson->id]) && $data['completion_status'][$lesson->id]; 
                                    ?>
                                    <a href="<?= URL_ROOT ?>/learning/course/<?= $data['course']->id ?>/<?= $lesson->id ?>" 
                                       class="block px-4 py-3 hover:bg-purple-50 transition relative group <?= $isActive ? 'bg-purple-50' : '' ?>">
                                        
                                        <?php if($isActive): ?>
                                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-primary"></div>
                                        <?php endif; ?>

                                        <div class="flex items-start gap-3">
                                            <!-- Checkbox/Status Indicator -->
                                            <div class="mt-0.5 flex-shrink-0">
                                                <button class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center hover:border-success transition group-hover:border-primary <?= $isCompleted ? 'bg-success border-success text-white' : '' ?>">
                                                    <?php if($isCompleted): ?>
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                    <?php endif; ?>
                                                </button>
                                            </div>
                                            
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium leading-snug mb-1 <?= $isActive ? 'text-primary font-bold' : 'text-gray-700' ?>"><?= $lesson->title ?></p>
                                                
                                                <div class="flex items-center text-xs text-gray-500 gap-1.5 font-medium">
                                                    <?php if($lesson->type == 'video'): ?>
                                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                                                        <span>Video</span>
                                                    <?php else: ?>
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                        <span>Reading</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col h-full relative bg-gray-50">
        <!-- Top Toolbar -->
        <div class="h-14 bg-white border-b border-gray-200 flex items-center justify-between px-4 lg:px-6 shadow-sm z-10 flex-shrink-0">
            <div class="flex items-center gap-3">
                <button @click="$dispatch('toggle-sidebar')" class="md:hidden p-2 text-gray-500 hover:text-gray-900 rounded-lg hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <div class="hidden md:flex items-center gap-2">
                    <a href="<?= URL_ROOT ?>/student/dashboard" class="text-sm font-medium text-gray-500 hover:text-gray-900 transition flex items-center gap-1 bg-gray-100 px-3 py-1.5 rounded-full">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Dashboard
                    </a>
                </div>
            </div>
            
            <div class="flex items-center gap-3">
                <?php Session::flash('learning_message'); ?>
                
                <!-- Certificate Button -->
                <?php if($data['is_completed']): ?>
                    <?php if($data['certificate']): ?>
                        <a href="<?= URL_ROOT ?>/learning/viewCertificate/<?= $data['course']->id ?>" target="_blank" class="px-5 py-2 text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 rounded-full transition flex items-center gap-1.5 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a.75.75 0 00-1.034 1.034l.622.622L5.43 8.35a.75.75 0 101.06 1.06l2.353-2.353.622.622a.75.75 0 001.034-1.034l-.622-.622 2.353-2.353a.75.75 0 00-1.06-1.06l-2.353 2.353-.622-.622z"></path></svg>
                            View Certificate
                        </a>
                    <?php else: ?>
                        <form action="<?= URL_ROOT ?>/learning/generateCertificate/<?= $data['course']->id ?>" method="post">
                            <button type="submit" class="px-5 py-2 text-sm font-bold text-white bg-primary hover:bg-purple-800 rounded-full transition flex items-center gap-1.5 shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Claim Certificate
                            </button>
                        </form>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if($data['current_lesson']): ?>
                    <?php $isLessonCompleted = isset($data['completion_status'][$data['current_lesson']->id]) && $data['completion_status'][$data['current_lesson']->id]; ?>
                    
                    <?php if(!$isLessonCompleted): ?>
                        <form action="<?= URL_ROOT ?>/learning/complete/<?= $data['course']->id ?>/<?= $data['current_lesson']->id ?>" method="post">
                            <button type="submit" class="px-5 py-2 text-sm font-bold text-white bg-success hover:bg-green-600 rounded-full transition flex items-center gap-1.5 shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                Mark Complete
                            </button>
                        </form>
                    <?php else: ?>
                        <div class="px-5 py-2 text-sm font-bold text-success bg-green-50 border border-green-200 rounded-full flex items-center gap-1.5 shadow-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            Completed
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto">
            <?php if(!$data['current_lesson']): ?>
                <div class="h-full flex items-center justify-center">
                    <div class="text-center max-w-md p-8">
                        <div class="w-24 h-24 mx-auto mb-6 bg-purple-100 rounded-full flex items-center justify-center text-primary">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Welcome to <?= $data['course']->title ?></h2>
                        <p class="text-gray-500 mb-6">Select a lesson from the Curriculum sidebar to start your learning journey.</p>
                    </div>
                </div>
            <?php else: ?>
                <div class="max-w-5xl mx-auto w-full">
                    
                    <?php if($data['current_lesson']->type == 'video' && !empty($data['current_lesson']->video_url)): ?>
                        <!-- Video Player Area -->
                        <div class="w-full bg-black aspect-video relative">
                            <!-- Dummy Video Player (Using YouTube embed for now) -->
                            <?php 
                                // Simple extraction of youtube ID for demo
                                $video_url = $data['current_lesson']->video_url;
                                $video_id = '';
                                if(preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $video_url, $matches)) {
                                    $video_id = $matches[1];
                                }
                            ?>
                            
                            <?php if($video_id): ?>
                                <iframe class="w-full h-full" src="https://www.youtube.com/embed/<?= $video_id ?>?rel=0&showinfo=0&color=white" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <?php else: ?>
                                <div class="absolute inset-0 flex flex-col items-center justify-center text-white p-8 text-center bg-gray-900">
                                    <svg class="w-16 h-16 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                    <p class="text-xl font-medium mb-2">External Video Source</p>
                                    <a href="<?= $video_url ?>" target="_blank" class="text-primary hover:text-purple-400 underline"><?= $video_url ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php elseif($data['current_lesson']->type == 'video'): ?>
                         <!-- Missing Video Area -->
                         <div class="w-full bg-gray-900 aspect-video flex items-center justify-center text-white">
                            <div class="text-center">
                                <svg class="w-16 h-16 text-gray-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                <p>Video content not available.</p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="px-6 py-8 md:px-10 lg:py-6" x-data="{ activeTab: 'content' }">
                        <!-- Content Tabs -->
                        <div class="flex border-b border-gray-200 mb-8">
                            <button @click="activeTab = 'content'" :class="activeTab === 'content' ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700'" class="px-6 py-3 border-b-2 font-bold text-sm transition focus:outline-none">Lesson Content</button>
                            <button @click="activeTab = 'qa'" :class="activeTab === 'qa' ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700'" class="px-6 py-3 border-b-2 font-bold text-sm transition focus:outline-none flex items-center gap-2">
                                Q&A
                                <span class="bg-gray-100 text-gray-500 py-0.5 px-2 rounded-full text-[10px]"><?= count($data['discussions']) ?></span>
                            </button>
                        </div>

                        <!-- Tab: Lesson Content -->
                        <div x-show="activeTab === 'content'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0">
                            <h1 class="text-3xl font-extrabold text-gray-900 mb-6 leading-tight"><?= $data['current_lesson']->title ?></h1>
                        
                        <?php if(!empty($data['current_lesson']->content)): ?>
                            <div class="prose prose-lg prose-indigo max-w-none text-gray-700">
                                <?= nl2br(htmlspecialchars($data['current_lesson']->content)) ?>
                            </div>
                        <?php endif; ?>

                        <!-- Lesson Navigation -->
                        <div class="mt-12 flex items-center justify-between pt-6 border-t border-gray-200">
                            <button class="px-6 py-2.5 bg-white border border-gray-300 rounded-full font-medium text-gray-700 hover:bg-gray-50 transition shadow-sm flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                Previous Lesson
                            </button>
                            <button class="px-6 py-2.5 bg-primary border border-transparent rounded-full font-medium text-white hover:bg-purple-800 transition shadow-sm flex items-center gap-2">
                                Next Lesson
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </button>
                        </div>
                        </div>

                        <!-- Tab: Q&A -->
                        <div x-show="activeTab === 'qa'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">Questions & Answers</h2>
                            
                            <!-- Ask Question Form -->
                            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm mb-8">
                                <form action="<?= URL_ROOT ?>/discussions/create" method="post">
                                    <input type="hidden" name="course_id" value="<?= $data['course']->id ?>">
                                    <textarea name="content" rows="3" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:outline-none transition mb-3" placeholder="Ask a question about this course..." required></textarea>
                                    <div class="flex justify-end">
                                        <button type="submit" class="bg-primary text-white px-6 py-2 rounded-full font-bold hover:bg-purple-800 transition shadow-sm">Post Question</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Discussion List -->
                            <div class="space-y-6">
                                <?php if(empty($data['discussions'])): ?>
                                    <div class="text-center py-12">
                                        <p class="text-gray-500">No questions yet. Be the first to ask!</p>
                                    </div>
                                <?php else: ?>
                                    <?php foreach($data['discussions'] as $discussion): ?>
                                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" x-data="{ replying: false }">
                                            <div class="p-6">
                                                <div class="flex items-start gap-4 mb-4">
                                                    <div class="w-10 h-10 rounded-full bg-indigo-50 text-primary flex items-center justify-center font-bold">
                                                        <?= substr($discussion->user_name, 0, 1) ?>
                                                    </div>
                                                    <div>
                                                        <h4 class="font-bold text-gray-900"><?= $discussion->user_name ?></h4>
                                                        <p class="text-xs text-gray-400"><?= date('M j, Y', strtotime($discussion->created_at)) ?></p>
                                                    </div>
                                                </div>
                                                <div class="text-gray-700 mb-4">
                                                    <?= nl2br(htmlspecialchars($discussion->content)) ?>
                                                </div>
                                                <div class="flex items-center gap-4">
                                                    <button @click="replying = !replying" class="text-sm font-bold text-primary hover:underline">Reply</button>
                                                    <span class="text-xs text-gray-400"><?= count($discussion->replies) ?> replies</span>
                                                </div>

                                                <!-- Reply Form -->
                                                <div x-show="replying" class="mt-4 pt-4 border-t border-gray-100">
                                                    <form action="<?= URL_ROOT ?>/discussions/reply" method="post">
                                                        <input type="hidden" name="course_id" value="<?= $data['course']->id ?>">
                                                        <input type="hidden" name="discussion_id" value="<?= $discussion->id ?>">
                                                        <textarea name="content" rows="2" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:outline-none transition mb-2" placeholder="Write your reply..." required></textarea>
                                                        <div class="flex justify-end gap-2">
                                                            <button type="button" @click="replying = false" class="px-4 py-2 text-sm text-gray-500 font-medium">Cancel</button>
                                                            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-full text-sm font-bold hover:bg-purple-800 transition shadow-sm">Post Reply</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <!-- Replies List -->
                                            <?php if(!empty($discussion->replies)): ?>
                                                <div class="bg-gray-50 border-t border-gray-100 px-6 py-4 space-y-4">
                                                    <?php foreach($discussion->replies as $reply): ?>
                                                        <div class="flex items-start gap-3">
                                                            <div class="w-8 h-8 rounded-full bg-white border border-gray-200 text-gray-600 flex items-center justify-center text-xs font-bold">
                                                                <?= substr($reply->user_name, 0, 1) ?>
                                                            </div>
                                                            <div class="flex-1">
                                                                <div class="flex items-center gap-2 mb-0.5">
                                                                    <span class="text-sm font-bold text-gray-800"><?= $reply->user_name ?></span>
                                                                    <span class="text-[10px] text-gray-400"><?= date('M j, Y', strtotime($reply->created_at)) ?></span>
                                                                </div>
                                                                <p class="text-sm text-gray-600"><?= nl2br(htmlspecialchars($reply->content)) ?></p>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Inject custom script for sidebar toggle -->
<script>
    document.addEventListener('alpine:init', () => {
        // Handle global events
        window.addEventListener('toggle-sidebar', () => {
             // Basic implementation of toggle targeting Alpine component
             // In a real Alpine app, use stores or cross-component communication
             document.querySelector('[x-data="{ sidebarOpen: true }"]').__x.$data.sidebarOpen = !document.querySelector('[x-data="{ sidebarOpen: true }"]').__x.$data.sidebarOpen;
        });
    });
</script>

<?php require_once '../app/views/layouts/footer.php'; ?>
