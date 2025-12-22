<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Detail Produk<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Detail Produk<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Added back button consistent with other pages -->
<div class="mb-6">
    <a href="<?= base_url('products') ?>" class="inline-flex items-center gap-2 text-muted-foreground hover:text-foreground transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali ke Produk
    </a>
</div>

<!-- Updated card styling to use CSS variables -->
<div class="bg-card rounded-xl border border-border overflow-hidden">
    <div class="p-6">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Product Image -->
            <div class="w-full md:w-1/3">
                <!-- Updated background and border colors -->
                <div class="aspect-square bg-muted rounded-lg overflow-hidden relative border border-border">
                    <?php if(!empty($product['image'])): ?>
                        <img src="<?= base_url('uploads/products/' . $product['image']) ?>" 
                             alt="<?= $product['name'] ?>" 
                             class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="flex items-center justify-center w-full h-full text-muted-foreground">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Product Details -->
            <div class="w-full md:w-2/3 space-y-6">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <!-- Updated badge colors -->
                        <span class="px-3 py-1 bg-primary/10 text-primary text-sm font-medium rounded-full">
                            <?= $product['category_name'] ?? 'Uncategorized' ?>
                        </span>
                        <?php if(($product['stock_quantity'] ?? 0) <= 10): ?>
                            <span class="px-3 py-1 bg-destructive/10 text-destructive text-sm font-medium rounded-full">
                                Stok Rendah
                            </span>
                        <?php endif; ?>
                    </div>
                    <!-- Updated text colors -->
                    <h1 class="text-3xl font-bold text-foreground mb-2"><?= $product['name'] ?></h1>
                    <p class="text-muted-foreground text-lg">SKU: <?= $product['sku'] ?></p>
                </div>

                <!-- Updated info card styling -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 bg-muted/50 rounded-lg border border-border">
                    <div>
                        <p class="text-sm text-muted-foreground mb-1">Harga Satuan</p>
                        <p class="text-2xl font-bold text-primary">Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-muted-foreground mb-1">Stok Tersedia</p>
                        <p class="text-2xl font-bold text-foreground"><?= $product['stock_quantity'] ?? 0 ?> <span class="text-base font-normal text-muted-foreground">Unit</span></p>
                    </div>
                </div>

                <!-- Additional Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Updated date cards styling -->
                    <div class="p-4 bg-muted/30 rounded-lg border border-border">
                        <p class="text-sm text-muted-foreground mb-1">Dibuat pada</p>
                        <p class="text-foreground font-medium"><?= date('d M Y, H:i', strtotime($product['created_at'] ?? 'now')) ?></p>
                    </div>
                    <div class="p-4 bg-muted/30 rounded-lg border border-border">
                        <p class="text-sm text-muted-foreground mb-1">Terakhir diupdate</p>
                        <p class="text-foreground font-medium"><?= date('d M Y, H:i', strtotime($product['updated_at'] ?? 'now')) ?></p>
                    </div>
                </div>

                <!-- Updated action buttons styling -->
                <div class="flex flex-wrap gap-3 pt-4 border-t border-border">
                    <a href="<?= base_url('products/edit/' . $product['id']) ?>" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary hover:bg-primary/90 text-primary-foreground text-sm font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Produk
                    </a>
                    <button onclick="confirmDelete(<?= $product['id'] ?>)" class="inline-flex items-center gap-2 px-5 py-2.5 bg-destructive/10 hover:bg-destructive/20 text-destructive text-sm font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Updated modal styling -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-card rounded-xl border border-border p-6 max-w-md w-full mx-4">
        <div class="text-center">
            <div class="w-16 h-16 bg-destructive/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-destructive" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-foreground mb-2">Hapus Produk?</h3>
            <p class="text-muted-foreground mb-6">Apakah Anda yakin ingin menghapus produk <strong class="text-foreground"><?= $product['name'] ?></strong>? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex gap-3 justify-center">
                <button onclick="closeDeleteModal()" class="px-5 py-2.5 text-sm font-medium text-muted-foreground hover:text-foreground hover:bg-muted rounded-lg transition-colors">
                    Batal
                </button>
                <form id="deleteForm" action="" method="POST" class="inline">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="px-5 py-2.5 bg-destructive hover:bg-destructive/90 text-destructive-foreground text-sm font-medium rounded-lg transition-colors">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id) {
    document.getElementById('deleteForm').action = '<?= base_url('products/delete/') ?>' + id;
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
}

document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});
</script>
<?= $this->endSection() ?>
