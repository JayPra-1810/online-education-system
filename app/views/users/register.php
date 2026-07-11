<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-md mx-auto w-full">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Create an Account</h2>
            <p class="text-gray-500 mt-2">Join to learn or start teaching today.</p>
        </div>

        <form action="<?= URL_ROOT ?>/users/register" method="post" class="space-y-4">
            <input type="hidden" name="csrf_token" value="<?= Session::generateCsrfToken() ?>">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Account Type</label>
                <div class="flex gap-4">
                    <label class="flex-1 border border-gray-200 rounded-lg p-3 flex cursor-pointer hover:border-primary transition focus-within:ring-2 focus-within:ring-primary">
                        <input type="radio" name="role" value="student" class="sr-only peer" checked>
                        <div class="flex items-center space-x-2">
                            <div class="w-4 h-4 rounded-full border border-gray-300 peer-checked:border-[5px] peer-checked:border-primary transition-all"></div>
                            <span class="text-sm font-medium text-gray-900">Student</span>
                        </div>
                    </label>
                    <label class="flex-1 border border-gray-200 rounded-lg p-3 flex cursor-pointer hover:border-primary transition focus-within:ring-2 focus-within:ring-primary">
                        <input type="radio" name="role" value="creator" class="sr-only peer">
                        <div class="flex items-center space-x-2">
                            <div class="w-4 h-4 rounded-full border border-gray-300 peer-checked:border-[5px] peer-checked:border-primary transition-all"></div>
                            <span class="text-sm font-medium text-gray-900">Creator</span>
                        </div>
                    </label>
                </div>
            </div>
            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-2 border <?= (!empty($data['name_err'])) ? 'border-red-500' : 'border-gray-300' ?> rounded-lg focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none transition" value="<?= $data['name'] ?>">
                <span class="text-sm text-red-500 mt-1"><?= $data['name_err'] ?></span>
            </div>

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

            <div>
                <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="w-full px-4 py-2 border <?= (!empty($data['confirm_password_err'])) ? 'border-red-500' : 'border-gray-300' ?> rounded-lg focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none transition">
                <span class="text-sm text-red-500 mt-1"><?= $data['confirm_password_err'] ?></span>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-full shadow-sm text-sm font-medium text-white bg-primary hover:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition">
                    Create Account
                </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Already have an account? 
                <a href="<?= URL_ROOT ?>/users/login" class="font-medium text-primary hover:text-purple-700">Sign in</a>
            </p>
        </div>
    </div>
</div>

<style>
/* Custom radio button styles via Tailwind peer class */
input:checked + div > div {
    border-width: 5px;
    border-color: #6b21a8; /* primary */
}
</style>

<?php require_once '../app/views/layouts/footer.php'; ?>
