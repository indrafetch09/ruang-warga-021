<?php

namespace App\Controllers;

use Core\App;
use Core\Database;
use Core\Session;
use Core\Authenticator;
use App\Models\User;

class PengaturanController
{
    /**
     * Tampilkan Halaman Pengaturan Sistem & Manajemen Akun
     */
    public function index()
    {
        $db = App::resolve(Database::class);
        $user = User::current();

        // Ambil data user lengkap dari database
        $userData = $db->query(
            'SELECT id, username, email, role, rt_assigned, created_at FROM users WHERE id = :id LIMIT 1',
            ['id' => $user->id]
        )->find() ?? [
            'id'          => $user->id,
            'username'    => $user->username ?? 'admin',
            'email'       => $user->email ?? 'admin@ruangwarga021.id',
            'role'        => $user->role ?? 'admin',
            'rt_assigned' => $user->rt_assigned ?? null,
        ];

        // Jika user adalah Super Admin, ambil seluruh daftar akun pengurus untuk dimanage
        $allUsers = [];
        if ($user->isAdmin()) {
            $allUsers = $db->query(
                'SELECT id, username, email, role, rt_assigned, created_at FROM users ORDER BY role ASC, rt_assigned ASC, username ASC'
            )->get();
        }

        return view('admin/pengaturan.php', [
            'user'     => $user,
            'userData' => $userData,
            'allUsers' => $allUsers,
        ]);
    }

    /**
     * Perbarui Profil Akun Sendiri (Username & Email)
     */
    public function updateProfile()
    {
        $db = App::resolve(Database::class);
        $user = User::current();

        $username = trim($_POST['username'] ?? '');
        $email    = trim($_POST['email'] ?? '');

        $errors = [];

        if (empty($username)) {
            $errors['username'] = 'Username tidak boleh kosong.';
        } elseif (strlen($username) < 3) {
            $errors['username'] = 'Username minimal 3 karakter.';
        }

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Format email tidak valid.';
        }

        // Cek duplikasi username untuk user lain
        $existingUser = $db->query(
            'SELECT id FROM users WHERE username = :username AND id != :id LIMIT 1',
            ['username' => $username, 'id' => $user->id]
        )->find();

        if ($existingUser) {
            $errors['username'] = 'Username sudah digunakan oleh akun lain.';
        }

        // Cek duplikasi email untuk user lain
        $existingEmail = $db->query(
            'SELECT id FROM users WHERE email = :email AND id != :id LIMIT 1',
            ['email' => $email, 'id' => $user->id]
        )->find();

        if ($existingEmail) {
            $errors['email'] = 'Email sudah terdaftar pada akun lain.';
        }

        if (!empty($errors)) {
            Session::flash('errors', $errors);
            Session::flash('old', ['username' => $username, 'email' => $email]);
            redirect('/admin/pengaturan');
        }

        $db->query(
            'UPDATE users SET username = :username, email = :email WHERE id = :id',
            [
                'username' => $username,
                'email'    => $email,
                'id'       => $user->id,
            ]
        );

        // Perbarui sesi aktif
        if (isset($_SESSION['user'])) {
            $_SESSION['user']['username'] = $username;
            $_SESSION['user']['email']    = $email;
        }

        Session::flash('sukses', 'Profil akun berhasil diperbarui.');
        redirect('/admin/pengaturan');
    }

    /**
     * Ganti Kata Sandi Akun Sendiri
     */
    public function updatePassword()
    {
        $db = App::resolve(Database::class);
        $user = User::current();

        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword     = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        $errors = [];

        if (empty($currentPassword)) {
            $errors['current_password'] = 'Kata sandi saat ini wajib diisi.';
        }

        if (empty($newPassword)) {
            $errors['new_password'] = 'Kata sandi baru wajib diisi.';
        } elseif (strlen($newPassword) < 6) {
            $errors['new_password'] = 'Kata sandi baru minimal 6 karakter.';
        }

        if ($newPassword !== $confirmPassword) {
            $errors['confirm_password'] = 'Konfirmasi kata sandi baru tidak cocok.';
        }

        if (empty($errors)) {
            // Ambil hash password saat ini dari DB
            $dbUser = $db->query('SELECT password FROM users WHERE id = :id LIMIT 1', ['id' => $user->id])->find();

            if (!$dbUser || !password_verify($currentPassword, $dbUser['password'])) {
                $errors['current_password'] = 'Kata sandi saat ini yang Anda masukkan salah.';
            }
        }

        if (!empty($errors)) {
            Session::flash('errors', $errors);
            redirect('/admin/pengaturan#keamanan');
        }

        // Hash dan simpan password baru
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $db->query(
            'UPDATE users SET password = :password WHERE id = :id',
            [
                'password' => $hashedPassword,
                'id'       => $user->id,
            ]
        );

        Session::flash('sukses', 'Kata sandi berhasil diperbarui! Silakan gunakan kata sandi baru Anda.');
        redirect('/admin/pengaturan#keamanan');
    }

    /**
     * Reset Kata Sandi User Lain (Khusus Super Admin)
     */
    public function resetUserPassword()
    {
        $user = User::current();

        if (!$user->isAdmin()) {
            Session::flash('errors', ['Hanya Super Admin yang berhak mereset kata sandi akun pengurus lain.']);
            redirect('/admin/pengaturan');
        }

        $targetUserId = (int)($_POST['target_user_id'] ?? 0);
        $newPassword  = $_POST['target_new_password'] ?? '';

        if ($targetUserId <= 0) {
            Session::flash('errors', ['Pengguna target tidak valid.']);
            redirect('/admin/pengaturan#kelola-akun');
        }

        if (empty($newPassword) || strlen($newPassword) < 6) {
            Session::flash('errors', ['Kata sandi reset minimal 6 karakter.']);
            redirect('/admin/pengaturan#kelola-akun');
        }

        $db = App::resolve(Database::class);

        $targetUser = $db->query('SELECT id, username, role FROM users WHERE id = :id LIMIT 1', ['id' => $targetUserId])->find();
        if (!$targetUser) {
            Session::flash('errors', ['Data pengguna tidak ditemukan.']);
            redirect('/admin/pengaturan#kelola-akun');
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $db->query(
            'UPDATE users SET password = :password WHERE id = :id',
            [
                'password' => $hashedPassword,
                'id'       => $targetUserId,
            ]
        );

        Session::flash('sukses', "Kata sandi akun '{$targetUser['username']}' berhasil direset menjadi yang baru.");
        redirect('/admin/pengaturan#kelola-akun');
    }
}
