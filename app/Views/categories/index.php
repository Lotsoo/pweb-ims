<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Categories<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <div>
        <h2 class="text-2xl font-bold text-foreground">Categories</h2>
        <p class="text-muted-foreground text-sm mt-1">Manage product categories</p>
    </div>
    <a href="<?= base_url('categories/create') ?>" class="bg-primary hover:bg-primary/90 text-primary-foreground font-medium py-2.5 px-4 rounded-lg transition duration-200 flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Add Category
    </a>
</div>

<?php if(session()->getFlashdata('success')): ?>
    <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 p-4 mb-6 rounded-lg flex items-center" role="alert">
        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <p><?= session()->getFlashdata('success') ?></p>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
    <div class="bg-red-500/10 border border-red-500/20 text-red-400 p-4 mb-6 rounded-lg flex items-center" role="alert">
        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <p><?= session()->getFlashdata('error') ?></p>
    </div>
<?php endif; ?>

<div class="bg-card border border-border rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-border">
            <thead class="bg-muted/50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider w-16">#</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">Name</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">Description</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold text-muted-foreground uppercase tracking-wider w-32">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border">
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $index => $category): ?>
                    <tr class="hover:bg-muted/30 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground"><?= $index + 1 ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-semibold text-foreground"><?= esc($category['name']) ?></span>
                        </td>
                        <td class="px-6 py-4 text-sm text-muted-foreground max-w-md truncate"><?= esc($category['description']) ?: '-' ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <div class="flex items-center justify-end gap-1">
                                <a href="<?= base_url('categories/edit/'.$category['id']) ?>" class="p-2 text-muted-foreground hover:text-foreground hover:bg-muted rounded-lg transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <button onclick="openDeleteModal(<?= $category['id'] ?>, '<?= esc($category['name']) ?>')" class="p-2 text-muted-foreground hover:text-red-400 hover:bg-red-500/10 rounded-lg transition-colors" title="Delete">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <svg class="w-12 h-12 mx-auto text-muted-foreground/50 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                            <p class="text-muted-foreground">No categories found.</p>
                            <a href="<?= base_url('categories/create') ?>" class="text-primary hover:underline text-sm mt-2 inline-block">Add your first category</a>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center">
    <div class="bg-card border border-border rounded-xl p-6 max-w-md w-full mx-4 shadow-xl">
        <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-500/10 rounded-full mb-4">
            <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>
        <h3 class="text-lg font-semibold text-foreground text-center mb-2">Delete Category</h3>
        <p class="text-muted-foreground text-center mb-6">Are you sure you want to delete "<span id="categoryName" class="text-foreground font-medium"></span>"? This action cannot be undone.</p>
        <div class="flex gap-3">
            <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2.5 bg-muted hover:bg-muted/80 text-foreground rounded-lg font-medium transition-colors">Cancel</button>
            <a id="deleteLink" href="#" class="flex-1 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-lg font-medium transition-colors text-center">Delete</a>
        </div>
    </div>
</div>

<script>
function openDeleteModal(id, name) {
    document.getElementById('categoryName').textContent = name;
    document.getElementById('deleteLink').href = '<?= base_url('categories/delete/') ?>' + id;
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
}

document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
});
</script>
<?= $this->endSection() ?>
