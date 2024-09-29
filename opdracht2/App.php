<?php

declare(strict_types=1);

/**
 * @param string $dir
 * @return array
 */
function getFiles(string $dir): array
{
    $files = array_diff(scandir($dir), ['.', '..']);
    return array_values($files);
}

/**
 * @param string $filepath
 * @return array
 */
function getTransactions(string $filepath): array
{
    $transactions = [];

    if (($handle = fopen($filepath, 'r')) !== false) {
        $firstLine = fgets($handle);
        $delimiter = strpos($firstLine, "\t") !== false ? "\t" : ",";
        rewind($handle);
        fgetcsv($handle, 1000, $delimiter);
        while (($data = fgetcsv($handle, 1000, $delimiter)) !== false) {
            // Controleer op het juiste aantal kolommen
            if (count($data) >= 4) {
                $amount = cleanAmount($data[3]);
                $transactions[] = [
                    'date' => formatDate($data[0]),
                    'checksum' => $data[1] ?? '',
                    'description' => $data[2],
                    'amount' => $amount
                ];
            } else {
                $fixedData = explode(',', $data[0]);
                if (count($fixedData) >= 4) {
                    $amount = cleanAmount($fixedData[3]);
                    $transactions[] = [
                        'test' => $fixedData[0],
                        'date' => formatDate($fixedData[0]),
                        'checksum' => $fixedData[1] ?? '',
                        'description' => $fixedData[2],
                        'amount' => $amount
                    ];
                }
            }
        }
        fclose($handle);
    }

    return $transactions;
}

/**
 * @param string $amount
 * @return float
 */
function cleanAmount(string $amount): float
{
    $amount = str_replace(['€', '�', '"'], '', $amount);
    $amount = str_replace(',', '.', $amount);

    return (float)$amount;
}


/**
 * @param string $date
 * @return string
 */
function formatDate(string $date): string
{
    $date = trim($date);
    $datetime = DateTime::createFromFormat('d/m/Y', $date);
    $formattedDate = $datetime->format('d/m/Y');

    if ($formattedDate === $date) {
        return $datetime->format('d M Y');
    } else {
        $datetime->format('m/d/Y');
        return $datetime->format('d M Y');
    }
}

/**
 * @param array $transactions
 * @return int[]
 */
function calculateTotals(array $transactions): array
{
    $totals = [
        'income' => 0,
        'expenses' => 0,
    ];

    foreach ($transactions as $transaction) {
        if ($transaction['amount'] > 0) {
            $totals['income'] += $transaction['amount'];
        } else {
            $totals['expenses'] += abs($transaction['amount']);
        }
    }

    $totals['net_total'] = $totals['income'] - $totals['expenses'];

    return $totals;
}
