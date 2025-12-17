<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Dashboard<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Header Section -->
<div class="mb-8">
    <h2 class="text-4xl font-extrabold text-white mb-2">Dashboard Overview</h2>
    <p class="text-indigo-100 text-lg">Selamat datang kembali, <span class="font-semibold"><?= session()->get('username') ?>!</span></p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Total Products Card -->
    <div class="glass-card stat-card p-6 rounded-2xl fade-in">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-semibold uppercase tracking-wide mb-2">Total Products</p>
                <h3 class="stat-number"><?= $total_products ?></h3>
                <p class="text-gray-500 text-xs mt-1">Produk terdaftar</p>
            </div>
            <div class="p-4 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white icon-bounce">
                <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
        </div>
    </div>
    
    <!-- Total Stock Card -->
    <div class="glass-card stat-card p-6 rounded-2xl fade-in">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-semibold uppercase tracking-wide mb-2">Total Stock Items</p>
                <h3 class="stat-number"><?= $total_stock ?></h3>
                <p class="text-gray-500 text-xs mt-1">Item dalam stok</p>
            </div>
            <div class="p-4 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white icon-bounce" style="animation-delay: 0.2s;">
                <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Low Stock Alerts Card -->
    <div class="glass-card stat-card p-6 rounded-2xl fade-in">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-semibold uppercase tracking-wide mb-2">Low Stock Alerts</p>
                <h3 class="stat-number text-red-600"><?= $low_stock ?></h3>
                <p class="text-gray-500 text-xs mt-1">Perlu restok</p>
            </div>
            <div class="p-4 rounded-2xl bg-gradient-to-br from-orange-500 to-red-600 text-white icon-bounce" style="animation-delay: 0.4s;">
                <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="glass-card rounded-2xl shadow-2xl p-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Recent Transactions</h3>
            <p class="text-gray-500 text-sm mt-1">Aktivitas transaksi terbaru</p>
        </div>
        <div class="p-3 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 table-hover">
            <thead>
                <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider rounded-tl-lg">
                        <div class="flex items-center gap-2">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Date
                        </div>
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                        <div class="flex items-center gap-2">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            Product
                        </div>
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                        <div class="flex items-center gap-2">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Type
                        </div>
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                        <div class="flex items-center gap-2">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                            </svg>
                            Quantity
                        </div>
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider rounded-tr-lg">
                        <div class="flex items-center gap-2">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            User
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                <?php if (!empty($recent_transactions)): ?>
                    <?php foreach ($recent_transactions as $transaction): ?>
                    <tr class="hover:shadow-md transition-all duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div class="p-2 rounded-lg bg-gray-100">
                                    <svg class="h-4 w-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-gray-900">
                                        <?= date('M d, Y', strtotime($transaction['created_at'])) ?>
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        <?= date('H:i', strtotime($transaction['created_at'])) ?>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-gray-900"><?= $transaction['product_name'] ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if ($transaction['type'] == 'in'): ?>
                                <span class="px-4 py-2 inline-flex items-center gap-2 text-xs font-bold rounded-full bg-gradient-to-r from-emerald-400 to-teal-500 text-white shadow-lg badge-in">
                                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                                    </svg>
                                    IN
                                </span>
                            <?php else: ?>
                                <span class="px-4 py-2 inline-flex items-center gap-2 text-xs font-bold rounded-full bg-gradient-to-r from-orange-400 to-red-500 text-white shadow-lg badge-out">
                                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                    OUT
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div class="p-2 rounded-lg bg-indigo-100">
                                    <span class="text-sm font-bold text-indigo-700"><?= $transaction['quantity'] ?></span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div class="h-8 w-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-xs">
                                    <?= strtoupper(substr($transaction['username'], 0, 2)) ?>
                                </div>
                                <span class="text-sm font-medium text-gray-700"><?= $transaction['username'] ?></span>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="empty-state flex flex-col items-center justify-center">
                                <div class="p-6 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 mb-4">
                                    <svg class="h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-bold text-gray-700 mb-2">Tidak ada transaksi</h4>
                                <p class="text-sm text-gray-500">Belum ada transaksi yang tercatat pada sistem</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
