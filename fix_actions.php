<?php
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('app/Filament'));
foreach ($files as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        $newContent = str_replace(
            ['Filament\Actions\BulkActionGroup', 'Filament\Actions\DeleteBulkAction', 'Filament\Actions\EditAction', 'Filament\Actions\DeleteAction', 'Filament\Actions\ViewAction'],
            ['Filament\Tables\Actions\BulkActionGroup', 'Filament\Tables\Actions\DeleteBulkAction', 'Filament\Tables\Actions\EditAction', 'Filament\Tables\Actions\DeleteAction', 'Filament\Tables\Actions\ViewAction'],
            $content
        );
        if ($content !== $newContent) {
            file_put_contents($file->getPathname(), $newContent);
            echo 'Updated: ' . $file->getPathname() . PHP_EOL;
        }
    }
}
echo "Done\n";
