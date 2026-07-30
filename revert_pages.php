<?php
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('app/Filament'));
foreach ($files as $file) {
    if ($file->isFile() && $file->getExtension() === 'php' && strpos($file->getPathname(), 'Pages') !== false) {
        $content = file_get_contents($file->getPathname());
        $newContent = str_replace(
            ['Filament\Tables\Actions\DeleteAction', 'Filament\Tables\Actions\EditAction', 'Filament\Tables\Actions\ViewAction'],
            ['Filament\Actions\DeleteAction', 'Filament\Actions\EditAction', 'Filament\Actions\ViewAction'],
            $content
        );
        if ($content !== $newContent) {
            file_put_contents($file->getPathname(), $newContent);
            echo 'Reverted: ' . $file->getPathname() . PHP_EOL;
        }
    }
}
echo "Done\n";
