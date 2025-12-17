<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Products<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Products</h2>
    <a href="<?= base_url('products/create') ?>" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200 flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Add Product
    </a>
</div>

<?php if(session()->getFlashdata('success')):?>
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded shadow-sm" role="alert">
        <p><?= session()->getFlashdata('success') ?></p>
    </div>
<?php endif;?>

<?php if(session()->getFlashdata('error')):?>
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded shadow-sm" role="alert">
        <p><?= session()->getFlashdata('error') ?></p>
    </div>
<?php endif;?>

<div class="glass-card overflow-hidden shadow-lg rounded-xl">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50 bg-opacity-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                 <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <?php if($product['image']): ?>
                            <img src="<?= base_url('uploads/products/'.$product['image']) ?>" alt="<?= esc($product['name']) ?>" class="h-10 w-10 rounded-full object-cover">
                        <?php else: ?>
                            <span class="inline-block h-10 w-10 rounded-full overflow-hidden bg-gray-100">
                                <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= esc($product['sku']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900"><?= esc($product['name']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                            <?= esc($product['category_name']) ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <?php if($product['stock_quantity'] < 10): ?>
                             <span class="text-red-600 font-bold"><?= $product['stock_quantity'] ?></span>
                        <?php else: ?>
                             <?= $product['stock_quantity'] ?>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp <?= number_format($product['price'], 2, ',', '.') ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="<?= base_url('products/edit/'.$product['id']) ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                        <a href="<?= base_url('products/delete/'.$product['id']) ?>" onclick="return confirm('Are you sure you want to delete this product?')" class="text-red-600 hover:text-red-900">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">No products found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>
