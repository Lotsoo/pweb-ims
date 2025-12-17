<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Categories<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Categories</h2>
    <a href="<?= base_url('categories/create') ?>" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200 flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Add Category
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
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $index => $category): ?>
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $index + 1 ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900"><?= esc($category['name']) ?></td>
                    <td class="px-6 py-4 text-sm text-gray-500"><?= esc($category['description']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="<?= base_url('categories/edit/'.$category['id']) ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                        <a href="<?= base_url('categories/delete/'.$category['id']) ?>" onclick="return confirm('Are you sure you want to delete this category?')" class="text-red-600 hover:text-red-900">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No categories found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>
