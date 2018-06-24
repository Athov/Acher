<?php
namespace App\Models;

use Core\Classes\Model as Model;

class User extends Model
{
    public function getAll()
    {
        $query = $this->db->query('SELECT * FROM users');
        return $query->fetchAll();
    }
    
    public function findId($id)
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
        $query->execute([$id]);
        return $query->fetch();
    }

    public function create($username, $password, $email)
    {
        $data = array(
            'username' => $username,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'email' => $email,
            'is_admin' => 0,
            'added_on' => time()
        );
        $this->db->prepare("INSERT INTO `users` (`username`, `password`, `email`, `is_admin`, `added_on`) VALUES (:username, :password, :email, :is_admin, :added_on)")
                    ->execute($data);
    }
}
