<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Edit Category<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="<?= base_url('categories') ?>" class="text-gray-500 hover:text-gray-700 flex items-center transition-colors">
            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Categories
        </a>
    </div>

    <div class="glass-card shadow-lg rounded-xl overflow-hidden p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Category</h2>

        <?php if(session()->has('errors')): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
                <ul>
                <?php foreach(session('errors') as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('categories/update/'.$category['id']) ?>" method="post">
            <div class="mb-6">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Category Name</label>
                <input type="text" name="name" id="name" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all" value="<?= old('name', $category['name']) ?>" required>
            </div>
            
            <div class="mb-8">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                <textarea name="description" id="description" rows="4" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"><?= old('description', $category['description']) ?></textarea>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-200 shadow-md">
                    Update Category
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
