<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Transaction Details<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="<?= base_url('transactions') ?>" class="text-muted-foreground hover:text-foreground flex items-center transition-colors">
            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Transactions
        </a>
    </div>

    <div class="bg-card border border-border rounded-xl overflow-hidden shadow-sm mb-6">
        <div class="px-6 py-4 border-b border-border flex justify-between items-center bg-muted/50">
            <h3 class="text-lg font-semibold text-foreground">Transaction #<?= $transaction['id'] ?></h3>
            <span class="text-sm text-muted-foreground"><?= date('M d, Y H:i', strtotime($transaction['created_at'])) ?></span>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm font-medium text-muted-foreground mb-1">User</p>
                <p class="text-foreground"><?= esc($transaction['username']) ?></p>
            </div>
            <div>
                <p class="text-sm font-medium text-muted-foreground mb-1">Type</p>
                <?php if ($transaction['type'] == 'in'): ?>
                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500/10 text-green-500">
                        Stock In (Incoming)
                    </span>
                <?php else: ?>
                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500/10 text-red-500">
                        Stock Out (Outgoing)
                    </span>
                <?php endif; ?>
            </div>
            <div class="col-span-1 md:col-span-2">
                <p class="text-sm font-medium text-muted-foreground mb-1">Notes</p>
                <p class="text-foreground"><?= esc($transaction['notes'] ?: '-') ?></p>
            </div>
        </div>
    </div>

    <div class="bg-card border border-border rounded-xl overflow-hidden shadow-sm">
        <div class="px-6 py-4 border-b border-border bg-muted/50">
            <h3 class="text-lg font-semibold text-foreground">Transaction Items</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-muted/50 border-b border-border">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">SKU</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Notes</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    <?php foreach($details as $detail): ?>
                    <tr class="hover:bg-muted/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <?php if($detail['product_image']): ?>
                                    <img src="<?= base_url('uploads/products/'.$detail['product_image']) ?>" alt="" class="h-8 w-8 rounded-full object-cover mr-3">
                                <?php else: ?>
                                    <div class="h-8 w-8 rounded-full bg-muted flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <span class="text-sm font-medium text-foreground"><?= esc($detail['product_name']) ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground">
                            <?= esc($detail['product_sku']) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-foreground">
                            <?= $detail['quantity'] ?>
                        </td>
                        <td class="px-6 py-4 text-sm text-muted-foreground">
                            <?= esc($detail['notes'] ?: '-') ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
