<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Reports<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Transaction Reports</h2>
</div>

<div class="glass-card p-6 rounded-xl shadow-lg mb-8">
    <form action="<?= base_url('reports') ?>" method="get" class="flex flex-col md:flex-row md:items-end gap-4">
        <div>
            <label for="start_date" class="block text-gray-700 text-sm font-bold mb-2">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all" value="<?= $start_date ?>" required>
        </div>
        <div>
            <label for="end_date" class="block text-gray-700 text-sm font-bold mb-2">End Date</label>
            <input type="date" name="end_date" id="end_date" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all" value="<?= $end_date ?>" required>
        </div>
        <div class="flex gap-4">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-200">
                Filter
            </button>
            <a href="<?= base_url('reports/exportPdf?start_date='.$start_date.'&end_date='.$end_date) ?>" target="_blank" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Export PDF
            </a>
        </div>
    </form>
</div>

<div class="glass-card overflow-hidden shadow-lg rounded-xl">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50 bg-opacity-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
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
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No transactions found for the selected period.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>
