<?php
// Read .env file
$envFile = __DIR__ . '/../.env';
if (!file_exists($envFile)) {
    die("File .env tidak ditemukan! Pastikan file .env berada di root proyek.");
}

$lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$env = [];
foreach ($lines as $line) {
    if (strpos(trim($line), '#') === 0) continue;
    if (strpos($line, '=') === false) continue;
    list($name, $value) = explode('=', $line, 2);
    $env[trim($name)] = trim($value, ' "\'');
}

echo "<h2>Diagnosis Database Laravel - Pilar Abdi</h2>";
echo "<table border='1' cellpadding='8' style='border-collapse: collapse;'>";
echo "<tr style='background: #f2f2f2;'><td><b>Konfigurasi .env</b></td><td><b>Nilai Aktif</b></td></tr>";
echo "<tr><td><b>Koneksi (DB_CONNECTION)</b></td><td>" . htmlspecialchars($env['DB_CONNECTION'] ?? 'mysql') . "</td></tr>";
echo "<tr><td><b>Host (DB_HOST)</b></td><td>" . htmlspecialchars($env['DB_HOST'] ?? '127.0.0.1') . "</td></tr>";
echo "<tr><td><b>Database (DB_DATABASE)</b></td><td>" . htmlspecialchars($env['DB_DATABASE'] ?? 'pilar_abdi') . "</td></tr>";
echo "<tr><td><b>Username (DB_USERNAME)</b></td><td>" . htmlspecialchars($env['DB_USERNAME'] ?? 'root') . "</td></tr>";
echo "</table>";

// Try to connect to database
try {
    if (($env['DB_CONNECTION'] ?? 'mysql') === 'sqlite') {
        $dbPath = __DIR__ . '/../database/' . ($env['DB_DATABASE'] ?? 'database.sqlite');
        if (!file_exists($dbPath)) {
            $dbPath = ($env['DB_DATABASE'] ?? 'database.sqlite');
        }
        $pdo = new PDO("sqlite:" . $dbPath);
        echo "<p style='color:green; font-weight:bold;'>✔️ Berhasil terhubung ke database SQLite!</p>";
        echo "<p>Lokasi file SQLite: <code>" . realpath($dbPath) . "</code></p>";
    } else {
        $host = $env['DB_HOST'] ?? '127.0.0.1';
        $port = $env['DB_PORT'] ?? '3306';
        $dbname = $env['DB_DATABASE'] ?? 'pilar_abdi';
        $username = $env['DB_USERNAME'] ?? 'root';
        $password = $env['DB_PASSWORD'] ?? '';
        
        $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<p style='color:green; font-weight:bold;'>✔️ Berhasil terhubung ke database MySQL!</p>";
    }
    
    // Query users table
    // check if users table exists
    $tableCheck = $pdo->query("SELECT 1 FROM users LIMIT 1");
    if ($tableCheck !== false) {
        $stmt = $pdo->query("SELECT id_user, name, email, role, status FROM users ORDER BY id_user DESC");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<h3>Daftar User di Database (" . count($users) . " User):</h3>";
        if (count($users) > 0) {
            echo "<table border='1' cellpadding='8' style='border-collapse: collapse;'>";
            echo "<tr style='background: #f2f2f2;'><th>ID</th><th>Nama</th><th>Email</th><th>Role</th><th>Status</th></tr>";
            foreach ($users as $u) {
                echo "<tr>";
                echo "<td>" . $u['id_user'] . "</td>";
                echo "<td>" . htmlspecialchars($u['name']) . "</td>";
                echo "<td>" . htmlspecialchars($u['email']) . "</td>";
                echo "<td>" . htmlspecialchars($u['role']) . "</td>";
                echo "<td>" . htmlspecialchars($u['status']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Tabel 'users' kosong.</p>";
        }
    }
} catch (Exception $e) {
    echo "<p style='color:red; font-weight:bold;'>❌ Gagal terhubung ke database:</p>";
    echo "<pre style='background: #fee; padding: 10px; border: 1px solid #fcc; color: red;'>" . htmlspecialchars($e->getMessage()) . "</pre>";
}
?>
