<?php
namespace App\Models;

use Core\Classes\Model as Model;

class Product extends Model
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
}
