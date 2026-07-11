<?php 
ob_start();
?>
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900 font-primary">Transactions & Payments</h1>
</div>

<?php Session::flash('admin_message'); ?>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Method</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (empty($data['payments'])): ?>
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">No transactions found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach($data['payments'] as $payment): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-mono">
                                <?= $payment->transaction_id ?: 'N/A' ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= date('M j, Y H:i', strtotime($payment->created_at)) ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($payment->user_name) ?></div>
                                        <div class="text-xs text-gray-500"><?= htmlspecialchars($payment->user_email) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 max-w-xs truncate" title="<?= htmlspecialchars($payment->course_title) ?>">
                                    <?= htmlspecialchars($payment->course_title) ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                $<?= number_format($payment->amount, 2) ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                <?= htmlspecialchars($payment->payment_method) ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php
                                $statusClass = 'bg-gray-100 text-gray-800';
                                if ($payment->status == 'completed') $statusClass = 'bg-green-100 text-green-800';
                                if ($payment->status == 'pending') $statusClass = 'bg-yellow-100 text-yellow-800';
                                if ($payment->status == 'failed') $statusClass = 'bg-red-100 text-red-800';
                                if ($payment->status == 'refunded') $statusClass = 'bg-blue-100 text-blue-800';
                                ?>
                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full <?= $statusClass ?>">
                                    <?= ucfirst($payment->status) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php 
$admin_content = ob_get_clean();
require_once '../app/views/layouts/admin_layout.php';
?>
