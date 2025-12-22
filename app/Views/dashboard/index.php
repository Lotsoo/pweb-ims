<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Dashboard<?= $this->endSection() ?>
<?= $this->section('page_title') ?>Dashboard<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <!-- Total Produk -->
    <div class="bg-card border border-border rounded-xl p-5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-muted-foreground">Total Produk</p>
                <p class="text-2xl font-semibold text-foreground mt-1"><?= number_format($total_products) ?></p>
                <p class="text-xs text-accent mt-2 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                    </svg>
                    Data Terkini
                </p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center">
                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v18l-8 4"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Kategori -->
    <div class="bg-card border border-border rounded-xl p-5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-muted-foreground">Kategori</p>
                <p class="text-2xl font-semibold text-foreground mt-1"><?= number_format($total_categories) ?></p>
                <p class="text-xs text-muted-foreground mt-2">Total kategori aktif</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-accent/10 flex items-center justify-center">
                <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Stok Masuk -->
    <div class="bg-card border border-border rounded-xl p-5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-muted-foreground">Stok Masuk</p>
                <p class="text-2xl font-semibold text-foreground mt-1"><?= number_format($stock_in_weekly) ?></p>
                <p class="text-xs text-accent mt-2 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                    </svg>
                    Minggu ini
                </p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-500/10 flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Stok Keluar -->
    <div class="bg-card border border-border rounded-xl p-5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-muted-foreground">Stok Keluar</p>
                <p class="text-2xl font-semibold text-foreground mt-1"><?= number_format($stock_out_weekly) ?></p>
                <p class="text-xs text-destructive mt-2 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                    Minggu ini
                </p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-orange-500/10 flex items-center justify-center">
                <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8V20m0 0l-4-4m4 4l4-4M7 4v12m0 0l4-4m-4 4l-4-4"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <!-- Stock Movement Chart -->
    <div class="bg-card border border-border rounded-xl p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-semibold text-foreground">Pergerakan Stok</h3>
            <div class="flex items-center gap-4 text-xs">
                <span class="flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-primary"></span>
                    <span class="text-muted-foreground">Masuk</span>
                </span>
                <span class="flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                    <span class="text-muted-foreground">Keluar</span>
                </span>
            </div>
        </div>
        <!-- <canvas id="stockChart" height="200"></canvas> -->
        <div class="relative h-64 w-full">
            <canvas id="stockChart"></canvas>
        </div>
    </div>

    <!-- Category Distribution -->
    <div class="bg-card border border-border rounded-xl p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-semibold text-foreground">Distribusi Kategori</h3>
            <select class="bg-muted border border-border rounded-lg px-3 py-1.5 text-xs text-foreground focus:outline-none focus:ring-2 focus:ring-primary/50">
                <option>7 Hari Terakhir</option>
                <option>30 Hari Terakhir</option>
                <option>Tahun Ini</option>
            </select>
        </div>
        <div class="relative h-64 w-full">
            <canvas id="categoryChart"></canvas>
        </div>
    </div>
</div>

