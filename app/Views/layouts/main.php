<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> - IMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        background: '#0a0a0a',
                        foreground: '#fafafa',
                        card: '#141414',
                        'card-foreground': '#fafafa',
                        border: '#262626',
                        muted: '#171717',
                        'muted-foreground': '#a3a3a3',
                        primary: '#3b82f6',
                        'primary-foreground': '#ffffff',
                        accent: '#22c55e',
                        destructive: '#ef4444',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .sidebar-link.active {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.15) 0%, transparent 100%);
            border-left: 2px solid #3b82f6;
        }

        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #141414;
        }

        ::-webkit-scrollbar-thumb {
            background: #333;
            border-radius: 3px;
        }
    </style>
</head>

<body class="bg-background text-foreground antialiased">
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside class="w-64 bg-card border-r border-border flex flex-col">
            <!-- Logo -->
            <div class="h-16 flex items-center px-6 border-b border-border">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-semibold text-foreground">IMS</h1>
                        <p class="text-xs text-muted-foreground">Inventory System</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 py-4 px-3 space-y-1 overflow-y-auto">
                <p class="px-3 py-2 text-xs font-medium text-muted-foreground uppercase tracking-wider">Menu Utama</p>

                <a href="<?= base_url('dashboard') ?>"
                    class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-muted-foreground hover:text-foreground transition-colors <?= (current_url() == base_url('dashboard')) ? 'active text-foreground' : '' ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Dashboard
                </a>

                <a href="<?= base_url('products') ?>"
                    class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-muted-foreground hover:text-foreground transition-colors <?= (strpos(current_url(), 'products') !== false) ? 'active text-foreground' : '' ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    Produk
                </a>

                <a href="<?= base_url('categories') ?>"
                    class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-muted-foreground hover:text-foreground transition-colors <?= (strpos(current_url(), 'categories') !== false) ? 'active text-foreground' : '' ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    Kategori
                </a>

                <p class="px-3 py-2 mt-4 text-xs font-medium text-muted-foreground uppercase tracking-wider">Transaksi</p>

                <a href="<?= base_url('transactions') ?>"
                    class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-muted-foreground hover:text-foreground transition-colors <?= (strpos(current_url(), 'transactions') !== false) ? 'active text-foreground' : '' ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                    Stok Masuk/Keluar
                </a>

                <a href="<?= base_url('reports') ?>"
                    class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-muted-foreground hover:text-foreground transition-colors <?= (strpos(current_url(), 'reports') !== false) ? 'active text-foreground' : '' ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Laporan
                </a>
            </nav>

            <!-- User Section -->
            <div class="p-3 border-t border-border">
                <div class="flex items-center gap-3 px-3 py-2 rounded-lg bg-muted">
                    <div class="w-8 h-8 rounded-full bg-primary/20 flex items-center justify-center">
                        <span class="text-sm font-medium text-primary">A</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-foreground truncate">Admin</p>
                        <p class="text-xs text-muted-foreground truncate">admin@ims.com</p>
                    </div>
                    <a href="<?= base_url('auth/logout') ?>" class="p-1.5 rounded-md hover:bg-background text-muted-foreground hover:text-destructive transition-colors" title="Logout">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="h-16 bg-card border-b border-border flex items-center justify-between px-6">
                <div class="flex items-center gap-4">
                    <h2 class="text-lg font-semibold text-foreground"><?= $this->renderSection('page_title') ?></h2>
                </div>
                <div class="flex items-center gap-3">
                    <!-- Search -->
                    <div class="relative">
                        <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" placeholder="Cari..." class="w-64 pl-9 pr-4 py-2 bg-muted border border-border rounded-lg text-sm text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary">
                    </div>
                    <?php
                    $threshold = 10;
                    $pm = new \App\Models\ProductModel();
                    $lowStockItems = $pm->select('products.*, categories.name as category_name')
                                        ->join('categories', 'categories.id = products.category_id', 'left')
                                        ->where('stock_quantity <', $threshold)
                                        ->orderBy('stock_quantity', 'ASC')
                                        ->findAll();
                    $lowStockCount = count($lowStockItems);
                    ?>
                    <div class="relative">
                        <button id="notifBtn" class="p-2 rounded-lg hover:bg-muted text-muted-foreground hover:text-foreground transition-colors relative">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <?php if ($lowStockCount > 0): ?>
                                <span class="absolute top-1.5 right-1.5 w-4 h-4 bg-destructive text-[10px] text-white rounded-full flex items-center justify-center"><?= $lowStockCount ?></span>
                            <?php endif; ?>
                        </button>
                        <div id="notifDropdown" class="hidden absolute right-0 mt-2 w-80 bg-card border border-border rounded-lg shadow-lg z-50">
                            <div class="p-4 border-b border-border flex items-center justify-between">
                                <p class="text-sm font-medium text-foreground">Stok Menipis</p>
                                <span class="px-2 py-0.5 bg-destructive/10 text-destructive text-xs font-medium rounded-full"><?= $lowStockCount ?> item</span>
                            </div>
                            <div class="max-h-64 overflow-y-auto divide-y divide-border">
                                <?php if ($lowStockCount === 0): ?>
                                    <div class="p-4 text-sm text-muted-foreground">Semua stok aman.</div>
                                <?php else: ?>
                                    <?php foreach ($lowStockItems as $item): ?>
                                        <div class="px-4 py-3 flex items-center justify-between">
                                            <div>
                                                <p class="text-sm font-medium text-foreground"><?= esc($item['name']) ?></p>
                                                <p class="text-xs text-muted-foreground"><?= esc($item['category_name'] ?? 'Tanpa Kategori') ?></p>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span class="px-2 py-1 bg-destructive/10 text-destructive text-xs font-medium rounded-md"><?= $item['stock_quantity'] ?> unit</span>
                                                <a href="<?= base_url('transactions/create') ?>" class="text-xs text-primary hover:underline">Request Stok</a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6 bg-background">
                <?php if (isset($lowStockCount) && $lowStockCount > 0): ?>
                    <div class="mb-4 bg-destructive/10 border border-destructive/20 text-destructive rounded-lg p-4 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M4.93 4.93a10 10 0 1114.14 14.14A10 10 0 014.93 4.93z"/></svg>
                            <p class="text-sm">Ada <?= $lowStockCount ?> produk dengan stok rendah. Segera buat <a class="underline" href="<?= base_url('transactions/create') ?>">request stok</a> untuk ketersediaan barang.</p>
                        </div>
                        <a href="<?= base_url('products') ?>" class="text-xs text-muted-foreground hover:text-foreground">Lihat produk</a>
                    </div>
                <?php endif; ?>
                <?= $this->renderSection('content') ?>
            </main>
            <script>
                const btn = document.getElementById('notifBtn');
                const dd = document.getElementById('notifDropdown');
                if (btn && dd) {
                    btn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        dd.classList.toggle('hidden');
                    });
                    document.addEventListener('click', () => dd.classList.add('hidden'));
                }
            </script>
        </div>
    </div>
</body>

</html>