<?php
$backup_file = "backup_files_" . date("Y-m-d_H-i-s") . ".zip";
$root_folder = __DIR__; // Carpeta del proyecto

$zip = new ZipArchive();
if ($zip->open($backup_file, ZipArchive::CREATE) === TRUE) {
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root_folder));
    foreach ($files as $file) {
        if (!$file->isDir()) {
            $zip->addFile($file->getRealPath(), str_replace($root_folder . '/', '', $file->getRealPath()));
        }
    }
    $zip->close();
    echo json_encode(["success" => "Respaldo de archivos realizado con éxito: $backup_file"]);
} else {
    echo json_encode(["error" => "Error al crear el respaldo"]);
}
?>
