<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> - IMS</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="font-sans antialiased">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-72 glass-card flex-shrink-0 flex flex-col justify-between">
            <div>
                <!-- Logo Header -->
                <div class="h-20 flex items-center justify-center border-b glass-border">
                    <div class="text-center">
                        <h1 class="text-2xl font-extrabold gradient-text tracking-tight">IMS v1.0</h1>
                        <p class="text-xs text-gray-500 font-medium">Inventory Management</p>
                    </div>
                </div>
                
                <!-- Navigation -->
                <nav class="mt-6 px-4 space-y-1">
                    <a href="<?= base_url('dashboard') ?>" 
                       class="flex items-center px-4 py-3.5 text-gray-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 rounded-xl transition-all duration-200 group <?= (current_url() == base_url('dashboard')) ? 'nav-link-active' : '' ?>">
                        <div class="p-2 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 text-white mr-3 group-hover:scale-110 transition-transform duration-200">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                        </div>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    
                    <a href="<?= base_url('products') ?>" 
                       class="flex items-center px-4 py-3.5 text-gray-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 rounded-xl transition-all duration-200 group <?= (strpos(current_url(), 'products') !== false) ? 'nav-link-active' : '' ?>">
                        <div class="p-2 rounded-lg bg-gradient-to-br from-blue-500 to-cyan-600 text-white mr-3 group-hover:scale-110 transition-transform duration-200">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <span class="font-medium">Products</span>
                    </a>
                    
                    <a href="<?= base_url('categories') ?>" 
                       class="flex items-center px-4 py-3.5 text-gray-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 rounded-xl transition-all duration-200 group <?= (strpos(current_url(), 'categories') !== false) ? 'nav-link-active' : '' ?>">
                        <div class="p-2 rounded-lg bg-gradient-to-br from-emerald-500 to-teal-600 text-white mr-3 group-hover:scale-110 transition-transform duration-200">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <span class="font-medium">Categories</span>
                    </a>
                    
                    <a href="<?= base_url('transactions') ?>" 
                       class="flex items-center px-4 py-3.5 text-gray-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 rounded-xl transition-all duration-200 group <?= (strpos(current_url(), 'transactions') !== false) ? 'nav-link-active' : '' ?>">
                        <div class="p-2 rounded-lg bg-gradient-to-br from-orange-500 to-red-600 text-white mr-3 group-hover:scale-110 transition-transform duration-200">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                            </svg>
                        </div>
                        <span class="font-medium">Inventory</span>
                    </a>
                    
                    <a href="<?= base_url('reports') ?>" 
                       class="flex items-center px-4 py-3.5 text-gray-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 rounded-xl transition-all duration-200 group <?= (strpos(current_url(), 'reports') !== false) ? 'nav-link-active' : '' ?>">
                        <div class="p-2 rounded-lg bg-gradient-to-br from-pink-500 to-rose-600 text-white mr-3 group-hover:scale-110 transition-transform duration-200">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <span class="font-medium">Reports</span>
                    </a>
                </nav>
            </div>
            
            <!-- Logout Button -->
            <div class="p-4 border-t glass-border">
                <a href="<?= base_url('auth/logout') ?>" 
                   class="flex items-center w-full px-4 py-3 text-red-600 hover:bg-red-50 rounded-xl transition-all duration-200 btn-logout group">
                    <div class="p-2 rounded-lg bg-red-100 text-red-600 mr-3 group-hover:bg-red-200 transition-colors">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </div>
                    <span class="font-semibold">Logout</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto p-8">
            <div class="max-w-7xl mx-auto">
                 <?= $this->renderSection('content') ?>
            </div>
        </main>
    </div>

</body>
</html>
