<?php

namespace App\Controllers;

use Core\Authenticator;
use Core\Csrf;
use Core\Session;
use Http\Forms\LoginForm;

class AuthController
{

    public function showLogin()
    {
        return view('user/login.php');
    }

    public function login()
    {
        if (!Csrf::verify($_POST['_csrf_token'] ?? null)) {
            Session::flash('errors', ['identity' => 'Sesi keamanan telah kadaluarsa. Silakan coba lagi.']);
            return redirect('/login');
        }

        $identity = trim($_POST['identity'] ?? $_POST['username'] ??  '');
        $password = $_POST['password'] ?? '';

        $form = LoginForm::validate([
            'identity' => $identity,
            'password' => $password,
        ]);

        $signedIn = (new Authenticator())->attempt($identity, $password);

        if (!$signedIn) {
            $form->error('identity', 'Username Pengurus atau kata sandi yang Anda masukkan salah.')->throw();
        }

        Session::flash('sukses', 'Selamat datang kembali di Portal Ruang Warga 021!');
        redirect('/dashboard');
    }

    public function logout()
    {
        (new Authenticator())->logout();
        redirect('/');
    }
}
