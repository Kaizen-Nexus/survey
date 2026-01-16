<?php

if (!isset($argv[1])) {
    throw new RuntimeException('DATA directory argument missing.');
}

$dataDir = realpath($argv[1]);
if ($dataDir === false) {
    throw new RuntimeException('Invalid DATA directory.');
}

define('DATA_REALDIR', rtrim($dataDir, '/') . '/');

$source = realpath(__DIR__ . '/../src/eccube');
$destination = DATA_REALDIR . 'downloads/module/kaizen_survey';

copyRecursive($source, $destination);

echo "source: {$source}\n";
echo "DATA_REALDIR: " . DATA_REALDIR . "\n";
echo "Survey module published successfully.\n";

function copyRecursive(string $src, string $dst): void
{
    if (!is_dir($src)) {
        return;
    }

    if (!is_dir($dst)) {
        mkdir($dst, 0777, true);
    }

    foreach (scandir($src) as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }

        $srcPath = $src . '/' . $file;
        $dstPath = $dst . '/' . $file;

        if (is_dir($srcPath)) {
            copyRecursive($srcPath, $dstPath);
        } else {
            copy($srcPath, $dstPath);
        }
    }
}
