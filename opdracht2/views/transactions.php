<!DOCTYPE html>
<html>
<head>
    <title>Transacties</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        table tr th, table tr td {
            padding: 5px;
            border: 1px #eee solid;
        }

        tfoot tr th, tfoot tr td {
            font-size: 20px;
        }

        tfoot tr th {
            text-align: right;
        }

        .income {
            color: green;
        }

        .expense {
            color: red;
        }
    </style>
</head>
<body class="container">
<h1>Transacties uit bestand: <?= htmlspecialchars($_GET['file']) ?></h1>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>Datum</th>
        <th>Check #</th>
        <th>Beschrijving</th>
        <th>Bedrag</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($transactions as $transaction): ?>
        <tr>
            <td><?= htmlspecialchars($transaction['date']) ?></td>
            <td><?= htmlspecialchars($transaction['checksum']) ?></td>
            <td><?= htmlspecialchars($transaction['description']) ?></td>
            <td class="<?= $transaction['amount'] > 0 ? 'income' : 'expense' ?>">
                <?= number_format($transaction['amount'], 2, ',', '.') ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
    <tr>
        <th colspan="3">Totale Inkomsten:</th>
        <td class="income"><?= number_format($totals['income'], 2, ',', '.') ?></td>
    </tr>
    <tr>
        <th colspan="3">Totale Uitgaven:</th>
        <td class="expense"><?= number_format($totals['expenses'], 2, ',', '.') ?></td>
    </tr>
    <tr>
        <th colspan="3">Netto totaal:</th>
        <td><?= number_format($totals['net_total'], 2, ',', '.') ?></td>
    </tr>
    </tfoot>
</table>
</body>
</html>
