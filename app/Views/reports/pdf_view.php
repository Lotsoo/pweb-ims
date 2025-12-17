<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transaction Report</title>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { margin: 0; font-size: 24px; color: #333; }
        .header p { margin: 5px 0; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; font-size: 12px; }
        th { background-color: #f4f4f4; font-weight: bold; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; color: #999; }
        .badge-in { background-color: #d1fae5; color: #065f46; padding: 2px 6px; border-radius: 9999px; font-size: 10px; }
        .badge-out { background-color: #fee2e2; color: #991b1b; padding: 2px 6px; border-radius: 9999px; font-size: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Inventory Transaction Report</h1>
        <p>Period: <?= date('d M Y', strtotime($start_date)) ?> - <?= date('d M Y', strtotime($end_date)) ?></p>
        <p>Generated on: <?= date('d M Y H:i:s') ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Product</th>
                <th>Type</th>
                <th>Qty</th>
                <th>User</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction): ?>
            <tr>
                <td><?= date('d/m/Y H:i', strtotime($transaction['created_at'])) ?></td>
                <td><?= $transaction['product_name'] ?></td>
                <td>
                    <?php if ($transaction['type'] == 'in'): ?>
                        <span class="badge-in">IN</span>
                    <?php else: ?>
                        <span class="badge-out">OUT</span>
                    <?php endif; ?>
                </td>
                <td><?= $transaction['quantity'] ?></td>
                <td><?= $transaction['username'] ?></td>
                <td><?= $transaction['notes'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer">
        Inventory Management System - Report Generated Automatically
    </div>
</body>
</html>
