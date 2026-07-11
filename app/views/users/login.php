<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-md mx-auto w-full">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Welcome Back</h2>
            <p class="text-gray-500 mt-2">Log in to continue your learning journey.</p>
        </div>

        <?php Session::flash('register_success'); ?>
        <?php Session::flash('auth_error'); ?>

        <form action="<?= URL_ROOT ?>/users/login" method="post" class="space-y-6">
            <input type="hidden" name="csrf_token" value="<?= Session::generateCsrfToken() ?>">
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 border <?= (!empty($data['email_err'])) ? 'border-red-500' : 'border-gray-300' ?> rounded-lg focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none transition" value="<?= $data['email'] ?>">
                <span class="text-sm text-red-500 mt-1"><?= $data['email_err'] ?></span>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2 border <?= (!empty($data['password_err'])) ? 'border-red-500' : 'border-gray-300' ?> rounded-lg focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none transition">
                <span class="text-sm text-red-500 mt-1"><?= $data['password_err'] ?></span>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                    <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                        Remember me
                    </label>
                </div>

                <div class="text-sm">
                    <a href="#" class="font-medium text-primary hover:text-purple-700">
                        Forgot your password?
                    </a>
                </div>
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-full shadow-sm text-sm font-medium text-white bg-primary hover:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition">
                    Sign in
                </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Don't have an account? 
                <a href="<?= URL_ROOT ?>/users/register" class="font-medium text-primary hover:text-purple-700">Sign up</a>
            </p>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
