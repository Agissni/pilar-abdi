<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Gurus: " . \App\Models\Guru::count() . "\n";
echo "Kelas: " . \App\Models\Kelas::count() . "\n";
echo "Payments: " . \App\Models\Payment::count() . "\n";
echo "Users: " . \App\Models\User::count() . "\n";
foreach (\App\Models\User::all() as $u) {
    echo "- User: {$u->name} ({$u->email}), Role: {$u->role}, Status: {$u->status}\n";
}
foreach (\App\Models\Payment::all() as $p) {
    echo "- Payment: ID={$p->id}, UserID={$p->id_user}, Bank={$p->bank}, Status={$p->status}\n";
}
