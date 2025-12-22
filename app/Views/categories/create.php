<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Add Category<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="<?= base_url('categories') ?>" class="text-muted-foreground hover:text-foreground flex items-center transition-colors">
            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Categories
        </a>
    </div>

    <div class="bg-card border border-border rounded-xl p-6 md:p-8">
        <h2 class="text-2xl font-bold text-foreground mb-6">Add New Category</h2>

        <?php if(session()->has('errors')): ?>
            <div class="bg-red-500/10 border border-red-500/20 text-red-400 p-4 mb-6 rounded-lg">
                <div class="flex items-start">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <ul class="list-disc list-inside space-y-1">
                    <?php foreach(session('errors') as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('categories/store') ?>" method="post">
            <div class="mb-6">
                <label for="name" class="block text-foreground text-sm font-medium mb-2">Category Name <span class="text-red-400">*</span></label>
                <input type="text" name="name" id="name" class="w-full bg-muted border border-border rounded-lg py-3 px-4 text-foreground placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" placeholder="Enter category name" value="<?= old('name') ?>" required>
            </div>
            
            <div class="mb-8">
                <label for="description" class="block text-foreground text-sm font-medium mb-2">Description</label>
                <textarea name="description" id="description" rows="4" class="w-full bg-muted border border-border rounded-lg py-3 px-4 text-foreground placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all resize-none" placeholder="Enter category description (optional)"><?= old('description') ?></textarea>
            </div>

            <div class="flex items-center justify-end gap-3">
                <a href="<?= base_url('categories') ?>" class="px-6 py-3 bg-muted hover:bg-muted/80 text-foreground rounded-lg font-medium transition-colors">Cancel</a>
                <button type="submit" class="px-6 py-3 bg-primary hover:bg-primary/90 text-primary-foreground rounded-lg font-medium transition-colors">
                    Save Category
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
