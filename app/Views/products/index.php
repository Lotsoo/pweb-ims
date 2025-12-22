<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Produk<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Produk<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Header Actions -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div class="flex items-center gap-3">
        <div class="relative">
            <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" id="searchInput" placeholder="Cari produk..." class="w-72 pl-9 pr-4 py-2 bg-card border border-border rounded-lg text-sm text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary">
        </div>
        <select id="categoryFilter" class="bg-card border border-border rounded-lg px-3 py-2 text-sm text-foreground focus:outline-none focus:ring-2 focus:ring-primary/50">
            <option value="">Semua Kategori</option>
            <?php foreach($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <a href="<?= base_url('products/create') ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-primary hover:bg-primary/90 text-primary-foreground text-sm font-medium rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Produk
    </a>
</div>

<!-- Flash Messages -->
<?php if(session()->getFlashdata('success')): ?>
    <div class="mb-6 px-4 py-3 bg-accent/10 border border-accent/20 text-accent rounded-lg flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
    <div class="mb-6 px-4 py-3 bg-destructive/10 border border-destructive/20 text-destructive rounded-lg flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<!-- Products Table -->
<div class="bg-card border border-border rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-border bg-muted/50">
                    <th class="text-left px-5 py-3 text-xs font-medium text-muted-foreground uppercase tracking-wider">Produk</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-muted-foreground uppercase tracking-wider">SKU</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-muted-foreground uppercase tracking-wider">Kategori</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-muted-foreground uppercase tracking-wider">Stok</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-muted-foreground uppercase tracking-wider">Harga</th>
                    <th class="text-left px-5 py-3 text-xs font-medium text-muted-foreground uppercase tracking-wider">Status</th>
                    <th class="text-right px-5 py-3 text-xs font-medium text-muted-foreground uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                <?php if(empty($products)): ?>
                    <tr>
                        <td colspan="7" class="px-5 py-12 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-muted flex items-center justify-center">
                                    <svg class="w-6 h-6 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                </div>
                                <p class="text-muted-foreground">Belum ada produk</p>
                                <a href="<?= base_url('products/create') ?>" class="text-primary hover:underline text-sm">Tambah produk pertama</a>
                            </div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach($products as $product): ?>
                        <tr class="hover:bg-muted/30 transition-colors">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <?php if($product['image']): ?>
                                        <img src="<?= base_url('uploads/products/'.$product['image']) ?>" alt="<?= $product['name'] ?>" class="w-10 h-10 rounded-lg object-cover">
                                    <?php else: ?>
                                        <div class="w-10 h-10 rounded-lg bg-muted flex items-center justify-center">
                                            <svg class="w-5 h-5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                    <div>
                                        <p class="text-sm font-medium text-foreground"><?= $product['name'] ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-sm text-muted-foreground font-mono"><?= $product['sku'] ?></td>
                            <td class="px-5 py-4">
                                <span class="px-2 py-1 bg-primary/10 text-primary text-xs font-medium rounded-md"><?= $product['category_name'] ?? 'Uncategorized' ?></span>
                            </td>
                            <td class="px-5 py-4 text-sm <?= $product['stock_quantity'] <= 10 ? 'text-destructive' : 'text-foreground' ?> font-medium"><?= $product['stock_quantity'] ?? 0 ?></td>
                            <td class="px-5 py-4 text-sm text-foreground">Rp <?= number_format($product['price'], 0, ',', '.') ?></td>
                            <td class="px-5 py-4">
                                <?php if(($product['stock_quantity'] ?? 0) <= 10): ?>
                                    <span class="px-2 py-1 bg-destructive/10 text-destructive text-xs font-medium rounded-full">Stok Rendah</span>
                                <?php else: ?>
                                    <span class="px-2 py-1 bg-accent/10 text-accent text-xs font-medium rounded-full">Tersedia</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="<?= base_url('products/show/'.$product['id']) ?>" class="p-2 rounded-lg hover:bg-muted text-muted-foreground hover:text-foreground transition-colors" title="Lihat">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a href="<?= base_url('products/edit/'.$product['id']) ?>" class="p-2 rounded-lg hover:bg-muted text-muted-foreground hover:text-foreground transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <button onclick="confirmDelete(<?= $product['id'] ?>, '<?= addslashes($product['name']) ?>')" class="p-2 rounded-lg hover:bg-destructive/10 text-muted-foreground hover:text-destructive transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <?php if(!empty($pager)): ?>
    <div class="px-5 py-4 border-t border-border flex items-center justify-between">
        <p class="text-sm text-muted-foreground">
            Menampilkan <?= ($pager['currentPage'] - 1) * $pager['perPage'] + 1 ?>-<?= min($pager['currentPage'] * $pager['perPage'], $pager['total']) ?> dari <?= $pager['total'] ?> produk
        </p>
        <div class="flex items-center gap-1">
            <?php if($pager['currentPage'] > 1): ?>
                <a href="?page=<?= $pager['currentPage'] - 1 ?>" class="px-3 py-1.5 text-sm text-muted-foreground hover:text-foreground hover:bg-muted rounded-lg transition-colors">Sebelumnya</a>
            <?php endif; ?>
            
            <?php for($i = 1; $i <= $pager['pageCount']; $i++): ?>
                <?php if($i == $pager['currentPage']): ?>
                    <span class="px-3 py-1.5 text-sm bg-primary text-primary-foreground rounded-lg"><?= $i ?></span>
                <?php else: ?>
                    <a href="?page=<?= $i ?>" class="px-3 py-1.5 text-sm text-muted-foreground hover:text-foreground hover:bg-muted rounded-lg transition-colors"><?= $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>
            
            <?php if($pager['currentPage'] < $pager['pageCount']): ?>
                <a href="?page=<?= $pager['currentPage'] + 1 ?>" class="px-3 py-1.5 text-sm text-muted-foreground hover:text-foreground hover:bg-muted rounded-lg transition-colors">Selanjutnya</a>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center">
    <div class="bg-card border border-border rounded-xl p-6 w-full max-w-md mx-4">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-full bg-destructive/10 flex items-center justify-center">
                <svg class="w-5 h-5 text-destructive" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-foreground">Hapus Produk</h3>
                <p class="text-sm text-muted-foreground">Tindakan ini tidak dapat dibatalkan</p>
            </div>
        </div>
        <p class="text-foreground mb-6">Apakah Anda yakin ingin menghapus <span id="deleteProductName" class="font-semibold"></span>?</p>
        <div class="flex items-center justify-end gap-3">
            <button onclick="closeDeleteModal()" class="px-4 py-2 text-sm font-medium text-muted-foreground hover:text-foreground hover:bg-muted rounded-lg transition-colors">Batal</button>
            <form id="deleteForm" method="post" class="inline">
                <button type="submit" class="px-4 py-2 text-sm font-medium bg-destructive hover:bg-destructive/90 text-white rounded-lg transition-colors">Hapus</button>
            </form>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, name) {
    document.getElementById('deleteProductName').textContent = name;
    document.getElementById('deleteForm').action = '<?= base_url('products/delete/') ?>' + id;
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
}

// Close modal on backdrop click
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
});

// Search functionality
document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});
</script>

<?= $this->endSection() ?>
