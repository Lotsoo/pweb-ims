<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>New Transaction<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="<?= base_url('transactions') ?>" class="text-gray-500 hover:text-gray-700 flex items-center transition-colors">
            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Transactions
        </a>
    </div>

    <div class="glass-card shadow-lg rounded-xl overflow-hidden p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Record New Transaction</h2>

        <?php if(session()->has('errors')): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
                <ul>
                <?php foreach(session('errors') as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if(session()->has('error')): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
                <p><?= session('error') ?></p>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('transactions/store') ?>" method="post">
            <div class="mb-6">
                <label for="product_id" class="block text-gray-700 text-sm font-bold mb-2">Product</label>
                <select name="product_id" id="product_id" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all" required>
                    <option value="">Select Product</option>
                    <?php foreach($products as $product): ?>
                        <option value="<?= $product['id'] ?>" <?= old('product_id') == $product['id'] ? 'selected' : '' ?>>
                            <?= $product['name'] ?> (Stock: <?= $product['stock_quantity'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Transaction Type</label>
                <div class="flex space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio text-indigo-600 h-5 w-5" name="type" value="in" <?= old('type') == 'in' ? 'checked' : '' ?> required>
                        <span class="ml-2 text-gray-700">Stock In (Add)</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio text-red-600 h-5 w-5" name="type" value="out" <?= old('type') == 'out' ? 'checked' : '' ?> required>
                        <span class="ml-2 text-gray-700">Stock Out (Remove)</span>
                    </label>
                </div>
            </div>

            <div class="mb-6">
                <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity</label>
                <input type="number" min="1" name="quantity" id="quantity" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all" value="<?= old('quantity') ?>" required>
            </div>

            <div class="mb-8">
                <label for="notes" class="block text-gray-700 text-sm font-bold mb-2">Notes (Optional)</label>
                <textarea name="notes" id="notes" rows="3" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"><?= old('notes') ?></textarea>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-200 shadow-md">
                    Process Transaction
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
