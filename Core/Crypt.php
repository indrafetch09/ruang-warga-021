<?php

namespace Core;

use Exception;

class Crypt
{
    // Ganti dengan key rahasia lu, minimal 32 karakter (256 bit).
    // Idealnya ambil dari file konfigurasi atau .env
    private const DEFAULT_KEY = 'SistemInformasiRW21-RahasiaSuper';
    private const CIPHER_ALGO = 'AES-256-CBC';

    /**
     * Mengenkripsi data (teks biasa) menjadi string acak (ciphertext).
     * Cocok untuk mengamankan NIK atau Nomor HP di Database.
     *
     * @param string $data Data yang mau dienkripsi
     * @param string|null $key Kunci opsional (jika null, pakai default)
     * @return string Data terenkripsi dalam format Base64
     * @throws Exception
     */
    public static function encrypt(string $data, ?string $key = null): string
    {
        $key = $key ?? self::DEFAULT_KEY;

        // 1. Generate IV (Initialization Vector) acak biar hasil enkripsi selalu unik
        $ivLength = openssl_cipher_iv_length(self::CIPHER_ALGO);
        $iv = openssl_random_pseudo_bytes($ivLength);

        // 2. Proses Enkripsi
        $encrypted = openssl_encrypt($data, self::CIPHER_ALGO, $key, 0, $iv);

        if ($encrypted === false) {
            throw new Exception('Gagal melakukan enkripsi data.');
        }

        // 3. Gabungkan IV dan Encrypted Data, lalu jadikan Base64 agar aman masuk DB
        $payload = base64_encode($iv . $encrypted);

        return $payload;
    }

    /**
     * Mendekripsi string acak kembali menjadi data teks asli.
     *
     * @param string $payload Data Base64 yang sudah dienkripsi
     * @param string|null $key Kunci opsional
     * @return string|false Teks asli, atau false jika gagal dekripsi
     */
    public static function decrypt(string $payload, ?string $key = null)
    {
        $key = $key ?? self::DEFAULT_KEY;

        // 1. Decode dari Base64
        $rawPayload = base64_decode($payload);

        if ($rawPayload === false) {
            return false; // Payload tidak valid
        }

        $ivLength = openssl_cipher_iv_length(self::CIPHER_ALGO);

        // 2. Ekstrak IV dan Data Terenkripsi
        $iv = substr($rawPayload, 0, $ivLength);
        $encrypted = substr($rawPayload, $ivLength);

        if (strlen($iv) !== $ivLength) {
            return false; // IV tidak sesuai (data mungkin corrupt/diubah)
        }

        // 3. Proses Dekripsi
        $decrypted = openssl_decrypt($encrypted, self::CIPHER_ALGO, $key, 0, $iv);

        return $decrypted;
    }
}
