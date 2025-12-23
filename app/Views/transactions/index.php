<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Inventory Transactions<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-foreground">Inventory Transactions</h2>
    <a href="<?= base_url('transactions/create') ?>" class="bg-primary hover:bg-primary/90 text-primary-foreground font-medium py-2 px-4 rounded-lg transition-colors flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
        New Transaction
    </a>
</div>

<?php if(session()->getFlashdata('success')):?>
    <div class="mb-6 px-4 py-3 bg-accent/10 border border-accent/20 text-accent rounded-lg flex items-center gap-2" role="alert">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif;?>

<div class="bg-card border border-border rounded-xl overflow-hidden shadow-sm">
    <table class="w-full">
        <thead class="bg-muted/50 border-b border-border">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Product</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Quantity</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">User</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Notes</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-muted-foreground uppercase tracking-wider">Actions</th>
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
                    <td class="px-6 py-4 text-sm text-muted-foreground">
                        <?= esc($transaction['notes']) ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="<?= base_url('transactions/edit/' . $transaction['id']) ?>" class="text-primary hover:text-primary/80 mr-3">Edit</a>
                        <a href="<?= base_url('transactions/delete/' . $transaction['id']) ?>" class="text-destructive hover:text-destructive/80" onclick="return confirm('Are you sure? This will adjust product stock accordingly.');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-sm text-muted-foreground">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-muted flex items-center justify-center">
                                <svg class="w-6 h-6 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <p>No transactions recorded yet.</p>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>