<!-- Recent Activity & Low Stock -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Recent Transactions -->
    <div class="lg:col-span-2 bg-card border border-border rounded-xl">
        <div class="p-5 border-b border-border flex items-center justify-between">
            <h3 class="text-base font-semibold text-foreground">Transaksi Terbaru</h3>
            <a href="<?= base_url('transactions') ?>" class="text-sm text-primary hover:underline">Lihat Semua</a>
        </div>
        <div class="divide-y divide-border">
            <?php if (empty($recent_transactions)): ?>
                <div class="p-5 text-center text-muted-foreground text-sm">
                    Belum ada transaksi.
                </div>
            <?php else: ?>
                <?php foreach ($recent_transactions as $transaction): ?>
                    <div class="px-5 py-4 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg <?= $transaction['type'] == 'in' ? 'bg-accent/10' : 'bg-destructive/10' ?> flex items-center justify-center">
                                <svg class="w-5 h-5 <?= $transaction['type'] == 'in' ? 'text-accent' : 'text-destructive' ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <?php if ($transaction['type'] == 'in'): ?>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                                    <?php else: ?>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                    <?php endif; ?>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-foreground"><?= esc($transaction['product_name']) ?></p>
                                <p class="text-xs text-muted-foreground">
                                    <?= $transaction['type'] == 'in' ? 'Stok Masuk' : 'Stok Keluar' ?> - <?= $transaction['quantity'] ?> unit
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium <?= $transaction['type'] == 'in' ? 'text-accent' : 'text-destructive' ?>">
                                <?= $transaction['type'] == 'in' ? '+' : '-' ?><?= $transaction['quantity'] ?>
                            </p>
                            <p class="text-xs text-muted-foreground"><?= date('d M H:i', strtotime($transaction['created_at'])) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Low Stock Alert -->
    <div class="bg-card border border-border rounded-xl">
        <div class="p-5 border-b border-border flex items-center justify-between">
            <h3 class="text-base font-semibold text-foreground">Stok Menipis</h3>
            <span class="px-2 py-1 bg-destructive/10 text-destructive text-xs font-medium rounded-full"><?= $low_stock ?> item</span>
        </div>
        <div class="divide-y divide-border">
            <?php if (empty($low_stock_items)): ?>
                <div class="p-5 text-center text-muted-foreground text-sm">
                    Tidak ada item dengan stok menipis.
                </div>
            <?php else: ?>
                <?php foreach ($low_stock_items as $item): ?>
                    <div class="px-5 py-3 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-foreground"><?= esc($item['name']) ?></p>
                            <p class="text-xs text-muted-foreground"><?= esc($item['category_name'] ?? 'Tanpa Kategori') ?></p>
                        </div>
                        <span class="px-2 py-1 bg-destructive/10 text-destructive text-xs font-medium rounded-md"><?= $item['stock_quantity'] ?> unit</span>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // Data from Controller
    const chartLabels = <?= $chart_labels ?>;
    const chartStockIn = <?= $chart_stock_in ?>;
    const chartStockOut = <?= $chart_stock_out ?>;
    
    const catLabels = <?= $cat_labels ?>;
    const catData = <?= $cat_data ?>;

    // ===== STOCK CHART =====
    const stockCanvas = document.getElementById('stockChart');
    if (stockCanvas) {
        const stockCtx = stockCanvas.getContext('2d');

        new Chart(stockCtx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [
                    {
                        label: 'Stok Masuk',
                        data: chartStockIn,
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 2,
                        pointBackgroundColor: '#10b981',
                        pointRadius: 4,
                        pointHoverRadius: 6
                    },
                    {
                        label: 'Stok Keluar',
                        data: chartStockOut,
                        borderColor: '#f97316',
                        backgroundColor: 'rgba(249, 115, 22, 0.1)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 2,
                        pointBackgroundColor: '#f97316',
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                scales: {
                    x: {
                        ticks: { color: '#9ca3af' },
                        grid: {
                            color: 'rgba(255,255,255,0.08)',
                            drawBorder: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#9ca3af', stepSize: 50 },
                        grid: {
                            color: 'rgba(255,255,255,0.08)',
                            drawBorder: false
                        }
                    }
                }
            }
        });
    }

    // ===== CATEGORY DOUGHNUT =====
    const categoryCanvas = document.getElementById('categoryChart');
    if (categoryCanvas) {
        const categoryCtx = categoryCanvas.getContext('2d');

        new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: catLabels,
                datasets: [{
                    data: catData,
                    backgroundColor: ['#10b981', '#3b82f6', '#f97316', '#8b5cf6', '#64748b', '#ec4899', '#14b8a6'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '60%',
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            color: '#9ca3af',
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 12
                        }
                    }
                }
            }
        });
    }

});
</script>

<?= $this->endSection() ?>
