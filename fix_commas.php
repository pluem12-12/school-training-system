<?php
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('app/Filament'));
foreach ($files as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        $newContent = str_replace(',,', ',', $content);
        $newContent = str_replace(', ,', ',', $newContent);
        if ($content !== $newContent) {
            file_put_contents($file->getPathname(), $newContent);
            echo 'Fixed commas: ' . $file->getPathname() . PHP_EOL;
        }
    }
}
echo "Done\n";
