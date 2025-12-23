<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Reports<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="mb-6">
    <h2 class="text-2xl font-bold text-foreground">Transaction Reports</h2>
</div>

<div class="bg-card border border-border rounded-xl p-6 shadow-sm mb-8">
    <form action="<?= base_url('reports') ?>" method="get" class="flex flex-col md:flex-row md:items-end gap-4">
        <div>
            <label for="start_date" class="block text-foreground text-sm font-medium mb-2">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="w-full bg-muted border border-transparent rounded-lg py-2 px-3 text-foreground focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all" value="<?= $start_date ?>" required>
        </div>
        <div>
            <label for="end_date" class="block text-foreground text-sm font-medium mb-2">End Date</label>
            <input type="date" name="end_date" id="end_date" class="w-full bg-muted border border-transparent rounded-lg py-2 px-3 text-foreground focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all" value="<?= $end_date ?>" required>
        </div>
        <div class="flex gap-4">
            <button type="submit" class="bg-primary hover:bg-primary/90 text-primary-foreground font-medium py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/50 transition-colors">
                Filter
            </button>
            <a href="<?= base_url('reports/exportPdf?start_date='.$start_date.'&end_date='.$end_date) ?>" target="_blank" class="bg-destructive hover:bg-destructive/90 text-destructive-foreground font-medium py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-destructive/50 transition-colors flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Export PDF
            </a>
        </div>
    </form>
</div>

<div class="bg-card border border-border rounded-xl overflow-hidden shadow-sm">
    <table class="w-full">
        <thead class="bg-muted/50 border-b border-border">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Product</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Quantity</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">User</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-border">
            <?php if (!empty($transactions)): ?>
                <?php foreach ($transactions as $transaction): ?>
                <tr class="hover:bg-muted/50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground">
                        <?= date('M d, Y H:i', strtotime($transaction['created_at'])) ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-foreground">
                        <?= esc($transaction['product_name']) ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <?php if ($transaction['type'] == 'in'): ?>
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500/10 text-green-500">
                                IN
                            </span>
                        <?php else: ?>
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500/10 text-red-500">
                                OUT
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground font-medium">
                        <?= $transaction['quantity'] ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground">
                        <?= esc($transaction['username']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-sm text-muted-foreground">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-muted flex items-center justify-center">
                                <svg class="w-6 h-6 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <p>No transactions found for the selected period.</p>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>
