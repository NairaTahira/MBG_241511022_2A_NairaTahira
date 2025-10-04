<?php 
namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function storeRegister()
    {
        $userModel = new UserModel();

        $name     = $this->request->getPost('name');
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role     = $this->request->getPost('role'); // gudang(admin) / dapur(client)

        // Check if student already exists
        if ($userModel->where('email', $email)->first()) {
            return redirect()->to('/register')->with('error', 'Email already registered!');
        }

        $userModel->insert([
            'name'     => $name,
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role'     => $role,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/login')->with('success', 'Account created! You can now log in.');
    }


    public function checkLogin()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password'); 

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'isLoggedIn' => true,
                'user_id'    => $user['id'],
                'username'   => $user['name'],
                'role'       => $user['role']
            ]);
        
            // Redirect based on role
            if ($user['role'] === 'gudang') {
                return redirect()->to('/home');
            } else {
                return redirect()->to('/home');
            }
        }

        return redirect()->to('/login')->with('error', 'Username atau Password salah!');
    }

    public function logout()
    {
        session()->destroy();

        helper('cookie');
        delete_cookie('ci_session'); 

        return redirect()->to('/login');
    }
}
