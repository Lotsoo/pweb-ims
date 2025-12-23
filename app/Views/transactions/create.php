<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>New Transaction<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="<?= base_url('transactions') ?>" class="text-muted-foreground hover:text-foreground flex items-center transition-colors">
            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Transactions
        </a>
    </div>

    <div class="bg-card border border-border rounded-xl overflow-hidden p-8 shadow-sm">
        <h2 class="text-2xl font-bold text-foreground mb-6">Record New Transaction</h2>

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

        <form action="<?= base_url('transactions/store') ?>" method="post">
            <div class="mb-6">
                <label for="product_id" class="block text-foreground text-sm font-medium mb-2">Product</label>
                <select name="product_id" id="product_id" class="w-full bg-muted border border-transparent rounded-lg py-3 px-4 text-foreground focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all" required>
                    <option value="">Select Product</option>
                    <?php foreach($products as $product): ?>
                        <option value="<?= $product['id'] ?>" <?= old('product_id') == $product['id'] ? 'selected' : '' ?>>
                            <?= $product['name'] ?> (Stock: <?= $product['stock_quantity'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-foreground text-sm font-medium mb-2">Transaction Type</label>
                <div class="flex space-x-4">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" class="form-radio text-primary h-5 w-5 border-border bg-muted" name="type" value="in" <?= old('type') == 'in' ? 'checked' : '' ?> required>
                        <span class="ml-2 text-foreground">Stock In (Add)</span>
                    </label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" class="form-radio text-destructive h-5 w-5 border-border bg-muted" name="type" value="out" <?= old('type') == 'out' ? 'checked' : '' ?> required>
                        <span class="ml-2 text-foreground">Stock Out (Remove)</span>
                    </label>
                </div>
            </div>

            <div class="mb-6">
                <label for="quantity" class="block text-foreground text-sm font-medium mb-2">Quantity</label>
                <input type="number" min="1" name="quantity" id="quantity" class="w-full bg-muted border border-transparent rounded-lg py-3 px-4 text-foreground focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all" value="<?= old('quantity') ?>" required>
            </div>

            <div class="mb-8">
                <label for="notes" class="block text-foreground text-sm font-medium mb-2">Notes (Optional)</label>
                <textarea name="notes" id="notes" rows="3" class="w-full bg-muted border border-transparent rounded-lg py-3 px-4 text-foreground focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all"><?= old('notes') ?></textarea>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-primary hover:bg-primary/90 text-primary-foreground font-medium py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/50 transition-colors shadow-sm">
                    Process Transaction
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
