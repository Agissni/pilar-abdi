<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Guru;

// 1. Sri Wahyuni, S.Pd. (ID 1)
$sri = Guru::find(1);
if ($sri) {
    $sri->whatsapp = '083823960202';
    $sri->save();
    echo "Sri updated successfully.\n";
}

// 2. Budi Santoso, M.Pd. (ID 2)
$budi = Guru::find(2);
if ($budi) {
    $budi->whatsapp = '081215100967';
    $budi->save();
    echo "Budi updated successfully.\n";
}

// 3. Dewi Lestari, S.Psi. (ID 3)
$dewi = Guru::find(3);
if ($dewi) {
    $dewi->whatsapp = '085956008088';
    $dewi->save();
    echo "Dewi updated successfully.\n";
}
