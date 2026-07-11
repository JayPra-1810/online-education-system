<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 animate-fade-in">
        <div class="md:flex">
            <!-- Order Summary Left -->
            <div class="md:w-1/2 bg-gray-50 p-8 border-r border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-8 flex items-center gap-2">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 118 0m-4 4v2m0 0a2 2 0 100-4 2 2 0 000 4zm-8 2a2 2 0 11-4 0 2 2 0 014 0zm0 0h10"></path></svg>
                    Order Summary
                </h2>
                
                <div class="flex items-start gap-4 mb-8">
                    <div class="w-24 h-16 bg-gray-200 rounded-xl overflow-hidden shadow-sm flex-shrink-0">
                        <?php if($data['course']->thumbnail): ?>
                            <img src="<?= (filter_var($data['course']->thumbnail, FILTER_VALIDATE_URL)) ? $data['course']->thumbnail : URL_ROOT . '/uploads/' . $data['course']->thumbnail ?>" alt="" class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full bg-gradient-to-tr from-purple-400 to-indigo-500"></div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 leading-tight"><?= $data['course']->title ?></h4>
                        <p class="text-xs text-gray-500 mt-1"><?= ucfirst($data['course']->category) ?> &bull; Instructor: <?= $data['course']->creator_name ?></p>
                    </div>
                </div>

                <div class="space-y-3 mb-8">
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Course Price</span>
                        <span class="font-medium">$<?= number_format($data['course']->price, 2) ?></span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Platform Fee</span>
                        <span class="font-medium text-success">Free</span>
                    </div>
                    <div class="pt-4 border-t border-gray-200 flex justify-between items-center text-lg font-bold text-gray-900">
                        <span>Total</span>
                        <span class="text-primary">$<?= number_format($data['course']->price, 2) ?></span>
                    </div>
                </div>

                <div class="bg-indigo-50 rounded-xl p-4 border border-indigo-100">
                    <p class="text-xs text-indigo-700 flex gap-2">
                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        This is a secure demo payment gateway. No real money will be charged from your account.
                    </p>
                </div>
            </div>

            <!-- Payment Form Right -->
            <div class="md:w-1/2 p-8" x-data="{ cardName: '', cardNumber: '', cardExpiry: '', cardCvc: '', loading: false }">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Demo Payment</h2>
                
                <form action="<?= URL_ROOT ?>/enrollments/processPayment" method="post" @submit="loading = true">
                    <input type="hidden" name="course_id" value="<?= $data['course']->id ?>">
                    
                    <div class="space-y-5">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Cardholder Name</label>
                            <input type="text" x-model="cardName" placeholder="John Doe" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-gray-700 font-medium" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Card Number</label>
                            <div class="relative">
                                <input type="text" x-model="cardNumber" placeholder="4242 4242 4242 4242" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-gray-700 font-medium" required>
                                <div class="absolute right-4 top-3 text-gray-400">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M1 4h22v16H1V4zm2 2v12h18V6H3zm12 9h4v2h-4v-2zm-6 0h4v2H9v-2z"></path></svg>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Expiry Date</label>
                                <input type="text" x-model="cardExpiry" placeholder="MM / YY" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-gray-700 font-medium" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">CVC</label>
                                <input type="text" x-model="cardCvc" placeholder="123" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-gray-700 font-medium" required>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit" 
                                class="w-full bg-primary hover:bg-purple-800 text-white font-bold py-4 px-4 rounded-2xl shadow-lg shadow-purple-200 transition flex justify-center items-center gap-2 relative overflow-hidden"
                                :disabled="loading"
                            >
                                <span x-show="!loading" class="flex items-center gap-2">
                                    Complete Purchase &rarr;
                                </span>
                                <span x-show="loading" class="flex items-center gap-2">
                                    <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    Processing...
                                </span>
                            </button>
                        </div>
                        
                        <div class="flex items-center justify-center gap-6 opacity-40 grayscale mt-6">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/2560px-Visa_Inc._logo.svg.png" class="h-4 w-auto" alt="Visa">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/1280px-Mastercard-logo.svg.png" class="h-6 w-auto" alt="Mastercard">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/PayPal.svg/1200px-PayPal.svg.png" class="h-4 w-auto" alt="Paypal">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="mt-8 text-center">
        <a href="<?= URL_ROOT ?>/courses/show/<?= $data['course']->id ?>" class="text-sm font-medium text-gray-500 hover:text-gray-700 transition flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Back to course
        </a>
    </div>
</div>

<style>
    .animate-fade-in {
        animation: fadeIn 0.4s ease-out forwards;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<?php require_once '../app/views/layouts/footer.php'; ?>
