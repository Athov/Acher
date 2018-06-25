<?php
namespace App\Models;

use Core\Classes\Model;

class Picture extends Model
{
    public function getAll()
    {
        $query = $this->db->query('SELECT * FROM images ORDER BY added_on DESC');
        return $query->fetchAll();
    }

    public function getTop12()
    {
        $query = $this->db->query('SELECT * FROM images ORDER BY added_on DESC LIMIT 12');
        return $query->fetchAll();
    }

    public function findId($id)
    {
        $query = $this->db->prepare("SELECT * FROM images WHERE id = ? LIMIT 1");
        $query->execute([$id]);
        return $query->fetch();
    }
}
