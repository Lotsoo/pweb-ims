<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Edit Produk<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Edit Produk<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Back Button -->
<div class="mb-6">
    <a href="<?= base_url('products') ?>" class="inline-flex items-center gap-2 text-muted-foreground hover:text-foreground transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali ke Produk
    </a>
</div>

<!-- Form Card -->
<div class="max-w-2xl">
    <div class="bg-card border border-border rounded-xl p-6">
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-foreground">Edit Produk</h2>
            <p class="text-sm text-muted-foreground mt-1">Perbarui informasi produk di bawah ini</p>
        </div>

        <?php if(session()->has('errors')): ?>
            <div class="mb-6 px-4 py-3 bg-destructive/10 border border-destructive/20 rounded-lg">
                <div class="flex items-center gap-2 text-destructive mb-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-medium">Terjadi kesalahan</span>
                </div>
                <ul class="list-disc list-inside text-sm text-destructive/80">
                    <?php foreach(session('errors') as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('products/update/'.$product['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="space-y-5">
                <!-- Product Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-foreground mb-2">Nama Produk <span class="text-destructive">*</span></label>
                    <input type="text" name="name" id="name" value="<?= old('name', $product['name']) ?>" required
                        class="w-full px-4 py-2.5 bg-background border border-border rounded-lg text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors"
                        placeholder="Masukkan nama produk">
                </div>

                <!-- SKU & Category -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="sku" class="block text-sm font-medium text-foreground mb-2">SKU <span class="text-destructive">*</span></label>
                        <input type="text" name="sku" id="sku" value="<?= old('sku', $product['sku']) ?>" required
                            class="w-full px-4 py-2.5 bg-background border border-border rounded-lg text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors"
                            placeholder="Contoh: SKU-001">
                    </div>
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-foreground mb-2">Kategori <span class="text-destructive">*</span></label>
                        <select name="category_id" id="category_id" required
                            class="w-full px-4 py-2.5 bg-background border border-border rounded-lg text-foreground focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors">
                            <option value="">Pilih Kategori</option>
                            <?php foreach($categories as $category): ?>
                                <option value="<?= $category['id'] ?>" <?= old('category_id', $product['category_id']) == $category['id'] ? 'selected' : '' ?>><?= $category['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-foreground mb-2">Harga <span class="text-destructive">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-muted-foreground text-sm">Rp</span>
                        </div>
                        <input type="number" step="1" name="price" id="price" value="<?= old('price', $product['price']) ?>" required
                            class="w-full pl-12 pr-4 py-2.5 bg-background border border-border rounded-lg text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-colors"
                            placeholder="0">
                    </div>
                </div>

                <!-- Image Upload -->
                <div>
                    <label for="image" class="block text-sm font-medium text-foreground mb-2">Gambar Produk</label>
                    
                    <!-- Current Image -->
                    <?php if($product['image']): ?>
                        <div class="mb-3 p-3 bg-muted/50 rounded-lg border border-border">
                            <p class="text-xs text-muted-foreground mb-2">Gambar saat ini:</p>
                            <div class="flex items-center gap-3">
                                <img src="<?= base_url('uploads/products/'.$product['image']) ?>" alt="Current Image" class="h-16 w-16 object-cover rounded-lg border border-border">
                                <div class="text-sm text-muted-foreground">
                                    <p><?= $product['image'] ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="relative">
                        <input type="file" name="image" id="image" accept="image/*"
                            class="w-full px-4 py-2.5 bg-background border border-border rounded-lg text-foreground file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition-colors cursor-pointer">
                    </div>
                    <p class="mt-1.5 text-xs text-muted-foreground">Kosongkan jika tidak ingin mengubah gambar. Format: JPG, PNG, GIF. Maksimal 2MB</p>
                    
                    <!-- New Image Preview -->
                    <div id="imagePreview" class="mt-3 hidden">
                        <p class="text-xs text-muted-foreground mb-2">Preview gambar baru:</p>
                        <img id="previewImg" src="/placeholder.svg" alt="Preview" class="h-32 w-32 object-cover rounded-lg border border-border">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-border">
                <a href="<?= base_url('products') ?>" class="px-4 py-2.5 text-sm font-medium text-muted-foreground hover:text-foreground hover:bg-muted rounded-lg transition-colors">Batal</a>
                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary hover:bg-primary/90 text-primary-foreground text-sm font-medium rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Perbarui Produk
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Image preview
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('imagePreview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
});
</script>

<?= $this->endSection() ?>
