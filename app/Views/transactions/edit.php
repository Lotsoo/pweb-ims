<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Edit Transaction<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="<?= base_url('transactions') ?>" class="text-muted-foreground hover:text-foreground flex items-center transition-colors">
            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Transactions
        </a>
    </div>

    <div class="bg-card border border-border rounded-xl overflow-hidden p-8 shadow-sm">
        <h2 class="text-2xl font-bold text-foreground mb-6">Edit Transaction</h2>

        <div class="bg-yellow-500/10 border border-yellow-500/20 p-4 mb-6 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-600 dark:text-yellow-400">
                        Warning: Editing this transaction will automatically adjust the stock quantity of the associated product(s).
                    </p>
                </div>
            </div>
        </div>

        <?php if(session()->has('errors')): ?>
            <div class="bg-destructive/10 border border-destructive/20 text-destructive p-4 mb-6 rounded-lg">
                <ul class="list-disc list-inside">
                <?php foreach(session('errors') as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if(session()->has('error')): ?>
            <div class="bg-destructive/10 border border-destructive/20 text-destructive p-4 mb-6 rounded-lg">
                <p><?= session('error') ?></p>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('transactions/update/' . $transaction['id']) ?>" method="post">
            <div class="mb-6">
                <label for="product_id" class="block text-foreground text-sm font-medium mb-2">Product</label>
                <select name="product_id" id="product_id" class="w-full bg-muted border border-transparent rounded-lg py-3 px-4 text-foreground focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all" required>
                    <option value="">Select Product</option>
                    <?php foreach($products as $product): ?>
                        <option value="<?= $product['id'] ?>" <?= (old('product_id', $transaction['product_id']) == $product['id']) ? 'selected' : '' ?>>
                            <?= $product['name'] ?> (Current Stock: <?= $product['stock_quantity'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-foreground text-sm font-medium mb-2">Transaction Type</label>
                <div class="flex space-x-4">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" class="form-radio text-primary h-5 w-5 border-border bg-muted" name="type" value="in" <?= (old('type', $transaction['type']) == 'in') ? 'checked' : '' ?> required>
                        <span class="ml-2 text-foreground">Stock In (Add)</span>
                    </label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" class="form-radio text-destructive h-5 w-5 border-border bg-muted" name="type" value="out" <?= (old('type', $transaction['type']) == 'out') ? 'checked' : '' ?> required>
                        <span class="ml-2 text-foreground">Stock Out (Remove)</span>
                    </label>
                </div>
            </div>

            <div class="mb-6">
                <label for="quantity" class="block text-foreground text-sm font-medium mb-2">Quantity</label>
                <input type="number" min="1" name="quantity" id="quantity" class="w-full bg-muted border border-transparent rounded-lg py-3 px-4 text-foreground focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all" value="<?= old('quantity', $transaction['quantity']) ?>" required>
            </div>

            <div class="mb-8">
                <label for="notes" class="block text-foreground text-sm font-medium mb-2">Notes (Optional)</label>
                <textarea name="notes" id="notes" rows="3" class="w-full bg-muted border border-transparent rounded-lg py-3 px-4 text-foreground focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all"><?= old('notes', $transaction['notes']) ?></textarea>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-primary hover:bg-primary/90 text-primary-foreground font-medium py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/50 transition-colors shadow-sm">
                    Update Transaction
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
