<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Inventory Transactions<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Inventory Transactions</h2>
    <a href="<?= base_url('transactions/create') ?>" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200 flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
        New Transaction
    </a>
</div>

<?php if(session()->getFlashdata('success')):?>
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded shadow-sm" role="alert">
        <p><?= session()->getFlashdata('success') ?></p>
    </div>
<?php endif;?>

<div class="glass-card overflow-hidden shadow-lg rounded-xl">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50 bg-opacity-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notes</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <?php if (!empty($transactions)): ?>
                <?php foreach ($transactions as $transaction): ?>
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <?= date('M d, Y H:i', strtotime($transaction['created_at'])) ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                        <?= esc($transaction['product_name']) ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <?php if ($transaction['type'] == 'in'): ?>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                IN
                            </span>
                        <?php else: ?>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                OUT
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">
                        <?= $transaction['quantity'] ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <?= esc($transaction['username']) ?>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        <?= esc($transaction['notes']) ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="<?= base_url('transactions/edit/' . $transaction['id']) ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                        <a href="<?= base_url('transactions/delete/' . $transaction['id']) ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure? This will adjust product stock accordingly.');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">No transactions recorded yet.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>
