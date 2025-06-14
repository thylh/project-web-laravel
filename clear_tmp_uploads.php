<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

use Illuminate\Support\Facades\File;
use Carbon\Carbon;

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$tmpPath = storage_path('app/tmp');
$files = File::files($tmpPath);
$now = Carbon::now(); // Đảm bảo là Carbon object
$deleted = 0;

// Tạo log để dễ debug nếu cần
$logPath = __DIR__ . '/log_clear_tmp.txt';
file_put_contents($logPath, "=== Dọn file tạm lúc {$now->toDateTimeString()} ===\n", FILE_APPEND);

foreach ($files as $file) {
    $modified = Carbon::createFromTimestamp($file->getMTime());

    $ageMinutes = $modified->lessThan($now)
        ? $modified->diffInMinutes($now)
        : -$now->diffInMinutes($modified);

    file_put_contents($logPath, "File: {$file->getFilename()}, modified_at: {$modified->toDateTimeString()}, tuổi: {$ageMinutes} phút\n", FILE_APPEND);

    if ($ageMinutes > 60) {
        File::delete($file->getPathname());
        $deleted++;
        file_put_contents($logPath, "--> Đã xóa: {$file->getFilename()}\n", FILE_APPEND);
    }
}

echo "Đã xóa $deleted file tạm.\n";
file_put_contents($logPath, "Tổng cộng đã xóa: $deleted file.\n\n", FILE_APPEND);
