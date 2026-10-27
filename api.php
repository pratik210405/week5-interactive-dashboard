<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'db.php';

$start = $_GET['start'] ?? '';
$end = $_GET['end'] ?? '';
$type = $_GET['type'] ?? 'all';

$where = [];
$params = [];
if ($start !== '') { $where[] = 'transaction_date >= ?'; $params[] = $start; }
if ($end !== '') { $where[] = 'transaction_date <= ?'; $params[] = $end; }
if (in_array($type, ['income', 'expense'], true)) { $where[] = 'type = ?'; $params[] = $type; }
$sqlWhere = $where ? (' WHERE ' . implode(' AND ', $where)) : '';

try {
    $stmt = $pdo->prepare("SELECT id, transaction_date, type, category, description, amount FROM transactions" . $sqlWhere . " ORDER BY transaction_date DESC, id DESC");
    $stmt->execute($params);
    $rows = $stmt->fetchAll();

    $income = 0.0; $expense = 0.0;
    $monthly = [];
    foreach ($rows as $row) {
        $amount = (float)$row['amount'];
        if ($row['type'] === 'income') $income += $amount;
        else $expense += $amount;
        $month = substr($row['transaction_date'], 0, 7);
        if (!isset($monthly[$month])) $monthly[$month] = ['income' => 0, 'expense' => 0];
        $monthly[$month][$row['type']] += $amount;
        $row['amount'] = $amount;
    }
    ksort($monthly);
    echo json_encode([
        'success' => true,
        'summary' => ['income' => $income, 'expense' => $expense, 'balance' => $income - $expense, 'count' => count($rows)],
        'monthly' => $monthly,
        'transactions' => $rows
    ]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Could not load dashboard data. Check database tables.']);
}
?>
