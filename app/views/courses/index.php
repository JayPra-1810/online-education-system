<?php require_once '../app/views/layouts/header.php'; ?>

<div class="mb-8 max-w-7xl mx-auto w-full">
    <div class="bg-primary rounded-2xl p-8 relative overflow-hidden shadow-lg shadow-purple-200 mb-10 flex flex-col items-center text-center justify-center">
        <div class="absolute top-0 right-0 -mt-16 -mr-16 bg-white opacity-10 rounded-full w-64 h-64 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -mb-16 -ml-16 bg-indigo-500 opacity-20 rounded-full w-64 h-64 blur-3xl"></div>
        
        <div class="relative z-10">
            <h1 class="text-4xl font-extrabold text-white tracking-tight mb-4">Explore our Catalog</h1>
            <p class="text-lg text-purple-100 max-w-2xl text-balance">Find the perfect course to kickstart your career, level up your skills, or explore a new hobby.</p>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-2">
            <select class="form-select pl-3 pr-10 py-2 border-none bg-gray-50 text-gray-700 text-sm rounded-lg focus:ring-0 focus:outline-none cursor-pointer">
                <option value="">All Categories</option>
                <option value="programming">Programming</option>
                <option value="design">Design</option>
                <option value="business">Business</option>
            </select>
            <select class="form-select pl-3 pr-10 py-2 border-none bg-gray-50 text-gray-700 text-sm rounded-lg focus:ring-0 focus:outline-none cursor-pointer">
                <option value="">Difficulty</option>
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
            </select>
            <select class="form-select pl-3 pr-10 py-2 border-none bg-gray-50 text-gray-700 text-sm rounded-lg focus:ring-0 focus:outline-none cursor-pointer">
                <option value="">Price</option>
                <option value="free">Free</option>
                <option value="paid">Paid</option>
            </select>
        </div>
        
        <div class="relative w-full md:w-64">
            <input type="text" placeholder="Search courses..." class="w-full bg-white border border-gray-200 rounded-full py-2 px-4 pl-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
            <svg class="w-4 h-4 text-gray-400 absolute left-4 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
    </div>

    <!-- Courses Grid -->
    <?php if(empty($data['courses'])) : ?>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
            <div class="inline-flex w-16 h-16 rounded-full bg-gray-50 text-gray-400 items-center justify-center mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">No courses available</h3>
            <p class="text-gray-500 max-w-md mx-auto">There are no published courses matching your criteria right now. Check back later!</p>
        </div>
    <?php else : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach($data['courses'] as $course) : ?>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col">
                    <div class="h-44 bg-gray-200 relative group overflow-hidden">
                        <?php if($course->thumbnail): ?>
                            <img src="<?= (filter_var($course->thumbnail, FILTER_VALIDATE_URL)) ? $course->thumbnail : URL_ROOT . '/uploads/' . $course->thumbnail ?>" alt="<?= $course->title ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <!-- Placeholder gradient -->
                            <div class="absolute inset-0 bg-gradient-to-tr from-indigo-500 to-purple-600"></div>
                            <div class="absolute inset-0 flex items-center justify-center text-white/50 group-hover:scale-110 transition duration-500">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="p-5 flex-grow flex flex-col">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="inline-block px-2.5 py-1 bg-purple-50 text-primary text-xs font-semibold rounded-full"><?= ucfirst($course->category) ?></span>
                            <span class="inline-block px-2.5 py-1 bg-gray-100 text-gray-600 text-xs font-semibold rounded-full"><?= ucfirst($course->difficulty_level) ?></span>
                        </div>
                        
                        <h4 class="font-bold text-gray-900 text-lg mb-2 line-clamp-2 leading-tight group-hover:text-primary transition"><a href="<?= URL_ROOT ?>/courses/show/<?= $course->id ?>"><?= $course->title ?></a></h4>
                        
                        <p class="text-sm text-gray-500 mb-4 line-clamp-2 flex-grow"><?= $course->description ?></p>
                        
                        <div class="flex items-center mt-auto pt-4 border-t border-gray-100 justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xs">
                                    <?= substr($course->creator_name, 0, 1) ?>
                                </div>
                                <span class="text-xs font-medium text-gray-700"><?= $course->creator_name ?></span>
                            </div>
                            
                            <span class="font-bold text-gray-900 text-lg">
                                <?= $course->price == 0 ? 'Free' : '$' . number_format($course->price, 2) ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
