<?php require_once '../app/views/layouts/header.php'; ?>

<div class="animate-fade-in">
    <!-- Hero Section -->
    <div class="bg-primary rounded-2xl p-8 md:p-12 mb-8 text-white relative overflow-hidden shadow-lg shadow-purple-200">
        <div class="absolute top-0 right-0 -mt-16 -mr-16 bg-white opacity-10 rounded-full w-64 h-64 blur-3xl"></div>
        <div class="relative z-10 max-w-2xl">
            <h1 class="text-4xl font-extrabold tracking-tight mb-4">Master Your Skills with Modern LMS</h1>
            <p class="text-lg text-purple-100 mb-8 max-w-xl text-balance">Join thousands of students learning new and futuristic skills with our easy-to-use platform from the world's best creators.</p>
            <div class="flex gap-4">
                <a href="<?= URL_ROOT ?>/courses" class="bg-white text-primary px-6 py-3 rounded-full font-semibold hover:bg-gray-50 transition transform hover:-translate-y-0.5 shadow-md">Browse Catalog</a>
                <a href="<?= URL_ROOT ?>/users/register" class="bg-purple-800 text-white px-6 py-3 rounded-full font-semibold border border-purple-600 hover:bg-purple-900 transition translate hover:-translate-y-0.5">Start Learning</a>
            </div>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition">
            <div>
                <p class="text-sm text-gray-500 font-medium">Active Students</p>
                <h3 class="text-2xl font-bold text-gray-800">10,000+</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition">
            <div>
                <p class="text-sm text-gray-500 font-medium">Expert Creators</p>
                <h3 class="text-2xl font-bold text-gray-800">500+</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-orange-50 text-orange-500 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition">
            <div>
                <p class="text-sm text-gray-500 font-medium">Premium Courses</p>
                <h3 class="text-2xl font-bold text-gray-800">1,200+</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-purple-50 text-primary flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition">
            <div>
                <p class="text-sm text-gray-500 font-medium">Certificates</p>
                <h3 class="text-2xl font-bold text-gray-800">5M+</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-green-50 text-success flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
            </div>
        </div>
    </div>
</div>

<style>
    .animate-fade-in {
        animation: fadeIn 0.5s ease-out forwards;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<?php require_once '../app/views/layouts/footer.php'; ?>
