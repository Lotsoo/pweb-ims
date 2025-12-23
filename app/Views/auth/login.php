<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - IMS</title>
    <!-- style.css removed to avoid conflicts on login page -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-background text-foreground flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-card border border-border rounded-2xl p-8">
            <div class="flex flex-col items-center mb-6">
                <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center text-primary-foreground font-semibold">IM</div>
                <h2 class="text-2xl font-semibold mt-3 text-foreground">Masuk ke IMS</h2>
                <p class="text-sm text-muted-foreground mt-1">Kelola persediaan dengan mudah</p>
            </div>

            <?php if(session()->getFlashdata('msg')):?>
                <div class="mb-4 rounded-lg border border-destructive/20 bg-destructive/10 text-destructive p-3 text-sm">
                    <?= session()->getFlashdata('msg') ?>
                </div>
            <?php endif;?>

            <form action="<?= base_url('auth/attemptLogin') ?>" method="post" class="space-y-5">
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                    <div class="relative">
                        <svg class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A7 7 0 1118.879 6.196M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <input type="text" name="username" id="username" class="w-full pl-10 pr-4 py-3 bg-muted border border-border rounded-lg text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition" placeholder="Masukkan username" required>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-sm font-medium text-foreground">Password</label>
                        <button type="button" id="togglePassword" class="text-xs text-muted-foreground hover:text-foreground">Tampilkan</button>
                    </div>
                    <div class="relative">
                        <svg class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.657-1.343-3-3-3m6 0c-1.657 0-3 1.343-3 3m-7 0a7 7 0 0114 0c0 3.866-3.582 7-7 7s-7-3.134-7-7z"/></svg>
                        <input type="password" name="password" id="password" class="w-full pl-10 pr-12 py-3 bg-muted border border-border rounded-lg text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition" placeholder="Masukkan password" required>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center gap-2 text-sm text-muted-foreground">
                        <input type="checkbox" name="remember" class="rounded border-border text-primary focus:ring-primary/50">
                        Ingat saya
                    </label>
                    <a href="<?= base_url('/') ?>" class="text-sm text-primary hover:text-primary/90">Butuh bantuan?</a>
                </div>
                <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-primary-foreground font-medium py-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/50 transition">Masuk</button>
            </form>
        </div>

        <p class="text-xs text-muted-foreground mt-4 text-center">© <?= date('Y') ?> IMS</p>
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
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
        };
    </script>
    <script>
        const toggle = document.getElementById('togglePassword');
        const pwd = document.getElementById('password');
        if (toggle && pwd) {
            toggle.addEventListener('click', () => {
                const isText = pwd.type === 'text';
                pwd.type = isText ? 'password' : 'text';
                toggle.textContent = isText ? 'Tampilkan' : 'Sembunyikan';
            });
        }
    </script>
</body>
</html>
