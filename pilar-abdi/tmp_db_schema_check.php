<?php
$db = __DIR__ . '/database/database.sqlite';
$pdo = new PDO('sqlite:' . $db);
foreach (['users', 'pembayaran', 'gurus', 'kelas'] as $t) {
    echo "TABLE:$t\n";
    $stmt = $pdo->query('PRAGMA table_info(' . $t . ')');
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $col) {
        echo sprintf("%s %s %s %s %s %s\n", $col['cid'], $col['name'], $col['type'], $col['notnull'], $col['dflt_value'] === null ? 'NULL' : $col['dflt_value'], $col['pk']);
    }
    echo "\n";
}

