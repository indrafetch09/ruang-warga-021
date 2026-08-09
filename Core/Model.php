<?php

namespace Core;

abstract class Model
{
    protected static $table;
    public $attributes = [];
    public $relations = [];

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    // Magic method: Akses kolom database jadi properti objek ($warga->nama)
    // Dan memicu LAZY LOADING
    public function __get($key)
    {
        // 1. Cek apakah ada di atribut database
        if (array_key_exists($key, $this->attributes)) {
            return $this->attributes[$key];
        }

        // 2. LAZY LOADING: Cek apakah ada method relasi dengan nama tersebut
        if (method_exists($this, $key)) {
            // Cache hasil relasi biar gak query ke database berulang kali
            if (!array_key_exists($key, $this->relations)) {
                $this->relations[$key] = $this->$key(); // Eksekusi method relasi
            }
            return $this->relations[$key];
        }

        return null;
    }

    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    // -----------------------------------------------------------------
    // FUNGSI RELASI
    // -----------------------------------------------------------------

    // Relasi One-to-Many (Contoh: Warga punya banyak PengajuanLayanan)
    protected function hasMany($relatedModel, $foreignKey, $localKey = 'id')
    {
        $db = App::resolve(Database::class);
        $localValue = $this->attributes[$localKey] ?? null;

        if (!$localValue) return [];

        $table = $relatedModel::$table;
        $results = $db->query("SELECT * FROM {$table} WHERE {$foreignKey} = :id", ['id' => $localValue])->get();

        return array_map(fn($row) => new $relatedModel($row), $results);
    }

    // Relasi Belongs-To / Many-to-One (Contoh: PengajuanLayanan milik Warga)
    protected function belongsTo($relatedModel, $foreignKey, $ownerKey = 'id')
    {
        $db = App::resolve(Database::class);
        $foreignValue = $this->attributes[$foreignKey] ?? null;

        if (!$foreignValue) return null;

        $table = $relatedModel::$table;
        $result = $db->query("SELECT * FROM {$table} WHERE {$ownerKey} = :id", ['id' => $foreignValue])->find();

        return $result ? new $relatedModel($result) : null;
    }

    // -----------------------------------------------------------------
    // HELPER QUERY DASAR
    // -----------------------------------------------------------------
    public static function all()
    {
        $db = App::resolve(Database::class);
        $table = static::$table;
        $results = $db->query("SELECT * FROM {$table}")->get();
        return array_map(fn($row) => new static($row), $results);
    }

    public static function find($id)
    {
        $db = App::resolve(Database::class);
        $table = static::$table;
        $result = $db->query("SELECT * FROM {$table} WHERE id = :id", ['id' => $id])->find();
        return $result ? new static($result) : null;
    }

    // -----------------------------------------------------------------
    // EAGER LOADING NATIVE (Menghindari N+1 Query Problem)
    // -----------------------------------------------------------------
    public static function with($models, $relationName, $relatedModel, $foreignKey, $type = 'hasMany', $localKey = 'id')
    {
        if (empty($models)) return $models;

        $db = App::resolve(Database::class);
        $table = $relatedModel::$table;

        // 1. Kumpulkan semua ID Utama (untuk query IN)
        $ids = array_map(function($model) use ($type, $localKey, $foreignKey) {
            return $type === 'hasMany' ? $model->attributes[$localKey] : $model->attributes[$foreignKey];
        }, $models);

        $ids = array_values(array_unique(array_filter($ids)));
        if (empty($ids)) return $models;

        // 2. Hit ke Database HANYA 1 KALI (WHERE IN)
        $inClause = implode(',', array_fill(0, count($ids), '?'));
        $keyToMatch = $type === 'hasMany' ? $foreignKey : $localKey;
        
        $results = $db->query("SELECT * FROM {$table} WHERE {$keyToMatch} IN ($inClause)", $ids)->get();

        // 3. Kelompokkan Data Relasi
        $dictionary = [];
        foreach ($results as $row) {
            $obj = new $relatedModel($row);
            if ($type === 'hasMany') {
                $dictionary[$row[$keyToMatch]][] = $obj;
            } else {
                $dictionary[$row[$keyToMatch]] = $obj;
            }
        }

        // 4. Suntikkan (Inject) ke Property Object Utama
        foreach ($models as $model) {
            $matchId = $type === 'hasMany' ? $model->attributes[$localKey] : $model->attributes[$foreignKey];
            
            if ($type === 'hasMany') {
                $model->relations[$relationName] = $dictionary[$matchId] ?? [];
            } else {
                $model->relations[$relationName] = $dictionary[$matchId] ?? null;
            }
        }

        return $models; // Return array of objects yang sudah terisi relasinya
    }

    public function delete()
    {
        $id = $this->attributes['id'] ?? null;
        if (!$id) return false;

        $db = App::resolve(Database::class);
        $table = static::$table;

        $db->query("DELETE FROM {$table} WHERE id = :id", ['id' => $id]);
        
        return true;
    }

    // -----------------------------------------------------------------
    // 2. WHERE CLAUSE (Filter Data)
    // -----------------------------------------------------------------
    public static function where($column, $value, $operator = '=')
    {
        $db = App::resolve(Database::class);
        $table = static::$table;

        $results = $db->query(
            "SELECT * FROM {$table} WHERE {$column} {$operator} :val", 
            ['val' => $value]
        )->get();

        return array_map(fn($row) => new static($row), $results);
    }

    // -----------------------------------------------------------------
    // 3. PAGINATION (Sistem Halaman)
    // -----------------------------------------------------------------
    public static function paginate($perPage = 10, $page = 1)
    {
        $db = App::resolve(Database::class);
        $table = static::$table;

        // Hitung total record di database
        $total = $db->query("SELECT COUNT(*) as total FROM {$table}")->find()['total'] ?? 0;

        // Hitung offset limit
        $offset = max(0, ($page - 1) * $perPage);

        // Fetch data sesuai limit & offset
        $results = $db->query(
            "SELECT * FROM {$table} LIMIT :per_page OFFSET :offset", 
            [
                'per_page' => (int) $perPage,
                'offset' => (int) $offset
            ]
        )->get();

        return [
            'data' => array_map(fn($row) => new static($row), $results),
            'total' => (int) $total,
            'per_page' => (int) $perPage,
            'current_page' => (int) $page,
            'last_page' => ceil($total / $perPage)
        ];
    }

     public static function create($attributes)
    {
        $db = App::resolve(Database::class);
        $table = static::$table;

        $columns = implode(', ', array_keys($attributes));
        $placeholders = ':' . implode(', :', array_keys($attributes));

        $db->query("INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})", $attributes);

        // Ambil instance data yang baru saja di-insert
        $id = $db->connection->lastInsertId();
        return static::find($id);
    }

    // Hitung Total Baris
    public static function count()
    {
        $db = App::resolve(Database::class);
        $table = static::$table;

        $result = $db->query("SELECT COUNT(*) as total FROM {$table}")->find();
        return (int)($result['total'] ?? 0);
    }

    // Ambil Data Terbaru dengan Limit
    public static function latest($limit = 5, $column = 'created_at')
    {
        $db = App::resolve(Database::class);
        $table = static::$table;

        $results = $db->query("SELECT * FROM {$table} ORDER BY {$column} DESC LIMIT :limit", [
            'limit' => (int)$limit
        ])->get();

        return array_map(fn($row) => new static($row), $results);
    }

}
