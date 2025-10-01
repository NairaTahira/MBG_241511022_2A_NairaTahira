<?php 
namespace App\Controllers;
use App\Models\RecordsModel;

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
        $name  = $this->request->getPost('name');
        $email = $this->request->getPost('email');

        $studentModel = new \App\Models\StudentModel();

        // Check if student already exists
        if ($studentModel->where('email', $email)->first()) {
            return redirect()->to('/register')->with('error', 'Email already registered!');
        }

        // Use NIM as password For Students
        $studentModel->insert([
            'name'          => $name,
            'email'         => $email,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        return redirect()->to('/login')->with('success', 'Account created! You can now log in.');
    }


    public function checkLogin()
    {
        $username = strtolower($this->request->getPost('name'));
        $password = $this->request->getPost('password');    

        $model = new RecordsModel();

        // Admin login rule
        if (strpos($username, 'gudangA') !== false && $password === 'gudang.a') {
            session()->set([
                'isLoggedIn' => true,
                'name'   => $name,
                'role'       => 'gudang'
            ]);
            return redirect()->to('/home');   // send admin to courses
        }

        // 
        $studentModel = new \App\Models\StudentModel();
        $user = $studentModel->where('email', $username)
                            ->orWhere('name', $username)
                            ->first();

        if ($user && password_verify($password, $user['password_hash'])) {
            session()->set([
                'isLoggedIn' => true,
                'user_id'    => $user['id'],
                'username'   => $user['name'],
                'role'       => 'student'
            ]);
            return redirect()->to('/home');
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
