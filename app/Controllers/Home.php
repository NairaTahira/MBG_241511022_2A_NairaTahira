<?php
namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Home',
            'content' => view('home/index')
        ];
        return view('view_template_01', $data);
    }
}
