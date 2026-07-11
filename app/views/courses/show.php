<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-7xl mx-auto w-full pb-16">
    <!-- Breadcrumb -->
    <nav class="flex py-4 mb-4 text-gray-500 text-sm" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="<?= URL_ROOT ?>" class="hover:text-gray-900 transition">Home</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <a href="<?= URL_ROOT ?>/courses" class="hover:text-gray-900 transition">Catalog</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <span class="text-gray-900 font-medium truncate max-w-[200px]"><?= $data['course']->title ?></span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Top Hero Section -->
    <div class="bg-gray-900 rounded-3xl overflow-hidden shadow-xl mb-12">
        <div class="flex flex-col lg:flex-row min-h-[400px]">
            <!-- Course Info -->
            <div class="lg:w-3/5 p-8 md:p-12 flex flex-col justify-center bg-gray-900 text-white relative z-10">
                <div class="flex items-center gap-3 mb-6">
                    <span class="inline-block px-3 py-1 bg-white/10 text-white text-xs font-semibold rounded-full border border-white/20"><?= ucfirst($data['course']->category) ?></span>
                    <span class="inline-block px-3 py-1 bg-white/10 text-white text-xs font-semibold rounded-full border border-white/20"><?= ucfirst($data['course']->difficulty_level) ?></span>
                </div>
                
                <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight mb-4 leading-tight"><?= $data['course']->title ?></h1>
                <p class="text-lg text-gray-300 max-w-2xl mb-8 leading-relaxed line-clamp-3"><?= $data['course']->description ?></p>
                
                <div class="flex flex-wrap items-center gap-6 mt-auto">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-white text-primary flex items-center justify-center font-bold text-lg">
                            <?= substr($data['course']->creator_name, 0, 1) ?>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Created by</p>
                            <p class="font-medium text-white"><?= $data['course']->creator_name ?></p>
                        </div>
                    </div>
                    
                    <div class="w-px h-10 bg-gray-700 hidden sm:block"></div>
                    
                    <div class="flex items-center gap-2 text-yellow-400">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <span class="font-bold text-white"><?= number_format($data['avg_rating'], 1) ?></span>
                        <span class="text-sm text-gray-400">(<?= $data['review_count'] ?> ratings)</span>
                    </div>
                </div>
            </div>

            <!-- Preview Video/Enroll Card -->
            <div class="lg:w-2/5 relative p-8 flex items-center justify-center">
                <!-- Background decorative elements -->
                <div class="absolute inset-0 bg-gradient-to-br from-purple-900 to-indigo-900"></div>
                <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>
                
                <div class="bg-white rounded-2xl shadow-2xl overflow-hidden w-full max-w-sm relative z-20 transform translate-y-8 lg:translate-y-0">
                    <div class="h-48 relative bg-gray-100 group cursor-pointer flex items-center justify-center">
                        <?php if($data['course']->thumbnail): ?>
                            <img src="<?= (filter_var($data['course']->thumbnail, FILTER_VALIDATE_URL)) ? $data['course']->thumbnail : URL_ROOT . '/uploads/' . $data['course']->thumbnail ?>" alt="Course preview" class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="absolute inset-0 bg-gradient-to-tr from-indigo-500 to-primary"></div>
                        <?php endif; ?>
                        
                        <!-- Play button overlay -->
                        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center group-hover:bg-opacity-30 transition">
                            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition duration-300">
                                <svg class="w-8 h-8 text-primary ml-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                            </div>
                        </div>
                        <span class="absolute bottom-4 inset-x-0 text-center text-white font-medium text-sm drop-shadow-md">Preview this course</span>
                    </div>
                    
                    <div class="p-6">
                        <div class="text-3xl font-extrabold text-gray-900 mb-4">
                            <?= $data['course']->price == 0 ? 'Free' : '$' . number_format($data['course']->price, 2) ?>
                        </div>
                        
                        <form action="<?= URL_ROOT ?>/enrollments/checkout" method="post">
                            <input type="hidden" name="course_id" value="<?= $data['course']->id ?>">
                            <button type="submit" class="w-full bg-primary hover:bg-purple-800 text-white font-bold py-3.5 px-4 rounded-xl shadow-md shadow-purple-200 transition mb-3 flex justify-center items-center gap-2">
                                <?php if($data['course']->price == 0): ?>
                                    Enroll Now
                                <?php else: ?>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    Add to Cart
                                <?php endif; ?>
                            </button>
                        </form>
                        
                        <p class="text-xs text-center text-gray-500 mb-6">30-Day Money-Back Guarantee</p>
                        
                        <div class="space-y-3">
                            <h4 class="font-semibold text-sm text-gray-900 uppercase tracking-wider mb-2">This course includes:</h4>
                            <?php 
                                $total_lessons = 0;
                                foreach($data['modules'] as $m) $total_lessons += count($m->lessons);
                            ?>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                <?= count($data['modules']) ?> sections &bull; <?= $total_lessons ?> lessons
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                Full lifetime access
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                Access on mobile and Web
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4a3 3 0 013 3v1a3 3 0 01-3 3H5a3 3 0 01-3-3v-1a3 3 0 013-3z"></path></svg>
                                Certificate of completion
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Details Setup -->
    <div class="flex flex-col lg:flex-row gap-12">
        <!-- Main Content Column -->
        <div class="lg:w-2/3 space-y-12">
            
            <!-- What You'll Learn -->
            <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">What you'll learn</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-success mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-gray-600">Understand the core principles of the subject matter</span>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-success mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-gray-600">Build real-world projects from scratch</span>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-success mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-gray-600">Master best practices and industry standards</span>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-success mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-gray-600">Prepare for professional certification exams</span>
                    </div>
                </div>
            </div>

            <!-- Course Content / Syllabus Accordion -->
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Course Content</h2>
                <div class="text-sm text-gray-500 mb-4 flex items-center justify-between">
                    <span><?= count($data['modules']) ?> sections &bull; <?= $total_lessons ?> lectures</span>
                </div>
                
                <div class="border border-gray-200 rounded-xl overflow-hidden divide-y divide-gray-200">
                    <?php if(empty($data['modules'])): ?>
                        <div class="p-8 text-center bg-gray-50">
                            <p class="text-gray-500 italic">No content uploaded yet.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach($data['modules'] as $index => $module): ?>
                            <div x-data="{ expanded: <?= $index == 0 ? 'true' : 'false' ?> }" class="bg-gray-50">
                                <button @click="expanded = !expanded" class="w-full px-6 py-4 flex items-center justify-between focus:outline-none hover:bg-gray-100 transition">
                                    <div class="flex items-center gap-4">
                                        <svg :class="expanded ? 'rotate-180 transform' : ''" class="w-5 h-5 text-gray-500 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        <span class="font-bold text-gray-900 text-left"><?= $module->title ?></span>
                                    </div>
                                    <span class="text-sm text-gray-500"><?= count($module->lessons) ?> lectures</span>
                                </button>
                                <div x-show="expanded" x-collapse class="bg-white border-t border-gray-200 divide-y divide-gray-100">
                                    <?php if(empty($module->lessons)): ?>
                                        <div class="px-6 py-3 text-sm text-gray-500 italic">No lessons in this module.</div>
                                    <?php else: ?>
                                        <?php foreach($module->lessons as $lesson): ?>
                                            <div class="px-6 py-3.5 flex items-center justify-between hover:bg-gray-50 transition">
                                                <div class="flex items-center gap-3">
                                                    <?php if($lesson->type == 'video'): ?>
                                                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                                                    <?php else: ?>
                                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                    <?php endif; ?>
                                                    <span class="text-sm text-gray-700"><?= $lesson->title ?></span>
                                                </div>
                                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest"><?= $lesson->type ?></span>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Reviews Section -->
            <div id="reviews">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">Student feedback</h2>
                    <div class="flex items-center gap-2 text-yellow-500 bg-yellow-50 px-4 py-2 rounded-xl">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <span class="text-2xl font-extrabold"><?= number_format($data['avg_rating'], 1) ?></span>
                        <span class="text-gray-500 font-medium">Course Rating</span>
                    </div>
                </div>

                <?php Session::flash('review_message'); ?>

                <!-- Review Form (Only for enrolled students) -->
                <?php if($data['is_enrolled']): ?>
                    <div class="bg-gray-50 rounded-2xl p-8 mb-12 border border-gray-100 shadow-sm" x-data="{ rating: 5 }">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Rate this course</h3>
                        <form action="<?= URL_ROOT ?>/reviews/add" method="post" class="space-y-4">
                            <input type="hidden" name="course_id" value="<?= $data['course']->id ?>">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                                <div class="flex items-center gap-1">
                                    <template x-for="i in 5">
                                        <button type="button" @click="rating = i" class="focus:outline-none transition-transform hover:scale-110">
                                            <svg :class="i <= rating ? 'text-yellow-400 fill-current' : 'text-gray-300'" class="w-8 h-8" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        </button>
                                    </template>
                                </div>
                                <input type="hidden" name="rating" :value="rating">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Review</label>
                                <textarea name="review_text" rows="4" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:outline-none transition" placeholder="Tell us what you thought of the course..."></textarea>
                            </div>
                            <button type="submit" class="bg-primary text-white px-8 py-3 rounded-xl font-bold hover:bg-purple-800 transition shadow-sm">Submit Review</button>
                        </form>
                    </div>
                <?php endif; ?>

                <!-- Review List -->
                <div class="space-y-6">
                    <?php if(empty($data['reviews'])): ?>
                        <div class="text-center py-12 bg-white rounded-2xl border border-dashed border-gray-200">
                            <p class="text-gray-500">No reviews yet for this course.</p>
                        </div>
                    <?php else: ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <?php foreach($data['reviews'] as $review): ?>
                                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm transition hover:shadow-md">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-purple-100 text-primary flex items-center justify-center font-bold">
                                                <?= substr($review->user_name, 0, 1) ?>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-gray-900 text-sm"><?= $review->user_name ?></h4>
                                                <div class="flex items-center gap-1 text-yellow-400">
                                                    <?php for($i=1; $i<=5; $i++): ?>
                                                        <svg class="w-3 h-3 <?= $i <= $review->rating ? 'fill-current' : 'text-gray-300' ?>" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                    <?php endfor; ?>
                                                    <span class="text-[10px] text-gray-400 ml-1 font-medium"><?= date('M j, Y', strtotime($review->created_at)) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600 italic line-clamp-4">"<?= htmlspecialchars($review->review_text) ?>"</p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
