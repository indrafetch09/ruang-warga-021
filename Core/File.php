<?php

namespace Core;

class File
{
    public static function upload($fileInputName, $destinationFolder, $allowedTypes = [])
    {
        if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        $file = $_FILES[$fileInputName];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!empty($allowedTypes) && !in_array($ext, $allowedTypes)) {
            throw new \Exception("Tipe file tidak diizinkan.");
        }

        // Bikin nama file unik biar gak bentrok
        $filename = uniqid() . '-' . time() . '.' . $ext;
        $targetPath = base_path($destinationFolder . '/' . $filename);

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return $filename; // return nama filenya aja buat disimpen ke DB
        }

        return false;
    }
}
