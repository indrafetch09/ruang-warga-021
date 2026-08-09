<?php

namespace Core;

use PDO;

class Database
{
    public $connection;
    public $statement;

    public function __construct($config, $username = 'root', $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);

        // Binding parameter satu per satu dengan deteksi tipe data otomatis
        foreach ($params as $key => $value) {
            
            // 1. Cek tipe data otomatis
            if (is_int($value)) {
                $type = PDO::PARAM_INT;
            } elseif (is_bool($value)) {
                $type = PDO::PARAM_BOOL;
            } elseif (is_null($value)) {
                $type = PDO::PARAM_NULL;
            } else {
                $type = PDO::PARAM_STR;
            }

            // 2. Tentukan format key
            // Jika array angka [10, 0] (posisi '?'), PDO butuh urutan mulai dari 1 (1, 2, 3...)
            // Jika array asosiatif ['limit' => 10], dipastikan ada titik dua (:limit)
            $paramKey = is_int($key) 
                ? $key + 1 
                : (str_starts_with($key, ':') ? $key : ':' . $key);

            // 3. Bind value dengan tipe data yang pas
            $this->statement->bindValue($paramKey, $value, $type);
        }

        // Eksekusi tanpa melempar array lagi di dalam execute()
        $this->statement->execute();

        return $this;
    }

    public function get()
    {
        return $this->statement->fetchAll();
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();

        if (! $result) {
            abort();
        }

        return $result;
    }
}
