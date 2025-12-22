<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <title><?= lang('Errors.whoops') ?></title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen text-center overflow-hidden">

    <div class="glass-card p-12 rounded-3xl flex flex-col items-center max-w-lg mx-4 fade-in border-t border-white/10">
        <div class="relative mb-8">
            <div class="absolute inset-0 bg-red-500 blur-2xl opacity-20 rounded-full"></div>
            <img src="<?= base_url('images/foto-rizky.jpeg') ?>" alt="Error Image" class="relative w-48 h-48 object-cover rounded-full border-4 border-red-500/30 shadow-2xl">
        </div>
        
        <h1 class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-orange-400 mb-4"><?= lang('Errors.whoops') ?></h1>
        <p class="text-xl text-gray-300 mb-8 font-medium">aduh program ada error</p>
        
        <a href="<?= base_url('/') ?>" class="group px-8 py-3 bg-red-600 hover:bg-red-500 text-white rounded-xl transition-all duration-300 flex items-center gap-2 shadow-lg shadow-red-500/20">
            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Beranda
        </a>
    </div>

</body>
</html>
