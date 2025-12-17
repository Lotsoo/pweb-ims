<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - IMS</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="login-container">
        <div class="glass-card p-8 rounded-xl shadow-lg w-96">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Welcome Back</h2>
            <?php if(session()->getFlashdata('msg')):?>
                <div class="alert alert-danger mb-4 p-3 bg-red-100 text-red-700 rounded">
                    <?= session()->getFlashdata('msg') ?>
                </div>
            <?php endif;?>
            <form action="<?= base_url('auth/attemptLogin') ?>" method="post">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                    <input type="text" name="username" id="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full transition duration-300" type="submit">
                        Sign In
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
