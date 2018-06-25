<?php

namespace App\Controllers;

use App\Extend\Controller as Controller;
use App\Models\User;

class Users extends Controller
{
    private $user = null;
    
    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
    }
    
    public function index()
    {
        $data['title'] = 'Users';
        $data['users'] = $this->user->getAll();
        $this->view->forge('users/index', $data);
    }
   
    public function create()
    {
        if($this->input->method() === 'POST')
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            if( ! filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $data['error'][] = 'Invalid email address.';
            }
            if(count($data['error']) == 0)
            {
                $this->user->create($username, $password, $email);
            }
        }
        $data['title'] = 'Create new account';
        $this->view->forge('users/create', $data);
    }
   
    public function edit(int $id) // gives error on PHP 5 works on PHP 7
    {
        $data['user'] = $this->user->findId($id);
        if(empty($data['user']))
        {
            header('Location: /users');
        }
        if($this->input->method() === 'POST')
        {
            $data['error'][] = 'TODO';
        }
        $this->view->forge('users/edit', $data);
    }
}
