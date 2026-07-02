<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "--- START DATABASE MIGRATION & RESTORE SCRIPT (HARDCODED BACKUP) ---\n";

// Hardcoded backup data
$users = [
    [
        "id_user" => 1,
        "name" => "abdal riski maulana",
        "email" => "714250063@std.ilbi.ac.id",
        "password" => '$2y$12$rhaH/LAbtZ/xAI5mBj4fuuTbFNYxRHTlT/uPdZqHVzsgIL.bgLns2',
        "status" => "active",
        "package" => "intensif",
        "sekdin" => "stip-jakarta",
        "address" => "cililin pride euy",
        "remember_token" => null,
        "whatsapp" => "085956009099",
        "role" => "siswa",
        "created_at" => "2026-06-29 13:45:13",
        "updated_at" => "2026-06-29 14:19:17",
    ],
    [
        "id_user" => 2,
        "name" => "devi fonira walia",
        "email" => "kaylanajwa674@gmail.com",
        "password" => '$2y$12$lFfChTqp.9a8RoC/Mpne3.KJh95ybS7iiLbLZNBDECxq.KilQOTLq',
        "status" => "pending",
        "package" => "reguler",
        "sekdin" => "ptdi-sttd",
        "address" => "cisarongge jaya selalu pokoknya",
        "remember_token" => null,
        "whatsapp" => "085956009099",
        "role" => "siswa",
        "created_at" => "2026-07-02 06:17:16",
        "updated_at" => "2026-07-02 06:17:16",
    ]
];

$pembayaran = [
    [
        "id" => 1,
        "id_user" => 1,
        "bank" => "BRI",
        "account_number" => "7766554433",
        "sender_name" => "abay ganteng",
        "transfer_date" => "2026-06-29",
        "transfer_time" => "21:08:00",
        "amount" => 2150000,
        "note" => "makasihh",
        "status" => "lunas",
        "proof_path" => "payments/gOsi1qziAvtvrnOvR8lmlXr8lLTPQb0IJtV5x2nA.jpg",
        "created_at" => "2026-06-29 14:05:26",
        "updated_at" => "2026-06-29 14:21:22",
    ],
    [
        "id" => 2,
        "id_user" => 2,
        "bank" => "BRI",
        "account_number" => "12222349506",
        "sender_name" => "devi fonira walia",
        "transfer_date" => "2026-07-02",
        "transfer_time" => "13:18:00",
        "amount" => 1250000,
        "note" => null,
        "status" => "pending",
        "proof_path" => "payments/aAvjlJUU2BII49Az9o2FdHJPN5tmmtFJzKTUvkoL.png",
        "created_at" => "2026-07-02 06:18:24",
        "updated_at" => "2026-07-02 06:18:24",
    ]
];

// 1. Wipe database
echo "Wiping database...\n";
$exitCode = Artisan::call('db:wipe', ['--force' => true]);
echo "db:wipe exit code: $exitCode\n";

// 2. Run migrations
echo "Running migrations...\n";
$exitCode = Artisan::call('migrate', ['--force' => true]);
echo "migrate exit code: $exitCode\n";

// 3. Restore users first (to get their original IDs)
echo "Restoring users...\n";
foreach ($users as $userArr) {
    DB::table('users')->insert($userArr);
    echo "Restored user: {$userArr['email']} with ID {$userArr['id_user']}\n";
}

// 4. Restore pembayaran
echo "Restoring pembayaran...\n";
foreach ($pembayaran as $pembArr) {
    DB::table('pembayaran')->insert($pembArr);
    echo "Restored pembayaran ID: {$pembArr['id']} for User ID: {$pembArr['id_user']}\n";
}

// 5. Run seeders (seeded users will automatically get IDs > 2)
echo "Seeding database...\n";
$exitCode = Artisan::call('db:seed', ['--force' => true]);
echo "db:seed exit code: $exitCode\n";
echo Artisan::output() . "\n";

echo "--- MIGRATION & RESTORE COMPLETED SUCCESSFULLY ---\n";
