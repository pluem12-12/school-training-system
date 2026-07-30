<?php
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('app/Filament'));
foreach ($files as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        
        $newContent = preg_replace(
            '/BulkActionGroup::make\(\[\s*(.*?)\s*\]\)/s',
            '$1',
            $content
        );
        $newContent = preg_replace(
            '/\\\\Filament\\\\Actions\\\\BulkActionGroup::make\(\[\s*(.*?)\s*\]\)/s',
            '$1',
            $newContent
        );
        
        if ($content !== $newContent) {
            file_put_contents($file->getPathname(), $newContent);
            echo 'Ungrouped bulk actions: ' . $file->getPathname() . PHP_EOL;
        }
    }
}
echo "Done\n";
