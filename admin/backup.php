<?php
session_start();
$conf = json_decode(file_get_contents("../config.json"),true);
if (password_verify($_SESSION["passwd"],$conf["password-hash"])){
// Get real path for our folder
$rootPath = realpath('../pages');

// Initialize archive object
$zip = new ZipArchive();
$zip->open('backup.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}

// Zip archive will be created only after closing object
echo <<<BACKEDUP
files have been backed up to <a href="backup.zip">backup.zip</a>
BACKEDUP;
$zip->close();
}else{echo "GO AWAY!";}
?>
<br>
<a href="manage.php"><< back to panel </a>