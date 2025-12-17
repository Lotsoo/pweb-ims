<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Edit Product<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <a href="<?= base_url('products') ?>" class="text-gray-500 hover:text-gray-700 flex items-center transition-colors">
            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Products
        </a>
    </div>

    <div class="glass-card shadow-lg rounded-xl overflow-hidden p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Product</h2>

        <?php if(session()->has('errors')): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
                <ul>
                <?php foreach(session('errors') as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('products/update/'.$product['id']) ?>" method="post" enctype="multipart/form-data">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="md:col-span-2">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Product Name</label>
                    <input type="text" name="name" id="name" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all" value="<?= old('name', $product['name']) ?>" required>
                </div>

                <div>
                    <label for="sku" class="block text-gray-700 text-sm font-bold mb-2">SKU</label>
                    <input type="text" name="sku" id="sku" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all" value="<?= old('sku', $product['sku']) ?>" required>
                </div>

                <div>
                    <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                    <select name="category_id" id="category_id" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all" required>
                        <option value="">Select Category</option>
                        <?php foreach($categories as $category): ?>
                            <option value="<?= $category['id'] ?>" <?= old('category_id', $product['category_id']) == $category['id'] ? 'selected' : '' ?>><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">Rp</span>
                        </div>
                        <input type="number" step="0.01" name="price" id="price" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 pl-12 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all" value="<?= old('price', $product['price']) ?>" required>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Product Image (Leave blank to keep current)</label>
                    <input type="file" name="image" id="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-colors" accept="image/*">
                    <?php if($product['image']): ?>
                        <div class="mt-2">
                             <p class="text-sm text-gray-500 mb-1">Current Image:</p>
                             <img src="<?= base_url('uploads/products/'.$product['image']) ?>" alt="Current Image" class="h-20 w-20 object-cover rounded-lg border border-gray-200">
                        </div>
                    <?php endif; ?>
                </div>

            </div>

            <div class="flex items-center justify-end mt-8">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-200 shadow-md">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
